<div wire:ignore>
    <label for="search" class="creat__call-content-date-label">
        Assigned Nurse
        <div class="add__schools__inputs-label-item-input-search">
            <select class="form-control" name="nurse_id" id="nurse">
{{--                <option disabled selected>Select...</option>--}}
{{--                @foreach($nurses as $nurse)--}}
{{--                    <option--}}
{{--                        value="{{ $nurse->id }}"--}}
{{--                    >--}}
{{--                        {{ $nurse->first_name }} {{ $nurse->last_name }} {{ $nurse->mi }}--}}
{{--                    </option>--}}
{{--                @endforeach--}}
            </select>
            <span class="add__schools__inputs-label-item-input-search-icon mt-0">
                                            <img src="{{ asset('img/search-icon.svg') }}" alt="">
                                        </span>
            <span class="add__schools__inputs-label-item-input-search-icon mt-0">
                                            <img src="{{ asset('img/magic.svg') }}" alt="">
                                        </span>
        </div>
        @error('nurse_id') <span class="text-danger">{{ $message }}</span> @enderror

    </label>

    @push('js')
        @include('js.select2-nurse')
    @endpush
</div>
