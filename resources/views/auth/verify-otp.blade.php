@extends('layouts.master')

@section('content')
    @csrf
    <div class="login">
        <div class="container login__container">
            <div class="login__form">
                <h2 class="login__form-title">Welcome to the NYC DoE Nurse Scheduling System</h2>
                <label class="login__form-label col-12">
                    Enter the mobile verification code
                    <span style="color: red;">*</span>
                    <input
                        type="number"
                        class="form-control"
                        id="otp"
                        placeholder="Type..."
                        name="cell_number"
                    >
                </label>

                <span class="text-danger" id="message"></span>

                <button
                    type="button"
                    class="login__form-button-mobile btn__green btn-reset"
                    id="mobile-login"
                >
                    Log in
                </button>

                <input type="hidden" id="user_id" name="user_id" value="{{ $userId }}">
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script defer>
        document.getElementById('mobile-login').addEventListener('click', event => {
            event.preventDefault();

            axios.post('{{ route('otp.login') }}', {
                user_id: document.getElementById('user_id').value,
                otp: document.getElementById('otp').value
            })
                .then(response => {
                    window.location = response.data.url;
                })
                .catch(error => {
                    document.getElementById('message').textContent = error.response.data.message;
                });
        });
    </script>
@endpush
