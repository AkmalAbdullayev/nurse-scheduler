<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AssignmentPrioritiy;
use App\Enums\Boroughs;
use App\Exports\SchoolsExport;
use App\helpers\Services\FileManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSchoolRequest;
use App\Http\Requests\Admin\UpdateSchoolRequest;
use App\Imports\SchoolsImport;
use App\Models\MedicalNeed;
use App\Models\Nurse;
use App\Models\NurseCredential;
use App\Models\School;
use App\Models\SchoolPrincipal;
use App\Models\State;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Maatwebsite\Excel\Excel;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class SchoolController extends Controller
{
    /**
     * @param Request $request
     * @return Factory|View|Application
     */
    public function index(Request $request): Factory|View|Application
    {
        $states = State::query()->get();
        $boroughs = Boroughs::values();
        $assignment_priorities = AssignmentPrioritiy::values();
        $medicalNeeds = MedicalNeed::query()->get();
        $credentials = NurseCredential::query()->get();

        return view('add-schools', compact('states', 'boroughs', 'assignment_priorities', 'medicalNeeds', 'credentials'));
    }

    /**
     * @param StoreSchoolRequest $request
     * @return RedirectResponse
     */
    public function store(StoreSchoolRequest $request): RedirectResponse
    {
        $schoolModel = new School();
        $schoolModel->building_code = $request->input('building_code');
        $schoolModel->district = $request->input('district');
        $schoolModel->primary_dbn = $request->input('primary_dbn');
        $schoolModel->school_name = $request->input('school_name');
        $schoolModel->street_address_1 = $request->input('street_address_1');
        $schoolModel->street_address_2 = $request->input('street_address_2');
        $schoolModel->city = $request->input('city');
        $schoolModel->state_id = $request->input('state_id');
        $schoolModel->zip_code = $request->input('zip_code');
        $schoolModel->borough_id = $request->input('borough_id');
        $schoolModel->school_phone = '+1' . $request->input('school_phone');
        $schoolModel->google_map = $request->input('google_map');
        $schoolModel->special_notes = $request->input('special_notes');
        $schoolModel->assignment_priority = $request->input('assignment_priority');
        $schoolModel->is_active = $request->input('is_active');

        /** @var Nurse $nurse */
        $nurse = Nurse::query()
            ->with(['role' => function ($query) {
                return $query->where('name', '=', 'Perm School Nurse');
            }, 'schools', 'user'])
            ->where('email', '=', $request->input('nurses')['email'])
            ->first();

        if (!is_null($nurse)) {
            if (!is_null($nurse->role) && $nurse->schools->isNotEmpty()) {
                return back()
                    ->with('message', 'Nurse is already assigned to school. Please, choose another.')
                    ->withInput();
            }

            $schoolModel->saveQuietly();

            $schoolModel->nurses()->attach($nurse->id);

            $role = Role::query()->where('name', '=', 'Perm School Nurse')->first();
            $nurse->role_id = $role->id;
            $nurse->saveQuietly();

            $user = $nurse->user()->first();
            $user?->syncRoles($role->name);

            $request->whenFilled(key: 'nurses.credentials', callback: function () use ($request, $nurse) {
                $nurse->credentials()->syncWithoutDetaching($request->input('nurses')['credentials']);
            });
        }

        $schoolModel->save();

        $request->whenFilled(key: 'medical_needs', callback: function () use ($request, $schoolModel) {
            $schoolModel->medical_needs()->syncWithoutDetaching($request->input('medical_needs'));
        });

        $request->whenFilled(key: 'principals.name', callback: function () use ($request, $schoolModel) {
            $schoolPrincipal = SchoolPrincipal::query()->create([
                'name' => $request->input('principals.name'),
                'email' => $request->input('principals.email'),
                'cell_number' => '+1' . $request->input('principals.cell_number')
            ]);

            $schoolModel->school_principal()->associate($schoolPrincipal);

            $schoolModel->saveQuietly();
        });

        return redirect()->route('main')->with('success');
    }

    public function show(int $id): Factory|View|Application
    {
        $schoolMedicalNeeds = collect();

        /** @var School $school */
        $school = School::query()
            ->with(['school_principal', 'medical_needs', 'history'])
            ->findOrFail($id);

        foreach ($school->medical_needs as $medical_need) {
            $schoolMedicalNeeds->push($medical_need);
        }

        $boroughs = Boroughs::values();
        $states = State::query()->get();
        $medicalNeeds = MedicalNeed::query()->get();
        $assignment_priorities = AssignmentPrioritiy::values();
        $credentials = NurseCredential::query()->get();

        return view('view-school', compact(
            'school',
            'boroughs',
            'states',
            'medicalNeeds',
            'assignment_priorities',
            'credentials',
            'schoolMedicalNeeds'
        ));
    }

    public function update(UpdateSchoolRequest $request, int $id): RedirectResponse
    {
        /** @var School $school */
        $school = School::query()
            ->with(['nurses.credentials', 'school_principal'])
            ->find($id);

        $school->update($request->validated());

        if (!$request->has('is_active')) {
            $school->is_active = 0;
            $school->saveQuietly();
        }

        /** @var Nurse $nurse */
        $nurse = Nurse::query()
            ->with(['user', 'role'])
            ->where('email', '=', $request->input('nurses')['email'])
            ->first();

        if (!is_null($nurse)) {
            if (!is_null($nurse->role) && $nurse->schools->isNotEmpty() && $nurse->schools->last()->pivot->school_id != $school->id) {
                return back()
                    ->with('message', 'Nurse is already assigned to school. Please, choose another.')
                    ->withInput();
            }

            $role = Role::query()->where('name', '=', 'Perm School Nurse')->first();
            $nurse->role_id = $role->id;
            $nurse->saveQuietly();

            $user = $nurse->user()->first();
            $user?->syncRoles($role->name);

            $schoolNurse = $school->nurses()->where('nurse_id', '=', $nurse->id);
            $schoolNurse->sync($nurse->id);

            // if $request->input('nurses') is null then credentials also null
            $request->whenFilled(key: 'nurses.credentials', callback: function () use ($request, $schoolNurse) {
                $schoolNurse->first()->credentials()->syncWithoutDetaching($request->input('nurses')['credentials']);
            });
        }

        $request->whenFilled(key: 'medical_needs', callback: function () use ($request, $school) {
            $school->medical_needs()->syncWithoutDetaching($request->input('medical_needs'));
        });

        $request->whenFilled(key: 'principals.name', callback: function () use ($request, $school) {
            $schoolPrincipal = SchoolPrincipal::query()->find($request->input('principals.id'));

            if (!is_null($schoolPrincipal)) {
                $schoolPrincipal->update([
                    'name' => $request->input('principals.name'),
                    'email' => $request->input('principals.email'),
                    'cell_number' => $request->input('principals.cell_number')
                ]);
            } else {
                $schoolPrincipal = SchoolPrincipal::query()->create([
                    'name' => $request->input('principals.name'),
                    'email' => $request->input('principals.email'),
                    'cell_number' => '+1' . $request->input('principals.cell_number')
                ]);

                $school->school_principal()->associate($schoolPrincipal);
                $school->save();
            }
        });

        return redirect()->route('main')->with('success');
    }

    public function destroy(Request $request, int $id): Redirector|RedirectResponse|Application
    {
        $school = School::query()->find($id);

        if ($school->delete()) {
            return redirect()->intended(route('main'))->with('success', 'School deleted successfully!');
        }

        return redirect(route('schools.view', $id))->with('error');
    }

    /**
     * @return BinaryFileResponse
     */
    public function export(): BinaryFileResponse
    {
        $export = new FileManager(format: 'csv');
        return $export->export(new SchoolsExport, 'schools-list-export');
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
                class: new SchoolsImport(),
                filename: $file->storeAs('public', $file->getClientOriginalName()),
            ),
            'xlsx' => $fileManager->importXlsx(
                class: new SchoolsImport(),
                filename: $file->storeAs('public', $file->getClientOriginalName()),
            ),
            'xls' => $fileManager->importXls(
                class: new SchoolsImport(),
                filename: $file->storeAs('public', $file->getClientOriginalName()),
            ),
        };

        return back();
    }
}
