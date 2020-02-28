$(function() {
    //generer des posts
    var start = 0
    var limit = 6
    var postsEnd = false
    $(window).scroll(function() {
        var test = $(document).height() - $(window).height()
        if($(window).scrollTop() >= ($(document).height() - $(window).height()))
            getData()
    })
    getData()
    function getData() {
        if(postsEnd)
            return

        $('.loader').css('display', 'block')
        $.post('posts.php', {
            get_data: 1,
            start: start,
            limit: limit
        }).done(function(data, textStatus, jqXHR) {
            if(data == "postsEnd") {
                postsEnd = true
                $('.loader').css('display', 'none')
            } else {
                start += limit
                $('.gallery').append(data)
            }
        }).fail(function(jqXHR, textStatus, errorThrown) {
    
        })
    }
})