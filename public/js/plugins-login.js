/*jslint vars: true*/
/*global $, alert, console*/
$(document).ready(function () {
    "use strict";
    /*Input style on focus Start*/
    $('input[type!="submit"]').focus(function () {
        if ($(this).attr("placeholder").length > 0) {
            $(this).attr("data-place", $(this).attr("placeholder"));
            $(this).attr("placeholder", "");
        }
        if ($(this).parent().css("border-bottom-color") === "rgb(85, 85, 85)") {
            $(this).parent().css("border-color", "#3583fb");
        }
    });
    /*Input style on focus End*/

    /* Show Box of Sign Up Start */
    $("#show_signup").click(function () {
        $('form.form-login').hide(function () {
            $('form.form-signup').slideDown();
        });
    });
    $("#back_login").click(function () {
        $('form.form-signup').hide(function () {
            $('form.form-login').slideDown();
        });
    });
    /* Show Box of Sign Up End */
    /*show password Start*/
    $('.glyphicon-eye-open').hover(function () {
        $(this).addClass("glyphicon-eye-close");
        $(this).removeClass("glyphicon-eye-open");
        $(this).siblings("input").attr("type", "text");
    }, function () {
        $(this).addClass("glyphicon-eye-open");
        $(this).removeClass("glyphicon-eye-close");
        $(this).siblings("input").attr("type", "password");
    });
    /*show password End*/

    /*Validation of Inputs Start*/
    $('input[type!="submit"]').blur(function () {
        if ($(this).attr("data-place").length > 0) {
            $(this).attr("placeholder", $(this).attr("data-place"));
            $(this).attr("data-place", "");
        }
        var email_pattern = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/,
            carte_num_pattern = /^\d+$/,
            moyenne_pattren = /^1[0-9]([.][0-9]{1,2})?$/,
            input_val = $(this).val();
        if ($(this).attr("data") === "email") {
            if (input_val.match(email_pattern)) {
                $(this).parent().css("border-color", "#5cb85c");
                $(this).parent().next(".error").html("");
            } else {
                $(this).parent().css("border-color", "#dd1037");
                $(this).parent().next(".error").html("Vérifiez que vous utilisez votre adresse mail complète, y compris le signe @ et un domaine.");

            }
        } else if ($(this).attr("data") === "password") {
            if (input_val.length >= 8) {
                $(this).parent().css("border-color", "#5cb85c");
                $(this).parent().next(".error").html("");
            } else {
                $(this).parent().css("border-color", "#dd1037");
                if (input_val.length === 0) {
                    $(this).parent().next(".error").html("Votre mot de passe n’est pas suffisamment fort, essayez de créer un mot de passe plus long.");
                } else {
                    $(this).parent().next(".error").html("Votre mot de passe n’est pas suffisamment fort, essayez de créer un mot de passe plus long.");
                }
            }
        } else if ($(this).attr("data") === "num_carte") {
            if (input_val.match(carte_num_pattern)) {
                $(this).parent().css("border-color", "#5cb85c");
                $(this).parent().next(".error").html("");
            } else {
                $(this).parent().css("border-color", "#dd1037");
                $(this).parent().next(".error").html("Ce numéro est invalide.");

            }
        } else if ($(this).attr("data") === "moyenne") {
            input_val = input_val.replace(/,/, ".");
            console.log(input_val);
            console.log(typeof input_val);
            if (input_val.match(moyenne_pattren)) {
                $(this).parent().css("border-color", "#5cb85c");
                $(this).parent().next(".error").html("");
            } else {
                $(this).parent().css("border-color", "#dd1037");
                $(this).parent().next(".error").html("Cette moyenne est invalid.");

            }
        }
    });
    /*Validation of Inputs End*/

    /*Login with ajax Start */
    $('form').submit(function (e) {
        $(this).find(".error").each(function (index) {
            if ($(this).siblings(".required").eq(index).find("input").val().length <= 8) {
                e.preventDefault();
                $(this).siblings(".required").eq(index).css("border-color", "#dd1037");
                $(this).siblings(".required").eq(index).find("input").focus();
                return;
            }
            if ($(this).eq(index).text().length !== 0) {
                e.preventDefault();
                $('form').find(".required").eq(index).find("input").focus();
                return;
            }
        });

        // $.ajax({
        //     url: '/jami3aty/users/login',
        //     type: 'post',
        //     data: {
        //         'email': "ismail@gmail.com",
        //         'password': "hellohello",
        //         'ajax': "ajax"
        //     },
        //     success: function (data) {
        //         console.log(data);
        //     }
        // });

    });
    /*Login with ajax End */

});
