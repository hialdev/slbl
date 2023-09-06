$('.hero-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:false,
    items:1,
    dotsContainer:'#hero-dots',
    autoHeight:true,
    autoplay:true,
    autoplayTimeout:7000,
    autoplayHoverPause:false
})

const item = $('.item-carousel');
item.owlCarousel({
    loop:false,
    margin:10,
    nav:false,
    items:1,
    dotsContainer:'#item-dots',
    autoHeight:true
})
$('.next-item').click(function() {
    item.trigger('next.owl.carousel');
})
$('.prev-item').click(function() {
    item.trigger('prev.owl.carousel', [300]);
})

$('.service-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:false,
    responsive:{
        0:{
            items:2,
        },
        360:{
            items:2,
        },
        720:{
            items:2,
        },
        930:{
            items:3,
        },
        1020:{
            items:3,
        }
    }
})

$('.client-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:false,
    autoplay:true,
    responsive:{
        0:{
            items:2,
        },
        360:{
            items:3,
        },
        720:{
            items:4,
        },
        930:{
            items:5,
        },
        1020:{
            items:6,
        }
    }
})