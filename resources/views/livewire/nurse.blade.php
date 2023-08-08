<div class="tab-pane fade" id="nav-nurses" role="tabpanel" aria-labelledby="nav-nurses-tab" wire:ignore.self>
    <div class="tab-pane-header">
        <div class="tab-pane-header-left">
            <form action="">
                <input class="form-control" type="text" placeholder="Search..." wire:model="search">
                {{--                <span class="tab-pane-header-left-search"><img src="{{ asset('img/search.svg') }}" alt=""></span>--}}
            </form>
        </div>
        <div class="tab-pane-header-right">
            <ul class="list-group list-group-horizontal-lg">
                <li
                    class="list-group-item"
                    data-bs-toggle="modal"
                    href="#exampleModalToggle"
                >
                    <span
                        class="list-group-item-span"
                    >
                        <img src="{{ asset('img/file-import.svg') }}" alt="">
                    </span>
                </li>

                <li class="list-group-item">
                    <a
                        href="{{ route('nurses.export') }}"
                        class="list-group-item-span"
                    >
                        <img src="{{ asset('img/file-import2.svg') }}" alt="">
                    </a>
                </li>

                <li class="list-group-item disabled disabled__btn">
                    <span class="list-group-item-span"><img src="{{ asset('img/print.svg') }}" alt=""></span>
                </li>

                <li class="list-group-item">
                    <a href="{{ route('nurses.index') }}"><img src="{{ asset('img/pluse.svg') }}" alt=""></a>
                </li>
            </ul>
        </div>
    </div>
    <div style="overflow-x: auto">
        <table class="table table-striped table-responsive" x-data>
            <thead>
            <tr>
                <th scope="col" wire:click="sortBy('first_name')">First
                    Name <img
                        src="{{ $sortDirection == 'asc' ? asset('img/tabler-arrow.svg') : asset('img/dropdown.svg') }}"
                        alt=""
                    >
                </th>
                <th scope="col" wire:click="sortBy('last_name')">Last
                    Name <img
                        src="{{ $sortDirection == 'asc' ? asset('img/tabler-arrow.svg') : asset('img/dropdown.svg') }}"
                        alt=""
                    >
                </th>
                <th scope="col" wire:click="sortBy('first_name')">Job
                    type <img
                        src="{{ $sortDirection == 'asc' ? asset('img/tabler-arrow.svg') : asset('img/dropdown.svg') }}"
                        alt=""
                    >
                </th>
                <th scope="col" wire:click="sortBy('zip_code')">ZIP
                    Code <img
                        src="{{ $sortDirection == 'asc' ? asset('img/tabler-arrow.svg') : asset('img/dropdown.svg') }}"
                        alt=""
                    >
                </th>
                <th scope="col" wire:click="sortBy('first_name')">Borough
                    <img
                        src="{{ $sortDirection == 'asc' ? asset('img/tabler-arrow.svg') : asset('img/dropdown.svg') }}"
                        alt=""
                    >
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse($nurses as $k => $nurse)
                <tr x-on:click="$wire.view({{ $nurse->id }})">
                    <td>{{ $nurse->first_name }}</td>
                    <td>{{ $nurse->last_name }}</td>
                    <td>{{ $nurse->role?->name }}</td>
                    <td>{{ $nurse->zip_code }}</td>
                    <td>{{ $nurse->desired_boroughs->first()?->name }}</td>
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
            <p class="mobilePaginationText"
               style="font-weight: 400;font-size: 16px;line-height: 19px;margin: 0;color: #646464;">
                Results {{ $nurses->firstItem() }}-{{ $nurses->lastItem() }} of {{ $nurses->total() }}</p>
        </div>

        <div class="tab-pane-pagination">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    {{ $nurses->links('') }}
                </ul>
            </nav>
        </div>
    </div>

    <div
        class="modal modal-lg fade"
        id="exampleModalToggle"
        aria-hidden="true"
        aria-labelledby="exampleModalToggleLabel"
        tabindex="-1"
    >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 class="modal-body-title">File Import</h3>
                    <p class="modal-body-desc">If you haven’t, please download this template to create a [encoding
                        selected on
                        organization] encoded file</p>
                    <a href="{{ asset('files/nurse-list.xlsx') }}" download>
                        <button class="btn modal-body-btn">Download template</button>
                    </a>
                    <form action="{{ route('nurses.import') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <label for="nurseImportFile" class="modal-body-file">
                            <h3 class="modal-body-file-title">And drop here</h3>
                            <p class="modal-body-file-desc">Upload CSV, XLS or XLSX File</p>
                            <span class="modal-body-file-info"><img src="{{ asset('img/file.svg') }}"
                                                                    alt=""> Import</span>
                            <input
                                type="file"
                                id="nurseImportFile"
                                style="display:none"
                                name="file"
                                multiple
                            >
                        </label>
                        <button class="btn__green btn-reset mt-5">Save</button>
                    </form>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
