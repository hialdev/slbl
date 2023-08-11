$('#menu-close').click(function (){
    $('.menu').removeClass('active');
})

$('#menu-open').click(function (){
    $('.menu').addClass('active');
})

$('#menu-product-btn').click(function(){
    $('#menu-product-dropdown').fadeToggle();
})

$('#open-floating').click(function(){
    $('#data-floating').toggleClass('d-flex');
    $(this).addClass('d-none');
})

$('#close-floating').click(function(){
    $('#data-floating').removeClass('d-flex');
    $('#open-floating').removeClass('d-none');
})

var elementPosition = $('.menu-box').offset();

$(window).scroll(function(){
    if($(window).scrollTop() > elementPosition.top){
            $('.menu-box').addClass('sticky-al');
    } else {
        $('.menu-box').removeClass('sticky-al');
    }    
});
