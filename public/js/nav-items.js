/*jslint vars: true*/
/*global $, alert, console*/
$(document).ready(function () {
    "use strict";
    var count_notif = 0;

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

    function typeOfPostToString(type) {
        type = Number(type);
        switch (type) {
            case 1:
                return 'Consultation';
            case 2:
                return 'Affichage';
            case 3:
                return "Notes";
            default:
                return "Affichage";

        }

    }
    // get data with ajax when notif clicked
    $("#notif-btn").click(function () {
        var notif_list = $("#notif-list"),
            notifs_length;
        $.ajax({
            url: "http://localhost/jami3aty/notifications/all",
            type: "post",
            data: {
                '_id_student': 10101012,
                ajax: "hello"
            },
            dataType: "json",
            success: function (response) {
                notifs_length = response.data.length;
                for (count_notif; count_notif < notifs_length; count_notif += 1) {
                    notif_list.append(createNotifMold());
                    notif_list.children("li")
                        .eq(count_notif).find("#prof_name")
                        .html(response.data[count_notif].fullName);
                    notif_list.children("li")
                        .eq(count_notif).find("#type_post")
                        .html(typeOfPostToString(response.data[count_notif].type));
                    notif_list.children("li")
                        .eq(count_notif).find("h4")
                        .html(response.data[count_notif].title);
                    notif_list.children("li")
                        .eq(count_notif).find(".time")
                        .html(response.data[count_notif].date_parsed);
                }
            }
        });
    });
});
