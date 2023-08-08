<div class="tab-pane fade" id="nav-nurses" role="tabpanel" aria-labelledby="nav-nurses-tab">
    <div class="tab-pane-header">
        <div class="tab-pane-header-left">
            <form action="">
                <input class="form-control" type="text" placeholder="Search..." wire:model="search">
                <span class="tab-pane-header-left-search"><img src="{{ asset('img/search.svg') }}" alt=""></span>
            </form>
        </div>
        <div class="tab-pane-header-right">
            <ul class="list-group list-group-horizontal-lg">
                <li class="list-group-item">
                    <span class="list-group-item-span"><img src="{{ asset('img/delet.svg') }}" alt=""></span>
                </li>
                <li class="list-group-item" data-bs-toggle="modal" href="#exampleModalToggle"
                    role="button">
                    <span class="list-group-item-span"><img src="{{ asset('img/file-import.svg') }}" alt=""></span>
                </li>
                <li class="list-group-item">
                    <span class="list-group-item-span"><img src="{{ asset('img/file-import2.svg') }}" alt=""></span>
                </li>
                <li class="list-group-item">
                    <span class="list-group-item-span"><img src="{{ asset('img/print.svg') }}" alt=""></span>
                </li>
                <li class="list-group-item">
                    <a href="{{ route('nurses.index') }}"><img src="{{ asset('img/pluse.svg') }}" alt=""></a>
                </li>
            </ul>
        </div>
    </div>
    <div style="overflow-x: auto">
        <table class="table table-striped table-responsive">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">MI</th>
                <th scope="col">Street Address 1</th>
                <th scope="col">Street Address 2</th>
                <th scope="col">City</th>
                <th scope="col">State</th>
                <th scope="col">Zip Code</th>
                <th scope="col">Email</th>
                <th scope="col">Cell Number</th>
                <th scope="col">License Number</th>
                <th scope="col">Role</th>
                <th scope="col">Active for assignments</th>
                <th scope="col">Assigned Date</th>
            </tr>
            </thead>
            <tbody>
            @forelse($nurses as $k => $nurse)
                <tr>
                    <td>{{ ++$k }}</td>
                    <td>{{ $nurse->first_name }}</td>
                    <td>{{ $nurse->last_name }}</td>
                    <td>{{ $nurse->mi }}</td>
                    <td>{{ $nurse->street_address_1 }}</td>
                    <td>{{ $nurse->street_address_2 }}</td>
                    <td>{{ $nurse->city }}</td>
                    <td>{{ $nurse?->state->name }}</td>
                    <td>{{ $nurse->zip_code }}</td>
                    <td>{{ $nurse->email }}</td>
                    <td>{{ $nurse->cell_number }}</td>
                    <td>{{ $nurse->license_number }}</td>
                    <td>{{ $nurse->getRole() }}</td>
                    <td>{{ $nurse->active_for_assignments == 1 ? 'Yes' : 'No' }}</td>
                    <td>{{ $nurse->assigned_date?->format('Y-m-d') }}</td>
                </tr>
            @empty
                <tr>
                    <td  colspan="15">No data found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="tab-pane-pagination">
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">«</span>
                    </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">»</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
