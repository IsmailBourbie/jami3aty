/*jslint vars: true*/
/*global $, alert, console*/
$(document).ready(function () {
    "use strict";
    var selectElement = $('#list-profs'),
        modalBody = selectElement.parents(".modal-content").children(".modal-body"),
        user_id = Number($('#_std_id').text()),
        countProfs = 0;

    function optionMold(value, text) {
        return '<option value="' + value + '">' + text + '</option>';
    }
    // get Profs Name and id
    $('.new_message .new_message_btn').click(function () {
        $.ajax({
            url: "http://localhost/jami3aty/mails/profs",
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
            profId = selectElement.val();
        // validate inputs
        validateInputs(messageSubject, messageText);
        // send data with ajax
        modalBody.html("<div class='loader'></div>");
        $.ajax({
            url: "http://localhost/jami3aty/mails/insert",
            type: "post",
            data: {
                id_professor: profId,
                _id_student: user_id,
                message: messageText.val(),
                subject: messageSubject.val(),
                sender: 0,
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
        }
        if (text.val().length === 0) {
            text.focus();
            text.css('border', '1px solid #C00');
            return false;
        } else {
            text.css('border', '1px solid #5cb85c');
        }
    }
});
