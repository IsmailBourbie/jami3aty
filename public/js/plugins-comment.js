/*jslint eqeq: true, vars: true*/
/*global $, alert, console, confirm*/
$(document).ready(function () {
    "use strict";
    var site_host = 'http://' + location.host + "/jami3aty/",
        data_comments,
        user_id = Number($('#_user_id').text()),
        myComment_text;
    function createCommentMold() {
        var commentHTML = '<div class="comment_mold">' +
            '<div class="row reset-margin">' +
            '<div class="col-xs-1 student_logo"><i class="fa fa-user-circle fa-3x"></i></div>' +
            '<div class="col-xs-8 student_data">' +
            '<h5 class="student_name reset-margin">CHARFAOUI</h5>' +
            '<p class="student_comment reset-margin">HERE COMMENT</p>' +
            '<span class="time_comment">TIME</span>' +
            '<span class="arrow"></span></div>' +
            '<div class="change-comment col-xs-2 hide text-right">' +
            '</div></div></div>';
        return commentHTML;
    }

    function createModifyMold() {
        var tepmpateHTML = '<button class="btn-transparent edit">' +
            '<i class="fa fa-edit fa-lg"></i></button>' +
            '<button class="btn-transparent remove">' +
            '<i class="fa fa-trash fa-lg"></i></button>';
        return tepmpateHTML;
    }

    // get Post's data with ajax after login
    function getComments(myCurrentsComments, id_post) {
        var count_comments = 0;
        $.ajax({
            url: site_host + "comments/all",
            type: "post",
            data: {
                id_post: id_post,
                ajax: true
            },
            dataType: "json",
            success: function (response) {
                if (response.status == 200) {
                    data_comments = response.data;
                }

            },
            complete: function (response) {
                var comment_len = data_comments.length;
                for (count_comments; count_comments < comment_len; count_comments += 1) {
                    myCurrentsComments.children('.loader').before(createCommentMold());
                    myCurrentsComments.find(".student_name").last()
                        .text(data_comments[count_comments].name_person);
                    myCurrentsComments.find(".student_comment").last()
                        .text(data_comments[count_comments].text_comment);
                    myCurrentsComments.find(".time_comment").last()
                        .text(data_comments[count_comments].date_parsed);
                    // check if this is my comment
                    if (user_id == data_comments[count_comments]._id_person) {
                        myCurrentsComments.find(".change-comment").last().html(createModifyMold());
                        myCurrentsComments.find(".change-comment")
                            .last().attr("data-target", data_comments[count_comments]._id_comments);
                    }
                }
                myCurrentsComments.children('.loader').hide();
            }
        });
    }
    // get comment when button cklicked
    $('#main-posts').on("click", "span.see-comments", function () {
        var myCurrentsComments = $(this).parents(".publication_body").siblings(".publication_footer")
            .children(".current_comments"),
            id_post = $(this).parents(".publication_mold").attr('data-target');
        $(this).parents(".publication_body").siblings(".publication_footer")
            .children(".current_comments").slideDown();
        getComments(myCurrentsComments, id_post);
        $(this).removeClass("see-comments").hide();
    });

    // delete Comment 
    $('#main-posts').on("click", ".change-comment .remove", function () {
        var id_comment = $(this).parent().attr('data-target'),
            confirm_del = false,
            myComment = $(this);
        confirm_del = confirm('vous etes sur !');
        if (!confirm_del) {
            return false;
        }
        $.ajax({
            url: site_host + 'comments/remove',
            type: 'post',
            data: {
                id_comment: id_comment,
                ajax: true
            },
            dataType: "json",
            success: function (response) {
                if (response.status == 200) {
                    myComment.parents(".comment_mold").hide();
                }
            }
        });
    });

    /* add comment start */
    $('#main-posts').on("click", ".react-bar .comment-btn", function () {
        $(this).parents(".publication_mold").find(".new_comment  .comment-input").focus();
    });
    $('#main-posts').on("keypress", ".new_comment  .comment-input", function (e) {
        var type = $(this).parent().attr('data-target'),
            status,
            myComment = $(this),
            text_input = $(this).val().trim();
        if (e.which == 13 && !e.shiftKey && type === "add") {
            var id_post = $(this).parents(".publication_mold").attr('data-target');
            e.preventDefault();
            if (text_input.length == 0) {
                return false;
            }
            // do ajax call 
            $.ajax({
                url: site_host + 'comments/add',
                type: 'post',
                data: {
                    'id_post': id_post,
                    '_id_person': user_id,
                    'text_added': text_input
                },
                success: function (response) {
                    status = response.status;
                }
            }).done(function () {
                if (status == 200) {
                    // reset the value of
                    myComment.val("");
                    // remove all the comments
                    myComment.parent().siblings(".current_comments").children().not(".loader").remove();
                    // click button and get the new comments
                    myComment.parents(".publication_footer").siblings(".publication_body")
                        .children('.react-bar')
                        .find(".pull-right").children("span").addClass("see-comments").trigger("click");
                }
            });
        } else if (e.which == 13 && !e.shiftKey && type === "edit") {
            e.preventDefault();
            var id_comment = $(this).parent().attr("data-id"),
                text_edited = $(this).val().trim();
            if (text_edited == myComment_text) {
                return false;
            }
            $.ajax({
                url: site_host + 'comments/edit',
                type: 'post',
                data: {
                    'id_comment': id_comment,
                    'text_edited': text_edited
                },
                success: function (response) {
                    console.log(response);
                    status = response.status;
                }
            }).done(function () {
                if (status == 200) {
                    var current_comment = $(".change-comment[data-target='" + id_comment + "']");
                    reset_cmntr(myComment, current_comment);
                    current_comment.siblings('.student_data').children(".student_comment")
                        .text(text_edited);
                    current_comment.siblings('.student_data').children(".time_comment")
                        .text("À l'instant");

                }
            });

        }
    });
    /* add comment end */


    /* edit comment start */
    $('#main-posts').on("click", ".change-comment .edit", function () {
        var id_comment = $(this).parent().attr('data-target'),
            myComment = $(this).parent().siblings(".student_data").children(".student_comment"),
            myInputComment = $(this)
            .parents(".current_comments").siblings(".new_comment ").children("textarea");
        // hide the comment
        $(this).parents(".comment_mold").hide();
        myComment_text = myComment.text();
        // change the data target from add to edit
        myInputComment.parent().attr("data-target", "edit");
        // set the id in attr data-id 
        myInputComment.parent().attr("data-id", id_comment);
        // show cancel edit button
        myInputComment.siblings(".cancel-edit").show();
        // put the value of comment in the input
        myInputComment.val(myComment_text);
        // focus the input to change data 
        myInputComment.focus();
        // make some style 
        myInputComment.parent().css("border", "1px solid #46bfbe");

    });
    $('#main-posts').on("click", ".new_comment .cancel-edit", function () {
        var id_comment = $(this).parent().attr('data-id'),
            input_comment = $(this).siblings("textarea"),
            current_comment = $(".change-comment[data-target='" + id_comment + "']");
        reset_cmntr(input_comment, current_comment);
    });
    /* edit comment end */
    function reset_cmntr(input_comment, current_comment) {
        console.log(current_comment);
        input_comment.val("");
        input_comment.siblings(".cancel-edit").hide();
        input_comment.blur();
        input_comment.parent().css("border", "none");
        current_comment.parents('.comment_mold').fadeIn(900);
    }

});
