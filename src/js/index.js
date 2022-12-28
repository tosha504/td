$(document).ready(function () {
  var slider = $('.location__wrap'),
      burger = $('.header__burger span'),
      body = $("body"),
      nav = $('.header__mobile-navigation');
  burger.on("click", function (event) {
    burger.toggleClass("active");
    nav.toggleClass("active");
    body.toggleClass("fixed-page");
  });

  if (body.hasClass('home')) {
    $("a[href^='#']").on("click", function (e) {
      var target = $(this).attr("href");
      $("html, body").animate({
        scrollTop: $(target).offset().top - 120
      }, 1000);
    });
  }

  var sliderSettings = {
    infinite: true,
    arrows: false,
    dots: true,
    slidesToShow: 3,
    slidesToScroll: 3,
    responsive: [{
      breakpoint: 1201,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    }]
  };
  var sliderBanner = {
    infinite: true,
    arrows: false,
    dots: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 3500
  };
  $('.Banner').slick(sliderBanner);
  $(window).on('scroll', function (e) {
    if ($(window).scrollTop() > 0) {
      $('header').addClass('fixed');
    } else {
      $('header').removeClass('fixed');
    }
  });
  $('.sale__slider').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    dots: true,
    swipeToSlide: true,
    focusOnSelect: true,
    arrows: false,
    responsive: [{
      breakpoint: 769,
      settings: {
        slidesToShow: 2
      }
    }, {
      breakpoint: 576,
      settings: {
        slidesToShow: 1
      }
    }]
  });
  $('.shop__items_wrap').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    dots: false,
    cssEase: 'linear',
    arrows: true,
    centerMode: true,
    infinite: true,
    nextArrow: '.fake-arrow-after',
    prevArrow: '.fake-arrow-before',
    draggable: false,
    responsive: [{
      breakpoint: 993,
      settings: {
        arrows: false
      }
    }, {
      breakpoint: 769,
      settings: {
        arrows: false,
        slidesToShow: 2
      }
    }, {
      breakpoint: 576,
      settings: {
        arrows: false,
        slidesToShow: 1
      }
    }]
  });
  $('.shop__items_wrap a').on('click', function (e) {
    e.preventDefault();

    if ($(e.target).siblings().hasClass('btn__active')) {
      $(e.target).siblings().removeClass('btn__active');
    }

    $(e.target).addClass('btn__active');
    $.ajax({
      type: 'post',
      url: localizedObject.ajaxurl,
      data: {
        action: 'get_product_cat',
        cat_id: $(this).attr('data-cat')
      },
      beforeSend: function beforeSend(response) {
        // body.addClass("fixed-page");
        $('#shopProducts').hide();
        $('.box').addClass('active');
        $('.shop__items_wrap a').addClass('disabled');
      },
      success: function success(response) {
        $('.box').removeClass('active');
        $('#shopProducts').html(response).show();
        $('.shop__items_wrap a').removeClass('disabled');
      },
      error: function error(jqXhr, textStatus, errorMessage) {
        $('.box').removeClass('active');
        $('.box').after('<p class="error">Something went wrong</p>');
      }
    });
  });
  $(document).on("click", '.cart-qty.plus, .cart-qty.minus', function (e) {
    e.preventDefault();
    var input = $(this).parent().find('.input-text.qty.text');
    var input_val = parseInt(input.val());

    if ($(this).hasClass('plus')) {
      input.val(input_val + 1);
      input.attr('value', input_val + 1);
    } else {
      var new_val = input_val - 1;

      if (new_val > 0) {
        input.val(input_val - 1);
        input.attr('value', input_val - 1);
      }
    }

    input.trigger("change");
  });
  var timeout;
  $('.woocommerce').on('change', 'input.qty', function () {
    if (timeout !== undefined) {
      clearTimeout(timeout);
    }

    timeout = setTimeout(function () {
      $("[name='update_cart']").trigger("click"); // trigger cart update
    }, 100); // 1 second delay, half a second (500) seems comfortable too
  });
});
