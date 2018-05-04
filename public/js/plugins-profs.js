/*global $, jquery, alert, console*/
$(document).ready(function () {
    'use strict';
    var site_host = 'http://' + location.host + "/jami3aty/",
        user_id = Number($('#_user_id').text()),
        i = 0,
        data;

    // get level, section and group with ajax
    function getDataProf() {
        $.ajax({
            url: site_host + "posts/profInfo",
            type: "post",
            data: {
                id_professor: user_id
            },
            dataType: "json",
            success: function (response) {
                data = response.data;
                for (i; i < data.length; i += 1) {
                    $('select.level').append('<option value="' + data[i]._id_subject + '">' +
                        data[i].title + '</option>');
                }
            }
        });
    }
    $('.text-pub textarea').focus(function () {
        $(this).parent().siblings().slideDown();
        $(this).parents("form").addClass('infocus');
        
        getDataProf();
    });
    $("html").click(function (e) {
        if ($(e.target).closest('#add-post').length) {
            return;
        }
        if($(this).find('#add-post form .data').css("display") !== "none") {
            $(this).find('#add-post form .data').slideUp();
            $(this).find('#add-post form .footer').slideUp();
            $(this).find('#add-post form').removeClass('infocus');
        }
    });
    $('select.level').change(function () {
        console.log(data);
    });
});
