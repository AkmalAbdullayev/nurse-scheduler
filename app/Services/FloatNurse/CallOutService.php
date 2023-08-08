<?php

namespace App\Services\FloatNurse;

use App\Enums\CallOutStatuses;
use App\helpers\Repositories\CallOutRepository;
use App\Models\CallOut;
use App\Models\History;
use App\Models\Nurse;
use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;

class CallOutService
{
    public function __construct(
        public CallOutRepository $callOutRepository
    )
    {

    }

    /**
     * @param Request $request
     * @param int $id
     * @return bool|null
     */
    public function cancel(Request $request, int $id): bool|null
    {
        /** @var CallOut $callOut */
        $callOut = $this->callOutRepository->find($id);
        $nurse = $callOut->nurse->first_name . " " . $callOut->nurse->mi . " " . $callOut->nurse->last_name;

        $callOut->status = CallOutStatuses::CANCELLED->value;
        $callOut->time_of_arrival = null;

        if ($callOut->save()) {
            $callOutDate = $callOut->from->format('m.d.Y');

            if ($callOut->created_by_role === 'Perm School Nurse') {
                $schoolNurse = Nurse::query()->find($callOut->created_by_id);
                activity()
                    ->useLog('Nurses')
                    ->performedOn($schoolNurse)
                    ->withProperties(['attributes' => $callOut->nurse])
                    ->log("Call-out rejected for $callOutDate by $nurse");
            }

            activity()
                ->useLog('Schools')
                ->performedOn($callOut->school)
                ->withProperties(['attributes' => $callOut->school])
                ->log("Call-out rejected for $callOutDate by $nurse");

            activity()
                ->useLog('Nurses')
                ->performedOn($callOut->nurse)
                ->withProperties(['attributes' => $callOut->nurse])
                ->log("Call-out rejected for $callOutDate by $nurse");

            return true;
        }

        return false;
    }

    /**
     * @param Request $request
     * @param Nurse $nurse
     * @return bool
     */
    public function confirm(Request $request, Nurse $nurse): bool
    {
        /** @var CallOut $callOut */
        $callOut = CallOut::query()->findOrFail($request->input('call_out_id'));

        $callOut->nurse_id = auth()->user()->nurse->id;
        $callOut->status = CallOutStatuses::ACCEPTED->value;
        $callOut->time_of_arrival = $request->input('time_of_arrival');
        $nurse->assigned_date = now();
        $nurse->saveQuietly();

        return $callOut->save();
    }
}
