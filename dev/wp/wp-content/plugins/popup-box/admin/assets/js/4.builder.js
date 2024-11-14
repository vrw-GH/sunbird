'use strict';

jQuery(document).ready(function ($) {

    $.fn.wowPopupLiveBuilder = function () {
        const element = document.getElementById('ds-popup-preview');

        const selectors = {
            content: '[data-field="content"]',
            // overlay
            overlay_checkbox: '[data-field="overlay_checkbox"]',
            overlay: '[data-field="overlay"]',
            overlay_animation: '[data-field="overlay_animation"]',
            // Popup Css
            popup_animation: '[data-field="popup_animation"]',
            location: '[data-field="location"]',
            top: '[data-field="top"]',
            bottom: '[data-field="bottom"]',
            left: '[data-field="left"]',
            right: '[data-field="right"]',
            width: '[data-field="width"]',
            width_unit: '[data-field="width_unit"]',
            height: '[data-field="height"]',
            height_unit: '[data-field="height_unit"]',
            radius: '[data-field="radius"]',
            padding: '[data-field="padding"]',
            background: '[data-field="background"]',
            background_img_checkbox: '[data-field="background_img_checkbox"]',
            background_img: '[data-field="background_img"]',
            shadow_checkbox: '[data-field="shadow_checkbox"]',
            shadow: '[data-field="shadow"]',
            shadow_color: '[data-field="shadow_color"]',
            // Content CSS
            content_font: '[data-field="content_font"]',
            content_size: '[data-field="content_size"]',
            content_padding: '[data-field="content_padding"]',
            border_style: '[data-field="border_style"]',
            border_width: '[data-field="border_width"]',
            border_radius: '[data-field="border_radius"]',
            border_color: '[data-field="border_color"]',
            // Close button
            close_checkbox: '[data-field="close_checkbox"]',
            close: '[data-field="close"]',
            close_size: '[data-field="close_size"]',
            close_text: '[data-field="close_text"]',
            close_location: '[data-field="close_location"]',
            close_place: '[data-field="close_place"]',
            close_color: '[data-field="close_color"]',
            close_background: '[data-field="close_background"]',
            // Mobile
            mobile_checkbox: '[data-field="mobile_checkbox"]',
            mobile: '[data-field="mobile"]',
            mobile_width: '[data-field="mobile_width"]',
            mobile_width_unit: '[data-field="mobile_width_unit"]',
            block_page: '[data-field="block_page"]',
            // Video
            video_support: '[data-field="video_support"]',
            video_autoplay: '[data-field="video_autoplay"]',
            video_close: '[data-field="video_close"]',
        };


        $('.wpie-settings__main').on('click', '.wpie-preview-button', function (e) {
            e.preventDefault();
            destroy();

            let content;
            const editor = tinyMCE.get('wpie-fulleditor-1');
            if (editor && !editor.isHidden()) {
                content = editor.getContent();
            } else {
                content = $('#wpie-fulleditor-1').val();
            }

            const data = {
                action: 'popup_preview_content', // Replace with your desired action hook
                data: content,
                security_nonce: $('#popup_box_settings').val(),
            };
            $.post(ajaxurl, data, function(response) {
                if(response.success) {
                    $("#ds-popup-preview .ds-popup-content").html(response.data);
                    const options = getOptions();
                    new PopupBox('#ds-popup-preview', options, element);
                }
            });

        });

        function getOptions() {
            let def_options = {
                open_popup: 'auto',
                popup_zindex: 9999999,
                popup_esc: true,
            };

            if ($(selectors.block_page).is(':checked')) {
                def_options.block_page = true;
            }

            if ($(selectors.video_support).is(':checked')) {
                def_options.video_enable = true;
            }

            if (!($(selectors.video_autoplay).is(':checked'))) {
                def_options.video_autoPlay = false;
            }

            if (!($(selectors.video_close).is(':checked'))) {
                def_options.video_onClose = false;
            }


            let overlay = getOverlay();
            let popup_css = getPopupCss();
            let content_css = getContentCss();
            let close_css = getCloseCss();
            let mobile_css = getMobileCss();

            const options = Object.assign(def_options, overlay, popup_css, content_css, close_css, mobile_css);

            return options;
        }

        function getOverlay() {

            let options = {
                overlay_isVisible: true,
                overlay_animation: $(selectors.overlay_animation).val(),
                overlay_css: {
                    background: $(selectors.overlay).val()
                },
            }
            if (!($(selectors.overlay_checkbox).is(':checked'))) {
                options = {
                    overlay_isVisible: false
                }
            }
            return options;
        }

        function getPopupCss() {
            let location = $(selectors.location).val();
            let options = {
                popup_animation: $(selectors.popup_animation).val(),
                popup_position: location,
            };

            let css = {
                'padding': $(selectors.padding).val() + 'px',
                'border-radius': $(selectors.radius).val() + 'px',
            };

            // location
            let top = $(selectors.top).val();
            let bottom = $(selectors.bottom).val();
            let left = $(selectors.left).val();
            let right = $(selectors.right).val();

            switch (location) {
                case '-topCenter':
                    css['top'] = top + 'px';
                    break;
                case '-bottomCenter':
                    css['bottom'] = bottom + 'px';
                    break;
                case '-left':
                    css['left'] = left + 'px';
                    break;
                case '-right':
                    css['right'] = right + 'px';
                    break;
                case '-topLeft':
                    css['top'] = top + 'px';
                    css['left'] = left + 'px';
                    break;
                case '-bottomLeft':
                    css['bottom'] = bottom + 'px';
                    css['left'] = left + 'px';
                    break;
                case '-topRight':
                    css['top'] = top + 'px';
                    css['right'] = right + 'px';
                    break;
                case '-bottomRight':
                    css['bottom'] = bottom + 'px';
                    css['right'] = right + 'px';
                    break;
            }

            if ($(selectors.shadow_checkbox).prop('checked')) {
                css['box-shadow'] = '0 0 ' + $(selectors.shadow).val() + 'px ' + $(selectors.shadow_color).val();
            }

            css['background-color'] = $(selectors.background).val();
            if ($(selectors.background_img_checkbox).prop('checked')) {
                css['background-image'] = $(selectors.background_img).val();
                css['background-size'] = 'cover';
            }
            let width_unit = $(selectors.width_unit).val();
            let width = $(selectors.width).val();
            let height_unit = $(selectors.height_unit).val();
            let height = $(selectors.height).val();

            if (width_unit === 'auto') {
                css['width'] = 'auto';
            } else {
                css['width'] = width + width_unit;
            }

            if (height_unit === 'auto') {
                css['height'] = 'auto';
            } else {
                css['height'] = height + height_unit;
            }

            options.popup_css = css;

            return options;
        }

        function getContentCss() {
            let css = {
                'font-family': $(selectors.content_font).val(),
                'font-size': $(selectors.content_size).val() + 'px',
                'padding': $(selectors.content_padding).val() + 'px',
            };

            const border_style = $(selectors.border_style).val();
            const border_width = $(selectors.border_width).val() + 'px';
            const border_radius = $(selectors.border_radius).val() + 'px';
            const border_color = $(selectors.border_color).val();

            if (border_style !== 'none') {
                css['border-radius'] = border_radius;
                css['border'] = `${border_width} ${border_style} ${border_color}`;
            }

            return {
                content_css: css
            };
        }

        function getCloseCss() {
            let options = {
                close_position: $(selectors.close_location).val(),
                close_type: $(selectors.close).val(),
                close_content: $(selectors.close_text).val(),
            };

            if ($(selectors.close_place).val() === '-outer') {
                options.close_outer = true;
            }
            const close_size = $(selectors.close_size).val() + 'px';
            const close_color = $(selectors.close_color).val();
            const close_background = $(selectors.close_background).val();
            options.close_css = {
                'font-size': close_size,
                'color': close_color,
                'background': close_background,
            };

            return options;

        }

        function getMobileCss() {
            let options = {};

            if (!($(selectors.mobile_checkbox).is(':checked'))) {
                options.mobile_show = false;
                return options;
            }

            options.mobile_breakpoint = $(selectors.mobile).val() + 'px';
            options.mobile_css = {
                'width': $(selectors.mobile_width).val() + $(selectors.mobile_width_unit).val(),
            };
            return options;
        }

        function destroy() {
            const wrapper = element.querySelector('.ds-popup-wrapper');
            $(wrapper).removeClass().addClass('ds-popup-wrapper');

            const closeBtn = element.querySelector('.ds-popup-close');
            if (closeBtn) {
                closeBtn.remove();
            }
            const popupOverlay = element.querySelector('.ds-popup-overlay');
            if (popupOverlay) {
                popupOverlay.remove();
            }
        }


    };

    $($.fn).wowPopupLiveBuilder();
});