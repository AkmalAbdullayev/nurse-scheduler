<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class SearchNurse extends Component
{
    /**
     * @var string
     */
    public string $search = '';

    public function render(): Factory|View|Application
    {
        $nurseSearch = strtoupper($this->search);

        $nurses = \App\Models\Nurse::query()
            ->where('first_name', 'like', "%$nurseSearch%")
            ->orWhere('mi', 'like', "%$nurseSearch%")
            ->orWhere('last_name', 'like', "%$nurseSearch")
            ->get();

        return view('livewire.search-nurse', compact('nurses'));
    }
}
