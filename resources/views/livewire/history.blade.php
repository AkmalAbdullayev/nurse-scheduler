<div class="tab-pane fade" id="nav-log" role="tabpanel" aria-labelledby="nav-log-tab" wire:ignore.self>
    <div class="tab-pane-header">
        <div class="tab-pane-header-left">
            <form action="">
                <input class="form-control" type="text" placeholder="Search...">
                <span class="tab-pane-header-left-search"><img src="{{ asset('img/search.svg') }}" alt=""></span>
            </form>
        </div>
        <div class="tab-pane-header-right">
            <ul class="list-group list-group-horizontal-lg">
                <li class="list-group-item disabled disabled__btn" data-bs-toggle="modal" href="#exampleModalToggle"
                    role="button">
                    <span class="list-group-item-span"><img src="{{ asset('img/file-import.svg') }}" alt=""></span>
                </li>
                <li class="list-group-item disabled disabled__btn"
                    style="background-color: inherit; border: 1px dashed #333333">
                    <span class="list-group-item-span"><img src="{{ asset('img/print.svg') }}" alt=""></span>
                </li>
            </ul>
        </div>
    </div>
    <div class="tab-pane-date">
        <label class="tab-pane-date-calendar">
            Select Period
            <div class="tab-pane-date-calendar-input">
                <img src="{{ asset('img/calendar-icon.svg') }}" alt="">
                <input id="calendar" placeholder="Pick a date..." wire:model="period">
            </div>
        </label>
    </div>
    <div style="overflow-x: auto">
        <table class="table table-striped table-responsive">
            <thead>
            <tr>
                <th
                    scope="col"
                    wire:click="sortBy('description')"
                >
                    Event <img
                        src="{{ $direction == 'asc' ? asset('img/tabler-arrow.svg') : asset('img/dropdown.svg') }}">
                </th>
                <th
                    scope="col"
                    wire:click="sortBy('log_name')"
                >
                    Event Type <img
                        src="{{ $direction == 'asc' ? asset('img/tabler-arrow.svg') : asset('img/dropdown.svg') }}">
                </th>
                <th
                    scope="col"
                    wire:click="sortBy('properties->attributes')"
                >
                    Entity <img
                        src="{{ $direction == 'asc' ? asset('img/tabler-arrow.svg') : asset('img/dropdown.svg') }}">
                </th>
                <th
                    scope="col"
                    wire:click="sortBy('created_at')"
                >
                    Date <img
                        src="{{ $direction == 'asc' ? asset('img/tabler-arrow.svg') : asset('img/dropdown.svg') }}">
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse($logs as $log)
                <tr>
                    <td>{{ $log->description }}</td>
                    <td>{{ $log->log_name }}</td>
                    <td>
                        {{ $log->changes->value('first_name') }} {{ $log->changes->value('mi') }} {{ $log->changes->value('last_name') ?? $log->changes->value('nurse.full_name') ?? $log->changes->value('school_name') }}
                    </td>
                    <td>{{ $log->created_at->format('Y-m-d') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No data found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between mobilePagination">
        <div>
            <select
                class="form-select"
                name="number_of_pagination"
                id="number_of_pagination"
                wire:model="perPage"
            >
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
            </select>
        </div>

        <div>
            <p
                class="mobilePaginationText"
                style="font-weight: 400;font-size: 16px;line-height: 19px;margin: 0;color: #646464;"
            >
                Results {{ $logs->firstItem() }}-{{ $logs->lastItem() }} of {{ $logs->total() }}</p>
        </div>

        <div class="tab-pane-pagination">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    {{ $logs->links() }}
                </ul>
            </nav>
        </div>
    </div>
</div>

@push('js')
    <script defer>

    </script>
@endpush
