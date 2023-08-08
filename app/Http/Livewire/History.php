<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Activitylog\Models\Activity;

class History extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';
    public string $column = 'created_at';
    public string $direction = 'desc';
    public int $perPage = 15;
    public string $search = '';
    public array $period = [];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render(): Factory|View|Application
    {
        $logs = Activity::query()
            ->orderBy($this->column, $this->direction)
            ->paginate($this->perPage, ['*'], 'history-page')
            ->withPath('/admin');

        return view('livewire.history', compact('logs'));
    }

    public function sortBy(string $column)
    {
        if ($this->column === $column) {
            $this->direction = $this->direction === 'desc' ? 'asc' : 'desc';
        } else {
            $this->direction = 'asc';
        }
        $this->column = $column;
    }
}
