<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Livewire\Component;
use Livewire\WithPagination;

class School extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';
    /**
     * @var string
     */
    public string $search = '';
    public int $perPage = 15;

    public string $sortColumn = 'schools.created_at';
    public string $sortDirection = 'desc';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset($this->search);
    }

    /**
     * @return Factory|View|Application
     */
    public function render(): Factory|View|Application
    {
        $search = $this->search;

        $schools = \App\Models\School::query()
            ->with(['borough'])
            ->addSelect([
                'schools.id',
                'schools.building_code',
                'schools.school_name',
                'schools.street_address_1',
                'schools.zip_code',
                'boroughs.name'
            ])
            ->join('boroughs', 'schools.borough_id', '=', 'boroughs.id');

        if (!empty($search)) {
            $schools->where('building_code', 'like', "%$search%")
                ->orWhereRaw("LOWER(school_name) like '%$search%'")
                ->orWhereRaw("LOWER(street_address_1) like '%$search%'")
                ->orWhere('zip_code', 'like', "%$search%")
                ->orWhereRaw("LOWER(boroughs.name) like '%$search%'");
        }

        $schools = $schools->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate($this->perPage, ['*'], 'school-page')
            ->withPath('/admin');

        return view('livewire.school.index', compact('schools'));
    }

    public function view(int $id): Redirector|Application|RedirectResponse
    {
        return redirect(route('schools.show', $id));
    }

    public function sortBy(string $column)
    {
        if ($this->sortColumn === $column) {
            $this->sortDirection = $this->sortDirection === 'desc' ? 'asc' : 'desc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortColumn = $column;
    }
}
