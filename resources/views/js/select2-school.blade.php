<script defer>
    const schools = {{ \Illuminate\Support\Js::from($schools)}};

    const data = $.map(schools, function (item) {
        item.text = item.school_name
        return item;
    });

    function matchCustom(params, data) {
        if (data.disabled) {
            return null;
        }

        if ($.trim(params.term) === '') {
            return data;
        }

        if (typeof data.text === 'undefined') {
            return null;
        }

        const contains = data.text.includes(params.term.charAt(0).toUpperCase()) || data.text.includes(params.term) || data.building_code === params.term
        if (contains) {
            return data;
        }
        return null;
    }

    $('#school').select2({
        data: data,
        matcher: matchCustom,
        placeholder: 'Search for a school',
        // allowClear: true,
    }).val(null).trigger('change');
</script>
