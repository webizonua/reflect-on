$(function () {
    const $header = $('.header');
    const $toggle = $('.header__toggle');
    const $html = $('html');

    let lastScroll = 0;
    const threshold = 10;

    $toggle.on('click', function () {
        $(this).toggleClass('is-active');
        $html.toggleClass('is-locked');
        $header.toggleClass('menu-open');
    });

    $(window).on('resize', function () {
        if ($(window).width() > 1024) {
            $html.removeClass('is-locked');
            $toggle.removeClass('is-active');
            $header.removeClass('menu-open');
        }
    });

    $(window).on('scroll', function () {
        const current = $(this).scrollTop();
        if (Math.abs(current - lastScroll) > threshold) {
            if (current > lastScroll && current > 50) {
                $header.addClass('header--hide');
            } else if (current < lastScroll) {
                $header.removeClass('header--hide');
            }
            lastScroll = current;
        }
    });
    
    $('.faq__question').on('click', function() {
        const $item = $(this).closest('.faq__item');
        const $answer = $item.find('.faq__answer');

        if ($item.hasClass('active')) {
            $answer.animate({opacity: 0, height: 'toggle'}, 300);
            $item.removeClass('active');
        } else {
            $answer
                .css({opacity: 0, display: 'block', height: 'auto'})
                .hide()
                .animate({opacity: 1, height: 'show'}, 400);
            $item.addClass('active');
        }
    });
});
