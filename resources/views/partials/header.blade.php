<header class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6 md-12 sm-12">
                @guest
                    <a href="{{ route('login') }}" class="header__logo">
{{--                        <img src="{{ asset('img/logo.png') }}" alt="">--}}
                        Nurse <br> Scheduling <br> System
                    </a>
                @endguest

                @hasrole('Admin')
                <a href="{{ route('main') }}" class="header__logo">
{{--                    <img src="{{ asset('img/logo.png') }}" alt="">--}}
                    Nurse <br> Scheduling <br> System
                </a>
                @endhasrole

                @hasanyrole('Full Time Float Nurse|Float Nurse')
                <a href="{{ route('float-nurse.call-out.index') }}" class="header__logo">
{{--                    <img src="{{ asset('img/logo.png') }}" alt="">--}}
                    Nurse <br> Scheduling <br> System
                </a>
                @endhasanyrole

                @hasrole('Perm School Nurse')
                <a href="{{ route('school-nurse.call-out.index') }}" class="header__logo">
{{--                    <img src="{{ asset('img/logo.png') }}" alt="">--}}
                    Nurse <br> Scheduling <br> System
                </a>
                @endhasrole
            </div>
            @auth
                <div class="col-6 md-12 sm-12">
                    <div class="header__right">
                        <div class="dropdown">
                            <button
                                class="btn btn-secondary dropdown-toggle"
                                type="button"
                                id="dropdownMenu2"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            >
                                @if(auth()->user()->roles->first()?->name === 'Admin')
                                    Admin
                                @else
                                    {{ auth()->user()->nurse->first_name }} {{ auth()->user()->nurse->last_name }}
                                @endif
                            </button>
                            <ul class="dropdown-menu p-0" aria-labelledby="dropdownMenu2">
                                <li class="header__right-list">
                                    <a href="#" class="header__right-list-link">
                                        <img src="{{ asset('img/setting.svg') }}" alt="">
                                        Settings
                                    </a>
                                </li>
                                @if(auth()->user()->roles->first()?->name !== 'Admin')
                                    @hasanyrole('Full Time Float Nurse|Float Nurse')
                                    @php $route = route('float-nurse.profile') @endphp
                                    @endhasanyrole

                                    @hasrole('Perm School Nurse')
                                    @php $route = route('school-nurse.profile') @endphp
                                    @endhasrole

                                    <li class="header__right-list">
                                        <a href="{{ $route }}" class="header__right-list-link">
                                            <img src="{{ asset('img/user.svg') }}" alt="">
                                            My Profile
                                        </a>
                                    </li>
                                @endif
                                <li class="header__right-list">
                                    <a
                                        href="{{ route('auth.logout') }}"
                                        class="header__right-list-link"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    >
                                        <img src="{{ asset('img/logout.svg') }}" alt="">
                                        Log out
                                    </a>

                                    <form id="logout-form" action="{{ route('auth.logout') }}" method="POST">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</header>
