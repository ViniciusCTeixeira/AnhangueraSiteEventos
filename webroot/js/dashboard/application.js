var application;
$(function () {
    application = {
        isMobile: false,
        webroot: '',
        windowWidth: 0,
        windowHeight: 0,
        documentWidth: 0,
        documentHeight: 0,

        init: function () {
            const isMobile = (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent));
            if (isMobile) {
                $('body').addClass('isMobile');
                application.isMobile = true;
            }
            application.setEvents();
        },
        setEvents: function () {
            $(document).on('ready', application.onReady);
            $(window).on('load', application.onLoad);
            $(window).on('resize', application.onResize);

            $('a[href="#"]').on('click', function (e) {
                e.preventDefault();
            });

            $('.buttonRedirect').on('click', function (e) {
                e.preventDefault();

                window.location = $(this).attr('data-href');
            });

            $('.scrollMove').on('click', function (e){
                e.preventDefault();

                const href = $(this).attr('href');
                const hash = href.split('#')[1]
                application.trailPage(hash);
            });

            $('a.modalTrigger').unbind('click').bind('click', application.openModal);

            $('.confirmRemove').on('click', function (e) {
                e.preventDefault();

                var href = $(this).attr('href');

                $.confirm({
                    title: 'Confirme sua ação',
                    content: 'Você realmente deseja executar está ação?',
                    confirmButton: 'Sim, continuar',
                    cancelButton: 'Não, voltar',
                    confirmButtonClass: 'btn-warning',
                    cancelButtonClass: 'btn-success',
                    confirm: function () {
                        window.location = href;
                    }
                });
            });

            $('.copyToClipboard').click(function (e) {
                e.preventDefault();
                try {
                    let msg = 'URL copiada.';
                    if ($(this).data('msg')) {
                        msg = $(this).data('msg');
                    }
                    let $temp = $("<input>");
                    $("body").append($temp);
                    $temp.val($(this).attr('href')).select();
                    document.execCommand("copy");
                    $temp.remove();
                    application.alert('info', msg, '');
                } catch (err) {  //We can also throw from try block and catch it here
                    application.alert('notice', 'Não foi possivel copiar a URL para a área de transferência.', '');
                }
            });

            $('.openUrlClick').on('click', function (e) {
                e.preventDefault();

                if ($(this).data('url')) {
                    window.location = $(this).data('url');
                }
            });

            if (application.isMobile === false) {
                $('[data-popover=true]').popover({
                    trigger: "hover",
                    html: true,
                    container: 'body',
                });
            }

            if ((navigator.platform.indexOf('Win') > -1) && document.querySelector('#sidenav-scrollbar')) {
                let options = {
                    damping: '0.5'
                }
                Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
            }

        },
        onLoad: function (ev) {
            application.windowWidth = $(window).width();
            application.windowHeight = $(window).height();
            application.documentWidth = $('html').width();
            application.documentHeight = $('html').height();

            application.checkHash();
        },
        onResize: function (ev) {
            application.windowWidth = $(window).width();
            application.windowHeight = $(window).height();
            application.documentWidth = $('html').width();
            application.documentHeight = $('html').height();
        },
        onReady: function (ev) {
            application.setTheme();
            application.checkHash();
        },
        checkHash: function () {
            var hash = window.location.hash.substr(1);

            if (hash != '') {
                application.trailPage(hash);
            }
        },
        trailPage : function (hash){
            if (hash && hash.length) {
                if ($("#" + hash).length) {
                    $('html, body').stop().animate({
                        scrollTop : parseFloat($("#" + hash).offset().top) - 75
                    }, 900, 'easeInOutExpo');
                }
            }
        },
        openModal: function (evt) {

            application.pageLoading(true);

            let $trigger = $(this), modalPath = $trigger.attr('href'), $newModal,
                removeModal = function (evt) {
                    $newModal.off('hidden.bs.modal');
                    $newModal.remove();
                },
                showModal = function (data) {
                    $('body').append(data);
                    $newModal = $('.modal').last();
                    $newModal.modal('show');
                    $newModal.on('hidden.bs.modal', removeModal);
                };

            $.get(modalPath, showModal).done(function () {
                application.pageLoading(false);
                application.setTheme();
            });

            evt.preventDefault();
        },
        setTheme: function () {

            $('button[data-select2-open]').on('click', function () {
                let parent = $(this).parent().parent();
                let select = parent.find('select');
                select.select2('open');
            });

            $('.select-theme, .select-theme-multiple').select2({
                allowClear: false,
                placeholder: 'selecione um item'
            });

            $(".datepicker").datepicker({
                dateFormat: 'dd/mm/yy',
                language: 'en',
                prevText: '<i class="fa fa-caret-left"></i>',
                nextText: '<i class="fa fa-caret-right"></i>'
            });

            let timepicker = $('.timepicker');
            if (timepicker.length) {
                $.each(timepicker, function (key, obj) {
                    $(obj).wickedpicker({
                        now: $(obj).val(), //hh:mm 24 hour format only, defaults to current time
                        twentyFour: true, //Display 24 hour format, defaults to false
                        upArrow: 'wickedpicker__controls__control-up', //The up arrow class selector to use, for custom CSS
                        downArrow: 'wickedpicker__controls__control-down', //The down arrow class selector to use, for custom CSS
                        close: 'wickedpicker__close', //The close class selector to use, for custom CSS
                        hoverState: 'hover-state', //The hover state class to use, for custom CSS
                        title: 'Informe o horário', //The Wickedpicker's title,
                        showSeconds: false, //Whether or not to show seconds,
                        secondsInterval: 1, //Change interval for seconds, defaults to 1
                        minutesInterval: 5, //Change interval for minutes, defaults to 1
                        beforeShow: null, //A function to be called before the Wickedpicker is shown
                        show: null, //A function to be called when the Wickedpicker is shown
                        clearable: false, //Make the picker's input clearable (has clickable "x")
                    });
                });
            }
            //- ----------------------------------------------------

            //- ----------------------------------------------------
            //- Input Mask
            $('.mask_year').mask('0000', {
                placeholder: "____"
            });
            $('.mask_date').mask('00/00/0000', {
                placeholder: "__/__/____"
            });
            $('.mask_time').mask('00:00', {
                placeholder: "00:00"
            });
            $('.mask_date_time').mask('00/00/0000 00:00:00', {
                placeholder: "00/00/0000 00:00:00"
            });
            $('.mask_phone').mask('0000-0000', {
                placeholder: "0000-0000"
            });
            $('.mask_phone_with_ddd').mask('(00) 0000-0000', {
                placeholder: "(00) 0000-0000"
            });
            $('.mask_phone_or_cellular').mask("(00) 00000-0000").focusout(function (event) {
                var phone, element;
                element = $(this);
                $(this).unmask();
                phone = element.val().replace(/\D/g, '');

                console.log('phone: ', phone);
                console.log('phone.length: ', phone.length);

                if (phone.length > 10) {
                    element.mask("(00) 00000-0000");
                } else {
                    element.mask("(00) 0000-00000");
                }
            }).trigger('focusout');
            $('.mask_whatsapp').mask("+00 (00) 0000-0000?0").focusout(function (event) {
                let phone, element;
                element = $(this);
                element.unmask();
                phone = element.val().replace(/\D/g, '');
                if (phone.length > 12) {
                    element.mask("+99 (99) 99999-9999");
                } else {
                    element.mask("+99 (99) 9999-99999");
                }
            }).trigger('focusout');
            $('.mask_cellular_with_ddd').mask('(00) 00000-0000', {
                placeholder: "(00) 00000-0000"
            });
            $('.mask_percent').mask('##0,00', {
                reverse: true,
                placeholder: "000,00"
            });
            //- ----------------------------------------------------

            $("[data-toggle=tooltip]").tooltip();
        },
        pageLoading: function (show) {
            if (show) {
                $('#preloaderPage').removeClass('hide');
            } else {
                $('#preloaderPage').addClass('hide');
            }
        },
        alert: function (type, msg, title, redirect) {

            title = ((title == '' || title == undefined) ? '' : title);
            redirect = ((redirect == '' || redirect == undefined) ? '' : redirect);

            if (type == 'alert') {
                swal({
                    title: title,
                    text: msg,
                    icon: "warning",
                    confirmButtonColor: "#dd6b55",
                    allowOutsideClick: false,
                });
            } else if (type == 'info') {
                swal({
                    title: title,
                    text: msg,
                    icon: "info",
                    confirmButtonColor: "#4caf50",
                    allowOutsideClick: false,
                });
            } else if (type == 'success') {
                swal({
                    title: title,
                    text: msg,
                    icon: "success",
                    confirmButtonColor: "#4caf50",
                    allowOutsideClick: false,
                });
            } else if (type == 'successWithRedirect') {
                swal({
                    title: title,
                    html: msg,
                    icon: "success",
                    showCancelButton: false,
                    confirmButtonColor: "#4caf50",
                    confirmButtonText: "Ok",
                    closeOnConfirm: false,
                    allowOutsideClick: false,
                }).then(function (text) {
                    window.location = redirect;
                });
            } else if (type == 'successWithReload') {
                swal({
                    title: title,
                    html: msg,
                    icon: "success",
                    showCancelButton: false,
                    confirmButtonColor: "#4caf50",
                    confirmButtonText: "Ok",
                    closeOnConfirm: false,
                    allowOutsideClick: false,
                }).then(function (text) {
                    location.reload();
                });
            } else if (type == 'noticeWithRedirect') {
                swal({
                    title: title,
                    html: msg,
                    icon: "error",
                    showCancelButton: false,
                    confirmButtonColor: "#4caf50",
                    confirmButtonText: "Ok",
                    closeOnConfirm: false,
                    allowOutsideClick: false,
                }).then(function (text) {
                    window.location = redirect;
                });
            } else if (type == 'notice') {
                swal({
                    title: title,
                    text: msg,
                    icon: "error",
                    confirmButtonColor: "#dd6b55",
                    allowOutsideClick: false,
                });
            } else if (type == 'html') {
                swal({
                    title: title,
                    text: msg,
                    html: true
                });
            } else if (type == 'contentHtml') {
                swal({
                    title: title,
                    html: msg
                });
            }

            return true;
        },
        ajaxPost: function (url) {
            application.pageLoading(true);
            $.post(application.webroot + url, {}, function (res) {
                application.pageLoading(false);
                if (res.success) {
                    application.alert('success', res.msg, res.title);
                } else {
                    application.alert('notice', res.msg, res.title);
                }
            }, 'json');
        }
    };
    application.init();
});
