@extends('layouts.master')

@section('content')
    <div class="add">
        <div class="container-fluid mb-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('main') }}">Nurses</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add a nurse</li>
                </ol>
            </nav>
            <div class="add__inputs">
                <h2 class="add__inputs-title">Add a Nurse</h2>
                <form action="{{ route('nurses.store') }}" method="post">
                    @csrf
                    <div class="add__inputs-label">
                        <div class="add__inputs-label-item">
                            <label for="name" class="add__inputs-label-item-input">
                                First Name <span class="text-red">*</span>
                                <input
                                    type="text"
                                    class="form-control @error('first_name') mb-2 is-invalid @enderror"
                                    id="name"
                                    placeholder="Type..."
                                    name="first_name"
                                    value="{{ old('first_name') }}"
                                >
                                @error('first_name') <span class="error"
                                                           style="color: red;">{{ $message }}</span> @enderror
                            </label>

                            <label for="middleName" class="add__inputs-label-item-input">
                                Middle Name
                                <input
                                    type="text"
                                    class="form-control"
                                    id="middleName"
                                    placeholder="Type..."
                                    name="mi"
                                    value="{{ old('mi') }}"
                                >
                            </label>

                            <label for="lastName" class="add__inputs-label-item-input">
                                Last Name <span class="text-red">*</span>
                                <input
                                    type="text"
                                    class="form-control @error('last_name') mb-2 is-invalid @enderror"
                                    id="lastName"
                                    placeholder="Type..."
                                    name="last_name"
                                    value="{{ old('last_name') }}"
                                >
                                @error('last_name') <span class="error"
                                                          style="color: red;">{{ $message }}</span> @enderror
                            </label>

                            <label for="cellPhone" class="add__inputs-label-item-input">
                                Cell Phone <span class="text-red">*</span>
                                <input
                                    type="text"
                                    class="form-control @error('cell_number') mb-2 is-invalid @enderror"
                                    id="phone"
                                    placeholder="xxx-xxx-xxxx"
                                    name="cell_number"
                                    value="{{ old('cell_number') }}"
                                >
                                @if (session()->has('message')) <span class="text-danger">{{ session('message') }}</span> @endif
                            </label>

                            <label for="email" class="add__inputs-label-item-input">
                                Email Address <span class="text-red">*</span>
                                <input
                                    type="email"
                                    class="form-control @error('email') mb-2 is-invalid @enderror"
                                    id="email"
                                    placeholder="Type..."
                                    name="email"
                                    value="{{ old('email') }}"
                                >
                                @error('email') <span class="error"
                                                      style="color: red;">{{ $message }}</span> @enderror
                            </label>

                            <label for="licenseNumber" class="add__inputs-label-item-input">
                                License number <span class="text-red">*</span>
                                <input
                                    type="text"
                                    class="form-control @error('license_number') mb-2 is-invalid @enderror"
                                    id="licenseNumber"
                                    placeholder="Type..."
                                    name="license_number"
                                    value="{{ old('license_number') }}"
                                >
                                @error('license_number') <span class="error"
                                                               style="color: red;">{{ $message }}</span> @enderror
                            </label>
                        </div>
                        <div class="add__inputs-label-item">
                            <label for="streetAddress1" class="add__inputs-label-item-input">
                                Street Address 1
                                <input
                                    type="text"
                                    class="form-control @error('street_address_1') mb-2 is-invalid @enderror"
                                    id="streetAddress1"
                                    placeholder="Type..."
                                    name="street_address_1"
                                    value="{{ old('street_address_1') }}"
                                >
                                @error('street_address_1') <span class="error"
                                                                 style="color: red;">{{ $message }}</span> @enderror
                            </label>

                            <label for="streetAddress2" class="add__inputs-label-item-input">
                                Street Address 2
                                <input
                                    type="text"
                                    class="form-control"
                                    id="streetAddress2"
                                    placeholder="Type..."
                                    name="street_address_2"
                                    value="{{ old('street_address_2') }}"
                                >
                            </label>

                            <div class="add__inputs-label-item-select">
                                <label for="City" class="add__inputs-label-item-input">
                                    City
                                    <input
                                        type="text"
                                        class="form-control @error('city') mb-2 is-invalid @enderror"
                                        id="City"
                                        placeholder="Type..."
                                        name="city"
                                        value="{{ old('city') }}"
                                    >
                                    @error('city') <span class="error"
                                                         style="color: red;">{{ $message }}</span> @enderror
                                </label>

                                <label for="state" class="add__inputs-label-item-input">
                                    State
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

                            <div class="add__inputs-label-item-select">
                                <label for="borough" class="add__inputs-label-item-input">
                                    Borough <span class="text-red">*</span>
                                    <select
                                        class="form-select @error('borough_id') mb-2 is-invalid @enderror"
                                        id="borough"
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

                                <label for="zipC" class="add__inputs-label-item-input"
                                       style="width: 255px; max-width: 100%">
                                    ZIP Code
                                    <input
                                        type="text"
                                        class="form-control @error('zip_code') mb-2 is-invalid @enderror"
                                        id="zipC"
                                        placeholder="Type..."
                                        name="zip_code"
                                        value="{{ old('zip_code') }}"
                                    >
                                    @error('zip_code') <span class="error"
                                                             style="color: red;">{{ $message }}</span> @enderror
                                </label>
                            </div>

                            <label for="desired1" class="add__inputs-label-item-input">
                                Desired Primary Borough <span class="text-red">*</span>
                                <select
                                    class="form-select @error('boroughs.primary') mb-2 is-invalid @enderror"
                                    id="desired1"
                                    aria-label="Default select example"
                                    name="boroughs[primary]"
                                >
                                    <option selected disabled>Select…</option>
                                    @forelse ($boroughs as $k => $borough)
                                        <option
                                            value="{{ ++$k }}"
                                            @if(old('boroughs.primary') == $k) selected @endif
                                        >
                                            {{ $borough }}
                                        </option>
                                    @empty
                                        <option disabled>No data found.</option>
                                    @endforelse
                                </select>
                                @error('boroughs.primary') <span class="error"
                                                         style="color: red;">{{ $message }}</span> @enderror
                            </label>

                            <label for="desired1" class="add__inputs-label-item-input">
                                Desired Secondary Borough
                                <select
                                    class="form-select"
                                    id="desired1"
                                    aria-label="Default select example"
                                    name="boroughs[secondary]"
                                >
                                    <option selected disabled>Select…</option>
                                    @forelse ($boroughs as $k => $borough)
                                        <option
                                            value="{{ ++$k }}"
                                            @if(old('boroughs.secondary') == $k) selected @endif
                                        >
                                            {{ $borough }}
                                        </option>
                                    @empty
                                        <option disabled>No data found.</option>
                                    @endforelse
                                </select>

                            </label>

                            <label for="desired2" class="add__inputs-label-item-input">
                                Desired Third Borough
                                <select
                                    class="form-select"
                                    id="desired2"
                                    aria-label="Default select example"
                                    name="boroughs[tertiary]"
                                >
                                    <option selected disabled>Select…</option>
                                    @forelse ($boroughs as $k => $borough)
                                        <option
                                            value="{{ ++$k }}"
                                            @if(old('boroughs.tertiary') == $k) selected @endif
                                        >
                                            {{ $borough }}
                                        </option>
                                    @empty
                                        <option disabled>No data found.</option>
                                    @endforelse
                                </select>
                            </label>

                            <label for="desired3" class="add__inputs-label-item-input">
                                Desired Fourth Borough
                                <select
                                    class="form-select"
                                    id="desired3"
                                    aria-label="Default select example"
                                    name="boroughs[fourth]"
                                >
                                    <option selected disabled>Select…</option>
                                    @forelse ($boroughs as $k => $borough)
                                        <option
                                            value="{{ ++$k }}"
                                            @if(old('boroughs.fourth') == $k) selected @endif
                                        >
                                            {{ $borough }}
                                        </option>
                                    @empty
                                        <option disabled>No data found.</option>
                                    @endforelse
                                </select>
                            </label>

                            <label for="desired4" class="add__inputs-label-item-input">
                                Desired Fifth Borough
                                <select
                                    class="form-select"
                                    id="desired4"
                                    aria-label="Default select example"
                                    name="boroughs[fifth]"
                                >
                                    <option selected disabled>Select…</option>
                                    @forelse ($boroughs as $k => $borough)
                                        <option
                                            value="{{ ++$k }}"
                                            @if(old('boroughs.fifth') == $k) selected @endif
                                        >
                                            {{ $borough }}
                                        </option>
                                    @empty
                                        <option disabled>No data found.</option>
                                    @endforelse
                                </select>
                            </label>
                        </div>

                        <div class="add__inputs-label-item">
                            <h3 class="add__inputs-label-title">Nurse Credential </h3>
                            <label for="credential1" class="add__inputs-label-item-input">
                                Credential #1 <span class="text-red">*</span>
                                <select
                                    class="form-select @error('credentials.primary') is-invalid mb-2 @enderror"
                                    id="credential1"
                                    aria-label="Default select example"
                                    name="credentials[primary]"
                                >
                                    <option disabled selected>Select…</option>
                                    @forelse($credentials as $credential)
                                        <option
                                            value="{{ $credential->id }}"
                                            @if(old('credentials.primary') == $credential->id) selected @endif
                                        >
                                            {{ $credential->name }}
                                        </option>
                                    @empty
                                        <option>No data found.</option>
                                    @endforelse
                                </select>

                                @error('credentials.primary') <span class="error"
                                                                    style="color: red;">{{ $message }}</span> @enderror
                            </label>

                            <label for="credential2" class="add__inputs-label-item-input">
                                Credential #2
                                <select
                                    class="form-select"
                                    id="credential1"
                                    aria-label="Default select example"
                                    name="credentials[secondary]"
                                >
                                    <option disabled selected>Select…</option>
                                    @forelse($credentials as $credential)
                                        <option
                                            value="{{ $credential->id }}"
                                            @if(old('credentials.secondary') == $credential->id) selected @endif
                                        >
                                            {{ $credential->name }}
                                        </option>
                                    @empty
                                        <option>No data found.</option>
                                    @endforelse
                                </select>
                            </label>

                            <label for="credential3" class="add__inputs-label-item-input">
                                Credential #3
                                <select
                                    class="form-select"
                                    id="credential1"
                                    aria-label="Default select example"
                                    name="credentials[tertiary]"
                                >
                                    <option disabled selected>Select…</option>
                                    @forelse($credentials as $credential)
                                        <option
                                            value="{{ $credential->id }}"
                                            @if(old('credentials.tertiary') == $credential->id) selected @endif
                                        >
                                            {{ $credential->name }}
                                        </option>
                                    @empty
                                        <option>No data found.</option>
                                    @endforelse
                                </select>
                            </label>

                            <label for="credential4" class="add__inputs-label-item-input">
                                Credential #4
                                <select
                                    class="form-select"
                                    id="credential1"
                                    aria-label="Default select example"
                                    name="credentials[fourth]"
                                >
                                    <option disabled selected>Select…</option>
                                    @forelse($credentials as $credential)
                                        <option
                                            value="{{ $credential->id }}"
                                            @if(old('credentials.fourth') == $credential->id) selected @endif
                                        >
                                            {{ $credential->name }}
                                        </option>
                                    @empty
                                        <option>No data found.</option>
                                    @endforelse
                                </select>
                            </label>

                            <label for="credential5" class="add__inputs-label-item-input">
                                Credential #5
                                <select
                                    class="form-select"
                                    id="credential1"
                                    aria-label="Default select example"
                                    name="credentials[fifth]"
                                >
                                    <option disabled selected>Select…</option>
                                    @forelse($credentials as $credential)
                                        <option
                                            value="{{ $credential->id }}"
                                            @if(old('credentials.fifth') == $credential->id) selected @endif
                                        >
                                            {{ $credential->name }}
                                        </option>
                                    @empty
                                        <option>No data found.</option>
                                    @endforelse
                                </select>
                            </label>

                            <label for="credential6" class="add__inputs-label-item-input">
                                Credential #6
                                <select
                                    class="form-select"
                                    id="credential1"
                                    aria-label="Default select example"
                                    name="credentials[sixth]"
                                >
                                    <option disabled selected>Select…</option>
                                    @forelse($credentials as $credential)
                                        <option
                                            value="{{ $credential->id }}"
                                            @if(old('credentials.sixth') == $credential->id) selected @endif
                                        >
                                            {{ $credential->name }}
                                        </option>
                                    @empty
                                        <option>No data found.</option>
                                    @endforelse
                                </select>
                            </label>

                            <label for="credential7" class="add__inputs-label-item-input">
                                Credential #7
                                <select
                                    class="form-select"
                                    id="credential1"
                                    aria-label="Default select example"
                                    name="credentials[seventh]"
                                >
                                    <option disabled selected>Select…</option>
                                    @forelse($credentials as $credential)
                                        <option
                                            value="{{ $credential->id }}"
                                            @if(old('credentials.seventh') == $credential->id) selected @endif
                                        >
                                            {{ $credential->name }}
                                        </option>
                                    @empty
                                        <option>No data found.</option>
                                    @endforelse
                                </select>
                            </label>

                            <label for="credential8" class="add__inputs-label-item-input">
                                Credential #8
                                <select
                                    class="form-select"
                                    id="credential1"
                                    aria-label="Default select example"
                                    name="credentials[eighth]"
                                >
                                    <option disabled selected>Select…</option>
                                    @forelse($credentials as $credential)
                                        <option
                                            value="{{ $credential->id }}"
                                            @if(old('credentials.eighth') == $credential->id) selected @endif
                                        >
                                            {{ $credential->name }}
                                        </option>
                                    @empty
                                        <option>No data found.</option>
                                    @endforelse
                                </select>
                            </label>

                            <label for="credential9" class="add__inputs-label-item-input">
                                Credential #9
                                <select
                                    class="form-select"
                                    id="credential1"
                                    aria-label="Default select example"
                                    name="credentials[ninth]"
                                >
                                    <option disabled selected>Select…</option>
                                    @forelse($credentials as $credential)
                                        <option
                                            value="{{ $credential->id }}"
                                            @if(old('credentials.ninth') == $credential->id) selected @endif
                                        >
                                            {{ $credential->name }}
                                        </option>
                                    @empty
                                        <option>No data found.</option>
                                    @endforelse
                                </select>
                            </label>

                            <label for="credential10" class="add__inputs-label-item-input">
                                Credential #10
                                <select
                                    class="form-select"
                                    id="credential1"
                                    aria-label="Default select example"
                                    name="credentials[tenth]"
                                >
                                    <option disabled selected>Select…</option>
                                    @forelse($credentials as $credential)
                                        <option
                                            value="{{ $credential->id }}"
                                            @if(old('credentials.tenth') == $credential->id) selected @endif
                                        >
                                            {{ $credential->name }}
                                        </option>
                                    @empty
                                        <option>No data found.</option>
                                    @endforelse
                                </select>
                            </label>

                            <label for="role" class="add__inputs-label-item-input">
                                Role <span class="text-red">*</span>
                                <select
                                    class="form-select @error('role') is-invalid mb-2 @enderror"
                                    id="role"
                                    aria-label="Default select example"
                                    name="role"
                                >
                                    <option selected disabled>Select…</option>
                                    @foreach($roles as $k => $role)
                                        <option
                                            value="{{ $role }}"
                                            @if (old('role') == $role) selected @endif
                                        >
                                            {{ $role }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('role') <span class="error"
                                                     style="color: red;">{{ $message }}</span> @enderror
                            </label>
                            <label for="role" class="add__inputs-label-item-input">
                                {{--                                Role--}}
                                {{--                                <p class="add__inputs-label-item-input-number">FT Float Nurse</p>--}}
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        value="1"
                                        id="flexCheckDefault"
                                        name="active_for_assignments"
                                        onclick="disableFields()"
                                        {{ old('active_for_assignments') == 1 ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Active
                                    </label>
                                </div>
                            </label>
                        </div>

                        <div class="add__inputs-label-item">
                            <h3 class="add__inputs-label-title">Medical skills</h3>
                            <label for="need1" class="add__inputs-label-item-input">
                                Skill #1
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

                            <label for="need2" class="add__inputs-label-item-input">
                                Skill #2
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

                            <label for="need2" class="add__inputs-label-item-input">
                                Skill #3
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

                            <label for="need4" class="add__inputs-label-item-input">
                                Skill #4
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

                            <label for="need5" class="add__inputs-label-item-input">
                                Skill #5
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

                            <label for="need5" class="add__inputs-label-item-input">
                                Last date assigned
                                <p class="add__inputs-label-item-input-number">-</p>
                            </label>
                        </div>
                    </div>

                    <div class="add__inputs-textarea">
                        <h3 class="add__inputs-textarea-title">Special notes</h3>
                        <textarea
                            class="form-control"
                            placeholder="Type..."
                            id="floatingTextarea2"
                            style="height: 100px "
                            name="special_notes"
                        >{{ old('special_notes') }}</textarea>
                    </div>

                    <div class="add__inputs-footer">
                        <a
                            href="{{ route('main') }}"
                            class="btn-reset btn__outline"
                            id="cancel-btn"
                        >
                            Cancel
                        </a>
                        <button
                            type="submit"
                            class="btn-reset btn__green"
                            id="submit-btn"
                        >
                            Create
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        window.onload = function () {
            document.getElementById("cancel-btn").addEventListener('click', (event) => {
                localStorage.setItem('tab', 'nurse');
            });

            document.getElementById("submit-btn").addEventListener('click', (event) => {
                localStorage.setItem('tab', 'nurse');
            });

            let checkBox = document.getElementById("flexCheckDefault");
            let licenseNumber = document.getElementById("licenseNumber");
            let borough = document.getElementById("borough");
            let desiredPrimaryBorough = document.getElementById("desired1");

            licenseNumber.disabled = checkBox.checked !== true;
            borough.disabled = checkBox.checked !== true;
            desiredPrimaryBorough.disabled = checkBox.checked !== true;
        }

        function disableFields() {
            let checkBox = document.getElementById("flexCheckDefault");
            let licenseNumber = document.getElementById("licenseNumber");
            let borough = document.getElementById("borough");
            let desiredPrimaryBorough = document.getElementById("desired1");

            licenseNumber.disabled = checkBox.checked !== true;
            borough.disabled = checkBox.checked !== true;
            desiredPrimaryBorough.disabled = checkBox.checked !== true;
        }
    </script>
@endpush
