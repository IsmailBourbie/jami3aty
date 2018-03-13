/*jslint vars: true*/
/*global $, alert, console*/
$(document).ready(function () {
    'use strict';
    var pathname = location.pathname.replace("/jami3aty/", "");
    pathname = pathname.replace('/', "");
    /* add active class for styling start */
    if (pathname.length > 0) {
        if ($(".my_data .well li#" + pathname).length != 0) {
            $(".my_data .well li#" + pathname).addClass("avtive-navigation");
        }
    } else {
        $(".my_data .well li#home").addClass("avtive-navigation");
    }
    /* add active class for styling start */

    /* Hide ma joutnée et le meun on resize start */
    (function () {
        var menu_bar = $('.aside-left .collapse'),
            ma_journee = $('.aside-right .collapse');
        if (window.innerWidth <= 1200) {
            ma_journee.removeClass('in');
            menu_bar.removeClass('in');
        }
        $(window).resize(function () {
            if (window.innerWidth <= 1200) {
                ma_journee.removeClass('in');
                menu_bar.removeClass('in');
            } else {
                ma_journee.addClass('in');
                menu_bar.addClass('in');
            }
            console.log("h");
        });
    }());
    /* Hide ma joutnée and meun on resize end */

});
