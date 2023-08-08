<div class="tab-pane fade active show" id="nav-call" role="tabpanel" aria-labelledby="nav-call-tab" wire:ignore.self>
    <div class="tab-pane-header">
        <div class="tab-pane-header-left">
            <form action="">
                <input
                    class="form-control"
                    type="text"
                    placeholder="Search..."
                    wire:model="search"
                >
                <span class="tab-pane-header-left-search"><img src="{{ asset('img/search.svg') }}" alt=""></span>
            </form>
        </div>
        <div class="tab-pane-header-right">
            <ul class="list-group list-group-horizontal-lg">
                <li class="list-group-item disabled disabled__btn" data-bs-toggle="modal" href="#exampleModalToggle"
                    role="button">
                    <span class="list-group-item-span"><img src="{{ asset('img/file-import.svg') }}" alt=""></span>
                </li>
                <li class="list-group-item disabled disabled__btn">
                    <span class="list-group-item-span"><img src="{{ asset('img/file-import2.svg') }}" alt=""></span>
                </li>
                <li class="list-group-item disabled disabled__btn">
                    <span class="list-group-item-span"><img src="{{ asset('img/print.svg') }}" alt=""></span>
                </li>
                <li class="list-group-item">
                    <a href="{{ route('call-out.index') }}"><img src="{{ asset('img/pluse.svg') }}" alt=""></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="tab-pane-top">
        <button type="button" class="tab-pane-top-btn btn-reset ">Not Covered</button>
        <button type="button" class="tab-pane-top-btn btn-reset ">Past Dates</button>
    </div>
    <div style="overflow-x: auto">
        <table class="table table-striped" >
            <thead>
            <tr>
                <th scope="col" wire:click="sortBy('schools.building_code')">BC
                    <img
                        src="{{ $sortDirection == 'asc' ? asset('img/tabler-arrow.svg') : asset('img/dropdown.svg') }}"
                        alt=""
                    ></th>
                <th scope="col" wire:click="sortBy('schools.school_name')">School Name
                    <img
                        src="{{ $sortDirection == 'asc' ? asset('img/tabler-arrow.svg') : asset('img/dropdown.svg') }}"
                        alt=""
                    ></th>
                <th scope="col" wire:click="sortBy('schools.street_address_1')">Address
                    <img
                        src="{{ $sortDirection == 'asc' ? asset('img/tabler-arrow.svg') : asset('img/dropdown.svg') }}"
                        alt=""
                    ></th>
                <th scope="col" wire:click="sortBy('boroughs_sub.name')">Borough
                    <img
                        src="{{ $sortDirection == 'asc' ? asset('img/tabler-arrow.svg') : asset('img/dropdown.svg') }}"
                        alt=""
                    ></th>
                <th scope="col" wire:click="sortBy('nurses.first_name')">Covered By
                    <img
                        src="{{ $sortDirection == 'asc' ? asset('img/tabler-arrow.svg') : asset('img/dropdown.svg') }}"
                        alt=""
                    ></th>
                <th scope="col" wire:click="sortBy('from')">Start Date
                    <img
                        src="{{ $sortDirection == 'asc' ? asset('img/tabler-arrow.svg') : asset('img/dropdown.svg') }}"
                        alt=""
                    ></th>
                <th scope="col" wire:click="sortBy('time_of_arrival')">ETA
                    <img
                        src="{{ $sortDirection == 'asc' ? asset('img/tabler-arrow.svg') : asset('img/dropdown.svg') }}"
                        alt=""
                    ></th>
                <th scope="col" wire:click="sortBy('status')">
                    Status
                    <img
                        src="{{ $sortDirection == 'asc' ? asset('img/tabler-arrow.svg') : asset('img/dropdown.svg') }}"
                        alt=""
                    ></th>
            </tr>
            </thead>
            <tbody style="overflow-y: scroll" x-data>
            @forelse($callOuts as $callOut)
                <tr
                    x-on:click="$wire.view({{ $callOut->id }})"
                    @if (is_null($callOut->nurse)) class="bgRed" @endif
                >
                    <td>{{ $callOut->school?->building_code }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($callOut->school?->school_name, 50) }}</td>
                    <td>{{ $callOut->school?->street_address_1 }}</td>
                    <td>{{ $callOut->school?->borough->name }}</td>
                    <td>@if (is_null($callOut->nurse))
                            -
                        @else
                            {{ $callOut->nurse?->first_name }} {{ $callOut->nurse?->last_name }}
                        @endif</td>
                    <td>{{ $callOut->from?->format('m-d-Y') }}</td>
                    <td>{{ $callOut->time_of_arrival?->format('H:i') ?? '-' }}</td>
                    <td>{{ $callOut->status }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No data found.</td>
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
            <p class="mobilePaginationText" style="font-weight: 400;font-size: 16px;line-height: 19px;margin: 0;color: #646464;">Results {{ $callOuts->firstItem() }}-{{ $callOuts->lastItem() }} of {{ $callOuts->total() }}</p>
        </div>

        <div class="tab-pane-pagination">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    {{ $callOuts->links('') }}
                </ul>
            </nav>
        </div>
    </div>

    <div class="tab-pane-date">
        <p class="tab-pane-date-desc">Last updated on: {{ $callOuts->first()?->created_at->format('F d, h:i A') }}</p>
    </div>
</div>
