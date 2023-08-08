<div class="tab-pane fade active show" id="nav-call" role="tabpanel" aria-labelledby="nav-call-tab">
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
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">BC</th>
                <th scope="col">School Name</th>
                <th scope="col">Address</th>
                <th scope="col">Borough</th>
                <th scope="col">Covered By</th>
                <th scope="col">Start Date</th>
                <th scope="col">End Date</th>
            </tr>
            </thead>
            <tbody style="overflow-y: scroll">
            @forelse($callOuts as $callOut)
                <tr>
                    <td>{{ $callOut->school->building_code }}</td>
                    <td>{{ $callOut->school->school_name }}</td>
                    <td>{{ $callOut->school->street_address_1 }}</td>
                    <td>{{ $callOut->school->borough->name }}</td>
                    <td>{{ $callOut->nurse->first_name }} {{ $callOut->nurse->last_name }}</td>
                    <td>{{ $callOut->from->format('M d, Y') }}</td>
                    <td>{{ $callOut->to->format('M d, Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td  colspan="7">No data found.</td>
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
    <div class="tab-pane-date">
        <p>Last updated on: December 11, 11:59 pm</p>
    </div>
</div>
