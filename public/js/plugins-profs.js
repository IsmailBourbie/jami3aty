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
                    levelSelect.append('<option value="' + data[i]._id_subject + '">' +
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
        if ($(this).find('#add-post form .data').css("display") !== "none") {
            $(this).find('#add-post form .data').slideUp();
            $(this).find('#add-post form .footer').slideUp();
            $(this).find('#add-post form').removeClass('infocus');
        }
    });
    levelSelect.change(function () {
        var levelIndex = this.selectedIndex - 1,
            i = 0,
            sectionVal,
            sectionElem = data[levelIndex].section,
            sectionName = Object.keys(sectionElem);
        sectionSelect.empty().append('<option disabled selected hidden="hidden">Section</option>');
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
});
