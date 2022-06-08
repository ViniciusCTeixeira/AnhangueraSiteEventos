var application;
$(function (){
    application = {
        isMobile : false,
        webroot : '/',
        windowWidth : 0,
        windowHeight : 0,
        documentWidth : 0,
        documentHeight : 0,
        searchCityStateHave : true,

        init : function (){
            var isMobile = (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent));
            if (isMobile) {
                $('body').addClass('isMobile');
                application.isMobile = true;
            }

            application.setEvents();
        },
        setEvents : function (){
            $(document).on('ready', application.onReady);
            $(window).on('load', application.onLoad);
            $(window).on('resize', application.onResize);

            $('a[href="#"]').on('click', function (e){
                e.preventDefault();
            });

            //- --------------------------------------------------------------------------------------------------------
            //- scroll to move
            $('.scrollMove').on('click.smoothscroll', function (e){
                e.preventDefault();

                const href = $(this).attr('href');
                const hash = href.split('#')[1]
                application.trailPage(hash);
            });
            //- --------------------------------------------------------------------------------------------------------

            $(window).on('scroll', function (event){
                if ($(this).scrollTop() > 600) {
                    $('.back-to-top').fadeIn(200)
                } else {
                    $('.back-to-top').fadeOut(200)
                }
            });

            //Animate the scroll to yop
            $('.back-to-top').on('click', function (event){
                event.preventDefault();

                $('html, body').animate({
                    scrollTop : 0,
                }, 1500);
            });

            $('.container').imagesLoaded(function (){
                var $grid = $('.grid').isotope({
                    // options
                    transitionDuration : '1s'
                });

                // filter items on button click
                $('.portfolio-menu ul').on('click', 'li', function (){
                    var filterValue = $(this).attr('data-filter');
                    $grid.isotope({
                        filter : filterValue
                    });
                });

                //for menu active class
                $('.portfolio-menu ul li').on('click', function (event){
                    $(this).siblings('.active').removeClass('active');
                    $(this).addClass('active');
                    event.preventDefault();
                });
            });

            $('.slider-items-active').slick({
                infinite : true,
                slidesToShow : 3,
                slidesToScroll : 1,
                speed : 800,
                arrows : true,
                prevArrow : '<span class="prev"><i class="lni lni-arrow-left"></i></span>',
                nextArrow : '<span class="next"><i class="lni lni-arrow-right"></i></span>',
                dots : true,
                autoplay : true,
                autoplaySpeed : 5000,
                responsive : [
                    {
                        breakpoint : 1200,
                        settings : {
                            slidesToShow : 3,
                        }
                    },
                    {
                        breakpoint : 992,
                        settings : {
                            slidesToShow : 2,
                        }
                    },
                    {
                        breakpoint : 768,
                        settings : {
                            slidesToShow : 2,
                        }
                    },
                    {
                        breakpoint : 576,
                        settings : {
                            slidesToShow : 1,
                            arrows : false,
                        }
                    }
                ]
            });

            $(".navbar-nav a").on('click', function (){
                $(".navbar-collapse").removeClass("show");
            });

            $(".navbar-toggler").on('click', function (){
                $(this).toggleClass("active");
            });

            $(".navbar-nav a").on('click', function (){
                $(".navbar-toggler").removeClass('active');
            });
        },
        onLoad : function (ev){
            application.windowWidth = $(window).width();
            application.windowHeight = $(window).height();
            application.documentWidth = $('html').width();
            application.documentHeight = $('html').height();

            application.checkHash();
        },
        onResize : function (ev){
            application.windowWidth = $(window).width();
            application.windowHeight = $(window).height();
            application.documentWidth = $('html').width();
            application.documentHeight = $('html').height();
        },
        onReady : function (ev){
            application.checkHash();
        },
        checkHash : function (){
            var hash = window.location.hash.substr(1);

            if (hash != '') {
                application.trailPage(hash);
            }
        },
        scroolMotion : function (position, time){
            var time = (parseInt(time)) ? time : 1300;
            $("html, body").animate({scrollTop : position}, time);
        },
        trailPage : function (hash){
            if (hash && hash.length) {
                hash = hash.replace('/', '');
                if ($("#" + hash).length > 0) {
                    $('html, body').stop().animate({
                        scrollTop : parseFloat($("#" + hash).offset().top) - 75
                    }, 900, 'swing');
                }
            }
        },
    };
    application.init();
});
