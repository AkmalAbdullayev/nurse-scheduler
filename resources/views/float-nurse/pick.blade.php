<!DOCTYPE html>
<html lang="ru" class="page">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#111111">
    <title>NYC DOE Nurse Scheduler</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/vendor.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
    <script src="https://unpkg.com/feather-icons"></script>
    <script defer src="{{ asset('js/main.js') }}"></script>
</head>

<body class="page__body">
<div class="site-container">
    @include('partials.header')

    <div class="float">
        <div class="container-fluid">
            <nav>
                <div class="nav nav-tabs tabs-desktop" id="nav-tab" role="tablist">
                    <button
                        class="nav-link"
                        id="assigned-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#assigned"
                        type="button"
                        role="tab"
                        aria-controls="nav-home"
                        aria-selected="true"
                    >
                        <svg width="25" height="25" viewBox="0 0 24 25" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M18.9657 16.1455C19.0728 16.4625 19.1532 17.2341 18.9657 17.7184C18.5994 18.6696 17.1682 19.1182 15.5806 19.3299L15.766 19.1445C16.2948 18.6152 16.2948 17.7536 15.766 17.2245L14.9463 16.4053C14.6906 16.1491 14.349 16.0079 13.9868 16.0079C13.6243 16.0079 13.2834 16.1491 13.0272 16.4049L11.3246 18.1075L10.8512 17.6339C10.5942 17.3772 10.2537 17.2364 9.89125 17.2364C9.5288 17.2364 9.18833 17.3772 8.9319 17.633L8.11229 18.4531C7.90002 18.6651 7.76818 18.9358 7.7285 19.2281C6.1714 18.9282 4.34678 18.2811 4.90144 16.2349C5.1568 15.2936 6.293 14.6059 7.32787 14.0337C7.35308 14.0198 7.38063 14.0045 7.41032 13.9881C7.73493 13.8081 8.31414 13.4871 8.85575 13.2696C8.91385 13.2462 8.97464 13.2232 9.03681 13.1996C9.50809 13.0208 10.0583 12.812 10.1138 12.2362C10.1568 11.7917 9.93769 11.5142 9.67645 11.1833C9.61386 11.104 9.54884 11.0216 9.48443 10.9332C8.72327 9.8872 8.00733 8.46065 8.13639 6.52937C8.26397 4.63414 9.44305 3.16279 11.4172 2.93538C14.1321 2.62243 16.026 4.42955 15.7758 7.51858C15.7064 8.37895 15.3495 9.40891 14.922 10.1696C14.8066 10.3747 14.6501 10.578 14.4908 10.7849C14.0898 11.3058 13.6709 11.85 13.843 12.5058C13.966 12.9713 14.8116 13.2835 15.3784 13.4927C15.5176 13.5441 15.64 13.5893 15.7308 13.629C16.9054 14.1451 18.5529 14.915 18.9657 16.1455ZM15.1137 17.878C15.2836 18.0476 15.2836 18.3228 15.1137 18.4922L12.4516 21.1541L11.6326 21.9733C11.5477 22.0588 11.4366 22.1009 11.3254 22.1009C11.2143 22.1009 11.1031 22.0588 11.0184 21.9739L10.1995 21.1547L8.76587 19.7214C8.59627 19.5516 8.59627 19.2764 8.76587 19.1068L9.58506 18.2874C9.66975 18.2025 9.7809 18.1604 9.89204 18.1604C10.0032 18.1604 10.1143 18.2029 10.199 18.2874L11.3252 19.4137L13.6806 17.0588C13.7653 16.9737 13.8764 16.9316 13.9878 16.9316C14.0987 16.9316 14.2101 16.9743 14.2946 17.0588L15.1137 17.878Z"
                            />
                        </svg>
                        Assigned call outs
                    </button>

                    <button
                        class="nav-link active"
                        id="available-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#available"
                        type="button"
                        role="tab"
                        aria-controls="nav-nurses"
                        aria-selected="false"
                    >
                        <svg
                            width="24"
                            height="25"
                            viewBox="0 0 24 25"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M16.6358 14.9577C17.7296 15.3191 18.8837 15.503 20.0598 15.503C20.9098 15.503 21.6004 16.1941 21.6004 17.0436V20.5597C21.6004 21.4092 20.9098 22.1004 20.0598 22.1004C10.3223 22.1004 2.40039 14.1785 2.40039 4.44099C2.40039 3.59154 3.09099 2.90039 3.94099 2.90039H7.46704C8.31704 2.90039 9.00769 3.59154 9.00764 4.44109C9.00764 5.61504 9.19204 6.76919 9.55454 7.87024C9.73164 8.43064 9.58579 9.03014 9.17434 9.44159L7.59099 11.5452C8.90974 14.0301 10.4524 15.5718 12.9556 16.9082L15.1139 15.2785C15.441 14.9426 16.0994 14.7759 16.6358 14.9577ZM15.7341 2.90039H20.5341C21.1232 2.90039 21.6007 3.37794 21.6008 3.96709V8.76709C21.6008 9.06164 21.362 9.30044 21.0674 9.30044H20.0008C19.7062 9.30044 19.4674 9.06164 19.4674 8.76709V6.54209L14.732 11.2775C14.5237 11.4858 14.186 11.4858 13.9777 11.2775L13.2236 10.5234C13.0153 10.3151 13.0153 9.97749 13.2236 9.76919L17.9591 5.03374H15.7341C15.4395 5.03374 15.2007 4.79494 15.2007 4.50039V3.43374C15.2007 3.13919 15.4395 2.90039 15.7341 2.90039Z"
                            />
                        </svg>
                        Available call outs
                    </button>

                </div>
            </nav>



            <div class="tab-content" id="nav-tabContent">

                <!--   assigned call outs    -->
                <div class="tab-pane fade " id="assigned" role="tabpanel" aria-labelledby="assigned-tab"
                     style="width: 100%;">
                    <nav>
                        <div class="nav tabPane nav-tabs" id="nav-tabAssigned" role="tablist">
                            <button
                                class="nav-link active"
                                id="actual-tab"
                                data-bs-toggle="tab"
                                data-bs-target="#actual"
                                type="button"
                                role="tab"
                                aria-controls="nav-home"
                                aria-selected="true"
                            >
                                Actual call-outs
                            </button>

                            <button
                                class="nav-link"
                                id="history-tab"
                                data-bs-toggle="tab"
                                data-bs-target="#history"
                                type="button"
                                role="tab"
                                aria-controls="nav-nurses"
                                aria-selected="false"
                            >
                                History
                            </button>
                        </div>
                    </nav>

                    <!--   tabs content   -->
                    <div class="tab-content mt-0 p-0" id="nav-tabContentAssigned">
                        <!--   Current call-out    -->
                        <div class="tab-pane fade active show" id="actual" role="tabpanel" aria-labelledby="actual-tab"
                             style="width: 100%;">
                            @forelse($nurse->call_outs->where('status', '<>', 'CANCELLED') as $callOut)
                                <div class="tab-pane-content">
                                    <div class="tab-pane-content-card">
                                        <div class="tab-pane-content-card-info">
                                            <h3 class="tab-pane-content-card-info-title">School</h3>
                                            <p class="tab-pane-content-card-info-desc">{{ $callOut->school?->school_name }}</p>
                                        </div>
                                        <div class="tab-pane-content-card-info">
                                            <h3 class="tab-pane-content-card-info-title">Address</h3>
                                            <p class="tab-pane-content-card-info-desc">{{ $callOut->school?->street_address_1 }}</p>
                                        </div>
                                        <div class="tab-pane-content-card-info">
                                            <h3 class="tab-pane-content-card-info-title">Start Date</h3>
                                            <p class="tab-pane-content-card-info-desc">{{ $callOut->from?->format('F d, Y') }}</p>
                                        </div>
                                        <div class="tab-pane-content-card-info">
                                            <h3 class="tab-pane-content-card-info-title">End Date</h3>
                                            <p class="tab-pane-content-card-info-desc">{{ $callOut->to?->format('F d, Y') }}</p>
                                        </div>
                                    </div>
                                    <button
                                        type="button"
                                        class="btn-reset"
                                        data-bs-toggle="modal"
                                        href="#deletModalToggle-{{ $callOut->id }}"
                                        role="button"
                                    >
                                        Cancel
                                    </button>
                                </div>

                                <!-- Modal -->
                                <div
                                    class="modal modal-sm fade"
                                    id="deletModalToggle-{{ $callOut->id }}"
                                    aria-hidden="true"
                                    aria-labelledby="exampleModalToggleLabel"
                                    tabindex="-1"
                                >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <h3 class="modal-body-title">Are you sure you want to delete</h3>
                                                <p class="modal-body-desc">Only do it if it’s an emergency. You won’t
                                                    be able to pick other
                                                    dates on that
                                                    day.</p>
                                                <p class="modal-body-center">Are you sure?</p>
                                                <div class="modal-body-btn">
                                                    <button class="modal-body-btn-outline btn-reset"
                                                            data-bs-dismiss="modal">Cancel
                                                    </button>
                                                    <form
                                                        action="{{ route('float-nurse.call-out.destroy', $callOut->id) }}"
                                                        method="post"
                                                    >
                                                        @method('DELETE')
                                                        @csrf

                                                        <button class="modal-body-btn-green btn-reset">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @empty
                                <div
                                    class="tab-pane-found"
                                    style="margin-top: 5vh; display: flex; justify-content: center;"
                                >
                                    <img src="{{ asset('img/not-found.png') }}" alt="">
                                </div>
                            @endforelse
                        </div>

                        <!--   History   -->
                        <div
                            class="tab-pane fade"
                            id="history"
                            role="tabpanel"
                            aria-labelledby="history-tab"
                            style="width: 100%; "
                        >
                            @forelse($nurse->call_outs as $callOut)
                                <div class="tab-pane-content">
                                    <div class="tab-pane-content-card">
                                        <div class="tab-pane-content-card-info">
                                            <h3 class="tab-pane-content-card-info-title">School</h3>
                                            <p class="tab-pane-content-card-info-desc" style="color:#9f9f9f;">
                                                {{ $callOut->school->school_name }}
                                            </p>
                                        </div>
                                        <div class="tab-pane-content-card-info">
                                            <h3 class="tab-pane-content-card-info-title">Date</h3>
                                            <p class="tab-pane-content-card-info-desc">{{ $callOut->from->format('F d, Y') }}</p>
                                        </div>
                                        <div class="tab-pane-content-card-info">
                                            <h3 class="tab-pane-content-card-info-title">Status</h3>
                                            <p
                                                class="tab-pane-content-card-info-desc {{ $callOut->status === 'CANCELLED' ? 'text-danger' : 'text-green' }}"
                                            >
                                                @if($callOut->status === App\Enums\CallOutStatuses::PENDING_ACCEPTANCE->name)
                                                    {{ App\Enums\CallOutStatuses::PENDING_ACCEPTANCE->value }}
                                                @elseif($callOut->status === App\Enums\CallOutStatuses::ACCEPTED->name)
                                                    {{ App\Enums\CallOutStatuses::ACCEPTED->value }}
                                                @else
                                                    {{ App\Enums\CallOutStatuses::CANCELLED->value }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div
                                    class="tab-pane-found"
                                    style="margin-top: 5vh; display: flex; justify-content: center;"
                                >
                                    <img src="{{ asset('img/not-found.png') }}" alt="">
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!--   assigned call outs    -->
                <div class="tab-pane fade active show" id="available" role="tabpanel" aria-labelledby="available-tab"
                     style="width: 100%;">

                    <nav>
                        <div class="nav tabPane nav-tabs" id="nav-tabAvailable" role="tablist">
                            <button
                                class="nav-link active"
                                id="borough-tab"
                                data-bs-toggle="tab"
                                data-bs-target="#borough"
                                type="button"
                                role="tab"
                                aria-controls="nav-home"
                                aria-selected="true"
                            >
                                In my borough
                            </button>

                            <button
                                class="nav-link"
                                id="other-tab"
                                data-bs-toggle="tab"
                                data-bs-target="#other"
                                type="button"
                                role="tab"
                                aria-controls="nav-nurses"
                                aria-selected="false"
                            >
                                In other boroughs
                            </button>
                        </div>
                    </nav>

                    <div class="tab-content mt-0 p-0" id="nav-tabContentAssigned">
                        <!--   In my borough    -->
                        <div
                            class="tab-pane fade active show"
                            id="borough"
                            role="tabpanel"
                            aria-labelledby="other-tab"
                            style="width: 100%;"
                        >
                            <form action="{{ route('float-nurse.call-out.confirm') }}" method="post">
                                @csrf
                                <h3 class="tab-pane-title" style="margin: 10px 0 0 0">You selected</h3>
                                <div class="tab-pane-picked">
                                    <div class="tab-pane-picked-item">
                                        <div class="tab-pane-picked-item-card">
                                            <h3 class="tab-pane-picked-item-title">School</h3>
                                            <p class="tab-pane-picked-item-desc">{{ $currentCallOut->school->school_name }}</p>
                                        </div>

                                        <input type="hidden" value="{{ $currentCallOut->id }}" name="call_out_id">

                                        <div class="tab-pane-picked-item-card">
                                            <h3 class="tab-pane-picked-item-title">Start Date</h3>
                                            <p class="tab-pane-picked-item-desc">{{ $currentCallOut->from->format('F d, Y') }}</p>
                                        </div>
                                        {{--                            <div class="tab-pane-picked-item-card">--}}
                                        {{--                                <h3 class="tab-pane-picked-item-title">End Date</h3>--}}
                                        {{--                                <p class="tab-pane-picked-item-desc">{{ $callOut->to?->format('F d, Y') }}</p>--}}
                                        {{--                            </div>--}}
                                    </div>
                                    <div class="tab-pane-picked-item">
                                        <div class="tab-pane-picked-item-card">
                                            <h3 class="tab-pane-picked-item-title">Address</h3>
                                            <p class="tab-pane-picked-item-desc">{{ $currentCallOut->school->street_address_1 }}</p>
                                        </div>
                                        {{--                            <div class="tab-pane-picked-item-card">--}}
                                        {{--                                <h3 class="tab-pane-picked-item-title">Hours</h3>--}}
                                        {{--                                <p class="tab-pane-picked-item-desc">8 am to 3 pm</p>--}}
                                        {{--                            </div>--}}
                                        <div class="tab-pane-picked-item-card">
                                            <h3 class="tab-pane-picked-item-title">Medical skills</h3>
                                            <p class="tab-pane-picked-item-desc">
                                                @forelse($currentCallOut->school->medical_needs as $medicalNeed)
                                                    {{ $medicalNeed->name }}@if (!$loop->last)
                                                        ,
                                                    @endif
                                                @empty
                                                    No medical found. You can assign it from admin dashboard.
                                                @endforelse
                                            </p>
                                        </div>
                                    </div>
                                    <label for="calendar" class="tab-pane-picked-calendar">
                                        Estimated Time of Arrival
                                        <div class="tab-pane-picked-calendar-input">
                                            <img src="{{ asset('img/time.svg') }}" alt="">
                                            <input
                                                type="time"
                                                class="@error('time_of_arrival') mb-2 @enderror"
{{--                                                id="timepicker"--}}
{{--                                                placeholder="Pick a time..."--}}
                                                name="time_of_arrival"
                                            >

                                            @error('time_of_arrival') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </label>
                                    <div class="tab-pane-picked-footer">
                                        <a type="button" href="{{ route('float-nurse.call-out.index') }}" class="btn-reset btn__outline">Cancel</a>
                                        <button
                                            type="submit"
                                            class="btn-reset btn__green"
                                        >
                                            Confirm
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div
                            class="tab-pane fade"
                            id="other"
                            role="tabpanel"
                            aria-labelledby="other-tab"
                            style="width: 100%;"
                        >
                            @forelse($nurse->call_outs->where('status', '<>', 'CANCELLED') as $callOut)
                                @foreach($nurse->desired_boroughs->pluck('pivot')->where('is_primary', '==', 0) as $desiredBorough)
                                    @if ($desiredBorough->borough_id == $callOut->school->borough_id)
                                        <form action="{{ route('float-nurse.call-out.pick', $callOut->id) }}">
                                            <div class="tab-pane-content">
                                                <div class="tab-pane-content-card">
                                                    <div class="tab-pane-content-card-info">
                                                        <h3 class="tab-pane-content-card-info-title">School</h3>
                                                        <p class="tab-pane-content-card-info-desc">{{ $callOut->school->school_name }}</p>
                                                    </div>
                                                    <div class="tab-pane-content-card-info">
                                                        <h3 class="tab-pane-content-card-info-title">Address</h3>
                                                        <p class="tab-pane-content-card-info-desc">{{ $callOut->school->street_address_1 }}</p>
                                                    </div>
                                                    <div class="tab-pane-content-card-info">
                                                        <h3 class="tab-pane-content-card-info-title">Borough</h3>
                                                        <p class="tab-pane-content-card-info-desc">{{ $callOut->school->borough->name }}</p>
                                                    </div>
                                                    <div class="tab-pane-content-card-info">
                                                        <h3 class="tab-pane-content-card-info-title">Start Date</h3>
                                                        <p class="tab-pane-content-card-info-desc">{{ $callOut->from?->format('F d, Y') }}</p>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn-reset btn-green">Pick</button>
                                            </div>
                                        </form>
                                    @endif
                                @endforeach
                            @empty

                            @endforelse
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
