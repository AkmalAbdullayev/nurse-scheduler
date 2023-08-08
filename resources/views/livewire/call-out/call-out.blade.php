<div>
    <form action="{{ route('call-out.confirm') }}" method="post">
        @csrf

        <div class="creat__call-content">
            <div class="creat__call-content-date">
                <h3 class="creat__call-content-date-title text-left"><b>Create a Call-out for:</b></h3>
                <label for="search" class="creat__call-content-date-label">
                    Select school
                    <div class="add__schools__inputs-label-item-input-search">
                        <select
                            class="form-control"
                            name="school_id"
                            id="school"
                        >
                            <option selected disabled>Select...</option>
                            {{--                            @foreach ($schools as $school)--}}
                            {{--                                <option--}}
                            {{--                                    value="g|{{ $school->id }}"--}}
                            {{--                                    {{ old('school_id') == $school->id ? 'selected' : '' }}--}}
                            {{--                                >--}}
                            {{--                                    {{ $school->school_name }}--}}
                            {{--                                </option>--}}
                            {{--                            @endforeach--}}
                        </select>

                        <span class="add__schools__inputs-label-item-input-search-icon mt-0">
                                <img src="{{ asset('img/search-icon.svg') }}" alt="">
                            </span>
                    </div>

                    {{--                    @error('school_id') <span style="color: red;">{{ $message }}</span> @enderror--}}
                </label>

                <label for="creatCall2" class="creat__call-content-date-label">
                    Date
                    <div class="creat__call-content-date-calendar">
                        <img src="{{ asset('img/calendar-icon.svg') }}" alt="">
                        <input
                            id="creatCall2"
                            placeholder="Select dates..."
                            name="date"
                            autocomplete="off"
                            value="{{ old('date') }}"
                        >
                    </div>

                    {{--                    @error('date') <span style="color: red;">{{ $message }}</span> @enderror--}}
                </label>

                <label for="search" class="creat__call-content-date-label">
                    Assigned Nurse
                    <div class="add__schools__inputs-label-item-input-search">
                        <select class="form-control" id="nurse" name="nurse_id">
                            <option selected disabled>Select...</option>
                            {{--                            @foreach($nurses as $nurse)--}}
                            {{--                                <option--}}
                            {{--                                    value="{{ $nurse->id }}"--}}
                            {{--                                    {{ old('nurse_id') == $nurse->id ? 'selected' : '' }}--}}
                            {{--                                >--}}
                            {{--                                    {{ $nurse->first_name }} {{ $nurse->mi }} {{ $nurse->last_name }}--}}
                            {{--                                    {{ 'test'}}--}}
                            {{--                                </option>--}}
                            {{--                            @endforeach--}}
                        </select>

                        <span class="add__schools__inputs-label-item-input-search-icon mt-0">
                                <img src="{{ asset('img/search-icon.svg') }}" alt="">
                            </span>
                        <span class="add__schools__inputs-label-item-input-search-icon mt-0">
                                <img src="{{ asset('img/magic.svg') }}" alt="">
                            </span>
                    </div>

                    {{--                    @error('nurse_id') <span style="color: red;">{{ $message }}</span> @enderror--}}
                </label>

                <label class="creat__call-checkbox">
                    Or send to all available nurses
                    <input
                        type="checkbox"
                        id="mass-assign"
                        name="nurses"
                        value="1"
                        onclick="disableField()"
                        {{ old('nurses') == 1 ? 'checked' : '' }}
                    />
                </label>
            </div>
        </div>

        <div class="creat__call-content">
            <div class="creat__call-content-button">
                <a
                    class="btn-reset btn__outline"
                    href="{{ route('main') }}"
                >
                    Cancel
                </a>
                <button
                    type="submit"
                    class="btn-reset btn__green"
                >
                    Create
                </button>
            </div>
        </div>
    </form>
</div>

@push('js')
    @include('js.select2-school')
    @include('js.select2-nurse')

    <script defer>
        let selectNurse = document.getElementById('nurse');
        let massAssignCheckbox = document.getElementById('mass-assign');

        selectNurse.disabled = !massAssignCheckbox.checked !== true;

        function disableField() {
            let selectNurse = document.getElementById('nurse');
            let massAssignCheckbox = document.getElementById('mass-assign');

            selectNurse.disabled = massAssignCheckbox.checked !== false;

            $('#nurse').val(null).trigger('change');
        }
    </script>
@endpush
