<?php

namespace App\Http\Livewire\School;

use App\helpers\Repositories\NurseRepository;
use App\Models\Nurse;
use App\Models\NurseCredential;
use App\Models\NurseSchool;
use App\Models\School;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class View extends Component
{
    private readonly NurseRepository $nurseRepository;
    private mixed $school;
    public mixed $temp;
    public int $nurse_id;

    protected $listeners = ['get-school' => 'test'];

    public function boot(NurseRepository $nurseRepository, School $school)
    {
        $this->nurseRepository = $nurseRepository;
        $this->school = $school;
    }

    public function mount(School $school)
    {
        $this->school = $school;
        $this->temp = $this->school;
    }

    public function render(): Factory|\Illuminate\Contracts\View\View|Application
    {
        $school = $this->temp;
        $nurseCredentials = collect();
        $nurse = null;

        /** @var NurseSchool $nurseSchool */
        $nurseSchool = NurseSchool::query()
            ->where('school_id', '=', $school->id)
            ->latest()
            ->first();

        if (!is_null($nurseSchool)) {
            $nurse = Nurse::query()
                ->with(['credentials'])
                ->find($nurseSchool->nurse_id);
        }

        if (!empty($this->nurse_id)) {
            /** @var Nurse $nurse */
            $nurse = Nurse::query()
                ->with(['credentials'])
                ->find($this->nurse_id);
        }

        $nurse?->credentials->map(fn($item) => $nurseCredentials->push($item))->last();

        $credentials = NurseCredential::query()->get();
        $activeNurses = Nurse::query()->active()->get();

        return view('livewire.school.view', compact(
            'credentials',
            'nurse',
            'school',
            'nurseCredentials',
            'activeNurses'
        ));
    }

    public function test(int $school)
    {
        $this->school = $school;
    }
}
