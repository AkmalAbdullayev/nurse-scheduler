@extends('layouts.master')

@section('content')
    <div class="creat__call">
        <div class="container-fluid">
            <div class="creat__call-content">
                <form action="{{ route('call-out.store') }}" method="post">
                    @csrf

                    <div class="creat__call-content-date">
                        <h3 class="creat__call-content-date-title text-center"><b>Create a Call-out</b></h3>
                        <h3 class="creat__call-content-date-title text-center">
                            <b>{{ $data['school']->school_name }}</b>
                            <input type="hidden" name="school_id" value="{{ $data['school']->id }}">
                        </h3>

                        <label for="creatCall4" class="creat__call-content-date-label">
                            Date
                            <div class="creat__call-content-date-info">
                                <span
                                    class="creat__call-content-date-info-text"
                                >
                                    @foreach($data['dates'] as $date)
                                        {{ \Illuminate\Support\Carbon::parse($date)->format('F j, Y') . (!$loop->last ? ',' : '') }}

                                        <input type="hidden" name="dates_from[]" value="{{ $date }}">
                                    @endforeach
                                </span>
                            </div>
                        </label>

                        @if (!is_null($data['nurse']))
                            <label for="creatCall4" class="creat__call-content-date-label">
                                Assigned Nurse
                                <div class="creat__call-content-date-info">
                                <span
                                    class="creat__call-content-date-info-text"
                                >
                                        {{ $data['nurse']->first_name }} {{ $data['nurse']->last_name }} {{ $data['nurse']->mi }}
                                </span>

                                    {{--                                <input type="hidden" name="dateTo" value="{{ $dateTo }}">--}}
                                </div>
                            </label>

                            <input type="hidden" name="nurse_id" value="{{ $data['nurse']->id }}">
                        @endif
                    </div>
                    <div class="creat__call-content-button">
                        <a
                            class="btn-reset btn__outline"
                            href="{{ route('main') }}"
                        >
                            Cancel
                        </a>
                        <button type="submit" class="btn-reset btn__green">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
