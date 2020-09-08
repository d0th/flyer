'use strict';

$(document).ready(function() {
    $('.corporate__list').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        prevArrow: '<button class="slide-arrow prev-arrow"><img src="/images/icon/prev.svg" alt=""></button>',
        nextArrow: '<button class="slide-arrow next-arrow"><img src="/images/icon/next.svg" alt=""></button>',
        responsive: [
            {
                breakpoint: 1400,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 1050,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 750,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });

    $('.corporate__anchor[href^="#"]').click(function(){
        let anchor = $(this).attr('href');
        $('html, body').animate({
            scrollTop:  $(anchor).offset().top
        }, 600);
    });

    // добавляем имена вместо точек перелистывания на слайдере
    if ($(".instructor__name") !== undefined) {
        for (let childrenKey in $(".instructor__name")) {
            if ($(".instructor__name").hasOwnProperty(childrenKey)) {
                $(".slick-dots li button")[childrenKey].innerHTML = $(".instructor__name")[childrenKey].innerHTML
            }
        }
    }

    console.log($('.o-1'));
    console.log(1);

    $(".slick-list").on("init", function(event, slick) {
        console.log(slick.slideCount);
        //$(".seti__counter_facebook").text(1 + " / " + slick.slideCount);
    });
});
