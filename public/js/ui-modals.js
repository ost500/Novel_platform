// UI-Modals.js
// ====================================================================
// This file should not be included in your project.
// This is just a sample how to initialize plugins or components.
//
// - ThemeOn.net -


$(document).ready(function () {
    $('.novel-image').on('click', function () {
        bootbox.dialog({
            title: "표지관리",
            message: '<div class="row"> ' + '<div class="col-md-12"> ' +
            '<div class="modal-body pre-scrollable"><ul class="ul_basicCover"><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover1" value="1" name="radioInline" class="m-b"><label for="cover1">기본표지1 <img src="/img/novel_covers/default_1.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover2" value="2" name="radioInline" class="m-b"><label for="cover2">기본표지2 <img src="/img/novel_covers/default_2.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover3" value="3" name="radioInline" class="m-b"><label for="cover3">기본표지3 <img src="/img/novel_covers/default_3.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover4" value="4" name="radioInline" class="m-b"><label for="cover4">기본표지4 <img src="/img/novel_covers/default_4.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover5" value="5" name="radioInline" class="m-b"><label for="cover5">기본표지5 <img src="/img/novel_covers/default_5.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover6" value="6" name="radioInline" class="m-b"><label for="cover6">기본표지6 <img src="/img/novel_covers/default_6.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover7" value="7" name="radioInline" class="m-b"><label for="cover7">기본표지7 <img src="/img/novel_covers/default_7.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover8" value="8" name="radioInline" class="m-b"><label for="cover8">기본표지8 <img src="/img/novel_covers/default_8.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover9" value="9" name="radioInline" class="m-b"><label for="cover9">기본표지9 <img src="/img/novel_covers/default_9.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover10" value="10" name="radioInline" class="m-b"><label for="cover10">기본표지10 <img src="/img/novel_covers/default_10.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover11" value="11" name="radioInline" class="m-b"><label for="cover11">기본표지11 <img src="/img/novel_covers/default_11.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover12" value="12" name="radioInline" class="m-b"><label for="cover12">기본표지12 <img src="/img/novel_covers/default_12.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover13" value="13" name="radioInline" class="m-b"><label for="cover13">기본표지13 <img src="/img/novel_covers/default_13.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover14" value="14" name="radioInline" class="m-b"><label for="cover14">기본표지14 <img src="/img/novel_covers/default_14.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover15" value="15" name="radioInline" class="m-b"><label for="cover15">기본표지15 <img src="/img/novel_covers/default_15.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover16" value="16" name="radioInline" class="m-b"><label for="cover16">기본표지16 <img src="/img/novel_covers/default_16.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover17" value="17" name="radioInline" class="m-b"><label for="cover17">기본표지17 <img src="/img/novel_covers/default_17.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover18" value="18" name="radioInline" class="m-b"><label for="cover18">기본표지18 <img src="/img/novel_covers/default_18.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover19" value="19" name="radioInline" class="m-b"><label for="cover19">기본표지19 <img src="/img/novel_covers/default_19.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover20" value="20" name="radioInline" class="m-b"><label for="cover20">기본표지20 <img src="/img/novel_covers/default_20.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover21" value="21" name="radioInline" class="m-b"><label for="cover21">기본표지21 <img src="/img/novel_covers/default_21.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover22" value="22" name="radioInline" class="m-b"><label for="cover22">기본표지22 <img src="/img/novel_covers/default_22.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover23" value="23" name="radioInline" class="m-b"><label for="cover23">기본표지23 <img src="/img/novel_covers/default_23.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover24" value="24" name="radioInline" class="m-b"><label for="cover24">기본표지24 <img src="/img/novel_covers/default_24.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover25" value="25" name="radioInline" class="m-b"><label for="cover25">기본표지25 <img src="/img/novel_covers/default_25.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover26" value="26" name="radioInline" class="m-b"><label for="cover26">기본표지26 <img src="/img/novel_covers/default_26.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover27" value="27" name="radioInline" class="m-b"><label for="cover27">기본표지27 <img src="/img/novel_covers/default_27.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover28" value="28" name="radioInline" class="m-b"><label for="cover28">기본표지28 <img src="/img/novel_covers/default_28.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover29" value="29" name="radioInline" class="m-b"><label for="cover29">기본표지29 <img src="/img/novel_covers/default_29.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover30" value="30" name="radioInline" class="m-b"><label for="cover30">기본표지30 <img src="/img/novel_covers/default_30.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover31" value="31" name="radioInline" class="m-b"><label for="cover31">기본표지31 <img src="/img/novel_covers/default_31.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover32" value="32" name="radioInline" class="m-b"><label for="cover32">기본표지32 <img src="/img/novel_covers/default_32.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover33" value="33" name="radioInline" class="m-b"><label for="cover33">기본표지33 <img src="/img/novel_covers/default_33.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover34" value="34" name="radioInline" class="m-b"><label for="cover34">기본표지34 <img src="/img/novel_covers/default_34.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover35" value="35" name="radioInline" class="m-b"><label for="cover35">기본표지35 <img src="/img/novel_covers/default_35.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover36" value="36" name="radioInline" class="m-b"><label for="cover36">기본표지36 <img src="/img/novel_covers/default_36.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover37" value="37" name="radioInline" class="m-b"><label for="cover37">기본표지37 <img src="/img/novel_covers/default_37.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover38" value="38" name="radioInline" class="m-b"><label for="cover38">기본표지38 <img src="/img/novel_covers/default_38.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover39" value="39" name="radioInline" class="m-b"><label for="cover39">기본표지39 <img src="/img/novel_covers/default_39.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover40" value="40" name="radioInline" class="m-b"><label for="cover40">기본표지40 <img src="/img/novel_covers/default_40.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover41" value="41" name="radioInline" class="m-b"><label for="cover41">기본표지41 <img src="/img/novel_covers/default_41.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover42" value="42" name="radioInline" class="m-b"><label for="cover42">기본표지42 <img src="/img/novel_covers/default_42.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover43" value="43" name="radioInline" class="m-b"><label for="cover43">기본표지43 <img src="/img/novel_covers/default_43.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover44" value="44" name="radioInline" class="m-b"><label for="cover44">기본표지44 <img src="/img/novel_covers/default_44.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover45" value="45" name="radioInline" class="m-b"><label for="cover45">기본표지45 <img src="/img/novel_covers/default_45.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover46" value="46" name="radioInline" class="m-b"><label for="cover46">기본표지46 <img src="/img/novel_covers/default_46.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover47" value="47" name="radioInline" class="m-b"><label for="cover47">기본표지47 <img src="/img/novel_covers/default_47.jpg"> </label> </div></li><li><div class="radio radio-warning radio-inline m-b-xxs"><input type="radio" id="cover48" value="48" name="radioInline" class="m-b"><label for="cover48">기본표지48 <img src="/img/novel_covers/default_48.jpg"> </label> </div></li></ul></div></div> </div><script></script>',

            buttons: {
                success: {
                    label: "저장",
                    className: "btn-purple",
                    callback: function () {
                        var name = $('#name').val();
                        var answer = $("input[name='radioInline']:checked").val();
                        $("input[name='default_cover_photo']").val(answer);
                        // $.niftyNoty({
                        //     type: 'purple',
                        //     icon: 'fa fa-check',
                        //     //message : "Hello " + name + ".<br> You've chosen <strong>" + answer + "</strong>",
                        //     message: "필명 " + name + "이 저장 되었습니다.",
                        //     //container : 'floating',
                        //     container: 'page',
                        //     timer: 4000
                        // });
                    }
                }
            }
        });

        $(".demo-modal-radio").niftyCheck();
    });

    // $('.novel-agree').on('click', function(){


    //});


    // $('.novel-price-agree').on('click', function () {

    //  });


    // BOOTBOX - ALERT MODAL
    // =================================================================
    // Require Bootbox
    // http://bootboxjs.com/
    // =================================================================
    $('#demo-bootbox-alert').on('click', function () {
        bootbox.alert("Hello world!", function () {
            $.niftyNoty({
                type: 'info',
                icon: 'fa fa-info',
                message: 'Hello world callback',
                container: 'floating',
                timer: 3000
            });
        });
    });


    // BOOTBOX - CONFIRM MODAL
    // =================================================================
    // Require Bootbox
    // http://bootboxjs.com/
    // =================================================================
    $('#demo-bootbox-confirm').on('click', function () {
        bootbox.confirm("Are you sure?", function (result) {
            if (result) {
                $.niftyNoty({
                    type: 'success',
                    icon: 'fa fa-check',
                    message: 'User confirmed dialog',
                    container: 'floating',
                    timer: 3000
                });
            } else {
                $.niftyNoty({
                    type: 'danger',
                    icon: 'fa fa-minus',
                    message: 'User declined dialog.',
                    container: 'floating',
                    timer: 3000
                });
            }
            ;

        });
    });


    // BOOTBOX - PROMPT MODAL
    // =================================================================
    // Require Bootbox
    // http://bootboxjs.com/
    // =================================================================
    $('#demo-bootbox-prompt').on('click', function () {
        bootbox.prompt("What is your name?", function (result) {
            if (result) {
                $.niftyNoty({
                    type: 'success',
                    icon: 'fa fa-check',
                    message: 'Hi ' + result,
                    container: 'floating',
                    timer: 3000
                });
            } else {
                $.niftyNoty({
                    type: 'danger',
                    icon: 'fa fa-minus',
                    message: 'User declined dialog.',
                    container: 'floating',
                    timer: 3000
                });
            }
            ;
        });
    });


    // BOOTBOX - CUSTOM DIALOG
    // =================================================================
    // Require Bootbox
    // http://bootboxjs.com/
    // =================================================================
    $('#demo-bootbox-custom').on('click', function () {
        bootbox.dialog({
            message: "I am a custom dialog",
            title: "Custom title",
            buttons: {
                success: {
                    label: "Success!",
                    className: "btn-success",
                    callback: function () {
                        $.niftyNoty({
                            type: 'success',
                            icon: 'fa fa-check',
                            message: '<strong>Well done!</strong> You successfully read this important alert message. ',
                            container: 'floating',
                            timer: 3000
                        });
                    }
                },

                danger: {
                    label: "Danger!",
                    className: "btn-danger",
                    callback: function () {
                        $.niftyNoty({
                            type: 'danger',
                            icon: 'fa fa-times',
                            message: '<strong>Oh snap!</strong> Change a few things up and try submitting again.',
                            container: 'floating',
                            timer: 3000
                        });
                    }
                },

                main: {
                    label: "Click ME!",
                    className: "btn-primary",
                    callback: function () {
                        $.niftyNoty({
                            type: 'primary',
                            icon: 'fa fa-thumbs-o-up',
                            message: "<strong>Heads up!</strong> This alert needs your attention, but it's not super important.",
                            container: 'floating',
                            timer: 3000
                        });
                    }
                }
            }
        });
    });


    // BOOTBOX - CUSTOM HTML CONTENTS
    // =================================================================
    // Require Bootbox
    // http://bootboxjs.com/
    // =================================================================
    $('.novel-memo-view').on('click', function () {
        bootbox.dialog({
            title: "That html",
            message: '<div class="media"><div class="media-left"><img class="media-object img-lg img-circle" src="img/av3.png" alt="Profile picture"></div><div class="media-body"><h4 class="text-thin">You can also use <strong>html</strong></h4>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</div></div>',
            buttons: {
                confirm: {
                    label: "Save"
                }
            }
        });
    });


    // BOOTBOX - CUSTOM HTML FORM
    // =================================================================
    // Require Bootbox
    // http://bootboxjs.com/
    // =================================================================
    $('#demo-bootbox-custom-h-form').on('click', function () {
        bootbox.dialog({
            title: "This is a form in a modal.",
            message: '<div class="row"> ' + '<div class="col-md-12"> ' +
            '<form class="form-horizontal"> ' + '<div class="form-group"> ' +
            '<label class="col-md-4 control-label" for="name">Name</label> ' +
            '<div class="col-md-4"> ' +
            '<input id="name" name="name" type="text" placeholder="Your name" class="form-control input-md"> ' +
            '<span class="help-block"><small>Here goes your name</small></span> </div> ' +
            '</div> ' + '<div class="form-group"> ' +
            '<label class="col-md-4 control-label" for="awesomeness">How awesome is this?</label> ' +
            '<div class="col-md-8"> <div class="form-block"> ' +
            '<label class="form-radio form-icon demo-modal-radio active"><input type="radio" autocomplete="off" name="awesomeness" value="Really awesome" checked> Really awesome</label>' +
            '<label class="form-radio form-icon demo-modal-radio"><input type="radio" autocomplete="off" name="awesomeness" value="Super awesome"> Super awesome </label> </div>' +
            '</div> </div>' + '</form> </div> </div><script></script>',
            buttons: {
                success: {
                    label: "Save",
                    className: "btn-purple",
                    callback: function () {
                        var name = $('#name').val();
                        var answer = $("input[name='awesomeness']:checked").val();

                        $.niftyNoty({
                            type: 'purple',
                            icon: 'fa fa-check',
                            message: "Hello " + name + ".<br> You've chosen <strong>" + answer + "</strong>",
                            container: 'floating',
                            timer: 4000
                        });
                    }
                }
            }
        });

        $(".demo-modal-radio").niftyCheck();
    });


    // BOOTBOX - ZOOM IN/OUT ANIMATION
    // =================================================================
    // Require Bootbox
    // http://bootboxjs.com/
    //
    // Animate.css
    // http://daneden.github.io/animate.css/
    // =================================================================
    $('#demo-bootbox-zoom').on('click', function () {
        bootbox.confirm({
            message: "<h4 class='text-thin'>Zoom In/Out</h4><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>",
            buttons: {
                confirm: {
                    label: "Save"
                }
            },
            callback: function (result) {
                //Callback function here
            },
            animateIn: 'zoomInDown',
            animateOut: 'zoomOutUp'
        });
    });


    // BOOTBOX - BOUNCE IN/OUT ANIMATION
    // =================================================================
    // Require Bootbox
    // http://bootboxjs.com/
    //
    // Animate.css
    // http://daneden.github.io/animate.css/
    // =================================================================
    $('#demo-bootbox-bounce').on('click', function () {
        bootbox.confirm({
            message: "<h4 class='text-thin'>Bounce</h4><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>",
            buttons: {
                confirm: {
                    label: "Save"
                }
            },
            callback: function (result) {
                //Callback function here
            },
            animateIn: 'bounceIn',
            animateOut: 'bounceOut'
        });
    });


    // BOOTBOX - RUBBERBAND & WOBBLE ANIMATION
    // =================================================================
    // Require Bootbox
    // http://bootboxjs.com/
    //
    // Animate.css
    // http://daneden.github.io/animate.css/
    // =================================================================
    $('#demo-bootbox-ruberwobble').on('click', function () {
        bootbox.confirm({
            message: "<h4 class='text-thin'>RubberBand & Wobble</h4><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>",
            buttons: {
                confirm: {
                    label: "Save"
                }
            },
            callback: function (result) {
                //Callback function here
            },
            animateIn: 'rubberBand',
            animateOut: 'wobble'
        });
    });


    // BOOTBOX - FLIP IN/OUT ANIMATION
    // =================================================================
    // Require Bootbox
    // http://bootboxjs.com/
    //
    // Animate.css
    // http://daneden.github.io/animate.css/
    // =================================================================
    $('#demo-bootbox-flip').on('click', function () {
        bootbox.confirm({
            message: "<h4 class='text-thin'>Flip</h4><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>",
            buttons: {
                confirm: {
                    label: "Save"
                }
            },
            callback: function (result) {
                //Callback function here
            },
            animateIn: 'flipInX',
            animateOut: 'flipOutX'
        });
    });


    // BOOTBOX - LIGHTSPEED IN/OUT ANIMATION
    // =================================================================
    // Require Bootbox
    // http://bootboxjs.com/
    //
    // Animate.css
    // http://daneden.github.io/animate.css/
    // =================================================================
    $('#demo-bootbox-lightspeed').on('click', function () {
        bootbox.confirm({
            message: "<h4 class='text-thin'>Light Speed</h4><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>",
            buttons: {
                confirm: {
                    label: "Save"
                }
            },
            callback: function (result) {
                //Callback function here
            },
            animateIn: 'lightSpeedIn',
            animateOut: 'lightSpeedOut'
        });
    });


    // BOOTBOX - SWING & HINGE IN/OUT ANIMATION
    // =================================================================
    // Require Bootbox
    // http://bootboxjs.com/
    //
    // Animate.css
    // http://daneden.github.io/animate.css/
    // =================================================================
    $('#demo-bootbox-swing').on('click', function () {
        bootbox.confirm({
            message: "<h4 class='text-thin'>Swing & Hinge</h4><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>",
            buttons: {
                confirm: {
                    label: "Save"
                }
            },
            callback: function (result) {
                //Callback function here
            },
            animateIn: 'swing',
            animateOut: 'hinge'
        });
    });


})


