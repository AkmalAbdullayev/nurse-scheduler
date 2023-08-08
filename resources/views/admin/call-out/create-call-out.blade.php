@extends('layouts.master')

@section('content')
    <div class="creat__call">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('main') }}">Call-Outs</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create call-out for school</li>
                </ol>
            </nav>
            <livewire:call-out.call-out></livewire:call-out.call-out>
        </div>
    </div>
@endsection

@section('footer')
    <footer class="footer">
        <div class="container"></div>
    </footer>
@endsection
