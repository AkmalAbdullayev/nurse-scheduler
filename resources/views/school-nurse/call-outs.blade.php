<!--  button call-outs    -->
<div class="tab-pane float-pane fade @if(session()->has('call-out')) active show @endif" style="width: 100%" id="outs"
     role="tabpanel"
     aria-labelledby="outs-tab">
    <!-- tabs call-outs  -->
    <nav>
        <div class="nav tabPane school__nurse-nav nav-tabs" id="nav-tab2" role="tablist">
            <!--     Actual registered call-outs       -->
            <button class="nav-link active" id="reg-tab" data-bs-toggle="tab" data-bs-target="#myReg"
                    type="button"
                    role="tab" aria-controls="nav-home" aria-selected="true">
                Current call-outs
            </button>
            <!--     History       -->
            <button class="nav-link" id="history-tab" data-bs-toggle="tab" data-bs-target="#history"
                    type="button"
                    role="tab" aria-controls="nav-nurses" aria-selected="false">
                History
            </button>

        </div>
    </nav>
    <!--  content  call-outs -->
    <div class="tab-content history-content" style="width: 100%" id="nav-tabContent2">
        <!--  Actual registered call-outs   -->
        <div class="tab-pane fade active show" id="myReg" role="tabpanel" aria-labelledby="reg-tab">
            <div class="history-content-wrapper">
                @forelse ($callOuts as $k => $callOut)
                    <div class="history-content-card">
                        <p class="history-content-card-title">{{ \Carbon\Carbon::parse($k)->format('F') }}</p>
                        <span class="history-content-card-desc">
                            @forelse($callOut as $days)
                                {{ \Carbon\Carbon::parse($days->date_from)->format('d') }}
                                @if(!$loop->last)
                                    ,
                                @endif
                                @if ($loop->last)
                                    ({{ \Carbon\Carbon::parse($days->date_from)->format('Y') }})
                                @endif
                            @empty
                                Not found.
                            @endforelse
                        </span>
                    </div>
                @empty
                    <!--   not-found     -->
                    <div class="tab-pane-found">
                        <img src="{{ asset('img/not-found.png') }}" alt="">
                        <form
                            action="{{ route('school-nurse.call-out.register', ['schoolId' => $schoolNurse->schools->last()?->id]) }}"
                            style="width: 100%;"
                        >
                            <button type="submit" class="btn-reset text-center">
                                Register a call-out
                            </button>
                        </form>
                    </div>
                @endforelse
            </div>

            @if($callOuts->isNotEmpty())
                <div class="tab-pane-found">
                    <form
                        action="{{ route('school-nurse.call-out.register', ['schoolId' => $schoolNurse->schools->last()?->id]) }}"
                        style="width: 100%;"
                    >
                        <button type="submit" class="btn-reset text-center" style="max-width: 100%;">
                            Register a call-out
                        </button>
                    </form>
                </div>
            @endif

            <div class="history-content-footer" style="margin-top: 12px;">
                <p class="history-content-footer-info">For any changes to a registered call-out, please
                    <br> contact DoE
                    Inbox at
                    <a href="mailto:doe@rightsourcingusa.com.">doe@rightsourcingusa.com.</a>
                </p>
            </div>
        </div>

        <!--   History    -->
        <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="outs-tab">
            @include('school-nurse.log-list')

            @forelse($callOuts as $callOut)
                @foreach($callOut as $value)
                    <div class="history-content-item">
                        <div class="history-content-item-top">
                            <p class="history-content-item-top-title">School</p>
                            <p class="history-content-item-top-title">Date</p>
                            <p class="history-content-item-top-title">Status</p>
                        </div>
                        <div class="history-content-item-bottom">
                            <p
                                class="history-content-item-bottom-title"
                                style="color: #9f9f9f"
                            >
                                {{ $value->school?->school_name }}
                            </p>
                            <p class="history-content-item-bottom-title">{{ \Carbon\Carbon::parse($value->date_from)->format('F d, Y') }}</p>
                            <p class="history-content-item-bottom-title @if($value->status === App\Enums\CallOutStatuses::PENDING_ACCEPTANCE || $value->status == App\Enums\CallOutStatuses::ACCEPTED) text-success @else text-red @endif"
                            >

                                @if($value->status === App\Enums\CallOutStatuses::PENDING_ACCEPTANCE)
                                    {{ App\Enums\CallOutStatuses::PENDING_ACCEPTANCE->value }}
                                @elseif($value->status === App\Enums\CallOutStatuses::ACCEPTED)
                                    {{ App\Enums\CallOutStatuses::ACCEPTED->value }}
                                @else
                                    {{ App\Enums\CallOutStatuses::CANCELLED->value }}
                                @endif
                            </p>
                        </div>
                    </div>
                @endforeach
            @empty
                <!--   not-found     -->
                <div class="tab-pane-found">
                    <img src="{{ asset('img/not-found.png') }}" alt="">
                    <form
                        action="{{ route('school-nurse.call-out.register', ['schoolId' => $schoolNurse->schools->last()?->id]) }}"
                        style="width: 100%;"
                    >
                        <button type="submit" class="btn-reset text-center" style="max-width: 100%;">
                            Register a call-out
                        </button>
                    </form>
                </div>
            @endforelse

            <div class="history-content-footer">
                <p class="history-content-footer-info">For any changes to a registered call-out, please
                    <br> contact DoE
                    Inbox at
                    <a href="mailto:doe@rightsourcingusa.com.">doe@rightsourcingusa.com.</a></p>
            </div>
        </div>
    </div>
</div>
