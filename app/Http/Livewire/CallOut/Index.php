<?php

namespace App\Http\Livewire\CallOut;

use App\Models\CallOut;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Redirector;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    /**
     * @var string
     */
    public string $search = '';
    public int $perPage = 15;

    protected string $paginationTheme = 'bootstrap';

    private CallOut|LengthAwarePaginator|Builder $callOut;

    public string $sortDirection = 'desc';
    public string $sortColumn = 'call_outs.created_at';

    public function boot(CallOut $callOut)
    {
        $this->callOut = $callOut;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * @return Factory|View|Application
     */
    public function render(): Factory|View|Application
    {
        $search = $this->search;

        $this->callOut = CallOut::query()
            ->select(['call_outs.*'])
            ->with(['nurse', 'school'])
            ->has('school')
            ->leftJoin('nurses', 'call_outs.nurse_id', '=', 'nurses.id')
            ->join('schools', 'call_outs.school_id', '=', 'schools.id')
            ->joinSub('select * from boroughs', 'boroughs_sub', 'schools.borough_id', '=', 'boroughs_sub.id');

        if (!empty($search)) {
            $this->callOut->whereRaw("LOWER(CONCAT(nurses.first_name, ' ', nurses.last_name)) like '%$search%'")
                ->orWhere('building_code', 'like', "%$search%")
                ->orWhereRaw("LOWER(schools.school_name) like '%$search%'")
                ->orWhereRaw("LOWER(schools.street_address_1) like '%$search%'")
                ->orWhereRaw("LOWER(boroughs_sub.name) like '%$search%'");
        }

        $callOuts = $this->callOut
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate($this->perPage)
            ->withPath('/admin');

        return view('livewire.call-out.index', compact('callOuts'));
    }

    /**
     * @param int $callOutId
     * @return Redirector|Application|RedirectResponse
     */
    public function view(int $callOutId): Redirector|Application|RedirectResponse
    {
        return redirect(route('call-out.show', $callOutId));
    }

    /**
     * @param string $column
     * @return void
     */
    public function sortBy(string $column): void
    {
        if ($this->sortColumn === $column) {
            $this->sortDirection = $this->sortDirection === 'desc' ? 'asc' : 'desc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortColumn = $column;
    }
}