var agreement = function () {
    bootbox.dialog({
        className: "author_agreement_dialog",
        title: "연재약관",
        message: '<div class="row"> ' + '<div class="col-md-12"> ' +
        '<form class="form-horizontal"> ' + '<div class="form-group"> ' +
        '<div class="col-md-12"> ' +
        '<textarea cols="100%" rows="30" class="form-control input-md">연재약관</textarea> ' +
        '</div> ' +
        '</div> ' + '<div class="form-group"> ' +
        '<div class="col-md-12"> <div class="text-center"> ' +
        '<label class="form-radio form-icon demo-modal-radio form-text active"><input type="radio" autocomplete="off" name="awesomeness" value="1" checked> 동의합니다.</label>' +
        '<label class="form-radio form-icon demo-modal-radio form-text"><input type="radio" autocomplete="off" name="awesomeness" value="0"> 동의하지 않습니다.</label> </div>' +
        '</div> </div>' + '</form> </div> </div><script></script>',
        buttons: {
            success: {
                label: "저장",
                className: "btn-purple",
                callback: function () {
                    var name = $('#name').val();
                    var answer = $("input[name='awesomeness']:checked").val();

                    var formData = {name: name, author_agreement: answer};
                    $.ajax({
                        type: 'PUT',
                        url: '/users/update_agreement',
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': window.Laravel.csrfToken
                        },
                        dataType: 'json',
                        success: function (data2) {

                        },
                        error: function (data2) {
                            console.log(data2);
                        }
                    });


                    $.niftyNoty({
                        type: 'purple',
                        icon: 'fa fa-check',
                        message: "연재약관에 동의 하셨습니다.",
                        //container : 'floating',
                        container: 'page',
                        timer: 4000
                    });
                }
            }
        }
    });
    $("input[name='awesomeness']").on('click', function () {

        var ans = $("input[name='awesomeness']:checked").val();
        if (ans == 0) {
            console.log(ans);
            $(".btn-purple").attr("disabled", true);
        } else {
            $(".btn-purple").attr("disabled", false);
        }

    });
};

