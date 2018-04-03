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
                    <div class="calnedar">
                        <div class="aside-content">
                            <div class="ma_journee">
                                <a class="btn btn-default btn-block" role="button" data-toggle="collapse"
                                   href="#ma_journee" aria-expanded="false" aria-controls="ma_journee">
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
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 main">
                    <div class="welcom_day">
                        <h2 class="text-center">Bonjour <span>ISMAIL</span></h2>
                        <p class="text-center">Aucune événement aujourd'hui</p>
                    </div>
                    <div class="publication_mold">
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
                                    <button id="option_pub" type="button" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
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
                            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo vero beatae
                                a, atque repellat obcaecati explicabo placeat. Praesentium eum laboriosam officia
                                tenetur magni provident quo veritatis, id repellat vero quae ut eligendi quasi, quidem!
                                Ipsam soluta inventore earum facilis esse veritatis expedita placeat? Cumque
                                necessitatibus explicabo nihil perspiciatis, aut autem.</p>

                            <div class="react-bar">
                                <hr>
                                <ul class="list-inline reset-margin clearfix">
                                    <li><i class="fa fa-comment fa-2x"></i></li>
                                    <li><i class="fa fa-envelope fa-2x"></i></li>
                                    <li class="pull-right"><i class="fa fa-bookmark fa-2x"></i></li>
                                </ul>
                            </div>
                        </div>
                        <div class="publication_footer">
                            <div class="current_comments">
                                <div class="comment_mold">
                                    <div class="row reset-margin">
                                        <div class="col-xs-1 student_logo">
                                            <span>Y</span>
                                        </div>
                                        <div class="col-xs-9 student_data">
                                            <h5 class="student_name reset-margin">Charfaoui Younes</h5>
                                            <p class="student_comment reset-margin">Lorem ipsum dolor sit amet,
                                                consectetur.
                                            </p>
                                            <span class="time_comment">10 min</span>
                                            <span class="arrow"></span>
                                        </div>
                                        <div class="col-xs-2 hide text-right">
                                            <i class="fa fa-exclamation-circle" style="font-size: 17px"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="comment_mold">
                                    <div class="row reset-margin">
                                        <div class="col-xs-1 student_logo">
                                            <span>R</span>
                                        </div>
                                        <div class="col-xs-9 student_data">
                                            <h5 class="student_name reset-margin">Redouane Baya</h5>
                                            <p class="student_comment reset-margin">Lorem ipsum dolor sit amet,
                                                consectetur.
                                            </p>
                                            <span class="time_comment">25 min</span>
                                            <span class="arrow"></span>
                                        </div>
                                        <div class="col-xs-2 hide text-right">
                                            <i class="fa fa-exclamation-circle" style="font-size: 17px"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="input_comment"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php require_once APP_ROOT . '/views/inc/js_inc.php'; ?>
<?php require_once APP_ROOT . '/views/inc/footer.php'; ?>
