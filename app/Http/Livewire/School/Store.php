<?php

namespace App\Http\Livewire\School;

use App\Enums\AssignmentPrioritiy;
use App\Enums\Boroughs;
use App\helpers\Repositories\NurseRepository;
use App\Models\MedicalNeed;
use App\Models\Nurse;
use App\Models\NurseCredential;
use App\Models\State;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Store extends Component
{
    private readonly NurseRepository $nurseRepository;
    public ?int $nurse_id;

    public function boot(NurseRepository $nurseRepository)
    {
        $this->nurseRepository = $nurseRepository;
    }

    public function render(): Factory|View|Application
    {
        $nurseCredentials = collect();
        $nurse = null;

        if (!empty($this->nurse_id)) {
            /** @var Nurse $nurse */
            $nurse = Nurse::query()
                ->with(['credentials'])
                ->find($this->nurse_id);

            $nurse?->credentials->map(fn($item) => $nurseCredentials->push($item))->last();
        }

        $states = State::query()->get();
        $boroughs = Boroughs::values();
        $assignment_priorities = AssignmentPrioritiy::values();
        $medicalNeeds = MedicalNeed::query()->get();
        $credentials = NurseCredential::query()->get();
        $activeNurses = Nurse::query()->active()->get();

        return view('livewire.school.store', compact(
            'nurse',
            'states',
            'boroughs',
            'assignment_priorities',
            'medicalNeeds',
            'credentials',
            'nurseCredentials',
            'activeNurses'
        ));
    }
}
