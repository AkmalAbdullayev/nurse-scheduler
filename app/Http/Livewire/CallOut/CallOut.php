<?php

namespace App\Http\Livewire\CallOut;

use App\Models\ {
    School,
    Nurse
};
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CallOut extends Component
{
    public mixed $school;

    public function updatingSchool($value)
    {
        dd($value);
    }

    /**
     * @return Factory|View|Application
     */
    public function render(): Factory|View|Application
    {
        $schools = School::query()
            ->active()
            ->get();

        $nurses = Nurse::query()
            ->active()
            ->get();

        return view('livewire.call-out.call-out', compact('schools', 'nurses'));
    }
}
