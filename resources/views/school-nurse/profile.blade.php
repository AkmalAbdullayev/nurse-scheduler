@extends('layouts.master')

@section('content')
    <div class="views">
        <div class="container-fluid mb-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('school-nurse.call-out.index') }}">Nurses</a></li>
                    <li class="breadcrumb-item active" aria-current="page">View nurse profile</li>
                </ol>
            </nav>
            <div class="views__inputs">
                <form action="{{ route('school-nurse.update') }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="views__inputs-header">
                        <div class="views__inputs-header-left">
                            <h2 class="views__inputs-header-title ">View a Nurse Record —
                                {{ $nurse->first_name }} {{ $nurse->last_name }} {{ $nurse->mi }}</h2>
                        </div>
                        {{--                        <div class="views__inputs-header-right">--}}
                        {{--                            <ul class="list-group list-group-horizontal-lg float-end">--}}
                        {{--                                <li class="list-group-item" data-bs-toggle="modal" href="#deletModalToggle"--}}
                        {{--                                    role="button">--}}
                        {{--                                    <span class="list-group-item-span"><img src="{{ asset('img/delet.svg') }}"--}}
                        {{--                                                                            alt=""></span>--}}
                        {{--                                </li>--}}
                        {{--                            </ul>--}}
                        {{--                        </div>--}}
                    </div>

                    <div class="views__inputs-label">
                        <div class="views__inputs-label-item">
                            <label for="name" class="views__inputs-label-item-input">
                                First Name
                                <input
                                    type="text"
                                    class="form-control @error('first_name') mb-2 is-invalid @enderror"
                                    id="name"
                                    placeholder="Type..."
                                    value="{{ $nurse->first_name }}"
                                    name="first_name"
                                >
                            </label>
                            @error('first_name') <span class="text-danger">{{ $message }}</span> @enderror

                            <label for="middleName" class="views__inputs-label-item-input">
                                Middle Name
                                <input
                                    type="text"
                                    class="form-control @error('mi') mb-2 is-invalid @enderror"
                                    id="middleName"
                                    placeholder="Type..."
                                    value="{{ $nurse->mi }}"
                                    name="mi"
                                >
                            </label>
                            @error('mi') <span class="text-danger">{{ $message }}</span> @enderror

                            <label for="lastName" class="views__inputs-label-item-input">
                                Last Name
                                <input
                                    type="text"
                                    class="form-control @error('last_name') mb-2 is-invalid @enderror"
                                    id="lastName"
                                    placeholder="Type..."
                                    value="{{ $nurse->last_name }}"
                                    name="last_name"
                                >
                            </label>
                            @error('last_name') <span class="text-danger">{{ $message }}</span> @enderror

                            <label for="cellPhone" class="views__inputs-label-item-input">
                                Cell Phone
                                <input
                                    type="text"
                                    class="form-control @error('cell_number') mb-2 is-invalid @enderror"
                                    id="phone"
                                    placeholder="xxx-xxx-xxxx"
                                    value="{{ substr($nurse->cell_number, 2) }}"
                                    name="cell_number"
                                >
                            </label>

                            @if (session()->has('message'))
                                <span class="text-danger">{{ session('message') }}</span>
                            @endif

                            @error('cell_number') <span class="text-danger">{{ $message }}</span> @enderror

                            <label for="email" class="views__inputs-label-item-input">
                                Email Address
                                <input
                                    type="email"
                                    class="form-control @error('email') mb-2 is-invalid @enderror"
                                    id="email"
                                    placeholder="Type..."
                                    value="{{ $nurse->email }}"
                                    name="email"
                                >
                            </label>
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror

                            <label for="licenseNumber" class="views__inputs-label-item-input">
                                License number
                                <input
                                    type="text"
                                    class="form-control @error('license_number') mb-2 is-invalid @enderror"
                                    id="licenseNumber"
                                    placeholder="Type..."
                                    value="{{ $nurse->license_number }}"
                                    name="license_number"
                                >
                            </label>
                            @error('license_number') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="views__inputs-label-item">
                            <label for="streetviewsress1" class="views__inputs-label-item-input">
                                Street Address 1
                                <input
                                    type="text"
                                    class="form-control @error('street_address_1') mb-2 is-invalid @enderror"
                                    id="streetviewsress1"
                                    placeholder="Type..."
                                    value="{{ $nurse->street_address_1 }}"
                                    name="street_address_1"
                                >
                            </label>
                            @error('street_address_1') <span class="text-danger">{{ $message }}</span> @enderror

                            <label for="streetviewsress2" class="views__inputs-label-item-input">
                                Street Address 2
                                <input
                                    type="text"
                                    class="form-control @error('street_address_2') mb-2 is-invalid @enderror"
                                    id="streetviewsress2"
                                    placeholder="Type..."
                                    value="{{ $nurse->street_address_2 }}"
                                    name="street_address_2"
                                >
                            </label>
                            @error('street_address_2') <span class="text-danger">{{ $message }}</span> @enderror

                            <div class="views__inputs-label-item-select">
                                <label for="City" class="views__inputs-label-item-input">
                                    City
                                    <input
                                        type="text"
                                        class="form-control @error('city') mb-2 is-invalid @enderror"
                                        id="City"
                                        placeholder="Type..."
                                        value="{{ $nurse->city }}"
                                        name="city"
                                    >
                                </label>
                                @error('city') <span class="text-danger">{{ $message }}</span> @enderror

                                <label for="state" class="views__inputs-label-item-input">
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
                                                @if ($nurse->state_id == $state->id) selected @endif
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

                            <div class="views__inputs-label-item-select">
                                <label for="borough" class="views__inputs-label-item-input">
                                    Borough
                                    <select
                                        class="form-select @error('borough_id') mb-2 is-invalid @enderror"
                                        id="borough"
                                        aria-label="Default select example"
                                        name="borough_id"
                                    >
                                        <option selected disabled>Select…</option>
                                        @forelse ($boroughs as $k => $borough)
                                            <option value="{{ ++$k }}"
                                                    @if($nurse->borough_id == $k) selected @endif>{{ $borough }}</option>
                                        @empty
                                            <option disabled>No data found.</option>
                                        @endforelse
                                    </select>
                                </label>
                                @error('borough_id') <span class="text-danger">{{ $message }}</span> @enderror

                                <label
                                    for="zipC"
                                    class="views__inputs-label-item-input"
                                    style="width: 255px; max-width: 100%"
                                >
                                    ZIP Code
                                    <input
                                        type="text"
                                        class="form-control @error('zip_code') mb-2 is-invalid @enderror"
                                        id="zipC"
                                        placeholder="Type..."
                                        value="{{ $nurse->zip_code }}"
                                        name="zip_code"
                                    >
                                </label>
                                @error('zip_code') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <label for="desired1" class="views__inputs-label-item-input">
                                Desired Primary Borough
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
                                        @if ($nurse->getDesiredBoroughs()['primaryDesiredBoroughs']->has(0))
                                            {{ $nurse->getDesiredBoroughs()['primaryDesiredBoroughs'][0]->borough_id == $k ? 'selected' : '' }}
                                            @endif
                                        >
                                            {{ $borough }}
                                        </option>
                                    @empty
                                        <option disabled>No data found.</option>
                                    @endforelse
                                </select>
                            </label>
                            @error('boroughs.primary') <span class="text-danger">{{ $message }}</span> @enderror

                            <label for="desired1" class="views__inputs-label-item-input">
                                Desired Secondary Borough
                                <select
                                    class="form-select"
                                    id="desired1"
                                    aria-label="Default select example"
                                    name="boroughs[]"
                                >
                                    <option selected disabled>Select…</option>
                                    @forelse ($boroughs as $k => $borough)
                                        <option
                                            value="{{ ++$k }}"
                                        @if ($nurse->getDesiredBoroughs()['desiredBoroughs']->has(0))
                                            {{ $nurse->getDesiredBoroughs()['desiredBoroughs'][0]->borough_id == $k ? 'selected' : '' }}
                                            @endif
                                        >
                                            {{ $borough }}
                                        </option>
                                    @empty
                                        <option disabled>No data found.</option>
                                    @endforelse
                                </select>
                            </label>

                            <label for="desired2" class="views__inputs-label-item-input">
                                Desired Third Borough
                                <select
                                    class="form-select"
                                    id="desired2"
                                    aria-label="Default select example"
                                    name="boroughs[]"
                                >
                                    <option selected disabled>Select…</option>
                                    @forelse ($boroughs as $k => $borough)
                                        <option
                                            value="{{ ++$k }}"
                                        @if ($nurse->getDesiredBoroughs()['desiredBoroughs']->has(1))
                                            {{ $nurse->getDesiredBoroughs()['desiredBoroughs'][1]->borough_id == $k ? 'selected' : '' }}
                                            @endif
                                        >
                                            {{ $borough }}
                                        </option>
                                    @empty
                                        <option disabled>No data found.</option>
                                    @endforelse
                                </select>
                            </label>

                            <label for="desired3" class="views__inputs-label-item-input">
                                Desired Fourth Borough
                                <select
                                    class="form-select"
                                    id="desired3"
                                    aria-label="Default select example"
                                    name="boroughs[]"
                                >
                                    <option selected disabled>Select…</option>
                                    @forelse ($boroughs as $k => $borough)
                                        <option
                                            value="{{ ++$k }}"
                                        @if ($nurse->getDesiredBoroughs()['desiredBoroughs']->has(2))
                                            {{ $nurse->getDesiredBoroughs()['desiredBoroughs'][2]->borough_id == $k ? 'selected' : '' }}
                                            @endif
                                        >
                                            {{ $borough }}
                                        </option>
                                    @empty
                                        <option disabled>No data found.</option>
                                    @endforelse
                                </select>
                            </label>

                            <label for="desired4" class="views__inputs-label-item-input">
                                Desired Fifth Borough
                                <select
                                    class="form-select"
                                    id="desired4"
                                    aria-label="Default select example"
                                    name="boroughs[]"
                                >
                                    <option selected disabled>Select…</option>
                                    @forelse ($boroughs as $k => $borough)
                                        <option
                                            value="{{ ++$k }}"
                                        @if ($nurse->getDesiredBoroughs()['desiredBoroughs']->has(3))
                                            {{ $nurse->getDesiredBoroughs()['desiredBoroughs'][3]->borough_id == $k ? 'selected' : '' }}
                                            @endif
                                        >
                                            {{ $borough }}
                                        </option>
                                    @empty
                                        <option disabled>No data found.</option>
                                    @endforelse
                                </select>
                            </label>
                        </div>

                        <div class="views__inputs-label-item">
                            <h3 class="views__inputs-label-title">Nurse Credential </h3>
                            <label for="credential1" class="views__inputs-label-item-input">
                                Credential #1
                                <select
                                    class="form-select @error('credentials.primary') mb-2 is-invalid @enderror"
                                    id="credential1"
                                    aria-label="Default select example"
                                    name="credentials[primary]"
                                >
                                    <option @if(!$nurse->getCredentials()->has(0)) selected @endif disabled>Select…
                                    </option>
                                    @forelse($credentials as $credential)
                                        <option
                                            value="{{ $credential->id }}"
                                        @if($nurse->getCredentials()->has(0))
                                            {{ $nurse->getCredentials()[0]->id == $credential->id ? 'selected' : '' }}
                                            @endif
                                        >
                                            {{ $credential->name }}
                                        </option>
                                    @empty
                                        <option>No data found.</option>
                                    @endforelse
                                </select>
                            </label>
                            @error('credentials.primary') <span class="text-danger">{{ $message }}</span> @enderror

                            <label for="credential2" class="views__inputs-label-item-input">
                                Credential #2
                                <select
                                    class="form-select"
                                    id="credential1"
                                    aria-label="Default select example"
                                    name="credentials[]"
                                >
                                    <option @if(!$nurse->getCredentials()->has(1)) selected @endif disabled>Select…
                                    </option>
                                    @forelse($credentials as $credential)
                                        <option
                                            value="{{ $credential->id }}"
                                        @if($nurse->getCredentials()->has(1))
                                            {{ $nurse->getCredentials()[1]->id == $credential->id ? 'selected' : '' }}
                                            @endif
                                        >
                                            {{ $credential->name }}
                                        </option>
                                    @empty
                                        <option>No data found.</option>
                                    @endforelse
                                </select>
                            </label>

                            <label for="credential3" class="views__inputs-label-item-input">
                                Credential #3
                                <select
                                    class="form-select"
                                    id="credential1"
                                    aria-label="Default select example"
                                    name="credentials[]"
                                >
                                    <option @if(!$nurse->getCredentials()->has(2)) selected @endif disabled>Select…
                                    </option>
                                    @forelse($credentials as $credential)
                                        <option
                                            value="{{ $credential->id }}"
                                        @if($nurse->getCredentials()->has(2))
                                            {{ $nurse->getCredentials()[2]->id == $credential->id ? 'selected' : '' }}
                                            @endif
                                        >
                                            {{ $credential->name }}
                                        </option>
                                    @empty
                                        <option>No data found.</option>
                                    @endforelse
                                </select>
                            </label>

                            <label for="credential4" class="views__inputs-label-item-input">
                                Credential #4
                                <select
                                    class="form-select"
                                    id="credential1"
                                    aria-label="Default select example"
                                    name="credentials[]"
                                >
                                    <option @if(!$nurse->getCredentials()->has(3)) selected @endif disabled>Select…
                                    </option>
                                    @forelse($credentials as $credential)
                                        <option
                                            value="{{ $credential->id }}"
                                        @if($nurse->getCredentials()->has(3))
                                            {{ $nurse->getCredentials()[3]->id == $credential->id ? 'selected' : '' }}
                                            @endif
                                        >
                                            {{ $credential->name }}
                                        </option>
                                    @empty
                                        <option>No data found.</option>
                                    @endforelse
                                </select>
                            </label>

                            <label for="credential5" class="views__inputs-label-item-input">
                                Credential #5
                                <select
                                    class="form-select"
                                    id="credential1"
                                    aria-label="Default select example"
                                    name="credentials[]"
                                >
                                    <option @if(!$nurse->getCredentials()->has(4)) selected @endif disabled>Select…
                                    </option>
                                    @forelse($credentials as $credential)
                                        <option
                                            value="{{ $credential->id }}"
                                        @if($nurse->getCredentials()->has(4))
                                            {{ $nurse->getCredentials()[4]->id == $credential->id ? 'selected' : '' }}
                                            @endif
                                        >
                                            {{ $credential->name }}
                                        </option>
                                    @empty
                                        <option>No data found.</option>
                                    @endforelse
                                </select>
                            </label>

                            <label for="credential6" class="views__inputs-label-item-input">
                                Credential #6
                                <select
                                    class="form-select"
                                    id="credential1"
                                    aria-label="Default select example"
                                    name="credentials[]"
                                >
                                    <option @if(!$nurse->getCredentials()->has(5)) selected @endif disabled>Select…
                                    </option>
                                    @forelse($credentials as $credential)
                                        <option
                                            value="{{ $credential->id }}"
                                        @if($nurse->getCredentials()->has(5))
                                            {{ $nurse->getCredentials()[5]->id == $credential->id ? 'selected' : '' }}
                                            @endif
                                        >
                                            {{ $credential->name }}
                                        </option>
                                    @empty
                                        <option>No data found.</option>
                                    @endforelse
                                </select>
                            </label>

                            <label for="credential7" class="views__inputs-label-item-input">
                                Credential #7
                                <select
                                    class="form-select"
                                    id="credential1"
                                    aria-label="Default select example"
                                    name="credentials[]"
                                >
                                    <option @if(!$nurse->getCredentials()->has(6)) selected @endif disabled>Select…
                                    </option>
                                    @forelse($credentials as $credential)
                                        <option
                                            value="{{ $credential->id }}"
                                        @if($nurse->getCredentials()->has(6))
                                            {{ $nurse->getCredentials()[6]->id == $credential->id ? 'selected' : '' }}
                                            @endif
                                        >
                                            {{ $credential->name }}
                                        </option>
                                    @empty
                                        <option>No data found.</option>
                                    @endforelse
                                </select>
                            </label>

                            <label for="credential8" class="views__inputs-label-item-input">
                                Credential #8
                                <select
                                    class="form-select"
                                    id="credential1"
                                    aria-label="Default select example"
                                    name="credentials[]"
                                >
                                    <option @if(!$nurse->getCredentials()->has(7)) selected @endif disabled>Select…
                                    </option>
                                    @forelse($credentials as $credential)
                                        <option
                                            value="{{ $credential->id }}"
                                        @if($nurse->getCredentials()->has(7))
                                            {{ $nurse->getCredentials()[7]->id == $credential->id ? 'selected' : '' }}
                                            @endif
                                        >
                                            {{ $credential->name }}
                                        </option>
                                    @empty
                                        <option>No data found.</option>
                                    @endforelse
                                </select>
                            </label>

                            <label for="credential9" class="views__inputs-label-item-input">
                                Credential #9
                                <select
                                    class="form-select"
                                    id="credential1"
                                    aria-label="Default select example"
                                    name="credentials[]"
                                >
                                    <option @if(!$nurse->getCredentials()->has(8)) selected @endif disabled>Select…
                                    </option>
                                    @forelse($credentials as $credential)
                                        <option
                                            value="{{ $credential->id }}"
                                        @if($nurse->getCredentials()->has(8))
                                            {{ $nurse->getCredentials()[8]->id == $credential->id ? 'selected' : '' }}
                                            @endif
                                        >
                                            {{ $credential->name }}
                                        </option>
                                    @empty
                                        <option>No data found.</option>
                                    @endforelse
                                </select>
                            </label>

                            <label for="credential10" class="views__inputs-label-item-input">
                                Credential #10
                                <select
                                    class="form-select"
                                    id="credential1"
                                    aria-label="Default select example"
                                    name="credentials[]"
                                >
                                    <option @if(!$nurse->getCredentials()->has(9)) selected @endif disabled>Select…
                                    </option>
                                    @forelse($credentials as $credential)
                                        <option
                                            value="{{ $credential->id }}"
                                        @if($nurse->getCredentials()->has(9))
                                            {{ $nurse->getCredentials()[9]->id == $credential->id ? 'selected' : '' }}
                                            @endif
                                        >
                                            {{ $credential->name }}
                                        </option>
                                    @empty
                                        <option>No data found.</option>
                                    @endforelse
                                </select>
                            </label>

                            <label class="views__inputs-label-item-input" for="role"
                                   style="display: flex; flex-direction: column; row-gap: 8px; ">
                                Role
                                <span
                                    style="font-weight: 400;font-size: 16px;line-height: 19px;color: #333333;opacity: 0.69;"
                                >
                                    Perm School Nurse
                                </span>
                            </label>

                            <label for="password" class="views__inputs-label-item-input">
                                Current Password
                                <input
                                    type="password"
                                    class="form-control password-icon-input @error('current_password') is-invalid mb-2 @enderror"
                                    id="password"
                                    placeholder="******"
                                    name="current_password"
                                >
                                @error('current_password')<span class="text-danger">{{ $message }}</span>@enderror
                            </label>

                            <label for="password" class="views__inputs-label-item-input">
                                New Password
                                <input
                                    type="password"
                                    class="form-control password-icon-input @error('new_password') is-invalid mb-2 @enderror"
                                    id="password"
                                    placeholder="******"
                                    name="new_password"
                                >
                                @error('new_password')<span class="text-danger">{{ $message }}</span>@enderror
                            </label>

                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="flexCheckDefault"
                                    name="active_for_assignments"
                                    value="1"
                                    {{ $nurse->active_for_assignments == 1 ? 'checked' : '' }}
                                >
                                <label class="form-check-label" for="flexCheckDefault">
                                    Active
                                </label>
                            </div>
                        </div>

                        <div class="views__inputs-label-item">
                            <h3 class="views__inputs-label-title">Medical skills</h3>
                            <label for="need1" class="views__inputs-label-item-input">
                                Skill #1
                                <select
                                    class="form-select"
                                    id="need1"
                                    aria-label="Default select example"
                                    name="medical_needs[]"
                                >
                                    <option disabled selected>Select…</option>
                                    @forelse($medicalNeeds as $medicalNeed)
                                        <option
                                            value="{{ $medicalNeed->id }}"
                                        @if (array_key_exists(0, $nurse->getMedicalSkills()->toArray()))
                                            {{ $nurse->getMedicalSkills()[0] == $medicalNeed->id ? 'selected' : '' }}
                                            @endif
                                        >
                                            {{ $medicalNeed->name }}
                                        </option>
                                    @empty
                                        <option disabled>No data found.</option>
                                    @endforelse
                                </select>
                            </label>

                            <label for="need2" class="views__inputs-label-item-input">
                                Skill #2
                                <select
                                    class="form-select"
                                    id="need2"
                                    aria-label="Default select example"
                                    name="medical_needs[]"
                                >
                                    <option disabled selected>Select…</option>
                                    @forelse($medicalNeeds as $medicalNeed)
                                        <option
                                            value="{{ $medicalNeed->id }}"
                                        @if (array_key_exists(1, $nurse->getMedicalSkills()->toArray()))
                                            {{ $nurse->getMedicalSkills()[1] == $medicalNeed->id ? 'selected' : '' }}
                                            @endif
                                        >
                                            {{ $medicalNeed->name }}
                                        </option>
                                    @empty
                                        <option disabled>No data found.</option>
                                    @endforelse
                                </select>
                            </label>

                            <label for="need2" class="views__inputs-label-item-input">
                                Skill #3
                                <select
                                    class="form-select"
                                    id="need3"
                                    aria-label="Default select example"
                                    name="medical_needs[]"
                                >
                                    <option disabled selected>Select…</option>
                                    @forelse($medicalNeeds as $medicalNeed)
                                        <option
                                            value="{{ $medicalNeed->id }}"
                                        @if (array_key_exists(2, $nurse->getMedicalSkills()->toArray()))
                                            {{ $nurse->getMedicalSkills()[2] == $medicalNeed->id ? 'selected' : '' }}
                                            @endif
                                        >
                                            {{ $medicalNeed->name }}
                                        </option>
                                    @empty
                                        <option disabled>No data found.</option>
                                    @endforelse
                                </select>
                            </label>

                            <label for="need4" class="views__inputs-label-item-input">
                                Skill #4
                                <select
                                    class="form-select"
                                    id="need4"
                                    aria-label="Default select example"
                                    name="medical_needs[]"
                                >
                                    <option disabled selected>Select…</option>
                                    @forelse($medicalNeeds as $medicalNeed)
                                        <option
                                            value="{{ $medicalNeed->id }}"
                                        @if (array_key_exists(3, $nurse->getMedicalSkills()->toArray()))
                                            {{ $nurse->getMedicalSkills()[3] == $medicalNeed->id ? 'selected' : '' }}
                                            @endif
                                        >
                                            {{ $medicalNeed->name }}
                                        </option>
                                    @empty
                                        <option disabled>No data found.</option>
                                    @endforelse
                                </select>
                            </label>

                            <label for="need5" class="views__inputs-label-item-input">
                                Skill #5
                                <select
                                    class="form-select"
                                    id="need5"
                                    aria-label="Default select example"
                                    name="medical_needs[]"
                                >
                                    <option disabled selected>Select…</option>
                                    @forelse($medicalNeeds as $medicalNeed)
                                        <option
                                            value="{{ $medicalNeed->id }}"
                                        @if (array_key_exists(4, $nurse->getMedicalSkills()->toArray()))
                                            {{ $nurse->getMedicalSkills()[4] == $medicalNeed->id ? 'selected' : '' }}
                                            @endif
                                        >
                                            {{ $medicalNeed->name }}
                                        </option>
                                    @empty
                                        <option disabled>No data found.</option>
                                    @endforelse
                                </select>
                            </label>

                            {{--                            <label class="views__inputs-label-item-input">--}}
                            {{--                                Last date assigned--}}
                            {{--                                <p class="views__inputs-label-item-input-number">--}}
                            {{--                                    {{ !is_null($nurse->call_outs->last()) ? $nurse->call_outs->last()->from->format('m-d-Y') : '-' }}--}}
                            {{--                                </p>--}}
                            {{--                            </label>--}}
                        </div>
                    </div>
                    <div class="views__inputs-textarea">
                        <h3 class="views__inputs-textarea-title">Special notes</h3>
                        <textarea
                            class="form-control"
                            placeholder="Type..."
                            id="floatingTextarea2"
                            style="height: 100px"
                            name="special_notes"
                        >{{ $nurse->special_notes }}</textarea>
                    </div>
                    <div class="views__inputs-footer">
                        <div>
                            <a role="button" class="btn-reset btn__outline"
                               href="{{ route('school-nurse.call-out.index') }}">Cancel</a>
                        </div>
                        <div>
                            <button type="submit" class="btn-reset btn__green">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal -->
        {{--        <div class="modal fade" id="deletModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"--}}
        {{--             tabindex="-1">--}}
        {{--            <div class="modal-dialog modal-dialog-centered">--}}
        {{--                <div class="modal-content">--}}
        {{--                    <div class="modal-body">--}}
        {{--                        <h3 class="modal-body-title">Are you sure you want to delete</h3>--}}
        {{--                        <p class="modal-body-desc">{{ $nurse->first_name }} {{ $nurse->mi }} {{ $nurse->last_name }}--}}
        {{--                            record?</p>--}}
        {{--                        <div class="modal-body-btn">--}}
        {{--                            <button class="modal-body-btn-outline" data-bs-dismiss="modal">Cancel</button>--}}
        {{--                            <form action="{{ route('nurses.destroy', $nurse->id) }}" method="post">--}}
        {{--                                @csrf--}}
        {{--                                @method('DELETE')--}}
        {{--                                <button class="modal-body-btn-red" type="submit">Delete</button>--}}
        {{--                            </form>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
    </div>
@endsection

@push('js')
    <script defer>
        let checkBox = document.getElementById("flexCheckDefault");
        let licenseNumber = document.getElementById("licenseNumber");
        let borough = document.getElementById("borough");
        let desiredPrimaryBorough = document.getElementById("desired1");

        licenseNumber.disabled = checkBox.checked !== true;
        borough.disabled = checkBox.checked !== true;
        desiredPrimaryBorough.disabled = checkBox.checked !== true;

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
