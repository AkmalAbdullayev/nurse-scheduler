<!DOCTYPE html>
<html lang="ru" class="page">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#111111">
    <title>NYC DOE Nurse Scheduler</title>
    <link rel="stylesheet" href="css/vendor.css">
    <link rel="stylesheet" href="css/main.css">
    <script src="https://unpkg.com/feather-icons"></script>
    <script defer src="js/main.js"></script>
</head>

<body class="page__body">
<div class="site-container">
    @include('partials.header')

    <div class="forgot">
        <div class="container forgot__container">
            <div class="forgot__form">
                <form action="{{ route('forgot-password.send-link') }}" method="post">
                    @csrf

                    <h2 class="forgot__form-title">Please type your phone number to receive a password reset link</h2>
                    <label for="number" class="forgot__form-label col-12">
                        Phone Number
                        <input
                            type="text"
                            class="form-control @error('cell_number') mb-2 is-invalid @enderror"
                            id="phone"
                            placeholder="xxx-xxx-xxxx"
                            name="cell_number"
                        >
                    </label>

                    @error('cell_number') <span class="error"
                                                style="color: red;">{{ $message }}</span> @enderror

                    @if (session()->has('message'))
                        <span class="text-success mt-2">{{ session('message') }}</span>
                    @endif

                    @if (session()->has('error'))
                        <span class="text-danger mt-2">{{ session('error') }}</span>
                    @endif

                    <button type="submit" class="forgot__form-button btn__green btn-reset">Send Reset Link <span>via Text Message</span>
                    </button>
                    <p class="forgot__form-desc">Once you got the text, just click the link.</p>
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
