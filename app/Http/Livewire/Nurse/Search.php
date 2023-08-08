<?php

namespace App\Http\Livewire\Nurse;

use App\helpers\Repositories\NurseRepository;
use App\Models\CallOut;
use App\Models\Nurse;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Search extends Component
{
    public Collection $nurses;
    public CallOut $callOut;
    public int $nurse_id;
    private NurseRepository $nurseRepository;

    public function boot(NurseRepository $nurseRepository)
    {
        $this->nurseRepository = $nurseRepository;
    }

    public function mount(Collection $nurses, CallOut $callOut)
    {
        $this->nurses = $nurses;
        $this->callOut = $callOut;
    }

    public function render(): Factory|View|Application
    {
        if (isset($this->nurse_id)) {
            $this->callOut->nurse = $this->nurseRepository->find($this->nurse_id);
        }

        return view('livewire.nurse.search');
    }
}
