<?php

namespace App\Http\Livewire;

use App\helpers\Repositories\NurseRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Livewire\Component;
use Livewire\WithPagination;

class Nurse extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';

    public string $search = '';
    public string $sortField = 'created_at';
    public string $sortDirection = 'desc';
    public int $perPage = 15;
    private NurseRepository $nurseRepository;
    private Builder $query;

    /**
     * @param NurseRepository $nurseRepository
     * @return void
     */
    public function boot(NurseRepository $nurseRepository): void
    {
        $this->nurseRepository = $nurseRepository;
        $this->query = \App\Models\Nurse::query();
    }

    public function updatedSearch($value)
    {
        $this->search = $value;
    }

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
        $nurses = $this->query
            ->notAdmin()
            ->filterBy($this->sortField, $this->sortDirection)
            ->search($this->search)
            ->paginate($this->perPage, ['*'], 'nurse-page')
            ->withPath('/admin');

        return view('livewire.nurse', compact('nurses'));
    }

    public function sortBy(string $field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'desc' ? 'asc' : 'desc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function view(int $id): Redirector|Application|RedirectResponse
    {
        return redirect()->route('nurses.show', ['id' => $id]);
    }
}
