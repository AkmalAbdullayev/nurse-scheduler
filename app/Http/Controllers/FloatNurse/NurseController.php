<?php

namespace App\Http\Controllers\FloatNurse;

use App\Actions\Nurse\UpdateAction;
use App\Enums\Boroughs;
use App\Enums\CallOutStatuses;
use App\helpers\Repositories\NurseRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateNurseRequest;
use App\Models\CallOut;
use App\Models\MedicalNeed;
use App\Models\Nurse;
use App\Models\NurseCredential;
use App\Models\State;
use App\Services\FloatNurse\CallOutService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NurseController extends Controller
{
    /**
     * @param CallOutService $service
     * @param NurseRepository $nurseRepository
     * @param UpdateAction $updateAction
     */
    public function __construct(
        private readonly CallOutService  $service,
        private readonly NurseRepository $nurseRepository,
        private readonly UpdateAction    $updateAction,
    )
    {
    }

    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $authNurse = auth()->user()->nurse;

        /** @var Nurse $nurse */
        $nurse = $authNurse->with(['call_outs.school.borough', 'desired_boroughs'])
            ->find($authNurse->id);

        $availableCallOuts = CallOut::query()
            ->with(['school'])
            ->whereHas('school', function ($query) {
                return $query->where('is_active', '=', 1);
            })
            ->orderBy('from')
            ->get();

        return view('float-nurse.float', compact('nurse', 'availableCallOuts'));
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Application|Factory|View|RedirectResponse
     */
    public function pick(Request $request, int $id): Application|Factory|View|RedirectResponse
    {
        $authNurse = auth()->user()->nurse;

        /** @var Nurse $nurse */
        $nurse = $authNurse->with(['call_outs.school.borough', 'desired_boroughs'])
            ->find($authNurse->id);

        /** @var CallOut $currentCallOut */
        $currentCallOut = CallOut::query()
            ->with(['school.medical_needs'])
            ->findOrFail($id);

        if ($currentCallOut->status == CallOutStatuses::ACCEPTED) {
            return redirect()->route('float-nurse.call-out.index')
                ->with('accepted_call-out', 'Huh, this call-out was already taken by someone else.');
        }

        return view('float-nurse.pick', compact(
            'nurse',
            'currentCallOut'
        ));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function confirm(Request $request): RedirectResponse
    {
        $request->validate([
            'time_of_arrival' => ['required', 'string']
        ]);

        $authNurse = auth()->user()->nurse;
        $this->service->confirm($request, $authNurse);

        return redirect()->route('float-nurse.call-out.index');
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(Request $request, int $id): RedirectResponse
    {
        $service = $this->service->cancel($request, $id);

        if ($service) {
            return back()->with('success');
        }

        return back()->with('error');
    }

    public function profile(Request $request): Factory|View|Application
    {
        /** @var Nurse $nurse */
        $nurse = $this->nurseRepository->getNurseByUserId(auth()->id());

        $credentials = NurseCredential::query()->get();
        $boroughs = Boroughs::values();
        $states = State::query()->get();
        $medicalNeeds = MedicalNeed::query()->get();

        return view('float-nurse.profile', compact(
            'nurse',
            'boroughs',
            'states',
            'medicalNeeds',
            'credentials',
        ));
    }

    /**
     * @param UpdateNurseRequest $request
     * @return RedirectResponse
     */
    public function update(UpdateNurseRequest $request): RedirectResponse
    {
        $nurse = $this->nurseRepository->getNurseByUserId(auth()->id());

        $isUpdated = $this->updateAction->handle($request->validated(), $nurse);

        if ($isUpdated['value']) {
            return redirect()->route('float-nurse.call-out.index')->with('message', $isUpdated['message']);
        }

        return back()->withInput()->with('message', $isUpdated['message']);
    }
}
