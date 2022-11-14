$(document).ready(function() { 
    const slider = $('.location__wrap'),
          burger = $('.header__burger span'),
          body = $("body"),
          nav = $('.header__mobile-navigation');

    burger.on("click", function(event) {
        burger.toggleClass("active");
        nav.toggleClass("active");
        body.toggleClass("fixed-page");
    });

    if(body.hasClass('home')) {
        $("a[href^='#']").on("click", function(e) {
            const target = $(this).attr("href");
            $("html, body").animate({ scrollTop: $(target).offset().top - 120 }, 1000);       
        });
    }

    const sliderSettings = {
        infinite: true,
        arrows:false,
        dots: true,
        slidesToShow: 3,
        slidesToScroll: 3,
        responsive: [
            {
                breakpoint: 1201,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                }
            },
        ]
    };

    const sliderBanner = {
        infinite: true,
        arrows:false,
        dots: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3500,
    };

    $('.Banner').slick(sliderBanner);

    $(window).on('scroll', function (e) {
        if($(window).scrollTop() > 0) {
            $('header').addClass('fixed');
        } else {
            $('header').removeClass('fixed');
        }
    }) 

    // $headerLink.on("click", function(e) {
    //     e.preventDefault();
    //     const target = $(this).attr("href");
    //     $("html, body").animate({ scrollTop: $(target).offset().top - 75 }, 800);
    //     $nav.removeClass("active");
    //     $burger.removeClass("active");
    //     $body.removeClass("fixed-page");
    // });

    $('.sale__slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        dots: true,
        swipeToSlide: true,
        focusOnSelect: true,
        arrows: false,
        responsive: [
            {
                breakpoint: 769,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });
    $('.shop__items_wrap').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        cssEase: 'linear',
        focusOnSelect: true,
        arrows: false,
        swipeToSlide: true,
        centerMode: true,
        responsive: [
            // {
            //     breakpoint:1201,
            //     settings: {
            //         slidesToShow: 5
            //     }
            // },
            // {
            //     breakpoint:1025,
            //     settings: {
            //         slidesToShow: 4
            //     }
            // },
            {
                breakpoint: 769,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                }
            },
        ]
    });

    if($('.shop__items_wrap a').hasClass('slick-current')) {
        $('.slick-current').children().removeClass('btn__transparent').addClass('btn__primary'); 
    } 
    // const unslick = 'unslick';

    // $(window).on('resize', function () {
    //     if($(this).width() < 576) {
    //         slider.slick(unslick);
    //     }
    //     if($(this).width() > 576 && !slider.hasClass("slick-initialized")) {
    //         slider.slick(sliderSettings);
    //     }
        
    // })

    // if($(window).width() < 576) {
    //     slider.slick(unslick);
    // }
    // if($(window).width() > 576) {
    //     slider.slick(sliderSettings);
    // }
    // let $dataStart = $('.categories__items').children('a').attr('data-cat');

    $('.shop__items_wrap a').on('click', function (e) {
        e.preventDefault();
        console.log($(this).attr('data-cat'));   
        if($(e.target).parent().hasClass('slick-current')) {
            $(e.target).addClass('btn__primary').removeClass('btn__transparent'); 
            if($(e.target).parent().siblings().children().hasClass('btn__primary')) {
                $(e.target).parent().siblings().children().removeClass('btn__primary').addClass('btn__transparent');
            }
        } 

        $.ajax({
            type: 'post',
            url: localizedObject.ajaxurl,
            data: {
                action: 'get_product_cat',
                cat_id:  $(this).attr('data-cat'),
            },
            beforeSend: function (response) {
                // $('.resp-box').addClass("loader");
                // if($('.rolls')) {
                //     $('.rolls').hide();
                // }

                // isAjaxActive = true;
            },
            complete: function (response) {
                // $('.resp-box').removeClass("loader");
                // $('.rolly__categories_item').children().removeClass('disabled');
                // isAjaxActive = false;

            },
            success: function(response) {
                console.log(response);
                $('#shopProducts').html(response);
            },
            error: function (jqXhr, textStatus, errorMessage) {
                // if(!$('.resp-box').hasClass("error")){
                //     $('.resp-box').addClass("error").append('Something went wrong');
                // };   
            }
            
        });
    })



    $(document).on("click", '.cart-qty.plus, .cart-qty.minus', function (e) {
        e.preventDefault();
            const input  =  $(this).parent().find('.input-text.qty.text');
            const input_val = parseInt(input.val());
            if ($(this).hasClass('plus')) {
                input.val(input_val + 1);
                input.attr('value',input_val + 1)
            }
            else {
                const new_val = input_val - 1;
                if (new_val > 0) {
                    input.val(input_val - 1);
                    input.attr('value',input_val - 1)
                }
            }
    
        input.trigger("change");
    });

     
    let timeout;
    $('.woocommerce').on('change', 'input.qty', function(){
        if ( timeout !== undefined ) {
            clearTimeout( timeout );
        }
        timeout = setTimeout(function() {
            $("[name='update_cart']").trigger("click"); // trigger cart update
        }, 100 ); // 1 second delay, half a second (500) seems comfortable too
    });

    console.log( $("[name='update_cart']"));
});