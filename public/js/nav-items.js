/*jslint vars: true*/
/*global $, alert, console*/
$(document).ready(function () {
    "use strict";
    var count_notif = 0,
        url_post = "http://localhost/jami3aty/posts/get/";

    function createNotifMold() {
        var notifHTML = '<li class="notif_mold">' +
            '<a href="#" class="header">' +
            '<div class="icon">' +
            '<i class="fa fa-bell fa-2x"></i>' +
            '</div>' +
            '<div class="info">' +
            '<div class="title">' +
            '<b id="prof_name">Dr. Chikhaoui Ahmed</b> à publier ' +
            '<b id="type_post">Constultation</b>' +
            '</div>' +
            '<div class="description">' +
            '<h4 class="reset-margin">Compilation' +
            '</h4>' +
            '<span class="separitor"> . </span>' +
            '<span class="time">1min</span>' +
            '</div>' +
            '</div>' +
            '</a>' +
            '</li>';
        return notifHTML;
    }

    // get data with ajax when notif clicked
    $("#notif-btn").click(function () {
        var notif_list = $("#notif-list"),
            notifs_length;
        $.ajax({
            url: "http://localhost/jami3aty/notifications/all",
            type: "post",
            data: {
                ajax: true
            },
            dataType: "json",
            success: function (response) {
                notifs_length = response.data.length;
                for (count_notif; count_notif < notifs_length; count_notif += 1) {
                    notif_list.children(".loader").before(createNotifMold());
                    notif_list.children("li")
                        .eq(count_notif).find("#prof_name")
                        .html(response.data[count_notif].fullName);
                    notif_list.children("li")
                        .eq(count_notif).find("#type_post")
                        .html(response.data[count_notif].type_parsed);
                    notif_list.children("li")
                        .eq(count_notif).find("h4")
                        .html(response.data[count_notif].title);
                    notif_list.children("li")
                        .eq(count_notif).find(".time")
                        .html(response.data[count_notif].date_parsed);
                    notif_list.children("li")
                        .eq(count_notif).find("a")
                        .attr("href", url_post + response.data[count_notif]._id_post);
                    if (response.data[count_notif].seen == 0) {
                        notif_list.children("li").eq(count_notif).addClass("not-seen");
                    }
                }
                notif_list.children(".loader").hide();
            }
        });
    });

    // set save with ajax
    $('#main-posts').on("click", ".save-post", function () {
        var status = null;
        $.ajax({
            url: "http://localhost/jami3aty/saved/state",
            type: "post",
            data: {
                "action": 1,
                "id_post": $(this).attr('data-target'),
                "ajax": true
            },
            async: false,
            dataType: "json",
            success: function (data) {
                status = data.status;
            }
        });
        if (status == 200) {
            $(this).children("i").removeClass("fa-bookmark");
            $(this).children("i").addClass("fa-check");
            $(this).removeClass("save-post");
        }
    });

});
