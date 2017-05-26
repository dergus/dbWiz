$(function () {
    $(document)
        .on('click', '.js_add_search_row', function () {
            var $el = $(this);
            var $searchRow = $(this).closest('.js_search_row').clone();
            $searchRow
                .find('.js_search_row_label')
                .removeClass('visible')
                .addClass('invisible');

            $el.closest('form').append($searchRow);

            $el.remove();
        });
});
