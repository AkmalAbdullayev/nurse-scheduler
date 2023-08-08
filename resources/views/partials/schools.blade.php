<div class="tab-pane fade" id="nav-schools" role="tabpanel" aria-labelledby="nav-schools-tab">
    <div class="tab-pane-header">
        <div class="tab-pane-header-left">
            <form action="">
                <input class="form-control" type="text" placeholder="Search...">
                <span class="tab-pane-header-left-search"><img src="{{ asset('img/search.svg') }}" alt=""></span>
            </form>
        </div>
        <div class="tab-pane-header-right">
            <ul class="list-group list-group-horizontal-lg">
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
                    <a href="{{ route('school.index') }}"><img src="{{ asset('img/pluse.svg') }}" alt=""></a>
                </li>
            </ul>
        </div>
    </div>
    <div style="overflow-x: auto">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th scope="col">Building Code</th>
                <th scope="col">District</th>
                <th scope="col">Primary DBN</th>
                <th scope="col">School Name</th>
                <th scope="col">Street Address 1</th>
                <th scope="col">Street Address 2</th>
                <th scope="col">City</th>
                <th scope="col">State</th>
                <th scope="col">ZIP Code</th>
                <th scope="col">Assigned RN</th>
                <th scope="col">Email</th>
                <th scope="col">Borough</th>
                <th scope="col">Phone</th>
                <th scope="col">Assignment Priority</th>
            </tr>
            </thead>
            <tbody style="overflow-y: scroll">
            @forelse($schools as $k => $school)
                <tr>
                    <td>{{ ++$k }}</td>
                    <td>{{ $school->building_code }}</td>
                    <td>{{ $school->district }}</td>
                    <td>{{ $school->primary_dbn }}</td>
                    <td>{{ $school->school_name }}</td>
                    <td>{{ $school->street_address_1 }}</td>
                    <td>{{ $school->street_address_2 }}</td>
                    <td>{{ $school->city }}</td>
                    <td>{{ $school->state?->name }}</td>
                    <td>{{ $school->zip_code }}</td>
                    <td>{{ $school->assigned_rn }}</td>
                    <td>{{ $school->email }}</td>
                    <td>{{ $school->borough?->name }}</td>
                    <td>{{ $school->school_phone }}</td>
                    <td>{{ $school->assignment_priority }}</td>
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
