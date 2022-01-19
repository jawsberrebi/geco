(function ($) {

    var root = '/Lab/History';

    $('.ajax').live('click', function (event) {
        event.preventDefault();
        var $a = $(this);
        var url = $a.attr('href');
        $.get(url + '.json', {}, function (data) {
            $('#title').text(data.Post.name);
            $('#content').html(data.Post.content);
            $('#myModal').modal();
            history.pushState({ key: 'value' }, 'titre', '/ajout?type=patient');
        }, 'json');
    });

    windows.onpopstate = function (event) {
        if (event.state == null) {
            $('#myModal').modal('hide');
        }
    }

})(jQuery);