//$(".demo-modal-radio").niftyCheck();
var nonFreeAgreement = function (id) {
    bootbox.dialog({
        title: "유료연재약관",
        message: '<div class="row"> ' + '<div class="col-md-12"> ' +
        '<form class="form-horizontal"> ' + '<div class="form-group"> ' +
        '<div class="col-md-12"> ' +
        '<textarea cols="100%" rows="30" class="form-control input-md">연재약관</textarea> ' +
        '</div> ' +
        '</div> ' + '<div class="form-group"> ' +
        '<div class="col-md-12"> <div class="text-center"> ' +
        '<label class="form-radio form-icon demo-modal-radio form-text active"><input type="radio" autocomplete="off" name="awesomeness" id="" value="1" checked> 동의합니다.</label>' +
        '<label class="form-radio form-icon demo-modal-radio form-text "><input type="radio" autocomplete="off" name="awesomeness" value="0"> 동의하지 않습니다.</label> </div>' +
        '</div> </div>' + '</form> </div> </div><script></script>',
        buttons: {

            success: {
                label: "저장",
                className: "btn-purple",
                callback: function () {
                    var name = $('#name').val();
                    var answer = $("input[name='awesomeness']:checked").val();

                    var formData = {non_free_agreement: answer};
                    $.ajax({
                        type: 'PUT',
                        url: '/novels/update_agreement/' + id,
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': window.Laravel.csrfToken
                        },
                        dataType: 'json',
                        success: function (data) {
                            location.reload();

                        },
                        error: function (data) {
                            console.log(data);
                        }
                    });

                    $.niftyNoty({
                        type: 'purple',
                        icon: 'fa fa-check',
                        message: "유료연재약관에 동의 하셨습니다.",
                        //container : 'floating',
                        container: 'page',
                        timer: 4000
                    });
                }
            }
        }
    });

    $("awesomeness").niftyCheck();
    $("input[name='awesomeness']").on('click', function () {

        var ans = $("input[name='awesomeness']:checked").val();
        if (ans == 0) {
            console.log(ans);
            $(".btn-purple").attr("disabled", true);
        } else {
            $(".btn-purple").attr("disabled", false);
        }

    });
};

