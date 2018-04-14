/*jslint vars: true*/
/*global $, alert, console*/
$(document).ready(function () {
    "use strict";
    var count_posts = 0;

    function createPostMold() {
        var postHTML = '<article class="publication_mold">' +
            '<div class="row publication_head reset-margin">' +
            '<div class="col-xs-10 course_info">' +
            '<div class="teacher_logo"><span>O</span></div>' +
            '<div class="module_teacher">' +
            '<h3>Ouared Aek</h3>' +
            '<span class="separitor"> . </span>' +
            '<span class="time_pub"></span>' +
            '<span class="module_name show"></span></div></div>' +
            '<div class="col-xs-2 options_dropdown text-right">' +
            '<div class="dropdown">' +
            '<button id="option_pub" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
            '<i class="fa fa-ellipsis-h fa-2x"></i></button>' +
            '<ul class="dropdown-menu" aria-labelledby="option_pub"><li>' +
            '<i class="fa fa-bookmark"></i>' +
            '<div>Sauvgarder la publication</div></li><li>' +
            '<i class="fa fa-times-circle"></i>' +
            '<div>Masquer la publication</div></li><li>' +
            '<i class="fa fa-clipboard"></i><div>Copier le lien</div></li>' +
            '<li><i class="fa fa-exclamation-circle"></i>' +
            '<div>Signaler une erreur</div></li></ul></div></div></div>' +
            '<div class="publication_body"><p class="lead"></p><div class="react-bar"><hr>' +
            '<ul class="list-inline reset-margin clearfix"><li>' +
            '<i class="fa fa-comment fa-2x"></i></li>' +
            '<li><button class="btn-transparent save-post"><i class="fa fa-bookmark fa-2x"></i></button></li>' +
            '<li class="pull-right"><span class="see-comments">Voir les commentaires</span>' +
            '</li></ul></div></div>' +
            '<div class="publication_footer">' +
            '<div class="current_comments"><div class="loader lodear-sm"></div></div>' +
            '<div class="input_comment"></div></div></article>';
        return postHTML;
    }
    // get Post's data with ajax after login
    function getPosts() {
        var posts_length,
            posts_mold = '<article class="publication_mold">' + $(".publication_mold").html() + '</article>',
            myPostMold;
        $.ajax({
            url: "http://localhost/jami3aty/posts/all",
            type: "post",
            data: {
                ajax: true
            },
            dataType: "json",
            success: function (response) {
                posts_length = response.data.length;
                if (posts_length === 0) {
                    // there is no posts so hide the first mold
                    alert("There is no Posts");
                    return;
                }
                for (count_posts; count_posts < posts_length; count_posts += 1) {
                    $('#main-posts > .loader').before(createPostMold());
                    myPostMold = $(".publication_mold");
                    myPostMold.last().find(".module_teacher h3").html(response.data[count_posts].fullName);
                    myPostMold.last()
                        .find(".module_teacher .time_pub").html(response.data[count_posts].date_parsed);
                    myPostMold.last()
                        .find(".module_teacher .module_name").html(response.data[count_posts].title);
                    myPostMold.last()
                        .find(".publication_body p").html(response.data[count_posts].text_post);
                    myPostMold.last().attr("data-target", response.data[count_posts]._id_post);
                    if (response.data[count_posts].saved == 1) {
                        myPostMold.last().find(".react-bar .save-post")
                            .children("i").removeClass("fa-bookmark");

                        myPostMold.last().find(".react-bar .save-post")
                            .children("i").addClass("fa-check");
                        myPostMold.last().find(".react-bar .save-post")
                            .removeClass("save-post");
                    }
                }
                $('#main-posts > .loader').hide();
            }
        });
    }
    getPosts();
});
