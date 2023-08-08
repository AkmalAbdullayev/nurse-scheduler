<div class="add__schools">
    <div class="container-fluid mb-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('main') }}">Schools</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add a school</li>
            </ol>
        </nav>
        <form class="add__schools__inputs" action="{{ route('schools.store') }}" method="post">
            @csrf
            <div class="add__schools__inputs-header">
                <div>
                    <h2 class="add__schools__inputs-header-title">School info</h2>
                </div>

            </div>
            <div class="add__schools__inputs-label" wire:ignore>
                <div class="add__schools__inputs-label-item">
                    <label for="buildingC" class="add__schools__inputs-label-item-input">
                        Building code <span class="text-red">*</span>
                        <input
                            type="text"
                            class="form-control @error('building_code') mb-2 is-invalid @enderror"
                            id="buildingC"
                            placeholder="Type..."
                            name="building_code"
                            value="{{ old('building_code') }}"
                        >
                        @error('building_code') <span class="error"
                                                      style="color: red;">{{ $message }}</span> @enderror
                    </label>

                    <label for="district" class="add__schools__inputs-label-item-input">
                        District <span class="text-red">*</span>
                        <input
                            type="text"
                            class="form-control @error('district') mb-2 is-invalid @enderror"
                            id="district"
                            placeholder="Type..."
                            name="district"
                            value="{{ old('district') }}"
                        >
                        @error('district') <span class="error"
                                                 style="color: red;">{{ $message }}</span> @enderror
                    </label>

                    <label for="primary" class="add__schools__inputs-label-item-input">
                        Primary DBN <span class="text-red">*</span>
                        <input
                            type="text"
                            class="form-control @error('primary_dbn') mb-2 is-invalid @enderror"
                            id="primary"
                            placeholder="Type..."
                            name="primary_dbn"
                            value="{{ old('primary_dbn') }}"
                        >
                        @error('primary_dbn') <span class="error"
                                                    style="color: red;">{{ $message }}</span> @enderror
                    </label>

                    <label for="schoolName" class="add__schools__inputs-label-item-input">
                        School Name <span class="text-red">*</span>
                        <input
                            type="text"
                            class="form-control @error('school_name') mb-2 is-invalid @enderror"
                            id="schoolName"
                            placeholder="Type..."
                            name="school_name"
                            value="{{ old('school_name') }}"
                        >
                        @error('school_name') <span class="error"
                                                    style="color: red;">{{ $message }}</span> @enderror
                    </label>

                    <label for="schoolPhone" class="add__schools__inputs-label-item-input">
                        School Phone <span class="text-red">*</span>
                        <input
                            type="text"
                            class="form-control @error('school_phone') mb-2 is-invalid @enderror"
                            id="phone"
                            placeholder="xxx-xxx-xxxx"
                            name="school_phone"
                            value="{{ old('school_phone') }}"
                        >
                        @error('school_phone') <span class="error"
                                                     style="color: red;">{{ $message }}</span> @enderror
                    </label>

                    <label class="view__school__inputs-label-item-input">
                        <div class="form-check">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                value="1"
                                id="flexCheckDefault"
                                name="is_active"
                                @if(old('is_active') == 1) checked @endif
                            >
                            <label class="form-check-label" for="flexCheckDefault">
                                Active
                            </label>
                        </div>
                    </label>
                </div>

                <div class="add__schools__inputs-label-item">
                    <label for="streetadd__schoolsress1" class="add__schools__inputs-label-item-input">
                        Street address 1 <span class="text-red">*</span>
                        <input
                            type="text"
                            class="form-control @error('street_address_1') mb-2 is-invalid @enderror"
                            id="streetadd__schoolsress1"
                            placeholder="Type..."
                            name="street_address_1"
                            value="{{ old('street_address_1') }}"
                        >
                        @error('street_address_1') <span class="error"
                                                         style="color: red;">{{ $message }}</span> @enderror
                    </label>

                    <label for="streetadd__schoolsress2" class="add__schools__inputs-label-item-input">
                        Street address 2
                        <input
                            type="text"
                            class="form-control"
                            id="streetadd__schoolsress2"
                            placeholder="Type..."
                            name="street_address_2"
                            value="{{ old('street_address_2') }}"
                        >
                    </label>

                    <div class="add__schools__inputs-label-item-select">
                        <label for="City" class="add__schools__inputs-label-item-input">
                            City <span class="text-red">*</span>
                            <input
                                type="text"
                                class="form-control @error('city') mb-2 is-invalid @enderror"
                                id="City" placeholder="Type..."
                                name="city"
                                value="{{ old('city') }}"
                            >
                            @error('city') <span class="error"
                                                 style="color: red;">{{ $message }}</span> @enderror
                        </label>

                        <label for="state" class="add__schools__inputs-label-item-input">
                            State <span class="text-red">*</span>
                            <select
                                class="form-select @error('state_id') mb-2 is-invalid @enderror"
                                id="state"
                                aria-label="Default select example"
                                name="state_id"
                            >
                                <option selected disabled>Select…</option>
                                @forelse($states as $state)
                                    <option
                                        value="{{ $state->id }}"
                                        @if(old('state_id') == $state->id) selected @endif
                                    >
                                        {{ $state->name }}
                                    </option>
                                @empty
                                    <option disabled selected>No data found.</option>
                                @endforelse
                            </select>
                            @error('state_id') <span class="error"
                                                     style="color: red;">{{ $message }}</span> @enderror
                        </label>
                    </div>

                    <div class="add__schools__inputs-label-item-select">
                        <label for="googleMap" class="add__schools__inputs-label-item-input long">
                            Borough <span class="text-red">*</span>
                            <select
                                class="form-select @error('borough_id') mb-2 is-invalid @enderror"
                                id="googleMap"
                                aria-label="Default select example"
                                name="borough_id"
                            >
                                <option selected disabled>Select…</option>
                                @forelse ($boroughs as $k => $borough)
                                    <option
                                        value="{{ ++$k }}"
                                        @if(old('borough_id') == $k) selected @endif
                                    >
                                        {{ $borough }}
                                    </option>
                                @empty
                                    <option disabled>No data found.</option>
                                @endforelse
                            </select>
                            @error('borough_id') <span class="error"
                                                       style="color: red;">{{ $message }}</span> @enderror
                        </label>

                        <label for="code" class="add__schools__inputs-label-item-input"
                               style="max-width: 100%; width: 255px;">
                            ZIP Code <span class="text-red">*</span>
                            <input
                                type="text"
                                class="form-control @error('zip_code') mb-2 is-invalid @enderror"
                                id="code"
                                placeholder="Type..."
                                name="zip_code"
                                value="{{ old('zip_code') }}"
                            >
                            @error('zip_code') <span class="error" style="color: red;">{{ $message }}</span> @enderror
                        </label>
                    </div>

                    <label for="streetadd__schoolsress2" class="add__schools__inputs-label-item-input">
                        Google map
                        <div id="map" style="height: 200px"></div>
                    </label>
                </div>

                <div class="add__schools__inputs-label-item">
                    <h3 class="add__schools__inputs-label-title" style="margin-top: 42px">School Medical
                        needs</h3>
                    <label for="need1" class="add__schools__inputs-label-item-input">
                        Need #1
                        <select
                            class="form-select"
                            id="need1"
                            aria-label="Default select example"
                            name="medical_needs[primary]"
                        >
                            <option disabled selected>Select…</option>
                            @forelse($medicalNeeds as $medicalNeed)
                                <option
                                    value="{{ $medicalNeed->id }}"
                                    @if(old('medical_needs.primary') == $medicalNeed->id) selected @endif
                                >
                                    {{ $medicalNeed->name }}
                                </option>
                            @empty
                                <option disabled>No data found.</option>
                            @endforelse
                        </select>
                    </label>

                    <label for="need2" class="add__schools__inputs-label-item-input">
                        Need #2
                        <select
                            class="form-select"
                            id="need2"
                            aria-label="Default select example"
                            name="medical_needs[secondary]"
                        >
                            <option disabled selected>Select…</option>
                            @forelse($medicalNeeds as $medicalNeed)
                                <option
                                    value="{{ $medicalNeed->id }}"
                                    @if(old('medical_needs.secondary') == $medicalNeed->id) selected @endif
                                >
                                    {{ $medicalNeed->name }}
                                </option>
                            @empty
                                <option disabled>No data found.</option>
                            @endforelse
                        </select>
                    </label>

                    <label for="need3" class="add__schools__inputs-label-item-input">
                        Need #3
                        <select
                            class="form-select"
                            id="need3"
                            aria-label="Default select example"
                            name="medical_needs[tertiary]"
                        >
                            <option disabled selected>Select…</option>
                            @forelse($medicalNeeds as $medicalNeed)
                                <option
                                    value="{{ $medicalNeed->id }}"
                                    @if(old('medical_needs.tertiary') == $medicalNeed->id) selected @endif
                                >
                                    {{ $medicalNeed->name }}
                                </option>
                            @empty
                                <option disabled>No data found.</option>
                            @endforelse
                        </select>
                    </label>
                </div>

                <div class="add__schools__inputs-label-item mt-4">
                    <label for="need4" class="add__schools__inputs-label-item-input">
                        Need #4
                        <select
                            class="form-select"
                            id="need4"
                            aria-label="Default select example"
                            name="medical_needs[fourth]"
                        >
                            <option disabled selected>Select…</option>
                            @forelse($medicalNeeds as $medicalNeed)
                                <option
                                    value="{{ $medicalNeed->id }}"
                                    @if(old('medical_needs.fourth') == $medicalNeed->id) selected @endif
                                >
                                    {{ $medicalNeed->name }}
                                </option>
                            @empty
                                <option disabled>No data found.</option>
                            @endforelse
                        </select>
                    </label>

                    <label for="need5" class="add__schools__inputs-label-item-input">
                        Need #5
                        <select
                            class="form-select"
                            id="need5"
                            aria-label="Default select example"
                            name="medical_needs[fifth]"
                        >
                            <option disabled selected>Select…</option>
                            @forelse($medicalNeeds as $medicalNeed)
                                <option
                                    value="{{ $medicalNeed->id }}"
                                    @if(old('medical_needs.fifth') == $medicalNeed->id) selected @endif
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

            <div class="add__schools__inputs-header">
                <div style="margin-top: 10px">
                    <h2 class="add__schools__inputs-header-title">Nurse info ss</h2>
                </div>
            </div>
            <div class="add__schools__inputs-label">
                <div class="add__schools__inputs-label-item" style="max-width: 100%; width: 927px;">
                    <label for="search" class="add__schools__inputs-label-item-input">
                        Assigned Nurse
                        <div class="add__schools__inputs-label-item-input-search mt-2" wire:ignore>
                            <select class="form-control" id="nurse" name="nurse_id">
                                <option selected disabled>Select...</option>
{{--                                @foreach($activeNurses as $activeNurse)--}}
{{--                                    <option--}}
{{--                                        value="{{ $activeNurse->id }}"--}}
{{--                                        {{ old('nurse_id') == $activeNurse->id ? 'selected' : '' }}--}}
{{--                                        {{ old('nurse_id') == $activeNurse->id ? $nurse = $activeNurse : '' }}--}}
{{--                                    >--}}
{{--                                        {{ $activeNurse->first_name }} {{ $activeNurse->mi }} {{ $activeNurse->last_name }}--}}
{{--                                    </option>--}}
{{--                                @endforeach--}}
                            </select>
                        </div>

                        @if(session()->has('message'))
                            <span class="text-danger mt-2">{{ session('message') }}</span>
                        @endif
                    </label>
                </div>
            </div>
            <div class="add__schools__inputs-label">
                <div class="add__schools__inputs-label-item">
                    <label for="assignedemail" class="add__schools__inputs-label-item-input">
                        Assigned Registered Nurse Name
                        <input
                            type="text"
                            class="form-control"
                            id="assigned"
                            placeholder="Type..."
                            name="nurses[first_name]"
                            @isset($nurse) value="{{ $nurse->first_name }} {{ $nurse->mi }} {{ $nurse->last_name }}"
                            @endisset
                            readonly
                        >
                    </label>

                    <label for="cellPhone" class="add__schools__inputs-label-item-input">
                        Assigned Registered Nurse Cell Phone
                        <input
                            type="text"
                            class="form-control"
                            id="phone"
                            placeholder="xxx-xxx-xxxx"
                            name="nurses[phone]"
                            value="{{ substr($nurse?->cell_number,2) }}"
                            readonly
                        >
                    </label>

                    <label for="cellPhone" class="add__schools__inputs-label-item-input">
                        Assigned Registered Nurse Office Phone
                        <input
                            type="text"
                            class="form-control"
                            id="phone"
                            placeholder="xxx-xxx-xxxx"
                            name="nurses[office_phone]"
                            value="{{ substr($nurse?->office_phone,2) }}"
                            readonly
                        >
                    </label>
                </div>

                <div class="add__schools__inputs-label-item">
                    <label for="email" class="view__school__inputs-label-item-input">
                        Assigned Registered Nurse Email
                        <input
                            type="email"
                            class="form-control"
                            id="email"
                            placeholder="Type..."
                            name="nurses[email]"
                            value="{{ $nurse?->email }}"
                            readonly
                        >
                    </label>

                    <label for="district" class="add__schools__inputs-label-item-input">
                        Assigned Registered Nurse License Number
                        <input
                            type="text"
                            class="form-control"
                            id="assignedPhone3"
                            placeholder="Type..."
                            name="nurses[license_number]"
                            value="{{ $nurse?->license_number }}"
                            readonly
                        >
                    </label>
                </div>

                <div class="add__schools__inputs-label-item">
                    <label for="credential1" class="add__schools__inputs-label-item-input">
                        Nurse credential 1
                        <select
                            class="form-select"
                            id="credential1"
                            aria-label="Default select example"
                            name="nurses[credentials][]"
                        >
                            <option @if(!$nurseCredentials->has(0)) selected @endif disabled>Select…</option>
                            @forelse($credentials as $k => $credential)
                                <option
                                    value="{{ $credential->id }}"
                                @if($nurseCredentials->has(0))
                                    {{ $nurseCredentials[0]->id == $credential->id ? 'selected' : '' }}
                                    @endif
                                >
                                    {{ $credential->name }}
                                </option>
                            @empty
                                <option disabled selected>No data found.</option>
                            @endforelse
                        </select>
                    </label>

                    <label for="credential2" class="add__schools__inputs-label-item-input">
                        Nurse credential 2
                        <select
                            class="form-select"
                            id="credential2"
                            aria-label="Default select example"
                            name="nurses[credentials][]"
                        >
                            <option @if(!$nurseCredentials->has(1)) selected @endif disabled>Select…</option>
                            @forelse($credentials as $k => $credential)
                                <option
                                    value="{{ $credential->id }}"
                                @if($nurseCredentials->has(1))
                                    {{ $nurseCredentials[1]->id == $credential->id ? 'selected' : '' }}
                                    @endif
                                >
                                    {{ $credential->name }}
                                </option>
                            @empty
                                <option disabled selected>No data found.</option>
                            @endforelse
                        </select>
                    </label>

                    <label for="credential3" class="add__schools__inputs-label-item-input">
                        Nurse credential 3
                        <select
                            class="form-select"
                            id="credential3"
                            aria-label="Default select example"
                            name="nurses[credentials][]"
                        >
                            <option @if(!$nurseCredentials->has(2)) selected @endif disabled>Select…</option>
                            @forelse($credentials as $k => $credential)
                                <option
                                    value="{{ $credential->id }}"
                                @if($nurseCredentials->has(2))
                                    {{ $nurseCredentials[2]->id == $credential->id ? 'selected' : '' }}
                                    @endif
                                >
                                    {{ $credential->name }}
                                </option>
                            @empty
                                <option disabled selected>No data found.</option>
                            @endforelse
                        </select>
                    </label>

                    <label for="credential4" class="add__schools__inputs-label-item-input">
                        Nurse credential 4
                        <select
                            class="form-select"
                            id="credential4"
                            aria-label="Default select example"
                            name="nurses[credentials][]"
                        >
                            <option @if(!$nurseCredentials->has(3)) selected @endif disabled>Select…</option>
                            @forelse($credentials as $k => $credential)
                                <option
                                    value="{{ $credential->id }}"
                                @if($nurseCredentials->has(3))
                                    {{ $nurseCredentials[3]->id == $credential->id ? 'selected' : '' }}
                                    @endif
                                >
                                    {{ $credential->name }}
                                </option>
                            @empty
                                <option disabled selected>No data found.</option>
                            @endforelse
                        </select>
                    </label>

                    <label for="credential5" class="add__schools__inputs-label-item-input">
                        Nurse credential 5
                        <select
                            class="form-select"
                            id="credential5"
                            aria-label="Default select example"
                            name="nurses[credentials][]"
                        >
                            <option @if(!$nurseCredentials->has(4)) selected @endif disabled>Select…</option>
                            @forelse($credentials as $k => $credential)
                                <option
                                    value="{{ $credential->id }}"
                                @if($nurseCredentials->has(4))
                                    {{ $nurseCredentials[4]->id == $credential->id ? 'selected' : '' }}
                                    @endif
                                >
                                    {{ $credential->name }}
                                </option>
                            @empty
                                <option disabled selected>No data found.</option>
                            @endforelse
                        </select>
                    </label>
                </div>

                <div class="add__schools__inputs-label-item pt-0">
                    <label for="credential6" class="add__schools__inputs-label-item-input">
                        Nurse credential 6
                        <select
                            class="form-select"
                            id="credential6"
                            aria-label="Default select example"
                            name="nurses[credentials][]"
                        >
                            <option @if(!$nurseCredentials->has(5)) selected @endif disabled>Select…</option>
                            @forelse($credentials as $k => $credential)
                                <option
                                    value="{{ $credential->id }}"
                                @if($nurseCredentials->has(5))
                                    {{ $nurseCredentials[5]->id == $credential->id ? 'selected' : '' }}
                                    @endif
                                >
                                    {{ $credential->name }}
                                </option>
                            @empty
                                <option disabled selected>No data found.</option>
                            @endforelse
                        </select>
                    </label>

                    <label for="credential7" class="add__schools__inputs-label-item-input">
                        Nurse credential 7
                        <select
                            class="form-select"
                            id="credential7"
                            aria-label="Default select example"
                            name="nurses[credentials][]"
                        >
                            <option @if(!$nurseCredentials->has(6)) selected @endif disabled>Select…</option>
                            @forelse($credentials as $k => $credential)
                                <option
                                    value="{{ $credential->id }}"
                                @if($nurseCredentials->has(6))
                                    {{ $nurseCredentials[6]->id == $credential->id ? 'selected' : '' }}
                                    @endif
                                >
                                    {{ $credential->name }}
                                </option>
                            @empty
                                <option disabled selected>No data found.</option>
                            @endforelse
                        </select>
                    </label>

                    <label for="credential8" class="add__schools__inputs-label-item-input">
                        Nurse credential 8
                        <select
                            class="form-select"
                            id="credential8"
                            aria-label="Default select example"
                            name="nurses[credentials][]"
                        >
                            <option @if(!$nurseCredentials->has(7)) selected @endif disabled>Select…</option>
                            @forelse($credentials as $k => $credential)
                                <option
                                    value="{{ $credential->id }}"
                                @if($nurseCredentials->has(7))
                                    {{ $nurseCredentials[7]->id == $credential->id ? 'selected' : '' }}
                                    @endif
                                >
                                    {{ $credential->name }}
                                </option>
                            @empty
                                <option disabled selected>No data found.</option>
                            @endforelse
                        </select>
                    </label>

                    <label for="credential9" class="add__schools__inputs-label-item-input">
                        Nurse credential 9
                        <select
                            class="form-select"
                            id="credential9"
                            aria-label="Default select example"
                            name="nurses[credentials][]"
                        >
                            <option @if(!$nurseCredentials->has(8)) selected @endif disabled>Select…</option>
                            @forelse($credentials as $k => $credential)
                                <option
                                    value="{{ $credential->id }}"
                                @if($nurseCredentials->has(8))
                                    {{ $nurseCredentials[8]->id == $credential->id ? 'selected' : '' }}
                                    @endif
                                >
                                    {{ $credential->name }}
                                </option>
                            @empty
                                <option disabled selected>No data found.</option>
                            @endforelse
                        </select>
                    </label>

                    <label for="credential10" class="add__schools__inputs-label-item-input">
                        Nurse credential 10
                        <select
                            class="form-select"
                            id="credential10"
                            aria-label="Default select example"
                            name="nurses[credentials][]"
                        >
                            <option @if(!$nurseCredentials->has(9)) selected @endif disabled>Select…</option>
                            @forelse($credentials as $k => $credential)
                                <option
                                    value="{{ $credential->id }}"
                                @if($nurseCredentials->has(9))
                                    {{ $nurseCredentials[9]->id == $credential->id ? 'selected' : '' }}
                                    @endif
                                >
                                    {{ $credential->name }}
                                </option>
                            @empty
                                <option disabled selected>No data found.</option>
                            @endforelse
                        </select>
                    </label>
                </div>

            </div>
            <div class="add__schools__inputs-textarea">
                <h3 class="add__schools__inputs-textarea-title">Special notes</h3>
                <textarea
                    class="form-control"
                    placeholder="Type..."
                    style="height: 100px"
                    name="special_notes"
                >{{ old('special_notes') }}</textarea>
            </div>

            <div class="add__schools__inputs-header">
                <div style="margin-top: 10px">
                    <h2 class="add__schools__inputs-header-title">Principal info <span>(All or none)</span></h2>
                </div>
            </div>

            <div class="add__schools__inputs-label">
                <div class="add__schools__inputs-label-item">
                    <label for="principal" class="add__schools__inputs-label-item-input">
                        School Principal
                        <input
                            type="text"
                            class="form-control @error('principals.name') mb-2 is-invalid @enderror"
                            id="principal"
                            placeholder="Type..."
                            name="principals[name]"
                            value="{{ old('principals.name') }}"
                        >
                        @error('principals.name') <span class="error"
                                                        style="color: red;">{{ $message }}</span> @enderror
                    </label>

                    <label for="principalCellPhone" class="add__schools__inputs-label-item-input">
                        Principal Cell Phone
                        <input
                            type="text"
                            class="form-control @error('principals.cell_number') mb-2 is-invalid @enderror"
                            id="phone"
                            placeholder="xxx-xxx-xxxx"
                            name="principals[cell_number]"
                            value="{{ old('principals.cell_number') }}"
                        >
                        @error('principals.cell_number') <span class="error"
                                                               style="color: red;">{{ $message }}</span> @enderror
                    </label>

                </div>

                <div class="add__schools__inputs-label-item">
                    <label for="principalemail" class="add__schools__inputs-label-item-input">
                        Principal email
                        <input
                            type="email"
                            class="form-control @error('principals.email') mb-2 is-invalid @enderror"
                            id="principalemail"
                            placeholder="Type..."
                            name="principals[email]"
                            value="{{ old('principals.email') }}"
                        >
                        @error('principals.email') <span class="error"
                                                         style="color: red;">{{ $message }}</span> @enderror
                    </label>

                    <label for="priority" class="add__schools__inputs-label-item-input">
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
            {{--            <div class="add__schools__inputs-school">--}}
            {{--                <h3 class="add__schools__inputs-school-title">School History</h3>--}}
            {{--                <div class="add__schools__inputs-school-info">--}}
            {{--                    <p class="add__schools__inputs-school-info-desc">Event</p>--}}
            {{--                    <p class="add__schools__inputs-school-info-desc">Date</p>--}}
            {{--                </div>--}}
            {{--                <div class="add__schools__inputs-school-date">--}}
            {{--                    <p class="add__schools__inputs-school-date-desc">Record Created</p>--}}
            {{--                    <p class="add__schools__inputs-school-date-desc">August 02, 2022 12:00 am</p>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            <div class="add__schools__inputs-footer">
                <div>
                    <a
                        href="{{ route('main') }}"
                        class="btn-reset btn__outline"
                        id="cancel-btn"
                    >
                        Cancel
                    </a>
                </div>
                <div>
                    {{--                    <button type="button" class="btn-reset btn__dark">Send Reset Password Link</button>--}}
                    <button
                        type="submit"
                        class="btn-reset btn__green"
                        id="submit-btn"
                    >
                        Create
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deletModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
         tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 class="modal-body-title">Are you sure you want to delete</h3>
                    <p class="modal-body-desc">Belinda Michelle Gates record?</p>
                    <div class="modal-body-btn">
                        <button class="modal-body-btn-outline" data-bs-dismiss="modal">Cancel</button>
                        <button class="modal-body-btn-red">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    @include('js.select2-nurse', ['nurses' => $activeNurses])

    <script defer>
        document.getElementById('nurse').onchange = () => {
            const data = document.getElementById('nurse').value;
        @this.set('nurse_id', data);
        }
    </script>
@endpush

