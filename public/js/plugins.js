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

});
