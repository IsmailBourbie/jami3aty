/*jslint vars: true*/
/*global $, alert, console, confirm*/
$(document).ready(function () {
    "use strict";
    var data_comments,
        user_id;

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
            url: "http://localhost/jami3aty/comments/all",
            type: "post",
            data: {
                id_post: id_post,
                ajax: true
            },
            dataType: "json",
            success: function (response) {
                if (response.status == 200) {
                    data_comments = response.data;
                    user_id = response.user_id;
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
            url: 'http://localhost/jami3aty/comments/remove',
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

    /* add and edit comment start */
    $('#main-posts').on("click", ".react-bar .comment-btn", function () {
        $(this).parents(".publication_mold").find(".new_comment  .comment-input").focus();
    });
    $('#main-posts').on("keypress", ".new_comment  .comment-input", function (e) {
        if (e.which == 13 && !e.shiftKey) {
            var status,
                myComment = $(this),
                text_input = $(this).val().trim(),
                id_post = $(this).parents(".publication_mold").attr('data-target');
            e.preventDefault();
            if (text_input.length == 0) {
                return false;
            }
            // do ajax call 
            $.ajax({
                url: 'http://localhost/jami3aty/comments/add',
                type: 'post',
                data: {
                    'id_post': id_post,
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
        }
    });

    function addComment(id_post, text_added) {
        $.ajax({
            url: 'http://localhost/jami3aty/comments/add',
            type: 'post',
            data: {
                'id_post': id_post,
                'text_added': text_added
            },
            async: false,
            success: function (response) {
                status = response.status;
            }
        });
    }
    /* add and edit comment end */







});
