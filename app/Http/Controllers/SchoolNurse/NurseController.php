<?php

namespace App\Http\Controllers\SchoolNurse;

use App\Actions\Nurse\UpdateAction;
use App\Enums\Boroughs;
use App\helpers\Repositories\NurseRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateNurseRequest;
use App\Models\MedicalNeed;
use App\Models\Nurse;
use App\Models\NurseCredential;
use App\Models\State;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class NurseController extends Controller
{
    public function __construct(
        private readonly NurseRepository $nurseRepository,
        private readonly UpdateAction    $updateAction,
    )
    {
    }

    /**
     * @return Factory|View|Application
     */
    public function profile(): Factory|View|Application
    {
        /** @var Nurse $nurse */
        $nurse = $this->nurseRepository->getNurseByUserId(auth()->id());

        $credentials = NurseCredential::query()->get();
        $boroughs = Boroughs::values();
        $states = State::query()->get();
        $medicalNeeds = MedicalNeed::query()->get();

        return view('school-nurse.profile', compact(
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

        $this->updateAction->handle($request->validated(), $nurse);

        return redirect()->route('school-nurse.call-out.index')->with('message', 'Successfully updated');
    }
}
