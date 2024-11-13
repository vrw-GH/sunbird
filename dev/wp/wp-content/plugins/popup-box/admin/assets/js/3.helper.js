'use strict'

jQuery(document).ready(function ($) {

    $.fn.wowFullEditor = function () {
        this.each(function (index, element) {
            const newId = 'wpie-fulleditor-' + (index + 1);
            $(element).attr('id', newId);
            $(element).css({'border': 'none', 'width': '100%'});
            wp.editor.initialize(
                newId,
                {
                    tinymce: {
                        wpautop: false,
                        plugins: 'lists wplink hr charmap textcolor colorpicker paste tabfocus wordpress wpautoresize wpeditimage wpemoji wpgallery wplink wptextpattern',
                        toolbar1: 'shortcodes | bold italic underline subscript superscript blockquote | bullist numlist | alignleft aligncenter alignright alignjustify | link unlink | wp_adv',
                        toolbar2: 'strikethrough hr | forecolor backcolor | pastetext removeformat charmap | outdent indent | undo redo wp_help ',
                        toolbar3: 'formatselect fontselect fontsizeselect ',
                        setup: function (editor) {
                            editor.addButton('shortcodes', {
                                icon: 'mce-ico dashicons-before dashicons-shortcode',
                                onclick: function () {
                                    var width = $(window).width();
                                    var H = $(window).height();
                                    var W = (720 < width) ? 720 : width;
                                    W = W - 80;
                                    H = H - 120;

                                    // Open the Thickbox
                                    tb_show('Popup Box Shortcodes', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=popupShortcode');
                                    $("#TB_window").addClass("popup-box-shortcodes");
                                }
                            });
                        }
                    },
                    quicktags: {
                        buttons: "strong,em,link,block,del,ins,img,ul,ol,li,code,more,close",
                    },
                    mediaButtons: true,
                }
            );
        });
    };

    $.fn.wowTextEditor = function () {
        this.each(function (index, element) {
            const newId = 'wpie-shorteditor-' + (index + 1);
            $(element).attr('id', newId);
            $(element).css({'border-top': 'none', 'min-height': '2'});

            wp.editor.initialize(newId, {
                tinymce: false, // This disables Visual mode
                quicktags: {
                    buttons: "strong,em,link,block,del,ins,img,ul,ol,li,code,more,close,fullscreen"
                },
                mediaButtons: false,
            });
        });
    };

    $.fn.wowIconPicker = function () {
        this.fontIconPicker({
            theme: 'fip-darkgrey',
            emptyIcon: false,
            allCategoryText: 'Show all',
        });
    };


});

