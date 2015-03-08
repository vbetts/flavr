//Populate listbox with json array
function populateSelect(data, selobj, placeholder) {
    $(selobj).empty();

    $(selobj).append(
        $('<option></option>')
        .val('0')
        .html(placeholder));
    $.each(data, function (i, obj) {
        $(selobj).append(
            $('<option></option>')
            .val(obj['id'])
            .html(obj['name']));
    });
}