/*jslint vars: true*/
/*global $, alert, console*/
$(document).ready(function () {
    'use strict';
    var title = document.title.toLowerCase();
    /* add active class for styling start */
    if (title.length > 0) {
        $(".my_data .well li#" + title).addClass("active-navigation");
    }
    /* add active class for styling start */

    /* Hide ma journée et le menu on resize start */
    (function () {
        var ma_journee = $('.aside-right .collapse');
        if (window.innerWidth <= 1200) {
            ma_journee.removeClass('in');
        }
        $(window).resize(function () {
            if (window.innerWidth <= 1200) {
                ma_journee.removeClass('in');
            } else {
                ma_journee.addClass('in');
            }
        });
    }());
    /* Hide ma joutnée and meun on resize end */

    /* responsive navbar-left start */
    $('#show-menubar').click(function () {
        if (window.innerWidth <= 992) {
            $('#menubar').toggleClass('show-menubar');
            $('.navbar-fixed-top').toggleClass('animate-navbar');
            $('.main, .list_items, .search_container').fadeToggle(0);
        }
    });
    /* responsive navbar-left end */
    /* Auto size textarea start */
    $('textarea.autosize').each(function () {
        $(this).attr('style', 'height:' + (this.scrollHeight - 10) + 'px;');
    }).on('input', function () {
        this.style.height = "auto";
        this.style.height = (this.scrollHeight - 10) + "px";

    });

    /* Auto size textarea end */
    // chagne style of select tag 
    $('select').change(function () {
        $(this).css('color', '#22313F');
        $(this).parents('.modal').find('#send-message-btn').fadeIn();
    });
    
    // filteration of Messages
    $("#all-message").click(function(){
        $('.icon_send').parent().show();
    });
    $("#sent-message").click(function(){
        $('.icon_send .fa-arrow-circle-down').parents("tr").hide();
        $('.icon_send .fa-arrow-circle-up').parents("tr").show();
    });
    $("#received-message").click(function(){
        $('.icon_send .fa-arrow-circle-down').parents("tr").show();
        $('.icon_send .fa-arrow-circle-up').parents("tr").hide();
    });
});
