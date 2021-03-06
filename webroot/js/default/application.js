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
            application.setThemes();
        },
        setEvents : function (){
            $(document).on('ready', application.onReady);
            $(window).on('load', application.onLoad);
            $(window).on('resize', application.onResize);

            $('a[href="#"]').on('click', function (e){
                e.preventDefault();
            });

            $(".navbar-toggler").on('click', function (){
                $(this).toggleClass("active");
                $(".navbar-collapse").toggleClass("show");
            });

            $(".navbar-nav a").on('click', function (){
                $(".navbar-toggler").removeClass('active');
                $(".navbar-collapse").removeClass("show");
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
        },
        setThemes : function (){
            $('.cpf').mask('000.000.000-00', {reverse: false});
            $('.ra').mask('000000000000', {reverse: false});
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
        pnotify : function (type, msg, title){
            title = ((title == '' || title == undefined) ? false : title);
            new PNotify({title : title, text : msg, type : type});

            return true;
        },
        showAlert: function (type, msg, title, redirect) {
            title = ((title === '' || title === undefined) ? '' : title);
            redirect = ((redirect === '' || redirect === undefined) ? '' : redirect);

            switch (type) {
                case "success":
                    Swal.fire({
                        icon: 'success',
                        title: title,
                        text: msg,
                    })
                    break;
                case "error":
                    Swal.fire({
                        icon: 'error',
                        title: title,
                        text: msg,
                    })
                    break;
                case "warning":
                    Swal.fire({
                        icon: 'warning',
                        title: title,
                        text: msg,
                    })
                    break;
                case "info":
                    Swal.fire({
                        icon: 'info',
                        title: title,
                        text: msg,
                    })
                    break;
                case "question":
                    Swal.fire({
                        icon: 'question',
                        title: title,
                        text: msg,
                    })
                    break;
                case "successRedirect":
                    Swal.fire({
                        icon: 'success',
                        title: title,
                        text: msg,
                    }).then(function (text){
                        window.location = redirect;
                    });
                    break;
            }
        }
    };
    application.init();
});
