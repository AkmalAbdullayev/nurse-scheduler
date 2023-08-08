<div class="tab-pane fade" id="nav-schools" role="tabpanel" aria-labelledby="nav-schools-tab" wire:ignore.self>
    <div class="tab-pane-header">
        <div class="tab-pane-header-left">
            <form action="">
                <input class="form-control" type="text" placeholder="Search..." wire:model="search">
                <span class="tab-pane-header-left-search"><img src="{{ asset('img/search.svg') }}" alt=""></span>
            </form>
        </div>
        <div class="tab-pane-header-right">
            <ul class="list-group list-group-horizontal-lg">

                <li
                    class="list-group-item"
                    data-bs-toggle="modal"
                    href="#fileImportModalToggle"
                >
                    <span
                        class="list-group-item-span"
                    >
                        <img src="{{ asset('img/file-import.svg') }}" alt="">
                    </span>
                </li>

                <li class="list-group-item">
                    <a
                        href="{{ route('schools.export') }}"
                        class="list-group-item-span">
                        <img
                            src="{{ asset('img/file-import2.svg') }}" alt="">
                    </a>
                </li>

                <li class="list-group-item disabled disabled__btn">
                    <span class="list-group-item-span"><img src="{{ asset('img/print.svg') }}" alt=""></span>
                </li>

                <li class="list-group-item">
                    <a href="{{ route('schools.index') }}"><img src="{{ asset('img/pluse.svg') }}" alt=""></a>
                </li>
            </ul>
        </div>
    </div>

    <div style="overflow-x: auto">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col" wire:click="sortBy('building_code')">Building Code
                    <img
                        src="{{ $sortDirection == 'asc' ? asset('img/tabler-arrow.svg') : asset('img/dropdown.svg') }}"
                        alt=""
                    ></th>
                <th scope="col" wire:click="sortBy('school_name')">School Name
                    <img
                        src="{{ $sortDirection == 'asc' ? asset('img/tabler-arrow.svg') : asset('img/dropdown.svg') }}"
                        alt=""
                    ></th>
                <th scope="col" wire:click="sortBy('street_address_1')">Address
                    <img
                        src="{{ $sortDirection == 'asc' ? asset('img/tabler-arrow.svg') : asset('img/dropdown.svg') }}"
                        alt=""
                    ></th>
                <th scope="col" wire:click="sortBy('zip_code')">ZIP Code
                    <img
                        src="{{ $sortDirection == 'asc' ? asset('img/tabler-arrow.svg') : asset('img/dropdown.svg') }}"
                        alt=""
                    ></th>
                <th scope="col" wire:click="sortBy('boroughs.name')">Borough
                    <img
                        src="{{ $sortDirection == 'asc' ? asset('img/tabler-arrow.svg') : asset('img/dropdown.svg') }}"
                        alt=""
                    ></th>
            </tr>
            </thead>
            <tbody style="overflow-y: scroll" x-data>
            @forelse($schools as $school)
                <tr x-on:click="$wire.view({{ $school->id }})">
                    <td>{{ $school->building_code }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($school->school_name, '50') }}</td>
                    <td>{{ $school->street_address_1 }}</td>
                    <td>{{ $school->zip_code }}</td>
                    <td>{{ $school->name }}</td>
                </tr>
            @empty
                <tr>
                    <td>No data found.</td>
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
                Results {{ $schools->firstItem() }}-{{ $schools->lastItem() }} of {{ $schools->total() }}</p>
        </div>

        <div class="tab-pane-pagination">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    {{ $schools->links('') }}
                </ul>
            </nav>
        </div>
    </div>

    <div
        class="modal modal-lg fade"
        id="fileImportModalToggle"
        aria-hidden="true"
        aria-labelledby="fileImportModalToggleLabel"
        tabindex="-1"
    >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 class="modal-body-title">File Import</h3>
                    <p class="modal-body-desc">If you haven’t, please download this template to create a [encoding
                        selected on
                        organization] encoded file</p>
                    <a href="{{ asset('files/school-list.xlsx') }}" download>
                        <button class="btn modal-body-btn">Download template</button>
                    </a>
                    <form action="{{ route('schools.import') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <label for="schoolImportFile" class="modal-body-file">
                            <h3 class="modal-body-file-title">And drop here</h3>
                            <p class="modal-body-file-desc">Upload CSV, XLS or XLSX File</p>
                            <span class="modal-body-file-info">
                                <img src="{{ asset('img/file.svg') }}" alt=""> Import</span>
                            <input
                                type="file"
                                id="schoolImportFile"
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
