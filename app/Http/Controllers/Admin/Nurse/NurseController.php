<?php

namespace App\Http\Controllers\Admin\Nurse;

use App\Actions\Nurse\StoreAction;
use App\Actions\Nurse\UpdateAction;
use App\Enums\Boroughs;
use App\Enums\UserRoles;
use App\Exports\NursesExport;
use App\helpers\Repositories\NurseRepository;
use App\helpers\Services\FileManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreNurseRequest;
use App\Http\Requests\Admin\UpdateNurseRequest;
use App\Imports\NursesImport;
use App\Jobs\ProcessFile;
use App\Models\MedicalNeed;
use App\Models\Nurse;
use App\Models\NurseCredential;
use App\Models\State;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class NurseController extends Controller
{
    /**
     * @param NurseRepository $nurseRepository
     * @param StoreAction $storeAction
     * @param UpdateAction $updateAction
     */
    public function __construct(
        private readonly NurseRepository $nurseRepository,
        private readonly StoreAction     $storeAction,
        private readonly UpdateAction    $updateAction,
    )
    {
    }

    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $roles = UserRoles::only([UserRoles::FLOAT_NURSE->value, UserRoles::FULL_TIME_FLOAT_NURSE->value, UserRoles::PERM_SCHOOL_NURSE->value]);
        $boroughs = Boroughs::values();
        $states = State::query()->get();
        $medicalNeeds = MedicalNeed::query()->get();
        $credentials = NurseCredential::query()->get();

        return view('add-nurse', compact('roles', 'states', 'boroughs', 'medicalNeeds', 'credentials'));
    }

    /**
     * @param StoreNurseRequest $request
     * @return RedirectResponse
     */
    public function store(StoreNurseRequest $request): RedirectResponse
    {
        $isUpdated = $this->storeAction->handle($request->validated());

        if ($isUpdated['value']) {
            return redirect()->route('main')->with('message', $isUpdated['message'])->withInput();
        }

        return back()->with('message', $isUpdated['message'])->withInput();
    }

    /**
     * @param int $id
     * @return View|Factory|Application
     */
    public function show(int $id): View|Factory|Application
    {
        /** @var Nurse $nurse */
        $nurse = $this->nurseRepository->find($id);
        $desiredBoroughs = collect();
        $primaryDesiredBoroughs = collect();
        $medicalNeedsCollection = collect();
        $credentials = NurseCredential::query()->get();
        $roles = UserRoles::only([UserRoles::FLOAT_NURSE->value, UserRoles::FULL_TIME_FLOAT_NURSE->value, UserRoles::PERM_SCHOOL_NURSE->value]);
        $nurseCredentials = collect();

        foreach ($nurse->desired_boroughs as $desiredBorough) {
            if ($desiredBorough->pivot->is_primary == 1) {
                $primaryDesiredBoroughs->push($desiredBorough->pivot);
            } else {
                $desiredBoroughs->push($desiredBorough->pivot);
            }
        }

        $boroughs = Boroughs::values();
        $states = State::query()->get();
        $medicalNeeds = MedicalNeed::query()->get();

        foreach ($nurse->medical_needs as $medicalNeed) {
            $medicalNeedsCollection->push($medicalNeed->id);
        }

        $nurse?->credentials->map(fn($item) => $nurseCredentials->push($item))->last();

        return view('views-nurse', compact(
            'nurse',
            'boroughs',
            'states',
            'medicalNeeds',
            'credentials',
            'desiredBoroughs',
            'medicalNeedsCollection',
            'roles',
            'nurseCredentials',
            'primaryDesiredBoroughs'
        ));
    }

    /**
     * @param int $id
     * @param UpdateNurseRequest $request
     * @return RedirectResponse
     */
    public function update(UpdateNurseRequest $request, int $id): RedirectResponse
    {
        /** @var Nurse $nurse */
        $nurse = $this->nurseRepository->find($id);

        $isUpdated = $this->updateAction->handle($request->validated(), $nurse);

        if ($isUpdated['value']) {
            return redirect()->route('main')->with('message', $isUpdated['message']);
        }

        return back()->with('message', $isUpdated['message'])->withInput();
    }

    /**
     * @param int $id
     * @return Redirector|Application|RedirectResponse
     */
    public function destroy(int $id): Redirector|Application|RedirectResponse
    {
        $nurse = $this->nurseRepository->find($id);

        if ($nurse->delete()) {
            return redirect()->intended('/admin')->with('success', 'Nurse successfully deleted');
        }

        return redirect(route('nurses.show', $id));
    }

    /**
     * @return BinaryFileResponse
     */
    public function export(): BinaryFileResponse
    {
        $fileManager = new FileManager(format: 'csv');

        return $fileManager->export(
            class: new NursesExport,
            filename: 'nurse-list-export'
        );
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function import(Request $request): RedirectResponse
    {
        $fileManager = new FileManager();

        $file = $request->file('file');

        match ($file->extension()) {
            'csv' => $fileManager->importCsv(
                class: new NursesImport(),
                filename: $file->storeAs('public', $file->getClientOriginalName())
            ),
            'xlsx' => $fileManager->importXlsx(
                class: new NursesImport(),
                filename: $file->storeAs('public', $file->getClientOriginalName())
            ),
            'xls' => $fileManager->importXls(
                class: new NursesImport(),
                filename: $file->storeAs('public', $file->getClientOriginalName())
            ),
        };

        return back();
    }
}
