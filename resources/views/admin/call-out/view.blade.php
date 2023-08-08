@extends('layouts.master')

@section('content')
    <div class="add__schools">
        <div class="container-fluid mb-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('main') }}">Call-outs </a></li>
                    <li class="breadcrumb-item active" aria-current="page">View a call-out</li>
                </ol>
            </nav>
            <div class="add__schools__inputs">
                <form action="{{ route('call-out.update', $callOut->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="add__schools__inputs-header">
                        <div>
                            <h2 class="add__schools__inputs-header-title">{{ $callOut->school?->school_name }} vacant
                                record</h2>
                        </div>
                        <div>
                            <ul class="list-group list-group-horizontal-lg">
                                <li
                                    class="list-group-item"
                                    data-bs-toggle="modal"
                                    href="#deletModalToggle"
                                    role="button"
                                >
                                    <span><img src="{{ asset('img/delet.svg') }}" alt=""></span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    @if (session()->has('message'))
                        <div>
                            <span class="text-danger">{{ session('message') }}</span>
                        </div>
                    @endif

                    <div class="add__schools__inputs-label">
                        <div class="add__schools__inputs-label-item">
                            <h2 class="add__schools__inputs-header-title mb-3">Dates of registration</h2>
                            <label class="add__schools__inputs-label-item-input">
                                <h3 class="callTitle">Date and Time of Transaction</h3>
                                <p class="callSubTitle">{{ $callOut->created_at?->format('d F Y h:i:s A') }}</p>
                            </label>
                            <label class="add__schools__inputs-label-item-input d-flex" style="column-gap: 150px">
                                <div>
                                    <h3 class="callTitle">Time Vacant</h3>
                                    <p class="callSubTitle">{{ $callOut->from?->format('d F Y') }}</p>
                                </div>
                                <div>
                                    <h3 class="callTitle">ETA</h3>
                                    <p class="callSubTitle">{{ $callOut->time_of_arrival?->format('H:i A') }}</p>
                                </div>
                            </label>
                            <label class="add__schools__inputs-label-item-input">
                                <h3 class="callTitle">School Phone</h3>
                                <p class="callSubTitle">{{ substr($callOut->school?->school_phone, 2) }}</p>
                            </label>
                            <label class="add__schools__inputs-label-item-input">
                                <p class="callTitle">Google map</p>
                                <div id="map" style="height: 110px; margin-top: 8px; margin-right: 20px"></div>
                            </label>
                        </div>
                        <div class="add__schools__inputs-label-item">
                            <h2 class="add__schools__inputs-header-title mb-3">School address</h2>
                            <label class="add__schools__inputs-label-item-input d-flex" style="column-gap: 130px">
                                <div style="width: 50%; max-width: 100%">
                                    <h3 class="callTitle">School name </h3>
                                    <p class="callSubTitle">{{ $callOut->school?->school_name }}</p>
                                </div>
                                <div style="width: 50%; max-width: 100%">
                                    <h3 class="callTitle">Borough</h3>
                                    <p class="callSubTitle">{{ $callOut->school?->borough?->name }}</p>
                                </div>
                            </label>
                            <label class="add__schools__inputs-label-item-input d-flex" style="column-gap: 130px">
                                <div style="width: 50%; max-width: 100%">
                                    <h3 class="callTitle">State</h3>
                                    <p class="callSubTitle">{{ $callOut->school?->state?->name }}</p>
                                </div>
                                <div style="width: 50%; max-width: 100%">
                                    <h3 class="callTitle">City</h3>
                                    <p class="callSubTitle">{{ $callOut->school?->city }}</p>
                                </div>
                            </label>
                            <label class="add__schools__inputs-label-item-input d-flex" style="column-gap: 130px">
                                <div style="width: 50%; max-width: 100%">
                                    <h3 class="callTitle">District</h3>
                                    <p class="callSubTitle">{{ $callOut->school?->district }}</p>
                                </div>
                                <div style="width: 50%; max-width: 100%">
                                    <h3 class="callTitle">Building Code</h3>
                                    <p class="callSubTitle">{{ $callOut->school?->building_code }}</p>
                                </div>
                            </label>
                            <label class="add__schools__inputs-label-item-input d-flex" style="column-gap: 130px">
                                <div style="width: 50%; max-width: 100%">
                                    <h3 class="callTitle">Street Address 1</h3>
                                    <p class="callSubTitle">{{ $callOut->school?->street_address_1 }}</p>
                                </div>
                                <div style="width: 50%; max-width: 100%">
                                    <h3 class="callTitle">Street Address 2</h3>
                                    <p class="callSubTitle">{{ $callOut->school?->street_address_2 }}</p>
                                </div>
                            </label>
                            <label class="add__schools__inputs-label-item-input d-flex" style="column-gap: 130px">
                                <div style="width: 50%; max-width: 100%">
                                    <h3 class="callTitle">Primary DBN</h3>
                                    <p class="callSubTitle">{{ $callOut->school?->primary_dbn }}</p>
                                </div>
                                <div style="width: 50%; max-width: 100%">
                                    <h3 class="callTitle">ZIP Code</h3>
                                    <p class="callSubTitle">{{ $callOut->school?->zip_code }}</p>
                                </div>
                            </label>
                        </div>

                    </div>

                    <div class="add__schools__inputs-header">
                        <div style="margin-top: 10px">
                            <h2 class="add__schools__inputs-header-title">School medical needs</h2>
                        </div>
                    </div>
                    <div class="add__schools__inputs-label">
                        <div class="add__schools__inputs-label-item">
                            <label class="add__schools__inputs-label-item-input">
                                <h3 class="callTitle">Need #1</h3>
                                <p class="callSubTitle">
                                    {{ $callOut->school?->getMedicalNeeds()->has(0) ? $callOut->school?->getMedicalNeeds()[0]->name : '-' }}
                                </p>
                            </label>
                            <label class="add__schools__inputs-label-item-input">
                                <h3 class="callTitle">Need #3</h3>
                                <p class="callSubTitle">
                                    {{ $callOut->school?->getMedicalNeeds()->has(2) ? $callOut->school?->getMedicalNeeds()[2]->name : '-' }}
                                </p>
                            </label>
                            <label class="add__schools__inputs-label-item-input">
                                <h3 class="callTitle">Need #5</h3>
                                <p class="callSubTitle">
                                    {{ $callOut->school?->getMedicalNeeds()->has(4) ? $callOut->school?->getMedicalNeeds()[4]->name : '-' }}
                                </p>
                            </label>
                        </div>
                        <div class="add__schools__inputs-label-item">
                            <label class="add__schools__inputs-label-item-input">
                                <h3 class="callTitle">Need #2</h3>
                                <p class="callSubTitle">
                                    {{ $callOut->school?->getMedicalNeeds()->has(1) ? $callOut->school?->getMedicalNeeds()[1]->name : '-' }}
                                </p>
                            </label>
                            <label class="add__schools__inputs-label-item-input">
                                <h3 class="callTitle">Need #4</h3>
                                <p class="callSubTitle">
                                    {{ $callOut->school?->getMedicalNeeds()->has(3) ? $callOut->school?->getMedicalNeeds()[3]->name : '-' }}
                                </p>
                            </label>
                        </div>
                    </div>

                    <div class="add__schools__inputs-header">
                        <div>
                            <h2 class="add__schools__inputs-header-title">Covered by</h2>
                        </div>
                    </div>

                    <livewire:nurse.search
                        :nurses="$nurses"
                        :callOut="$callOut"
                    />

                    <div class="add__schools__inputs-header">
                        <div style="margin-top: 10px">
                            <h2 class="add__schools__inputs-header-title">Principal info</h2>
                        </div>
                    </div>
                    <div class="add__schools__inputs-label">
                        <div class="add__schools__inputs-label-item">
                            <label class="add__schools__inputs-label-item-input">
                                <h3 class="callTitle">School Principal</h3>
                                <p class="callSubTitle">{{ $callOut->school->school_principal->name ?? '-' }}</p>
                            </label>
                            <label class="add__schools__inputs-label-item-input">
                                <h3 class="callTitle">Principal Cell Phone</h3>
                                <p class="callSubTitle">{{ $callOut->school->school_principal->cell_number ?? '-' }}</p>
                            </label>
                        </div>
                        <div class="add__schools__inputs-label-item">
                            <label class="add__schools__inputs-label-item-input">
                                <h3 class="callTitle">Principal email</h3>
                                <p class="callSubTitle">{{ $callOut->school->school_principal->email ?? '-' }}</p>
                            </label>
                            <label class="add__schools__inputs-label-item-input">
                                <h3 class="callTitle">Assignment Priority</h3>
                                <p class="callSubTitle">{{ $callOut->school->assignment_priority ?? '-' }}</p>
                            </label>
                        </div>
                    </div>
                    <div class="add__schools__inputs-textarea">
                        <h3 class="callTitle">Special notes</h3>
                        <textarea
                            class="form-control"
                            placeholder="Type..."
                            id="floatingTextarea2"
                            style="height: 100px"
                            name="special_notes"
                        >{{ $callOut->special_notes }}</textarea>
                    </div>
                    <div class="add__schools__inputs-footer">
                        <div>
                            <a role="button" href="{{ route('main') }}" class="btn-reset btn__outline">Cancel</a>
                        </div>
                        <div>
                            <button type="submit" class="btn-reset btn__green">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="deletModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
             tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <h3 class="modal-body-title">Are you sure you want to remove <br> this call out?</h3>
                        <div class="modal-body-btn">
                            <form action="{{ route('call-out.destroy', $callOut->id) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="modal-body-btn-red">Yes</button>
                            </form>

                            <button class="modal-body-btn-outline" data-bs-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    @include('js.select2-nurse')
@endpush
