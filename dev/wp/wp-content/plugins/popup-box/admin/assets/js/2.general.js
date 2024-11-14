'use strict'

jQuery(document).ready(function($) {


    $(document).on('keydown', function(event) {
        if ((event.key === 's' || event.key === 'S') && (event.metaKey || event.ctrlKey)) {
            event.preventDefault();
            const button = document.getElementById('submit_settings');
            button.click();
        }
    });



    $('.wpie-tabs').on('click', '.wpie-tab-label', function() {
        $('.wpie-tabs .wpie-tab-label').removeClass('selected');
        $(this).addClass('selected');
    });

    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('notice')) {
        const notice = $('.wpie-notice');
        $(notice).addClass('is-active');
        setTimeout(function (){
            $(notice).removeClass('is-active');
        }, 5000);
    }

    $('.wpie-link-delete, .delete a').on('click', function (e){
        const proceed = confirm("Are you sure want to Delete Menu?");
        if(!proceed) {
            e.preventDefault();
        }
    });

});