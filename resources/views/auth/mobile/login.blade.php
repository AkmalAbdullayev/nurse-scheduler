@extends('layouts.master')

@section('content')
    <div class="login">
        <div class="container login__container">
            <div class="login__form">
                <form wire:submit.prevent="login" method="post" id="login-form" autocomplete="off" >
                    @csrf
                    <h2 class="login__form-title">Welcome to the NYC DoE Nurse Scheduling System</h2>
                    <label class="login__form-label col-12">
                        Phone Number
                        <span style="color: red;">*</span>
                        <input
                            type="text"
                            class="form-control @error("cell_number") is-invalid @enderror"
                            id="phone"
                            placeholder="xxx-xxx-xxxx"
                            wire:model="cell_number"
                            name="cell_number"
                        >
                        @error('cell_number') <span class="error" style="color: red;">{{ $message }}</span> @enderror
                    </label>

                    <label for="password" class="login__form-label col-12">
                        Password
                        <span style="color: red;">*</span>
                        <input
                            type="password"
                            class="form-control @error("password") is-invalid @enderror"
                            id="password"
                            placeholder="******"
                            wire:model="password"
                            name="password"
                        >
                        @error('password') <span class="error" style="color: red;">{{ $message }}</span> @enderror
                    </label>

                    <span class="text-danger" id="message"></span>

                    <a href="{{ route('forgot-password.index') }}" class="login__form-button-mobile" style="color: #646464">Forgot Password?</a>
                    <button
                        type="submit"
                        class="login__form-button-mobile btn__green btn-reset"
                    >
                        Save
                    </button>

                    @if(session()->has('message'))
                        <span class="text-success">{{ session('message') }}</span>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')

@endpush
