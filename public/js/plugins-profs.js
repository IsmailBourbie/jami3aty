/*global $, jquery, alert, console*/
$(document).ready(function () {
    'use strict';
    var site_host = 'http://' + location.host + "/jami3aty/",
        user_id = Number($('#_user_id').text()),
        i = 0,
        levelSelect = $('select.level'),
        sectionSelect = $('select.section'),
        groupSelect = $('select.group'),
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
                var destination = {};
                data = response.data;
                console.log(data);
                for (i; i < data.length; i += 1) {
                    levelSelect.append('<option value="' + data[i].level + '">' +
                        data[i].title + '</option>');
                }
            }
        });
    }
    $('.text-pub textarea').focus(function () {
        $(this).parent().siblings().slideDown();
        getDataProf();
    });
    $("html").click(function (e) {
        if ($(e.target).closest('#add-post').length) {
            return;
        }
        if ($(this).find('#add-post form .data').css("display") !== "none") {
            $(this).find('#add-post form .data').slideUp();
            $(this).find('#add-post form .footer').slideUp();
        }
    });
    levelSelect.change(function () {
        var levelIndex = this.selectedIndex - 1,
            i = 0,
            sectionVal,
            sectionElem = data[levelIndex].section,
            sectionName = Object.keys(sectionElem);
        sectionSelect.empty().append('<option disabled selected hidden="hidden">Section</option>');
        $(this).siblings("input").val(data[levelIndex]._id_subject);
        sectionSelect.removeAttr('disabled');
        for (i; i < sectionName.length; i += 1) {
            sectionVal = sectionName[i] == "0" ? "Promo" : 'Section ' + sectionName[i];
            sectionSelect.append('<option value="' + sectionName[i] + '">' + sectionVal + '</option>');
        }
    });
    sectionSelect.change(function () {
        var sectionIndex = Number(this.value, 10),
            levelIndex = levelSelect[0].selectedIndex - 1,
            i = 0,
            groupElem = data[levelIndex].section[sectionIndex];
        groupSelect.empty().append('<option disabled selected hidden="hidden">Group</option>');
        groupSelect.removeAttr('disabled');
        for (i; i < groupElem.length; i += 1) {
            groupSelect.append('<option value="' + groupElem[i] + '">Group ' + groupElem[i] + '</option>');
        }

    });

    // validate Form

    $('form.add').submit(function (e) {
        var select = $('select'),
            textarea = $(this).find('textarea'),
            i = 0;
        if (textarea.val().trim() == 0) {
            e.preventDefault();
            textarea.parent().css("border-color", "#d91f2d");
            textarea.focus();
            return;
        }
        for (i; i < select.length; i += 1) {
            if (select.eq(i).val() == null) {
                e.preventDefault();
                select.eq(i).css("background", "#d91f2d");
                select.eq(i).focus();
                return;
            }
        }
    });


    // make style in chagne select
    $('select').change(function () {
        $(this).css("background", "#46bfbe");
    });
    
    $('.add textarea').blur(function () {
       $(this).parent().css('border-color', "#ccc");
    });





});
