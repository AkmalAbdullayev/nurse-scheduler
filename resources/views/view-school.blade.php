@extends('layouts.master')

@section('content')
    <div class="view__school">
        <div class="container-fluid mb-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('main') }}">Schools</a></li>
                    <li class="breadcrumb-item active" aria-current="page">View a school</li>
                </ol>
            </nav>
            <div class="view__school__inputs">
                <form action="{{ route('schools.update', $school->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="view__school__inputs-header">
                        <div>
                            <h2 class="view__school__inputs-header-title">School info</h2>
                        </div>
                        <div>
                            <ul class="list-group list-group-horizontal-lg">
                                <li class="list-group-item" data-bs-toggle="modal" href="#deletModalToggle"
                                    role="button">
                                    <span class="list-group-item-span"><img src="{{ asset('img/delet.svg') }}"
                                                                            alt=""></span>
                                </li>
                                <li class="list-group-item">
                                    <span class="list-group-item-span"><img src="{{ asset('img/print.svg') }}"
                                                                            alt=""></span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="view__school__inputs-label">
                        <div class="view__school__inputs-label-item">
                            <label for="buildingC" class="view__school__inputs-label-item-input">
                                Building code <span class="text-red">*</span>
                                <input
                                    type="text"
                                    class="form-control @error('building_code') is-invalid @enderror"
                                    id="buildingC"
                                    placeholder="Type..."
                                    name="building_code"
                                    value="{{ $school->building_code }}"
                                >
                            </label>

                            @error('building_code') <span class="text-danger">{{ $message }}</span> @enderror

                            <label for="district" class="view__school__inputs-label-item-input">
                                District <span class="text-red">*</span>
                                <input
                                    type="text"
                                    class="form-control @error('district') is-invalid @enderror"
                                    id="district"
                                    placeholder="Type..."
                                    name="district"
                                    value="{{ $school->district }}"
                                >
                            </label>

                            @error('district') <span class="text-danger">{{ $message }}</span> @enderror

                            <label for="primary" class="view__school__inputs-label-item-input">
                                Primary DBN <span class="text-red">*</span>
                                <input
                                    type="text"
                                    class="form-control @error('primary_dbn') is-invalid @enderror"
                                    id="primary"
                                    placeholder="Type..."
                                    name="primary_dbn"
                                    value="{{ $school->primary_dbn }}"
                                >
                            </label>

                            @error('primary_dbn') <span class="text-danger">{{ $message }}</span> @enderror

                            <label for="schoolName" class="view__school__inputs-label-item-input">
                                School Name <span class="text-red">*</span>
                                <input
                                    type="text"
                                    class="form-control @error('school_name') is-invalid @enderror"
                                    id="schoolName"
                                    placeholder="Type..."
                                    name="school_name"
                                    value="{{ $school->school_name }}"
                                >
                            </label>

                            @error('school_name') <span class="text-danger">{{ $message }}</span> @enderror

                            <label for="schoolPhone" class="view__school__inputs-label-item-input">
                                School Phone <span class="text-red">*</span>
                                <input
                                    type="text"
                                    class="form-control @error('school_phone') is-invalid @enderror"
                                    id="phone"
                                    placeholder="xxx-xxx-xxxx"
                                    name="school_phone"
                                    value="{{ substr($school->school_phone, 2) }}"
                                >
                            </label>

                            @error('school_phone') <span class="text-danger">{{ $message }}</span> @enderror

                            <label class="view__school__inputs-label-item-input">
                                <div class="form-check">
                                    <input
                                        class="form-check-input @error('is_active') is-invalid @enderror"
                                        type="checkbox"
                                        value="1"
                                        id="flexCheckDefault"
                                        name="is_active"
                                        @checked($school->is_active)
                                    >
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Active
                                    </label>
                                </div>
                            </label>

                            @error('is_active') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="view__school__inputs-label-item">
                            <label for="streetview__schoolress1" class="view__school__inputs-label-item-input">
                                Street Address 1 <span class="text-red">*</span>
                                <input
                                    type="text"
                                    class="form-control @error('street_address_1') is-invalid @enderror"
                                    id="streetview__schoolress1"
                                    placeholder="Type..."
                                    name="street_address_1"
                                    value="{{ $school->street_address_1 }}"
                                >
                            </label>

                            @error('street_address_1') <span class="text-danger">{{ $message }}</span> @enderror

                            <label for="streetview__schoolress2" class="view__school__inputs-label-item-input">
                                Street Address 2
                                <input
                                    type="text"
                                    class="form-control @error('street_address_2') is-invalid @enderror"
                                    id="streetview__schoolress2"
                                    placeholder="Type..."
                                    name="street_address_2"
                                    value="{{ $school->street_address_2 }}"
                                >
                            </label>

                            @error('street_address_2') <span class="text-danger">{{ $message }}</span> @enderror

                            <div class="view__school__inputs-label-item-select">
                                <label for="City" class="view__school__inputs-label-item-input">
                                    City <span class="text-red">*</span>
                                    <input
                                        type="text"
                                        class="form-control @error('city') is-invalid @enderror"
                                        id="City"
                                        placeholder="Type..."
                                        name="city"
                                        value="{{ $school->city }}"
                                    >
                                </label>

                                @error('city') <span class="text-danger">{{ $message }}</span> @enderror

                                <label for="state" class="view__school__inputs-label-item-input">
                                    State <span class="text-red">*</span>
                                    <select
                                        class="form-select @error('state_id') is-invalid @enderror"
                                        id="state"
                                        aria-label="Default select example"
                                        name="state_id"
                                    >
                                        <option selected disabled>Select…</option>
                                        @forelse($states as $state)
                                            <option
                                                value="{{ $state->id }}"
                                                @if ($state->id == $school->id) selected @endif
                                            >
                                                {{ $state->name }}
                                            </option>
                                        @empty
                                            <option disabled selected>No data found.</option>
                                        @endforelse
                                    </select>
                                </label>

                                @error('state_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="view__school__inputs-label-item-select">
                                <label for="googleMap" class="view__school__inputs-label-item-input long">
                                    Borough <span class="text-red">*</span>
                                    <select
                                        class="form-select @error('borough_id') is-invalid @enderror"
                                        id="googleMap"
                                        aria-label="Default select example"
                                        name="borough_id"
                                    >
                                        <option selected disabled>Select…</option>
                                        @forelse ($boroughs as $k => $borough)
                                            <option
                                                value="{{ ++$k }}"
                                                @if ($k == $school->borough_id) selected @endif
                                            >
                                                {{ $borough }}
                                            </option>
                                        @empty
                                            <option disabled>No data found.</option>
                                        @endforelse
                                    </select>
                                </label>

                                @error('borough_id') <span class="text-danger">{{ $message }}</span> @enderror

                                <label for="code" class="view__school__inputs-label-item-input"
                                       style="width: 255px; max-width: 100%">
                                    ZIP Code <span class="text-red">*</span>
                                    <input
                                        type="text"
                                        class="form-control @error('zip_code') is-invalid @enderror"
                                        id="code"
                                        placeholder="Type..."
                                        name="zip_code"
                                        value="{{ $school->zip_code }}"
                                    >
                                </label>

                                @error('zip_code') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <label for="streetadd__schoolsress2" class="add__schools__inputs-label-item-input">
                                Google map
                                <div id="map" style="height: 200px"></div>
                            </label>
                        </div>

                        <div class="view__school__inputs-label-item">
                            <h3 class="view__school__inputs-label-title" style="margin-top: 42px">School Medical
                                needs</h3>
                            <label for="need1" class="view__school__inputs-label-item-input">
                                Need #1
                                <select
                                    class="form-select"
                                    id="need1"
                                    aria-label="Default select example"
                                    name="medical_needs[]"
                                >
                                    <option disabled @if(!$schoolMedicalNeeds->has(0)) selected @endif>Select…</option>
                                    @forelse($medicalNeeds as $medicalNeed)
                                        <option
                                            value="{{ $medicalNeed->id }}"
                                        @if($schoolMedicalNeeds->has(0))
                                            {{ $schoolMedicalNeeds[0]->id == $medicalNeed->id ? 'selected' : '' }}
                                            @endif
                                        >
                                            {{ $medicalNeed->name }}
                                        </option>
                                    @empty
                                        <option disabled>No data found.</option>
                                    @endforelse
                                </select>
                            </label>

                            <label for="need2" class="view__school__inputs-label-item-input">
                                Need #2
                                <select
                                    class="form-select"
                                    id="need2"
                                    aria-label="Default select example"
                                    name="medical_needs[]"
                                >
                                    <option disabled @if(!$schoolMedicalNeeds->has(1)) selected @endif>Select…</option>
                                    @forelse($medicalNeeds as $medicalNeed)
                                        <option
                                            value="{{ $medicalNeed->id }}"
                                        @if($schoolMedicalNeeds->has(1))
                                            {{ $schoolMedicalNeeds[1]->id == $medicalNeed->id ? 'selected' : '' }}
                                            @endif
                                        >
                                            {{ $medicalNeed->name }}
                                        </option>
                                    @empty
                                        <option disabled>No data found.</option>
                                    @endforelse
                                </select>
                            </label>

                            <label for="need3" class="view__school__inputs-label-item-input">
                                Need #3
                                <select
                                    class="form-select"
                                    id="need3"
                                    aria-label="Default select example"
                                    name="medical_needs[]"
                                >
                                    <option disabled @if(!$schoolMedicalNeeds->has(2)) selected @endif>Select…</option>
                                    @forelse($medicalNeeds as $medicalNeed)
                                        <option
                                            value="{{ $medicalNeed->id }}"
                                        @if($schoolMedicalNeeds->has(2))
                                            {{ $schoolMedicalNeeds[2]->id == $medicalNeed->id ? 'selected' : '' }}
                                            @endif
                                        >
                                            {{ $medicalNeed->name }}
                                        </option>
                                    @empty
                                        <option disabled>No data found.</option>
                                    @endforelse
                                </select>
                            </label>

                            <label for="need4" class="view__school__inputs-label-item-input">
                                Need #4
                                <select
                                    class="form-select"
                                    id="need4"
                                    aria-label="Default select example"
                                    name="medical_needs[]"
                                >
                                    <option disabled @if(!$schoolMedicalNeeds->has(3)) selected @endif>Select…</option>
                                    @forelse($medicalNeeds as $medicalNeed)
                                        <option
                                            value="{{ $medicalNeed->id }}"
                                        @if($schoolMedicalNeeds->has(3))
                                            {{ $schoolMedicalNeeds[3]->id == $medicalNeed->id ? 'selected' : '' }}
                                            @endif
                                        >
                                            {{ $medicalNeed->name }}
                                        </option>
                                    @empty
                                        <option disabled>No data found.</option>
                                    @endforelse
                                </select>
                            </label>

                            <label for="need5" class="view__school__inputs-label-item-input">
                                Need #5
                                <select
                                    class="form-select"
                                    id="need5"
                                    aria-label="Default select example"
                                    name="medical_needs[]"
                                >
                                    <option disabled @if(!$schoolMedicalNeeds->has(4)) selected @endif>Select…</option>
                                    @forelse($medicalNeeds as $medicalNeed)
                                        <option
                                            value="{{ $medicalNeed->id }}"
                                        @if($schoolMedicalNeeds->has(4))
                                            {{ $schoolMedicalNeeds[4]->id == $medicalNeed->id ? 'selected' : '' }}
                                            @endif
                                        >
                                            {{ $medicalNeed->name }}
                                        </option>
                                    @empty
                                        <option disabled>No data found.</option>
                                    @endforelse
                                </select>
                            </label>
                        </div>
                    </div>

                    <livewire:school.view
                        :credentials="$credentials"
                        :school="$school"
                    ></livewire:school.view>

                    <div class="view__school__inputs-textarea">
                        <h3 class="view__school__inputs-textarea-title">Special notes</h3>
                        <textarea
                            class="form-control @error('special_notes') is-invalid @enderror"
                            style="height: 100px"
                            placeholder="Type..."
                            name="special_notes"
                        >{{ $school->special_notes }}</textarea>
                    </div>

                    @error('special_notes') <span class="text-danger">{{ $message }}</span> @enderror

                    <div class="view__school__inputs-header">
                        <div style="margin-top: 10px">
                            <h2 class="view__school__inputs-header-title">Principal info <span>(All or none)</span></h2>
                        </div>
                    </div>
                    <div class="view__school__inputs-label">
                        <div class="view__school__inputs-label-item">
                            <label for="principal" class="view__school__inputs-label-item-input">
                                School principal
                                <input
                                    type="text"
                                    class="form-control @error('principals.name') mb-2 is-invalid @enderror"
                                    id="principal"
                                    placeholder="Type..."
                                    name="principals[name]"
                                    value="{{ $school->school_principal?->name }}"
                                >

                                @error('principals.name') <span class="error"
                                                                style="color: red;">{{ $message }}</span> @enderror

                                <input
                                    type="hidden"
                                    name="principals[id]"
                                    value="{{ $school->school_principal?->id }}"
                                >
                            </label>

                            <label for="principalC" class="view__school__inputs-label-item-input">
                                Principal Cell Phone
                                <input
                                    type="assignedPhone"
                                    class="form-control @error('principals.cell_number') mb-2 is-invalid @enderror"
                                    id="phone"
                                    placeholder="xxx-xxx-xxxx"
                                    name="principals[cell_number]"
                                    value="{{ substr($school->school_principal?->cell_number, 2) }}"
                                >

                                @error('principals.cell_number') <span class="error"
                                                                       style="color: red;">{{ $message }}</span> @enderror
                            </label>
                        </div>

                        <div class="view__school__inputs-label-item">
                            <label for="principalemail" class="view__school__inputs-label-item-input">
                                Principal email
                                <input
                                    type="email"
                                    class="form-control @error('principals.email') mb-2 is-invalid @enderror"
                                    id="principalemail"
                                    placeholder="Type..."
                                    name="principals[email]"
                                    value="{{ $school->school_principal?->email }}"
                                >

                                @error('principals.email') <span class="error"
                                                                 style="color: red;">{{ $message }}</span> @enderror
                            </label>

                            <label for="priority" class="view__school__inputs-label-item-input">
                                Assignment Priority
                                <select
                                    class="form-select"
                                    id="priority"
                                    aria-label="Default select example"
                                    name="assignment_priority"
                                >
                                    <option selected disabled>Select…</option>
                                    @forelse($assignment_priorities as $assignment_priority)
                                        <option
                                            value="{{ $assignment_priority }}"
                                            @if(old('assignment_priority') == $assignment_priority) selected @endif
                                        >
                                            {{ $assignment_priority }}
                                        </option>
                                    @empty
                                        <option selected disabled>No data found.</option>
                                    @endforelse
                                </select>
                            </label>
                        </div>
                    </div>

                    @if($school->subject->isNotEmpty())
                        <div class="view__school__inputs-school">
                            <h3 class="view__school__inputs-school-title">School History</h3>
                            <div class="view__school__inputs-school-info">
                                <p class="view__school__inputs-school-info-desc">Event</p>
                                <p class="view__school__inputs-school-info-desc">Date</p>
                            </div>
                            @forelse($school->subject as $log)
                                <div class="view__school__inputs-school-date">
                                    <p class="view__school__inputs-school-date-desc">{{ $log->description }}</p>
                                    <p class="view__school__inputs-school-date-desc">{{ $log->created_at->format('F d, Y g:i A') }}</p>
                                </div>
                            @empty

                            @endforelse
                        </div>
                    @endif
                    <div class="view__school__inputs-footer">
                        <div>
                            <a role="button" class="btn-reset btn__outline" href="{{ route('main') }}">Cancel</a>
                        </div>
                        <div class="view__school__inputs-footer-btns">
                            @if ($school->is_active)
                                <a
                                    role="button"
                                    class="btn-reset btn__dark"
                                    href="{{ route('call-out.school', $school->id) }}"
                                >
                                    Create Call-out
                                </a>
                            @endif
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
                        <h3 class="modal-body-title">Are you sure you want to delete</h3>
                        <p class="modal-body-desc">{{ $school->school_name }} record?</p>
                        <div class="modal-body-btn">
                            <button class="modal-body-btn-outline" data-bs-dismiss="modal">Cancel</button>
                            <form action="{{ route('schools.destroy', $school->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="modal-body-btn-red">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
