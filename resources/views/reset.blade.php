<!DOCTYPE html>
<html lang="ru" class="page">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#111111">
    <title>NYC DOE Nurse Scheduler</title>
    <link rel="stylesheet" href="{{ asset('css/vendor.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <script src="https://unpkg.com/feather-icons"></script>
    <script defer src="{{ asset('js/main.js') }}"></script>
</head>

<body class="page__body">
<div class="site-container">
    @include('partials.header')

    <div class="reset">
        <div class="container reset__container">
            <div class="reset__form">
                <form action="{{ route('forgot-password.reset-password') }}" method="post">
                    @csrf

                    <h2 class="reset__form-title">Welcome {{ $nurse->first_name }} {{ $nurse->last_name }}. Please type
                        your password twice</h2>
                    <label for="number" class="reset__form-label col-12">
                        Password
                        <input
                            type="password"
                            class="form-control password-icon-input @error('password') is-invalid mb-2 @enderror"
                            id="password"
                            placeholder="******"
                            name="password"
                        >
                        <span class="password-icon hide"><img src="{{ asset('img/hide.png') }}" alt=""></span>
                        <span class="password-icon show" style="visibility: hidden"><img
                                src="{{ asset('img/eye.svg') }}" alt=""></span>
                    </label>

                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror

                    <label for="txtPassword" class="reset__form-label col-12">
                        Repeat password
                        <input
                            type="password"
                            class="form-control password-icon-input @error('password_confirmation') is-invalid mb-2 @enderror"
                            id="txtPassword"
                            placeholder="******"
                            name="password_confirmation"
                        >
                        <span class="password-icon hide"><img src="{{ asset('img/hide.png') }}" alt=""></span>
                        <span class="password-icon show" style="visibility: hidden"><img
                                src="{{ asset('img/eye.svg') }}" alt=""></span>
                    </label>

                    @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror

                    <input type="hidden" name="cell_number" value="{{ $nurse->cell_number }}">

                    <button type="submit" class="reset__form-button btn__green btn-reset">Submit</button>
                </form>

            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container"></div>
    </footer>

</div>
</body>

</html>
