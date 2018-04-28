/*jslint vars: true*/
/*global $, alert, console*/
$(document).ready(function () {
    "use strict";
    var count_notif = 0,
        count_mails = 0,
        max_mails = 7,
        max_notf = 7,
        url_post = "http://localhost/jami3aty/posts/get/",
        url_mail = "http://localhost/jami3aty/mails/id/",
        isProf = $(".isProf").length > 0 ? true : false;

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

    function createMailMold() {
        var mailfHTML = '<li class="mail_mold">' +
            '<a href="#" class="header">' +
            '<div class="icon"><i class="fa fa-arrow-circle-up fa-2x"></i></div>' +
            '<div class="info">' +
            '<div class="title"><b id="message_to">Dr. Aid Lahcen</b></div>' +
            '<div class="subject">' +
            '<h4 class="reset-margin">Developing Android Apps</h4>' +
            '<span class="separitor"> . </span><span class="time">Thursday 19:03</span>' +
            '</div></div></a></li>';
        return mailfHTML;
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
                max_notf = response.data.length <= max_notf ? response.data.length : max_notf ;
                for (count_notif; count_notif < max_notf; count_notif += 1) {
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
        var status = null,
            mySave = $(this);
        $.ajax({
            url: "http://localhost/jami3aty/saved/state",
            type: "post",
            data: {
                "action": 1,
                "id_post": $(this).parents(".publication_mold").attr('data-target'),
                "ajax": true
            },
            dataType: "json",
            success: function (data) {
                status = data.status;
            }
        }).done(function () {
            if (status == 200) {
                mySave.children("i").removeClass("fa-bookmark");
                mySave.children("i").addClass("fa-check");
                mySave.removeClass("save-post");
            }
        });
    });

    // get mails whene btn message clicked
    $("#mails-nav-btn").click(function () {
        var mails_list = $("#mails-nav-list"),
            mails_length,
            message_to,
            sender_arrow = 'fa-arrow-circle-up';
        $.ajax({
            url: "http://localhost/jami3aty/mails/all",
            type: "post",
            data: {
                ajax: true
            },
            dataType: "json",
            success: function (response) {
                max_mails = response.data.length <= max_mails ? response.data.length : max_mails;
                console.log(response);
                
                for (count_mails; count_mails < max_mails; count_mails += 1) {
                    if (isProf) {
                        message_to = response.data[count_mails].fullNameS;
                        if (response.data[count_mails].sender == 0) {
                            sender_arrow = 'fa-arrow-circle-down';
                        } else {
                            sender_arrow = 'fa-arrow-circle-up';
                        }
                    } else {
                        message_to = response.data[count_mails].fullNameP;
                        if (response.data[count_mails].sender == 0) {
                            sender_arrow = 'fa-arrow-circle-up';
                        } else {
                            sender_arrow = 'fa-arrow-circle-down';
                        }
                    }
                    mails_list.children(".loader").before(createMailMold());
                    mails_list.children("li").eq(count_mails).find("#message_to").html(message_to);
                    mails_list.children("li").eq(count_mails).find(".subject")
                        .children('h4').html(response.data[count_mails].subject);
                    mails_list.children("li").eq(count_mails).find(".subject")
                        .children('.time').html(response.data[count_mails].date_parsed);
                    mails_list.children("li").eq(count_mails).find(".icon")
                        .children('.fa').removeAttr("class");
                    mails_list.children("li").eq(count_mails).find(".icon")
                        .children('i').addClass('fa ' + sender_arrow + ' fa-2x');
                    mails_list.children("li").eq(count_mails).children("a")
                        .attr("href", url_mail + response.data[count_mails]._id_mail);
                }
                mails_list.children(".loader").hide();
            }
        });
    });

});
