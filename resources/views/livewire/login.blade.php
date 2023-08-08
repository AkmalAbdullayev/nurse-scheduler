<div class="login">
    <div class="container login__container">
        <div class="login__form">
            <form
                wire:submit.prevent="login"
                id="login-form"
                autocomplete="off"
            >
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

                <div
                    x-data="loginButton"
                    for="password"
                    :class="$store.loginButton.show ? $store.loginButton.class : 'login__form-label col-12'"
                    :style="$store.loginButton.show ? '' : $store.loginButton.styles"
                >
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
                </div>

                <span class="text-danger" id="message"></span>

                <button
                    x-data="loginButton"
                    type="button"
                    class="login__form-button-mobile btn__green btn-reset @if(empty($cell_number)) disabled__btn @endif"
                    @if(empty($cell_number)) disabled @endif
                    x-text="$store.loginButton.show ? $store.loginButton.content : 'Log in'"
                    @click="$store.loginButton.show ? $store.loginButton.otp() : $store.loginButton.loginWithPassword()"
                >
                </button>

                <a href="{{ route('forgot-password.index') }}" class="login__form-forgot">Forgot Password?</a>
                <a
                    role="button"
                    class="login__form-login"
                    x-data="withPassword"
                    x-text="$store.loginButton.show ? content : 'Log in with OTP'"
                    @click="$store.loginButton.toggle()"
                >
                </a>
                <button
                    type="submit"
                    class="login__form-button btn__green login__form-button-desktop btn-reset @if(empty($cell_number) || empty($password)) disabled__btn @endif"
                    @if(empty($cell_number) || empty($password)) disabled @endif
                >
                    Log In
                </button>

                <a href="{{ route('forgot-password.index') }}" class="login__form-button-mobile">Forgot Password?</a>

                @if(session()->has('message'))
                    <span class="text-success">{{ session('message') }}</span>
                @endif
            </form>

            @isset($isAuthenticated)
                <div
                    class="login__form-modal {{ !$isAuthenticated ? 'show-modal' : '' }}"
                    wire:ignore.self
                    id="login-modal"
                >
                    <div class="login__form-modal-content">
                        <span class="close-button"></span>
                        <div class="login__form-modal-content-body">
                            <p class="login__form-modal-content-body-title">Phone Number or Password
                                Incorrect</p>
                            <a href="{{ route('login') }}" class="btn__green login__form-modal-content-body-btn">Try
                                Again</a>
                        </div>
                    </div>
                </div>
            @endisset
        </div>
    </div>
</div>

@push('js')
    <script defer>
        document.addEventListener('alpine:init', () => {
            Alpine.store('loginButton', {
                show: true,
                content: 'Send me a log-in code',
                class: 'login__form-label login__form-label-desktop col-12',
                styles: {
                    display: 'block',
                    width: '100%'
                },

                toggle() {
                    this.show = !this.show
                },

                async otp() {
                    await axios.post('{{ route('otp.generate') }}', {
                        cell_number: @this.get('cell_number')
                    })
                        .then((response) => {
                            window.location = response.data.url;
                        })
                        .catch(error => {
                            document.getElementById('message').textContent = error.response.data.message;
                        });
                },

                async loginWithPassword() {
                    await axios.post('{{ route('post-login') }}', {
                        cell_number: @this.get('cell_number'),
                        password: @this.get('password')
                    })
                        .then((response) => {
                            window.location = response.data.url;
                        })
                        .catch(error => {
                            document.getElementById('message').textContent = error.response.data.message;
                        });
                }
            });

            Alpine.data('withPassword', () => ({
                content: 'Log in with Password',
            }));
        });

        {{--document.getElementById('mobile-login').addEventListener('click', (event) => {--}}
        {{--    axios.post('{{ route('otp.generate') }}', {--}}
        {{--        cell_number: @this.get('cell_number')--}}
        {{--    })--}}
        {{--        .then((response) => {--}}
        {{--            window.location = response.data.url;--}}
        {{--        })--}}
        {{--        .catch(error => {--}}
        {{--            document.getElementById('message').textContent = error.response.data.message;--}}
        {{--        })--}}
        {{--});--}}
    </script>
@endpush
