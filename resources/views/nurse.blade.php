@extends('layouts.master')

@section('content')
    <div class="nurse">
        <div class="container-fluid">
            <!--   tabs button   -->
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button
                        class="nav-link active"
                        id="nav-call-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#nav-call"
                        type="button"
                        role="tab"
                        aria-controls="nav-home"
                        aria-selected="true"
                    >
                        <img src="{{ asset('img/call.svg') }}" alt="">
                        Call-outs
                    </button>

                    <button
                        class="nav-link"
                        id="nav-nurses-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#nav-nurses"
                        type="button"
                        role="tab"
                        aria-controls="nav-nurses"
                        aria-selected="false"
                    >
                        <img src="{{ asset('img/nurses.svg') }}" alt="">
                        Nurses
                    </button>

                    <button
                        class="nav-link"
                        id="nav-schools-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#nav-schools"
                        type="button"
                        role="tab"
                        aria-controls="nav-schools"
                        aria-selected="false"
                    >
                        <img src="{{ asset('img/school.svg') }}" alt="">
                        Schools
                    </button>

                    <button
                        class="nav-link"
                        id="nav-log-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#nav-log"
                        type="button"
                        role="tab"
                        aria-controls="nav-log"
                        aria-selected="false"
                    >
                        Log
                    </button>
                </div>
            </nav>
            <!--   tabs content   -->
            <div class="tab-content" id="nav-tabContent">
                <!--   Call-outs    -->
                <livewire:call-out.index></livewire:call-out.index>
                <!--   Nurses    -->
                <livewire:nurse/>
                <!--   School    -->
                <livewire:school/>
                <!--   Log    -->
                <livewire:history/>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <footer class="footer">
        <div class="container"></div>
    </footer>
@endsection

@push('js')
    <script>
        window.onload = () => {
            document.getElementById("nav-call-tab").addEventListener('click', (event) => {
                localStorage.setItem('tab', 'call-out');
                localStorage.removeItem('tab');
            });

            document.getElementById("nav-nurses-tab").addEventListener('click', (event) => {
                localStorage.setItem('tab', 'nurse');
            });

            document.getElementById("nav-schools-tab").addEventListener('click', (event) => {
                localStorage.setItem('tab', 'school');
            });

            document.getElementById("nav-log-tab").addEventListener('click', (event) => {
                localStorage.setItem('tab', 'log');
            });

            if (localStorage.getItem('tab') === 'nurse') {
                document.getElementById('nav-call-tab').classList.remove('active');
                document.getElementById('nav-call').classList.remove('active');
                document.getElementById('nav-call').classList.remove('show');

                document.getElementById('nav-nurses-tab').classList.add('active');
                document.getElementById('nav-nurses').classList.add('active');
                document.getElementById('nav-nurses').classList.add('show');
            }

            if (localStorage.getItem('tab') === 'school') {
                document.getElementById('nav-call-tab').classList.remove('active');
                document.getElementById('nav-call').classList.remove('active');
                document.getElementById('nav-call').classList.remove('show');

                document.getElementById('nav-schools-tab').classList.add('active');
                document.getElementById('nav-schools').classList.add('active');
                document.getElementById('nav-schools').classList.add('show');
            }

            if (localStorage.getItem('tab') === 'log') {
                document.getElementById('nav-call-tab').classList.remove('active');
                document.getElementById('nav-call').classList.remove('active');
                document.getElementById('nav-call').classList.remove('show');

                document.getElementById('nav-log-tab').classList.add('active');
                document.getElementById('nav-log').classList.add('active');
                document.getElementById('nav-log').classList.add('show');
            }
        }
    </script>
@endpush
