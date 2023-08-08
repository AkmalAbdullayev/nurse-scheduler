<div>
    <div class="add__schools__inputs-label">
        <div class="add__schools__inputs-label-item" style="max-width: 100%; width: 600px; ">
            <label for="search" class="add__schools__inputs-label-item-input">
                Nurse search
                <div
                    class="add__schools__inputs-label-item-input-search"
                    style="margin-top: 8px"
                    wire:ignore
                >
                    <select
                        class="form-control"
                        name="nurse_id"
                        wire:model="nurse_id"
                        id="nurse"
                    >
                        <option disabled selected>Select...</option>
{{--                        @forelse($nurses as $nurse)--}}
{{--                            <option--}}
{{--                                value="{{ $nurse->id }}"--}}
{{--                                @if($callOut->nurse?->id === $nurse->id)--}}
{{--                                    selected--}}
{{--                                @endif--}}
{{--                            >--}}
{{--                                {{ $nurse->first_name }} {{ $nurse->mi }} {{ $nurse->last_name }}--}}
{{--                            </option>--}}
{{--                        @empty--}}
{{--                            <option disabled selected>No data found.</option>--}}
{{--                        @endforelse--}}
                    </select>
                    <span class="add__schools__inputs-label-item-input-search-icon m-0"><img
                            src="{{ asset('img/search-icon.svg') }}"
                            alt=""></span>
                </div>
            </label>
        </div>
    </div>

    <div class="add__schools__inputs-label">
        <label class="add__schools__inputs-label-item-input">
            <h3 class="callTitle">First Name</h3>
            <p class="callSubTitle">{{ $callOut->nurse?->first_name ?? '-' }}</p>
        </label>
        <label class="add__schools__inputs-label-item-input">
            <h3 class="callTitle">Last Name</h3>
            <p class="callSubTitle">{{ $callOut->nurse?->last_name ?? '-' }}</p>
        </label>
        <label class="add__schools__inputs-label-item-input">
            <h3 class="callTitle">MI</h3>
            <p class="callSubTitle">{{ $callOut->nurse?->mi ?? '-' }}</p>
        </label>
        <label class="add__schools__inputs-label-item-input">
            <h3 class="callTitle">Email</h3>
            <p class="callSubTitle">{{ $callOut->nurse?->email ?? '-' }}</p>
        </label>
        <label class="add__schools__inputs-label-item-input">
            <h3 class="callTitle">License number</h3>
            <p class="callSubTitle">{{ $callOut->nurse?->license_number ?? '-' }}</p>
        </label>
        <label class="add__schools__inputs-label-item-input">
            <h3 class="callTitle">Nurse Cell Phone</h3>
            <p class="callSubTitle">{{ substr($callOut->nurse?->cell_number, 2) ?? '-' }}</p>
        </label>
        <label class="add__schools__inputs-label-item-input">
            <h3 class="callTitle">Borough</h3>
            <p class="callSubTitle">{{ $callOut->nurse?->borough->name ?? '-' }}</p>
        </label>
    </div>
    <div class="add__schools__inputs-header">
        <div style="margin-top: 10px">
            <h2 class="add__schools__inputs-header-title">School nurse info</h2>
        </div>
    </div>
    <div class="add__schools__inputs-label">
        @if($callOut->school->nurses->last()?->role->name == 'Perm School Nurse')
            <div class="add__schools__inputs-label-item">
                <label class="add__schools__inputs-label-item-input">
                    <h3 class="callTitle">School Nurse Name</h3>
                    <p class="callSubTitle">
                        {{ $callOut->school->nurses->last()->first_name . " " . $callOut->school->nurses->last()->mi . " " . $callOut->school->nurses->last()->last_name }}
                    </p>
                </label>

            </div>
            <div class="add__schools__inputs-label-item">
                <label class="add__schools__inputs-label-item-input">
                    <h3 class="callTitle">School Nurse Cell Phone</h3>
                    <p class="callSubTitle">{{ substr($callOut->school->nurses->last()?->cell_number, 2) }}</p>
                </label>
            </div>
        @else
            <div class="add__schools__inputs-label-item">
                <label class="add__schools__inputs-label-item-input">
                    <h3 class="callTitle">School Nurse Name</h3>
                    <p class="callSubTitle">
                        -
                    </p>
                </label>

            </div>
            <div class="add__schools__inputs-label-item">
                <label class="add__schools__inputs-label-item-input">
                    <h3 class="callTitle">School Nurse Cell Phone</h3>
                    -
                </label>
            </div>
        @endif
    </div>
</div>

@push('js')
    <script defer>
        document.getElementById('nurse').onchange = () => {
            const data = document.getElementById('nurse').value;
        @this.set('nurse_id', data);
        }
    </script>
@endpush
