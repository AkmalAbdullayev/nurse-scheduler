<?php

namespace App\Services\Admin;

use App\Enums\CallOutStatuses;
use App\Events\Admin\CallOutChanged;
use App\Events\Admin\CallOutCreated;
use App\helpers\Facades\Twilio;
use App\helpers\Repositories\CallOutRepository;
use App\helpers\Repositories\NurseRepository;
use App\Jobs\FloatNurse\SendCallOutSms;
use App\Models\CallOut;
use App\Models\History;
use App\Models\Nurse;
use App\Models\School;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use JetBrains\PhpStorm\ArrayShape;

class CallOutService
{
    public function __construct(
        private readonly CallOutRepository $callOutRepository,
        private readonly NurseRepository   $nurseRepository,
    )
    {
    }

    #[ArrayShape([
        'school' => "mixed",
        'nurse' => "mixed",
        'dates' => "string[]"
    ])]
    public function confirm(array $request): array
    {
        $nurse = array_key_exists('nurse_id', $request) ? $this->nurseRepository->find($request['nurse_id']) : null;
        $school = School::query()->findOrFail($request['school_id']);

        $dates = explode(',', $request['date']);
        sort(array: $dates);

        return [
            'school' => $school,
            'nurse' => $nurse,
            'dates' => $dates
        ];
    }

    public function store(array $request, int $createdById): void
    {
        $dates = collect();
        $callOuts = collect();
        $school = School::query()->find($request['school_id']);

        foreach ($request['dates_from'] as $date_from) {
            $callOuts->push(CallOut::query()->create([
                'nurse_id' => array_key_exists('nurse_id', $request) ? $request['nurse_id'] : null,
                'school_id' => $request['school_id'],
                'from' => $date_from,
                'to' => $request['dateTo'] ?? null,
                'status' => CallOutStatuses::PENDING_ACCEPTANCE->value,
                'created_by_id' => $createdById,
                'created_by_role' => 'Admin',
            ]));

            $dates->push(Carbon::parse($date_from)->format('F j, Y'));
        }

        if (array_key_exists('nurse_id', $request)) {
            /** @var Nurse $nurse */
            $nurse = $this->nurseRepository->find($request['nurse_id']);

            activity()
                ->useLog('Nurses')
                ->performedOn($nurse)
                ->withProperties(['attributes' => $nurse])
                ->log('Call out Created for ' . $dates->implode(', '));

            $nurse->assigned_date = collect($request['dates_from'])->last();
            $nurse->saveQuietly();

            CallOutCreated::dispatch($nurse, $request['dates_from']);
        } else {
            $nurses = Nurse::query()->active()->floatNurses()->get();
            $fullTimeFloatNurses = $nurses->where('role_id', '=', 3);
            $floatNurses = $nurses->where('role_id', '=', 4);

            CallOutCreated::dispatch($fullTimeFloatNurses, $request['dates_from']);
            SendCallOutSms::dispatch($floatNurses, $request['dates_from'], $callOuts)
                ->delay(now()->addMinutes(45));
        }

        activity()
            ->useLog('Schools')
            ->performedOn($school)
            ->withProperties(['attributes' => $school])
            ->log('Call out Created for ' . $dates->implode(', '));
    }

    /**
     * @param int $id
     * @return array
     */
    #[ArrayShape(['nurses' => "mixed", 'callOut' => "\App\Models\CallOut"])]
    public function show(int $id): array
    {
        /* @var CallOut $callOut */
        $callOut = CallOut::query()
            ->with([
                'school' => function ($query) {
                    return $query->with(['borough', 'state', 'medical_needs', 'school_principal', 'nurses']);
                },
                'nurse' => function ($query) {
                    return $query->with('borough');
                }
            ])
            ->findOrFail($id);

        $nurses = Nurse::query()
            ->with([
                'role' => function ($query) {
                    return $query->whereIn('name', ['Float Nurse', 'Full Time Float Nurse']);
                },
                'call_outs'
            ])
            ->whereDoesntHave('call_outs', function ($query) use ($callOut) {
                return $query->where('from', '=', $callOut->from);
            })
            ->active()
            ->get();

        return [
            'nurses' => $nurses,
            'callOut' => $callOut
        ];
    }

    public function update(array $request, int $id): array
    {
        /** @var CallOut $callOut */
        $callOut = $this->callOutRepository->find($id);

        if ($callOut->status == CallOutStatuses::ACCEPTED) {
            return [
                'message' => 'Call-out is already accepted!!!',
                'value' => false
            ];
        }

        $request['status'] = CallOutStatuses::PENDING_ACCEPTANCE;
        $request['time_of_arrival'] = null;

        if ($callOut->update($request)) {
            $callOutDate = $callOut->from->format('m.d.Y');

            activity()
                ->useLog('Schools')
                ->performedOn($callOut->school)
                ->withProperties(['attributes' => $callOut->school])
                ->log("Call-out for $callOutDate was reassigned");

            if ($callOut->created_by_role === 'Perm School Nurse') {
                $nurse = Nurse::query()->find($callOut->created_by_id);
                activity()
                    ->useLog('Nurses')
                    ->performedOn($nurse)
                    ->withProperties(['attributes' => $callOut->nurse])
                    ->log("Call-out for $callOutDate was reassigned");
            }

            if (!is_null($callOut->nurse)) {
                activity()
                    ->useLog('Nurses')
                    ->performedOn($callOut->nurse)
                    ->withProperties(['attributes' => $callOut->nurse])
                    ->log("Call-out for $callOutDate was reassigned");

                Twilio::send(
                    cell_number: $callOut->nurse->cell_number,
                    body: "You have been removed from call-out for $callOutDate."
                );
            }

            CallOutChanged::dispatchIf($callOut->wasChanged(['nurse_id']), $id);

            return [
                'message' => 'Call-out successfully updated!!!',
                'value' => true
            ];
        }

        return [
            'message' => 'Error while updating call-out',
            'value' => false
        ];
    }

    /**
     * @param Request $request
     * @param int $id
     * @return bool
     */
    public function destroy(Request $request, int $id): bool
    {
        /** @var CallOut $callOut */
        $callOut = $this->callOutRepository->find($id);

        if ($callOut->status == CallOutStatuses::ACCEPTED->value) {
            return false;
        }

        $callOut->status = CallOutStatuses::CANCELLED->value;
        $callOut->save();

        if ($callOut->delete()) {
            $callOutDate = $callOut->from->format('m.d.Y');

            activity()
                ->useLog('Schools')
                ->performedOn($callOut->school)
                ->withProperties(['attributes' => $callOut->school])
                ->log("Call-out canceled for $callOutDate");

            if (!is_null($callOut->nurse)) {
                $schoolName = $callOut->school->school_name;

                if ($callOut->created_by_role === 'Perm School Nurse') {
                    $nurse = Nurse::query()->find($callOut->created_by_id);
                    activity()
                        ->useLog('Nurses')
                        ->performedOn($nurse)
                        ->withProperties(['attributes' => $callOut->nurse])
                        ->log("Call-out canceled for $callOutDate");
                }

                activity()
                    ->useLog('Nurses')
                    ->performedOn($callOut->nurse)
                    ->withProperties(['attributes' => $callOut->nurse])
                    ->log("Call-out canceled for $callOutDate for " . $callOut->school->school_name);

                Twilio::send(
                    cell_number: $callOut->nurse->cell_number,
                    body: "Call-out for $callOutDate $schoolName was canceled."
                );
            }
            return true;
        }
        return false;
    }
}
