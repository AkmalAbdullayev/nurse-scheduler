<?php

namespace App\Http\Controllers\SchoolNurse;

use App\Enums\CallOutStatuses;
use App\Events\SchoolNurse\CallOutCreated;
use App\Http\Controllers\Controller;
use App\Models\BoroughNurse;
use App\Models\CallOut;
use App\Models\Nurse;
use App\Models\School;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CallOutController extends Controller
{
    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        /** @var Nurse $schoolNurse */
        $authUser = auth()->user()->nurse;
        $schoolNurse = Nurse::query()
            ->with(['schools', 'call_outs', 'desired_boroughs', 'subject'])
            ->find($authUser->id);

        $callOuts = CallOut::query()
            ->with(['school', 'nurse'])
            ->where('created_by_id', '=', $authUser->id)
            ->select([
                'school_id',
                'nurse_id',
                'status',
                'confirmed',
                'to',
                'from',
                DB::raw("to_char(\"from\", 'YYYY-mm-dd') as date_from"),
            ])
            ->get()
            ->sortBy('date_from')
            ->groupBy(function ($data) {
                return Carbon::parse($data->date_from)->format('F Y');
            });

        return view('school-nurse.index', compact('schoolNurse', 'callOuts'));
    }

    /**
     * @param Request $request
     * @param int $schoolId
     * @return View|Factory|Application
     */
    public function registerCallOut(Request $request, int $schoolId): View|Factory|Application
    {
        $authUser = auth()->user()->nurse;
        $schoolNurse = Nurse::query()
            ->with(['schools', 'call_outs', 'desired_boroughs'])
            ->find($authUser->id);

        $school = School::query()->findOrFail($schoolId);

        return \view('school-nurse.register-call-out', compact('school', 'schoolNurse'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'dates' => ['string', 'required']
        ]);

        /** @var Nurse $schoolNurse */
        $authUser = auth()->user()->nurse;
        $schoolNurse = Nurse::query()
            ->with(['schools', 'call_outs', 'desired_boroughs'])
            ->find($authUser->id);

        $callOuts = collect();

        $desiredBoroughs = collect();
        $desiredBoroughs->push($schoolNurse->desired_boroughs->map->id);

        $boroughNurse = BoroughNurse::query()
            ->whereHas('nurse', function ($query) {
                return $query->where('role_id', '=', 3)
                    ->orWhere('role_id', '=', 4);
            })
            ->where('nurse_id', '!=', $schoolNurse->id)
            ->orWhereIn('borough_id', $desiredBoroughs->values()->all()[0])
            ->get()
            ->groupBy(function ($data) {
                return $data->nurse_id;
            });

        $logDates = collect();
        $dates = explode(',', $request->input('dates'));
        sort(array: $dates);

        foreach ($dates as $date) {
            $logDates->push(Carbon::parse($date)->format('F j, Y'));

            $callOuts->push(CallOut::query()->updateOrCreate([
                'school_id' => $request->input('school_id'),
                'from' => $date,
                'status' => CallOutStatuses::PENDING_ACCEPTANCE->value,
                'created_by_id' => auth()->user()->nurse->id,
                'created_by_str' => auth()->user()->nurse->first_name . " " . auth()->user()->nurse->first_name,
                'created_by_role' => auth()->user()->nurse->role->name
            ], [
                'created_by_id' => auth()->user()->nurse->id,
                'from' => $date,
            ]));
        }

        session()->flash('call-out');

        $school = School::query()->find($request->input('school_id'));
        activity()
            ->useLog('Schools')
            ->performedOn($school)
            ->withProperties(['attributes' => $school])
            ->log('Call out Created for ' . $logDates->implode(','));

        CallOutCreated::dispatch($boroughNurse, $dates, $callOuts);

        return redirect()->route('school-nurse.call-out.index')->with('success');
    }
}