var commonAlertBox = function (str) {
    var alert_message;
    if (str == "comment") {
        alert_message = "<p style='text-align: center;font-weight: 600;font-size: 16px;margin-top: 4%;'>댓글이 없습니다</p>";
    } else if (str == "review") {
        alert_message = "<p style='text-align: center;font-weight: 600;font-size: 16px;margin-top: 4%;'>리뷰가 없습니다</p>";
    }

    bootbox.alert(alert_message, function () {
        /* $.niftyNoty({
         type: 'info',
         icon: 'fa fa-info',
         message: 'Thank you',
         container: 'floating',
         timer: 3000
         });*/
    });
};


var faqUpdate = function (faq) {

    bootbox.dialog({
        title: "유료연재약관",
        message: '<div class="row"> ' + '<div class="col-md-12"> ' +
        '<form class="form-horizontal" id="faq_edit" > ' + '<div class="form-group"> ' +
        '<label class="col-md-12 control-label" for="faq_category">자주 묻는 질문 범주</label> ' +
        '<div class="col-md-12" > ' +
        '<select  id="faq_category" name="faq_category" class="form-control input-md"  style="height:30px" >' +
        '<option value="">범주선택</option>' +
        '<option value="1">독자 </option>' +
        '<option value="2">작가 </option>' +
        '<option value="3">기타 </option>' + '</select> ' +
        '</div> ' +
        '</div> ' + '<div class="form-group"> ' +
        '<label class="col-md-12 control-label" for="title">작품제목</label> ' +
        '<div class="col-md-12"  > ' +
        '<input value="' + faq.title + '" id="title" name="title" type="text" placeholder="필명을 입력해주세요." class="form-control" style="height:30px"> ' +
        '</div> ' +
        '</div> ' + '<div class="form-group"> ' +
        '<label class="col-md-12 control-label" for="description">작품소개</label> ' +
        '<div class="col-md-12" > ' +
        '<textarea  rows="20" id="description" name="description" class="form-control input-md" >' + faq.description + '</textarea> ' +
        '</div> ' +
        '</div> ' + '</form> </div> </div>',
        buttons: {

            success: {
                label: "저장",
                className: "btn-purple",
                callback: function () {
                    var formData = $('#faq_edit').serializeArray();
                    $.ajax({
                        type: 'PUT',
                        url: '/faqs/' + faq.id,
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': window.Laravel.csrfToken
                        },
                        dataType: 'json',
                        success: function (data) {
                            location.reload();

                            $.niftyNoty({
                                type: 'purple',
                                icon: 'fa fa-check',
                                message: "유료연재약관에 동의 하셨습니다.",
                                //container : 'floating',
                                container: 'page',
                                timer: 4000
                            });

                        },
                        error: function (data) {
                            console.log(data);
                        }
                    });

                }
            }
        }
    });

    if (faq.faq_category == 1) {

        $("#faq_category").find("option[value=" + 1 + "]").attr("selected", true);
    }
    else if (faq.faq_category == 2) {
        $("#faq_category").find("option[value=" + 2 + "]").attr("selected", true);
    } else {
        $("#faq_category").find("option[value=" + 3 + "]").attr("selected", true);
    }

};

