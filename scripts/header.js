$(function() {
    $('a.profile').click(function(e) {
        e.preventDefault()
        $('.dropdown-menu').toggleClass('visible')
        $('.full-screen').toggleClass('visible')
    })
    $(document).keydown(function(e) {
        if(e.keyCode === 27) {
            $('.dropdown-menu').removeClass('visible')
            $('.full-screen').removeClass('visible')
        }
    })
    $(window).click(outSideHide)
    var fullScreen = document.querySelector('.full-screen')
    function outSideHide(e) {
        if(e.target == fullScreen) {
            $('.dropdown-menu').removeClass('visible')
            $('.full-screen').removeClass('visible')
        }
    }
})