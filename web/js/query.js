$(function () {
    // trigger extension
    ace.require("ace/ext/language_tools");
    var editor = ace.edit("editor");
    editor.setOptions({
        fontSize: "14pt"
    });
    editor.setTheme("ace/theme/monokai");
    editor.getSession().setMode("ace/mode/mysql");
    // enable autocompletion and snippets
    editor.setOptions({
        enableBasicAutocompletion: true,
        enableSnippets: true,
        enableLiveAutocompletion: false
    });

    $(document)
        .on('click', '.execute_query', function () {
            var query = editor.getSession().getValue();
            if (!query.trim()) {
                return;
            }
            $.ajax({
                method: 'post',
                data: {query: query},
                success: function (data) {
                    $('.query_result').html(data);
                }
            })
        })
        .on('click', '.query_result thead th a, .query_result .pagination a', function () {
            var query = $('.executed_query').val();

            $.ajax({
                url: $(this).attr('href'),
                method: 'post',
                data: {query: query},
                success: function (data) {
                    $('.query_result').html(data);
                }
            });

            return false;
        })
});
