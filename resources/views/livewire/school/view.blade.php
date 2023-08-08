<div>
    <div class="view__school__inputs-header">
        <div style="margin-top: 10px">
            <h2 class="view__school__inputs-header-title">Nurse info </h2>
        </div>
    </div>
    <div class="add__schools__inputs-label">
        <div class="add__schools__inputs-label-item" style="max-width: 100%; width: 927px;">
            <label for="search" class="add__schools__inputs-label-item-input">
                Assigned Nurse
                <div class="add__schools__inputs-label-item-input-search mt-2" wire:ignore>
                    <select class="form-control" id="nurse" name="nurse_id">
                        <option selected disabled>Select...</option>
{{--                        @foreach($activeNurses as $activeNurse)--}}
{{--                            <option--}}
{{--                                value="{{ $activeNurse->id }}"--}}
{{--                                {{ old('nurse_id') == $activeNurse->id ? 'selected' : '' }}--}}
{{--                            >--}}
{{--                                {{ $activeNurse->first_name }} {{ $activeNurse->mi }} {{ $activeNurse->last_name }}--}}
{{--                            </option>--}}
{{--                        @endforeach--}}
                    </select>
                </div>

                @if(session()->has('message'))
                    <span class="text-danger mt-2">{{ session('message') }}</span>
                @endif

            </label>
        </div>
    </div>

    <div class="view__school__inputs-label">
        <div class="view__school__inputs-label-item">
            <label for="assigned" class="view__school__inputs-label-item-input">
                Assigned Registered Nurse Name
                <input
                    type="text"
                    class="form-control"
                    id="assigned"
                    placeholder="Type..."
                    name="nurses[first_name]"
                    @isset($nurse) value="{{ $nurse->first_name }} {{ $nurse->mi }} {{ $nurse->last_name }}" @endisset
                    readonly
                >
            </label>

            <label class="view__school__inputs-label-item-input">
                Assigned Registered Nurse Cell Phone
                <input
                    type="text"
                    class="form-control"
                    id="phone"
                    placeholder="xxx-xxx-xxxx"
                    name="nurses[cell_number]"
                    value="{{ substr($nurse?->cell_number, 2) }}"
                    readonly
                >
            </label>

            <label for="cellPhone" class="add__schools__inputs-label-item-input">
                Assigned Registered Nurse Office Phone
                <input
                    type="text"
                    class="form-control"
                    id="officePhone"
                    placeholder="xxx-xxx-xxxx"
                    name="nurses[office_phone]"
                    value="{{ substr($nurse?->office_phone, 2) }}"
                    readonly
                >
            </label>
        </div>

        <div class="view__school__inputs-label-item">
            <label for="email" class="view__school__inputs-label-item-input">
                Assigned Registered Nurse Email
                <input
                    type="email"
                    class="form-control"
                    id="email"
                    placeholder="Type..."
                    name="nurses[email]"
                    value="{{ $nurse?->email }}"
                    readonly
                >
            </label>

            <label class="view__school__inputs-label-item-input">
                Assigned Registered Nurse License Number
                <input
                    type="text"
                    class="form-control"
                    placeholder="Type..."
                    name="nurses[license_number]"
                    value="{{ $nurse?->license_number }}"
                    readonly
                >
            </label>
        </div>

        <div class="view__school__inputs-label-item">
            <label for="credential1" class="view__school__inputs-label-item-input">
                Nurse credential #1
                <select
                    class="form-select"
                    id="credential1"
                    aria-label="Default select example"
                    name="nurses[credentials][]"
                >
                    <option @if(!$nurseCredentials->has(0)) selected @endif disabled>Select…</option>
                    @forelse($credentials as $k => $credential)
                        <option
                            value="{{ $credential->id }}"
                        @if($nurseCredentials->has(0))
                            {{ $nurseCredentials[0]->id == $credential->id ? 'selected' : '' }}
                            @endif
                        >
                            {{ $credential->name }}
                        </option>
                    @empty
                        <option disabled selected>No data found.</option>
                    @endforelse
                </select>
            </label>

            <label for="credential2" class="view__school__inputs-label-item-input">
                Nurse credential #2
                <select
                    class="form-select"
                    id="credential2"
                    aria-label="Default select example"
                    name="nurses[credentials][]"
                >
                    <option @if(!$nurseCredentials->has(1)) selected @endif disabled>Select…</option>
                    @forelse($credentials as $k => $credential)
                        <option
                            value="{{ $credential->id }}"
                        @if($nurseCredentials->has(1))
                            {{ $nurseCredentials[1]->id == $credential->id ? 'selected' : '' }}
                            @endif
                        >
                            {{ $credential->name }}
                        </option>
                    @empty
                        <option disabled selected>No data found.</option>
                    @endforelse
                </select>
            </label>

            <label for="credential3" class="view__school__inputs-label-item-input">
                Nurse credential #3
                <select
                    class="form-select"
                    id="credential3"
                    aria-label="Default select example"
                    name="nurses[credentials][]"
                >
                    <option @if(!$nurseCredentials->has(2)) selected @endif disabled>Select…</option>
                    @forelse($credentials as $k => $credential)
                        <option
                            value="{{ $credential->id }}"
                        @if($nurseCredentials->has(2))
                            {{ $nurseCredentials[2]->id == $credential->id ? 'selected' : '' }}
                            @endif
                        >
                            {{ $credential->name }}
                        </option>
                    @empty
                        <option disabled selected>No data found.</option>
                    @endforelse
                </select>
            </label>

            <label for="credential4" class="view__school__inputs-label-item-input">
                Nurse credential #4
                <select
                    class="form-select"
                    id="credential4"
                    aria-label="Default select example"
                    name="nurses[credentials][]"
                >
                    <option @if(!$nurseCredentials->has(3)) selected @endif disabled>Select…</option>
                    @forelse($credentials as $k => $credential)
                        <option
                            value="{{ $credential->id }}"
                        @if($nurseCredentials->has(3))
                            {{ $nurseCredentials[3]->id == $credential->id ? 'selected' : '' }}
                            @endif
                        >
                            {{ $credential->name }}
                        </option>
                    @empty
                        <option disabled selected>No data found.</option>
                    @endforelse
                </select>
            </label>

            <label for="credential5" class="view__school__inputs-label-item-input">
                Nurse credential #5
                <select
                    class="form-select"
                    id="credential5"
                    aria-label="Default select example"
                    name="nurses[credentials][]"
                >
                    <option @if(!$nurseCredentials->has(4)) selected @endif disabled>Select…</option>
                    @forelse($credentials as $k => $credential)
                        <option
                            value="{{ $credential->id }}"
                        @if($nurseCredentials->has(4))
                            {{ $nurseCredentials[4]->id == $credential->id ? 'selected' : '' }}
                            @endif
                        >
                            {{ $credential->name }}
                        </option>
                    @empty
                        <option disabled selected>No data found.</option>
                    @endforelse
                </select>
            </label>
        </div>

        <div class="view__school__inputs-label-item" style="pviewing-top: 0">
            <label for="credential6" class="view__school__inputs-label-item-input">
                Nurse credential #6
                <select
                    class="form-select"
                    id="credential6"
                    aria-label="Default select example"
                    name="nurses[credentials][]"
                >
                    <option @if(!$nurseCredentials->has(5)) selected @endif disabled>Select…</option>
                    @forelse($credentials as $k => $credential)
                        <option
                            value="{{ $credential->id }}"
                        @if($nurseCredentials->has(5))
                            {{ $nurseCredentials[5]->id == $credential->id ? 'selected' : '' }}
                            @endif
                        >
                            {{ $credential->name }}
                        </option>
                    @empty
                        <option disabled selected>No data found.</option>
                    @endforelse
                </select>
            </label>

            <label for="credential7" class="view__school__inputs-label-item-input">
                Nurse credential #7
                <select
                    class="form-select"
                    id="credential7"
                    aria-label="Default select example"
                    name="nurses[credentials][]"
                >
                    <option @if(!$nurseCredentials->has(6)) selected @endif disabled>Select…</option>
                    @forelse($credentials as $k => $credential)
                        <option
                            value="{{ $credential->id  }}"
                        @if($nurseCredentials->has(6))
                            {{ $nurseCredentials[6]->id == $credential->id ? 'selected' : '' }}
                            @endif
                        >
                            {{ $credential->name }}
                        </option>
                    @empty
                        <option disabled selected>No data found.</option>
                    @endforelse
                </select>
            </label>

            <label for="credential8" class="view__school__inputs-label-item-input">
                Nurse credential #8
                <select
                    class="form-select"
                    id="credential8"
                    aria-label="Default select example"
                    name="nurses[credentials][]"
                >
                    <option @if(!$nurseCredentials->has(7)) selected @endif disabled>Select…</option>
                    @forelse($credentials as $k => $credential)
                        <option
                            value="{{ $credential->id }}"
                        @if($nurseCredentials->has(7))
                            {{ $nurseCredentials[7]->id == $credential->id ? 'selected' : '' }}
                            @endif
                        >
                            {{ $credential->name }}
                        </option>
                    @empty
                        <option disabled selected>No data found.</option>
                    @endforelse
                </select>
            </label>

            <label for="credential9" class="view__school__inputs-label-item-input">
                Nurse credential #9
                <select
                    class="form-select"
                    id="credential9"
                    aria-label="Default select example"
                    name="nurses[credentials][]"
                >
                    <option @if(!$nurseCredentials->has(8)) selected @endif disabled>Select…</option>
                    @forelse($credentials as $k => $credential)
                        <option
                            value="{{ $credential->id }}"
                        @if($nurseCredentials->has(8))
                            {{ $nurseCredentials[8]->id == $credential->id ? 'selected' : '' }}
                            @endif
                        >
                            {{ $credential->name }}
                        </option>
                    @empty
                        <option disabled selected>No data found.</option>
                    @endforelse
                </select>
            </label>

            <label for="credential10" class="view__school__inputs-label-item-input">
                Nurse credential #10
                <select
                    class="form-select"
                    id="credential10"
                    aria-label="Default select example"
                    name="nurses[credentials][]"
                >
                    <option @if(!$nurseCredentials->has(9)) selected @endif disabled>Select…</option>
                    @forelse($credentials as $k => $credential)
                        <option
                            value="{{ $credential->id }}"
                        @if($nurseCredentials->has(9))
                            {{ $nurseCredentials[9]->id == $credential->id ? 'selected' : '' }}
                            @endif
                        >
                            {{ $credential->name }}
                        </option>
                    @empty
                        <option disabled selected>No data found.</option>
                    @endforelse
                </select>
            </label>
        </div>
    </div>
</div>

@push('js')
    @include('js.select2-nurse', ['nurses' => $activeNurses])

    <script defer>
        document.getElementById('nurse').onchange = () => {
            const data = document.getElementById('nurse').value;
        @this.set('nurse_id', data);
        }
    </script>
@endpush
