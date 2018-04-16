<?php
require_once APP_ROOT . '/views/inc/css_inc.php';
require_once APP_ROOT . '/views/inc/header.php';
$schedule = $data['my_day'];
?>
    <div class="row reset-margin">
        <div class="aside-left reset-padding">
            <?php require_once APP_ROOT . '/views/inc/navigation-bar.php'; ?>
        </div>
        <div class="content">
            <?php require_once APP_ROOT . '/views/inc/nav.php'; ?>
            <div class="main">
                <div class="row reset-margin">
                    <div class="col-lg-3  col-md-12 aside-right">
                        <div class="ma_journee">
                            <a class="btn btn-default btn-block" role="button" data-toggle="collapse" href="#ma_journee" aria-expanded="false" aria-controls="ma_journee">
                                    Ma Journée Universitaire
                                    </a>
                            <div class="collapse in" id="ma_journee">
                                <div class="well">
                                    <ul class="list-unstyled">
                                        <li>
                                            <h4>08:00 - 09:30</h4>
                                            <span class="course_name"><?= $schedule[1]["title"] ?></span>
                                            <span class="course_type"><?= \App\Classes\Helper::typeOfCourseToString($schedule[1]["type"]) ?></span>
                                            <span class="separitor">-</span>
                                            <span class="course_place"><?= $schedule[1]["place"] ?></span>
                                        </li>
                                        <li>
                                            <h4>09:30 - 11:00</h4>
                                            <span class="course_name"><?= $schedule[2]["title"] ?></span>
                                            <span class="course_type"><?= \App\Classes\Helper::typeOfCourseToString($schedule[2]["type"]) ?></span>
                                            <span class="separitor">-</span>
                                            <span class="course_place"><?= $schedule[2]["place"] ?></span>
                                        </li>
                                        <li>
                                            <h4>11:00 - 12:30</h4>
                                            <span class="course_name"><?= $schedule[3]["title"] ?></span>
                                            <span class="course_type"><?= \App\Classes\Helper::typeOfCourseToString($schedule[3]["type"]) ?></span>
                                            <span class="separitor">-</span>
                                            <span class="course_place"><?= $schedule[3]["place"] ?></span>
                                        </li>
                                        <li>
                                            <h4>12:30 - 14:00</h4>
                                            <span class="course_name"><?= $schedule[4]["title"] ?></span>
                                            <span class="course_type"><?= \App\Classes\Helper::typeOfCourseToString($schedule[4]["type"]) ?></span>
                                            <span class="separitor">-</span>
                                            <span class="course_place"><?= $schedule[4]["place"] ?></span>
                                        </li>
                                        <li>
                                            <h4>14:00 - 15:30</h4>
                                            <span class="course_name"><?= $schedule[5]["title"] ?></span>
                                            <span class="course_type"><?= \App\Classes\Helper::typeOfCourseToString($schedule[5]["type"]) ?></span>
                                            <span class="separitor">-</span>
                                            <span class="course_place"><?= $schedule[5]["place"] ?></span>
                                        </li>
                                        <li>
                                            <h4>15:30 - 17:00</h4>
                                            <span class="course_name"><?= $schedule[6]["title"] ?></span>
                                            <span class="course_type"><?= \App\Classes\Helper::typeOfCourseToString($schedule[6]["type"]) ?></span>
                                            <span class="separitor">-</span>
                                            <span class="course_place"><?= $schedule[6]["place"] ?></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Start Modal of new Comments-->
                    <div class="modal fade comment-modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <textarea cols="10" rows="20" placeholder="Commentaire"></textarea>
                                <button id="">Send</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12 main" id="main-posts">
                        <div class="welcom_day">
                            <h2 class="text-center">Bonjour <span><?=Session::get('user_lastname')?></span></h2>
                        </div>
                        <article class="publication_mold">
                            <div class="row publication_head reset-margin">
                                <div class="col-xs-10 course_info">
                                    <div class="teacher_logo">
                                        <span>O</span>
                                    </div>
                                    <div class="module_teacher">
                                        <h3>Ouared Aek</h3>
                                        <span class="separitor">.</span>
                                        <span class="time_pub">1 min</span>
                                        <span class="module_name show">System d'exploitaion</span>
                                    </div>
                                </div>
                                <div class="col-xs-2 options_dropdown text-right">
                                    <div class="dropdown">
                                        <button id="option_pub" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-h fa-2x"></i>
                                    </button>
                                        <ul class="dropdown-menu" aria-labelledby="option_pub">
                                            <li>
                                                <i class="fa fa-bookmark"></i>
                                                <div>Sauvgarder la publication</div>
                                            </li>
                                            <li>
                                                <i class="fa fa-times-circle"></i>
                                                <div>Masquer la publication</div>
                                            </li>
                                            <li>
                                                <i class="fa fa-clipboard"></i>
                                                <div>Copier le lien</div>
                                            </li>
                                            <li>
                                                <i class="fa fa-exclamation-circle"></i>
                                                <div>Signaler une erreur</div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="publication_body">
                                <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo vero beatae</p>

                                <div class="react-bar">
                                    <hr>
                                    <ul class="list-inline reset-margin clearfix">
                                        <li>
                                            <button type="button" class="btn-transparent" data-toggle="modal" data-target=".comment-modal">
                                               <i class="fa fa-comment fa-2x"></i> 
                                            </button>
                                        </li>
                                        <li><i class="fa fa-bookmark fa-2x"></i></li>
                                        <li class="pull-right">
                                            <span id="see-comments">Voire Tout</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="publication_footer">
                                <div class="current_comments show">
                                    <div class="comment_mold">
                                        <div class="row reset-margin">
                                            <div class="col-xs-1 student_logo">

                                            </div>
                                            <div class="col-xs-8 student_data">
                                                <h5 class="student_name reset-margin">Charfaoui Younes</h5>
                                                <p class="student_comment reset-margin">Lorem ipsum dolor sit amet, consectetur.
                                                </p>
                                                <span class="time_comment">10 min</span>
                                                <span class="arrow"></span>
                                            </div>
                                            <div class="change-comment col-xs-2 text-right">
                                                <button class="btn-transparent edit">
                                                    <i class="fa fa-edit fa-lg"></i>
                                                </button>
                                                <button class="btn-transparent remove">
                                                    <i class="fa fa-trash fa-lg"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <div class="new_comment text-center" data-target="add">
                                    <textarea class="comment-input autosize" placeholder="Ajouter un commentaire"></textarea>
                                    <span class="cancel-edit" title="annuler">
                                        <i class="fa fa-times"></i>
                                    </span>
                                </div>
                            </div>
                        </article>
                        <div class="loader"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php require_once APP_ROOT . '/views/inc/js_inc.php'; ?>
    <script src="<?=URL_ROOT?>js/plugins-posts.js"></script>
    <script src="<?=URL_ROOT?>js/plugins-comment.js"></script>
    <?php require_once APP_ROOT . '/views/inc/footer.php'; ?>
