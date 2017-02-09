$(function () {

    /**
     * Selectize for attributes
     */
    if ($('#attributes').length) {
        $.ajax({
            type: 'GET',
            url: '/api/attribute-groups'
        }).done(function(data) {
            var attributes = data.map(function(x) { return { item: x.value }; });

            $('#attributes').selectize({
                persist: false,
                create: true,
                delimiter: ', ',
                options: attributes,
                searchField: ['item'],
                labelField: 'item',
                valueField: 'item',
                createOnBlur: true
            });
        }).fail(function () {
            alertify.error('An error occurred while getting attributes.');
        });
    }

});
