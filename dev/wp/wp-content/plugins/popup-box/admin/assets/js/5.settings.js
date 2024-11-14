'use strict';

jQuery(document).ready(function ($) {

    const selectors = {
        settings: '.wpie-settings__main',
        color_picker: '.wpie-color',
        checkbox: '.wpie-field input[type="checkbox"]',
        full_editor: '.wpie-fulleditor',
        item_heading: '.wpie-item .wpie-item_heading',
        location: '[data-field="location"]',
        overlay: '[data-field="overlay_checkbox"]',
        shadow: '[data-field="shadow_checkbox"]',
        border_style: '[data-field="border_style"]',
        close: '[data-field="close"]',
        mobile_checkbox: '[data-field="mobile_checkbox"]',
        triggers: '[data-field="triggers"]',
        close_redirect_checkbox: '[data-field="close_redirect_checkbox"]',
        video_support: '[data-field="video_support"]',
        language: '[data-field="language"]',
        tracking_open: '[data-field="enable_tracking_open"]',
        tracking_close: '[data-field="enable_tracking_close"]',
        width_unit: '[data-field="width_unit"]',
        height_unit: '[data-field="height_unit"]',
    };


    function set_up() {
        $(selectors.full_editor).wowFullEditor();

        $(selectors.color_picker).wpColorPicker();

        $(selectors.checkbox).each(set_checkbox);
        $(selectors.location).each(location);
        $(selectors.overlay).each(overlay);
        $(selectors.shadow).each(shadow);
        $(selectors.border_style).each(border_style);
        $(selectors.mobile_checkbox).each(mobile_checkbox);
        $(selectors.triggers).each(triggers);
        $(selectors.close_redirect_checkbox).each(close_redirect_checkbox);
        $(selectors.video_support).each(video_support);
        $(selectors.close).each(close_type);
        $(selectors.language).each(language);
        $(selectors.tracking_open).each(tracking);
        $(selectors.tracking_close).each(tracking);
        $(selectors.width_unit).each(size_unit);
        $(selectors.height_unit).each(size_unit);
    }

    function initialize_events() {
        $(selectors.settings).on('change', selectors.checkbox, set_checkbox);
        $(selectors.settings).on('change', selectors.location, location);
        $(selectors.settings).on('change', selectors.overlay, overlay);
        $(selectors.settings).on('change', selectors.shadow, shadow);
        $(selectors.settings).on('change', selectors.border_style, border_style);
        $(selectors.settings).on('change', selectors.mobile_checkbox, mobile_checkbox);
        $(selectors.settings).on('click', selectors.item_heading, item_toggle);
        $(selectors.settings).on('change', selectors.triggers, triggers);
        $(selectors.settings).on('change', selectors.close_redirect_checkbox, close_redirect_checkbox);
        $(selectors.settings).on('change', selectors.video_support, video_support);
        $(selectors.settings).on('change', selectors.close, close_type);
        $(selectors.settings).on('change', selectors.language, language);
        $(selectors.settings).on('change', selectors.tracking_open, tracking);
        $(selectors.settings).on('change', selectors.tracking_close, tracking);
        $(selectors.settings).on('change', selectors.width_unit, size_unit);
        $(selectors.settings).on('change', selectors.height_unit, size_unit);
    }

    function initialize() {
        set_up();
        initialize_events();
    }

    // Set the checkboxes
    function set_checkbox() {
        const next = $(this).next('input[type="hidden"]');
        if ($(this).is(':checked')) {
            next.val('1');
        } else {
            next.val('0');
        }
    }

    function close_type() {


        const type = $(this).val();
        const close_text = $('[data-field-box="close_text"]');
        const close_background = $('[data-field-box="close_background"]');
        close_text.removeClass('is-hidden');
        close_background.removeClass('is-hidden');
        if(type === '-icon') {
            close_text.addClass('is-hidden');
            close_background.addClass('is-hidden');
        }

        if(type === '-tag') {
            close_text.addClass('is-hidden');
        }


    }
    function location() {
        const type = $(this).val().replace('-','');
        const parent = get_parent_fields($(this));
        const box = get_field_box($(this));
        const fields = parent.find('[data-field-box]').not(box);
        fields.addClass('is-hidden');
        const typeFieldMapping = {
            topCenter: ['top'],
            bottomCenter: ['bottom'],
            left: ['left'],
            topLeft: ['top', 'left'],
            bottomLeft: ['bottom', 'left'],
            right: ['right'],
            topRight: ['top', 'right'],
            bottomRight: ['bottom', 'right'],
            center: [],
        }
        if (typeFieldMapping[type]) {
            const fieldsToShow = typeFieldMapping[type];
            fieldsToShow.forEach(field => {
                parent.find(`[data-field-box="${field}"]`).removeClass('is-hidden');
            });
        }
    }

    function overlay() {
        const parent = get_parent_fields($(this));
        const fields = parent.find('.wp-picker-container, [data-field-box="overlay_animation"]');
        fields.addClass('is-hidden');
        if($(this).is(':checked')) {
            fields.removeClass('is-hidden');
        }
    }

    function shadow() {
        const field = $('[data-field-box="shadow_color"]');
        field.addClass('is-hidden');
        if($(this).is(':checked')) {
            field.removeClass('is-hidden');
        }
    }

    function close_redirect_checkbox() {
        const field = $('[data-field-box="close_redirect_target"]');
        field.addClass('is-hidden');
        if($(this).is(':checked')) {
            field.removeClass('is-hidden');
        }
    }

    function video_support() {
        const parent = get_parent_fields($(this));
        const box = get_field_box($(this));
        const fields = parent.find('[data-field-box]').not(box);
        fields.addClass('is-hidden');
        if($(this).is(':checked')) {
            fields.removeClass('is-hidden');
        }
    }

    function border_style() {
        const parent = get_parent_fields($(this));
        const box = get_field_box($(this));
        const type = $(this).val();
        const fields = parent.find('[data-field-box]').not(box);
        fields.addClass('is-hidden');
        if(type !== 'none') {
            fields.removeClass('is-hidden');
        }
    }

    function close_checkbox() {
        const parent = get_parent_fields($(this), '.wpie-fieldset');
        const box = get_field_box($(this));
        const fields = parent.find('[data-field-box]').not(box);
        fields.addClass('is-hidden');
        if($(this).is(':checked')) {
            fields.removeClass('is-hidden');
            $(selectors.close).each(close_type);
        }
    }

    function mobile_checkbox() {
        const field = $('[data-field-box="mobile_width"]');
        field.addClass('is-hidden');
        if($(this).is(':checked')) {
            field.removeClass('is-hidden');
        }
    }

    function triggers() {
        const parent = get_parent_fields($(this));
        const box = get_field_box($(this));
        const type = $(this).val();
        const fields = parent.find('[data-field-box]').not(box);
        const text = $('.wpie-trigger-click');
        fields.addClass('is-hidden');
        text.addClass('is-hidden');
        if(type === 'auto') {
            parent.find('[data-field-box="delay"]').removeClass('is-hidden');
        }
        if(type === 'click' || type === 'hover') {
            text.removeClass('is-hidden');
        }
        if(type === 'scrolled') {
            parent.find('[data-field-box="distance"]').removeClass('is-hidden');
        }
        if(type === 'loop') {
            parent.find('[data-field-box="loop_start"], [data-field-box="loop_end"], [data-field-box="loop_counter"]').removeClass('is-hidden');
        }
    }

    function language() {
        const type = $(this).val();
        const locale = $('[data-field-box="locale"]');
        locale.addClass('is-hidden');
        if(type === 'custom') {
            locale.removeClass('is-hidden');
        }
    }

    function tracking(){
        const parent = get_parent_fields($(this));
        const box = get_field_box($(this));
        const fields = parent.find('[data-field-box]').not(box);
        fields.addClass('is-hidden');
        if ($(this).is(':checked')) {
            fields.removeClass('is-hidden');
        }
    }

    function item_toggle() {
        const parent = get_parent_fields($(this), '.wpie-item');
        const val = $(parent).attr('open') ? '0' : '1';
        $(parent).find('.wpie-item__toggle').val(val);
    }

    function size_unit() {
        const val = $(this).val();
        const parent = get_field_box($(this));
        const field = $(parent).find('input');
        if (val === 'auto') {
            $(field).attr('readonly', 'readonly');
            $(field).addClass('is-blur');
        } else {
            $(field).removeAttr('readonly');
            $(field).removeClass('is-blur');
        }
    }

    function get_parent_fields($el, $class = '.wpie-fields') {
        return $el.closest($class);
    }

    function get_field_box($el, $class = '.wpie-field') {
        return $el.closest($class);
    }

    initialize();
});