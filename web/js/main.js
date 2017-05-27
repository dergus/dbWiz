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
        })
        .on('keydown', '.table-editable td', function (e) {
            if (e.ctrlKey && e.which === 13) {
                var $el = $(this);
                var $row   = $el.closest('tr');
                var condition = JSON.parse($row.attr('update-condition'));
                var data = {
                    condition: condition,
                    columns: {}
                };
                data.columns[$el.attr('column-name')] = $el.html();

                $.ajax({
                    url: window.location.pathname,
                    method: 'patch',
                    data: JSON.stringify(data),
                    contentType: 'application/json; charset=UTF-8',
                    dataType: 'json',
                    complete: function (jqXHR, textStatus) {
                        if (textStatus === 'success' && jqXHR.responseJSON && jqXHR.responseJSON.ok === true) {
                            alertSuccess();
                        } else {
                            //TODO: show error msg
                            alertFail();
                        }
                    }
                })
            }
        })
        .on('click', '.app-alert', function () {
            $(this).fadeOut();
        });

    //TODO: that's not very good code
    // gotta rewrite it, probably with some js framework or template engine
    function alertSuccess(time) {
        var $elem = $('.app-alert-success');
        $elem.fadeIn();
        setTimeout(function () {
            $elem.fadeOut();
        }, time || 3000);
    }

    function alertFail() {
        var $elem = $('.app-alert-fail');
        $elem.fadeIn();
    }

});