var keywordEdit = function (keyword) {

    bootbox.dialog({
        title: "키워드",
        message: '<div class="row"> ' + '<div class="col-md-12"> ' +
        '<form class="form-horizontal" id="keyword_edit" > ' + '<div class="form-group"> ' +
        '<label class="col-md-12 control-label" for="faq_category">자주 묻는 질문 범주</label> ' +
        '<div class="col-md-12" > ' +
        '<select  id="category" name="category" class="form-control input-md"  style="height:30px" >' +
        '<option value="">범주선택</option>' +
        '<option value="1">장르 </option>' +
        '<option value="2">배경 </option>' +
        '<option value="3">소재 </option>' +
        '<option value="4">관계 </option>' +
        '<option value="5">남주인공 </option>' +
        '<option value="6">여주인공 </option>' +
        '<option value="7">분위기/기타 </option>' + '</select> ' +
        '</div> ' +
        '</div> ' + '<div class="form-group"> ' +
        '<label class="col-md-12 control-label" for="title">작품제목</label> ' +
        '<div class="col-md-12"  > ' +
        '<input value="' + keyword.name + '" id="name" name="name" type="text" placeholder="필명을 입력해주세요." class="form-control" style="height:30px"> ' +
        '</div> ' +
        '</div> ' +'</form> </div> </div>',
        buttons: {

            success: {
                label: "저장",
                className: "btn-purple",
                callback: function () {
                    var formData = $('#keyword_edit').serializeArray();
                    $.ajax({
                        type: 'PUT',
                        url: '/keywords/' + keyword.id,
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': window.Laravel.csrfToken
                        },
                        dataType: 'json',
                        success: function (data) {
                            location.reload();

                            $.niftyNoty({
                                type: 'purple',
                                icon: 'fa fa-check',
                                message: "유료연재약관에 동의 하셨습니다.",
                                //container : 'floating',
                                container: 'page',
                                timer: 4000
                            });

                        },
                        error: function (data) {
                            console.log(data);
                        }
                    });

                }
            }
        }
    });

    if (keyword.category == 1) {
        $("#category").find("option[value=" + 1 + "]").attr("selected", true);
    }
    else if (keyword.category == 2) {
        $("#category").find("option[value=" + 2 + "]").attr("selected", true);
    } else if (keyword.category == 3)  {
        $("#category").find("option[value=" + 3 + "]").attr("selected", true);
    } else if (keyword.category == 4) {
        $("#category").find("option[value=" + 4 + "]").attr("selected", true);
    } else if (keyword.category == 5)  {
        $("#category").find("option[value=" + 5 + "]").attr("selected", true);
    } else if (keyword.category == 6) {
        $("#category").find("option[value=" + 6 + "]").attr("selected", true);
    } else  {
        $("#category").find("option[value=" + 7 + "]").attr("selected", true);
    }

};