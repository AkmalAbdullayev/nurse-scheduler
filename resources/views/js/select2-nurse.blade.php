<script defer>
    const nurses = {{ \Illuminate\Support\Js::from($nurses) }};

    const mapNurses = $.map(nurses, function (item) {
        if (item.mi === null) {
            item.mi = '';
        }
        item.text = `${item.first_name} ${item.mi} ${item.last_name}`;
        return item;
    });

    function matchCustom(params, data) {
        if (data.disabled) {
            return null;
        }

        const cell_number = data.cell_number.slice(2, data.cell_number.length).replace(/ /g,'');

        if ($.trim(params.term) === '') {
            return data;
        }

        if (typeof data.text === 'undefined') {
            return null;
        }

        const contains = data.text.includes(params.term.charAt(0).toUpperCase()) || data.text.includes(params.term) || cell_number === params.term
        if (contains) {
            return data;
        }

        return null;
    }

    $('#nurse').select2({
        data: mapNurses,
        matcher: matchCustom,
        placeholder: 'Search for a nurse',
        // allowClear: true,
    }).val(null).trigger('change');
</script>
