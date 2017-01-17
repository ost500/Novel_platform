$(function() {
    /**
     * GNB
     */
    $('#gnb_wrap').on({
        'focusin': function() {
            $(this).addClass('is-focus');
        },
        'focusout': function() {
            $(this).removeClass('is-focus');
        }
    });
    $('.gnb-bg').on({
        'mouseenter': function() {
            $('#gnb_wrap').addClass('is-focus');
        },
        'mouseleave': function() {
            $('#gnb_wrap').removeClass('is-focus');
        }
    });
    $('#gnb_wrap .gnb-depth1:first li:first, .gnb-depth2:last li:last').on('focusout', function() {
        $('#gnb_wrap').removeClass('is-focus');
    });
    // GNB 고정
    var header = $('#header');
    var aside_nav = $('#aside_nav');
    $(window).on('scroll', function() {
        if ($(this).scrollTop() < 176) {
            header.removeClass('is-gnb-fixed');
            aside_nav.removeClass('is-fixed');
        } else {
            header.addClass('is-gnb-fixed');
            aside_nav.addClass('is-fixed');
        }
    });

    /**
     * 사용자버튼 더보기
     */
    $('#more_btns_open').on('click', function() {
        if (! $(this).hasClass('is-active')) {
            $(this).addClass('is-active');
        } else {
            $(this).removeClass('is-active');
        }
    });

    /**
     * 모달팝업
     */

    var is_fullsize_modal = false;

    // 열기버튼
    $('[data-modal-id]').on('click', function(e) {
        e.preventDefault();

        var modal = $( '#'+$(this).data('modal-id') );
        if ($(this).is('[data-modal-fullsize]')) {
            is_fullsize_modal = true;
        } else {
            is_fullsize_modal = false;
        }

        if (! $('html').hasClass('is-modal')) {
            show_modal_bg();
            modal.addClass('modal-popup').add(this).addClass('is-active');
            if (is_fullsize_modal) {
                modal.fadeTo(500, 1, 'easeOutCubic');
            } else {
                modal.height(modal.children().height());
            }
            modal_tab(e);
        } else {
            if (is_fullsize_modal) {
                hide_modal_bg();
                modal.fadeTo(500, 0, 'easeOutCubic', function() { $(this).hide() });
            } else {
                close_modal();
            }
        }
    });
    // 닫기버튼
    $('[data-modal-close]').on('click', function(e) {
        e.preventDefault();
        var opener_id = $(this).closest('.modal-popup').attr('id');
        close_modal($('[data-modal-id="'+opener_id+'"]'));
    });
    // 팝업 자동열기
    $('[data-modal-start]').trigger('click');

    // 모달닫기
    function hide_modal_bg() {
        var modal_bg = $('#modal_bg');
        modal_bg.fadeTo(250, 0, function() { $(this).hide(); $('html').removeClass('is-modal'); });
    }
    // 모달열기
    function show_modal_bg() {
        if ($('#modal_bg').length == 0) {
            $('<div id="modal_bg" class="modal-bg"><span></span></div>').appendTo('body');
        }

        var modal_bg = $('#modal_bg');
        // fullsize modal
        if (is_fullsize_modal == true) {
            modal_bg.addClass('modal-bg--fullsize');
        } else {
            modal_bg.removeClass('modal-bg--fullsize');
        }
        $('html').addClass('is-modal');
        modal_bg.stop().show().fadeTo(400, 1, 'easeOutCubic');
    }
    // 팝업닫기
    function close_modal(el) {
        hide_modal_bg();
        // fullsize modal
        if (is_fullsize_modal == true) {
            $('.modal-popup.is-active').stop().clearQueue().fadeTo(500, 0, 'easeOutCubic', function() { $(this).hide() });
        }
        $('.modal-popup.is-active').add('[data-modal-id].is-active').removeClass('is-active');

        if (typeof(el) != 'undefined' && typeof(el.trigger) != 'undefined') {
            el.trigger('focus');
        }
    }
    // 모달 탭이동관리
    function modal_tab(e) {
        $(document).one('focusin', function(e) {
            if (!$(e.target).closest('.modal-popup.is-active').length) {
                $('.modal-popup.is-active').trigger('focus');
            }
        });
    }
    $(document).on('focus', '.modal-popup.is-active', modal_tab);
    // 팝업내부에 닫기버튼이 없는경우 ESC 로 대체
    $(document).on('keyup', '.modal-popup.is-active', function(e) {
        if (e.keyCode == 27) {
            close_modal( $('[data-modal-id="'+$(this).attr('id')+'"]') );
        }
    });
    $(document).on('click', '#modal_bg > span', close_modal);

    /**
     * 레이어팝업
     */
    $('.layer-popup-wrap').on({
        'focusin': function() {
            $(this).addClass('is-focus');
        },
        'focusout': function() {
            $(this).removeClass('is-focus');
        },
        'mouseenter': function() {
            $('.layer-popup-wrap').not(this).removeClass('is-focus');
        }
    });
    $('.layer-popup-wrap').on('focusout', 'a:first, a:last', function() {
        $(this).closest('.layer-popup-wrap').removeClass('is-focus');
    });

    /**
     * 셀렉트방식 링크
     */
    $('.select-link').on('click', function () {
        if (! $(this).hasClass('is-active')) {
            $(this).addClass('is-active');
        } else {
            $(this).removeClass('is-active');
        }
    });

    /**
     * 자동로그인
     */
    $('#auto_login_check').on('change', function() {
        if ($(this).is(':checked')) {
            $('#auto_login_notice').addClass('is-active');
        } else {
            $('#auto_login_notice').removeClass('is-active');
        }
    }).trigger('change');

    /**
     * 줄임내용 더보기
     */
    $('.hidden-content-view').on('click', function() {
        $(this).hide().next('.hidden-content').show();
    });

    /**
     * 가입약관 모두체크
     */
    $('#agreement_all_check').on('change', function() {
        if ($(this).is(':checked')) {
            $(this).closest('form').find('input[type=checkbox]').prop('checked', true);
        } else {
            $(this).closest('form').find('input[type=checkbox]').prop('checked', false);
        }
    });

    /**
     * 입력폼 검증 메시지 닫기
     */
    $('.join-form .alert-msg').on('click', function() {
        $(this).prevAll('input:eq(0)').trigger('focus');
        $(this).removeClass('is-active');
    });

    /**
     * 연재 헤더 고정
     */
    if ($('#original').length) {
        var ep_ori = $('#original');
        var ep_header = $('#original .episode-header:eq(0)');
        var gnb = $('#gnb');
        var ep_ori_top = ep_ori.offset().top;
        var gnb_top = ep_ori_top-46; // $('#gnb').height();
        var offset_top;

        $(window).on('scroll', function() {
            if ($(this).scrollTop() > gnb_top) {
                offset_top = gnb_top - $(this).scrollTop();
                gnb.css('margin-top', offset_top);
            } else {
                gnb.css('margin-top', 0);
            }
            if ($(this).scrollTop() <= ep_ori_top) {
                ep_ori.css('padding-top', 0);
                ep_header.removeClass('is-fixed');
            } else {
                ep_ori.css('padding-top', ep_header.outerHeight());
                ep_header.addClass('is-fixed');
            }
        });
    }

    /**
     * 파일첨부 커스텀
     */
    $('.typefile-input').each(function(index) {
        var isIE = /*@cc_on!@*/false;
        var $this = $(this);

        $this.on('change', function() {
            $(this).prev('.typefile-path').text($(this).val());
        });
        if (isIE == true) {
            $this.css('visibility', 'hidden').closest('.typefile').on('click', '.typefile-button, .typefile-path', function() {
                $this.trigger('click');
            });
        }
    });

    /**
     * 구슬충전 상품선택시 가격색상
     */
    $('.charge-list > li input[type=checkbox], .charge-list > li input[type=radio]').on('change', function() {
        if ($(this).is(':checked')) {
            $(this).closest('li').addClass('is-active');
            if ($(this).is('[type=radio]')) {
                $('.charge-list > li input[type=radio]').not(this).closest('li').removeClass('is-active');
            }
        } else {
            $(this).closest('li').removeClass('is-active');
        }
    }).trigger('change');

    /**
     * 게시물 모두체크
     */
    $('#list_all_check').on('change', function() {
        var targets = $(this).closest('form').find('[data-check-item]');//$('[data-check-item]');

        if ($(this).is(':checked')) {
            targets.prop('checked', true);
        } else {
            targets.prop('checked', false);
        }
    });
});
