/*jslint vars: true*/
/*global $, alert, console*/
$(document).ready(function () {
    "use strict";
    var count_notifs = 0,
        url_post = "http://localhost/jami3aty/posts/get/";

    function createNotifMoldView() {
        var notifHTML = '<div class="notif_mold">' +
            '<div class="left">' +
            '<a href="#" class="header">' +
            '<div class="icon"><i class="fa fa-bell fa-3x"></i></div>' +
            '<div class="info">' +
            '<div class="title">' +
            '<span id="prof_name_view"></span> à publier ' +
            '<span id="type_post_view"></span></div>' +
            '<div class="description">' +
            '<h4></h4><span class="separitor"> . </span>' +
            '<span class="time"></span></div></div></a></div></div>';
        return notifHTML;
    }

    // get data with ajax when notif clicked
    function getNotif() {
        var notif_layout = $("#notif-view"),
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
                console.log(response.data);
                for (count_notifs; count_notifs < notifs_length; count_notifs += 1) {
                    notif_layout.children(".loader").before(createNotifMoldView());
                    notif_layout.children(".notif_mold").last()
                        .find("a.header").attr("href", url_post + response.data[count_notifs]._id_post);
                    notif_layout.children(".notif_mold").last()
                        .find(".title #prof_name_view").html(response.data[count_notifs].fullName);
                    notif_layout.children(".notif_mold").last()
                        .find(".title #type_post_view").html(response.data[count_notifs].type_parsed);
                    notif_layout.children(".notif_mold").last()
                        .find(".description h4").html(response.data[count_notifs].title);
                    notif_layout.children(".notif_mold").last()
                        .find(".description .time").html(response.data[count_notifs].date_parsed);
                    if (response.data[count_notifs].seen == 0) {
                        notif_layout.children(".notif_mold").last().addClass("not-seen");
                    }
                }
                notif_layout.children(".loader").hide();
            }
        });
    }
    getNotif();
});
