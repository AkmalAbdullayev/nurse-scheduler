@extends('layouts.master')

@section('content')
    <div class="creat__call">
        <form action="{{ route('call-out.confirm') }}" method="post" autocomplete="off">
            @csrf

            <div class="container-fluid">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('main') }}" onclick="redirectToTab()">Call-Outs</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Create call-out for school</li>
                    </ol>
                </nav>
                <div class="creat__call-content">
                    <div class="creat__call-content-date">
                        <h3
                            class="creat__call-content-date-title"
                        >
                            <b>Create a Call-out for:</b> {{ $school->school_name }}
                        </h3>

                        <label for="creatCall1" class="creat__call-content-date-label">
                            Date
                            <div class="creat__call-content-date-calendar">
                                <img src="{{ asset('img/calendar-icon.svg') }}" alt="">
                                <input type="text" id="creatCall1" placeholder="Select dates..." name="date" value="{{ old('date') }}">
                            </div>
                            @error('date') <span class="text-danger">{{ $message }}</span> @enderror
                        </label>

                        <input type="hidden" name="school_id" value="{{ $school->id }}">

                        <livewire:search-nurse></livewire:search-nurse>

                        <label class="creat__call-checkbox">
                            Or send to all available nurses
                            <input
                                type="checkbox"
                                id="mass-assign"
                                name="nurses"
                                value="1"
                                onclick="disableField()"
                                {{ old('nurses') == 1 ? 'checked' : '' }}
                            />
                        </label>
                    </div>
                </div>

                <div class="creat__call-content">
                    <div class="creat__call-content-button">
                        <a
                            class="btn-reset btn__outline"
                            href="{{ route('main') }}"
                        >
                            Cancel
                        </a>
                        <button type="submit" class="btn-reset btn__green" id="createBtn">Create</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script defer>
        function redirectToTab() {
            localStorage.setItem('tab', 'call-out');
        }

        let selectNurse = document.getElementById('nurse');
        let massAssignCheckbox = document.getElementById('mass-assign');

        selectNurse.disabled = !massAssignCheckbox.checked !== true;

        function disableField() {
            let selectNurse = document.getElementById('nurse');
            let massAssignCheckbox = document.getElementById('mass-assign');

            selectNurse.disabled = massAssignCheckbox.checked !== false;
        }
    </script>
@endpush
