/*jslint vars: true*/
/*global $, alert, console*/
$(document).ready(function () {
    "use strict";
    var site_host = 'http://' + location.host + "/jami3aty/",
        selectElement = $('#list-profs'),
        modalBody = $("#md-body"),
        user_id = Number($('#_user_id').text()),
        countProfs = 0,
        isProf = false;
    if ($('body').attr("data-type") == 0) {
        isProf = true;
    }

    function optionMold(value, text) {
        return '<option value="' + value + '">' + text + '</option>';
    }
    // get Profs Name and id
    $('.new_message .new_message_btn').click(function () {
        $.ajax({
            url: site_host + "mails/profs",
            type: "post",
            data: {
                ajax: true
            },
            dataType: "json",
            success: function (response) {
                var data = response.data;
                for (countProfs; countProfs < data.length; countProfs += 1) {
                    selectElement.append(optionMold(data[countProfs]._id_professor, data[countProfs].fullName));
                }

            }
        });
    });

    // send message 
    $('#send-message-btn').click(function () {
        var messageSubject = $('#subject-message'),
            messageText = $('#text-message'),
            profId = selectElement.val(),
            sender = isProf ? 1 : 0;
        // validate inputs
        if (!validateInputs(messageSubject, messageText)) {
            return false;

        }
        // send data with ajax
        modalBody.html("<div class='loader'></div>");
        $.ajax({
            url: site_host + "mails/insert",
            type: "post",
            data: {
                id_professor: profId,
                _id_student: user_id,
                message: messageText.val(),
                subject: messageSubject.val(),
                sender: sender,
                ajax: true
            },
            dataType: "json",
            success: function (response) {
                var status = response.status;
                modalBody.children().fadeOut(function () {
                    modalBody.html('<div class="alert-success">Message Envoyée</div>');
                    modalBody.siblings('.modal-footer').children().last().hide();
                });
            }
        });
    });

    // repley Message 
    $('#send-reply-btn').click(function () {
        var messageSubject = $('#subject-reply').text(),
            messageText = $('#text-reply-message'),
            profId = $('#id_prof').text(),
            sender = isProf ? 1 : 0;

        user_id = $('#id_std').text();
        // validate inputs
        if (!validateText(messageText)) {
            return false;
        }

        // send data with ajax
        modalBody.html("<div class='loader'></div>");
        $.ajax({
            url: site_host + "mails/insert",
            type: "post",
            data: {
                id_professor: profId,
                _id_student: user_id,
                message: messageText.val().trim(),
                subject: messageSubject.trim(),
                sender: sender,
                ajax: true
            },
            dataType: "json",
            success: function (response) {
                var status = response.status;
                modalBody.children().fadeOut(function () {
                    modalBody.html('<div class="alert-success">Message Envoyée</div>');
                    modalBody.siblings('.modal-footer').children().last().hide();
                });
            }
        });
    });

    // helper fuction
    function validateInputs(subject, text) {
        if (subject.val().length === 0) {
            subject.focus();
            subject.parent().css('border', '1px solid #C00');
            return false;
        } else {
            subject.parent().css('border', '1px solid #5cb85c');
            return true;
        }
        if (text.val().length === 0) {
            text.focus();
            text.css('border', '1px solid #C00');
            return false;
        } else {
            text.css('border', '1px solid #5cb85c');
            return true;
        }
    }

    function validateText(text) {
        if (text.val().length === 0) {
            text.focus();
            text.css('border', '1px solid #C00');
            return false;
        } else {
            text.css('border', '1px solid #5cb85c');
            return true;
        }
    }
});
