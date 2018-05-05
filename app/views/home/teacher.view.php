<?php
require_once APP_ROOT . '/views/inc/css_inc.php'; ?>
    <link rel="stylesheet" href="<?=URL_ROOT?>css/prof_style.css">
    <?php require_once APP_ROOT . '/views/inc/header.php';
//$schedule = $data['my_day'];
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
                                    <!--                        <ul class="list-unstyled">-->
                                    <!--                           <li>-->
                                    <!--                              <h4>08:00 - 09:30</h4>-->
                                    <!--                              <span class="course_name">-->
                                    <?//= $schedule[1]["title"] ?>
                                        <!--</span>-->
                                        <!--                              <span class="course_type">-->
                                        <?//= \App\Classes\Helper::typeOfCourseToString($schedule[1]["type"]) ?>
                                            <!--</span>-->
                                            <!--                              <span class="separitor">-</span>-->
                                            <!--                              <span class="course_place">-->
                                            <?//= $schedule[1]["place"] ?>
                                                <!--</span>-->
                                                <!--                           </li>-->
                                                <!--                           <li>-->
                                                <!--                              <h4>09:30 - 11:00</h4>-->
                                                <!--                              <span class="course_name">-->
                                                <?//= $schedule[2]["title"] ?>
                                                    <!--</span>-->
                                                    <!--                              <span class="course_type">-->
                                                    <?//= \App\Classes\Helper::typeOfCourseToString($schedule[2]["type"]) ?>
                                                        <!--</span>-->
                                                        <!--                              <span class="separitor">-</span>-->
                                                        <!--                              <span class="course_place">-->
                                                        <?//= $schedule[2]["place"] ?>
                                                            <!--</span>-->
                                                            <!--                           </li>-->
                                                            <!--                           <li>-->
                                                            <!--                              <h4>11:00 - 12:30</h4>-->
                                                            <!--                              <span class="course_name">-->
                                                            <?//= $schedule[3]["title"] ?>
                                                                <!--</span>-->
                                                                <!--                              <span class="course_type">-->
                                                                <?//= \App\Classes\Helper::typeOfCourseToString($schedule[3]["type"]) ?>
                                                                    <!--</span>-->
                                                                    <!--                              <span class="separitor">-</span>-->
                                                                    <!--                              <span class="course_place">-->
                                                                    <?//= $schedule[3]["place"] ?>
                                                                        <!--</span>-->
                                                                        <!--                           </li>-->
                                                                        <!--                           <li>-->
                                                                        <!--                              <h4>12:30 - 14:00</h4>-->
                                                                        <!--                              <span class="course_name">-->
                                                                        <?//= $schedule[4]["title"] ?>
                                                                            <!--</span>-->
                                                                            <!--                              <span class="course_type">-->
                                                                            <?//= \App\Classes\Helper::typeOfCourseToString($schedule[4]["type"]) ?>
                                                                                <!--</span>-->
                                                                                <!--                              <span class="separitor">-</span>-->
                                                                                <!--                              <span class="course_place">-->
                                                                                <?//= $schedule[4]["place"] ?>
                                                                                    <!--</span>-->
                                                                                    <!--                           </li>-->
                                                                                    <!--                           <li>-->
                                                                                    <!--                              <h4>14:00 - 15:30</h4>-->
                                                                                    <!--                              <span class="course_name">-->
                                                                                    <?//= $schedule[5]["title"] ?>
                                                                                        <!--</span>-->
                                                                                        <!--                              <span class="course_type">-->
                                                                                        <?//= \App\Classes\Helper::typeOfCourseToString($schedule[5]["type"]) ?>
                                                                                            <!--</span>-->
                                                                                            <!--                              <span class="separitor">-</span>-->
                                                                                            <!--                              <span class="course_place">-->
                                                                                            <?//= $schedule[5]["place"] ?>
                                                                                                <!--</span>-->
                                                                                                <!--                           </li>-->
                                                                                                <!--                           <li>-->
                                                                                                <!--                              <h4>15:30 - 17:00</h4>-->
                                                                                                <!--                              <span class="course_name">-->
                                                                                                <?//= $schedule[6]["title"] ?>
                                                                                                    <!--</span>-->
                                                                                                    <!--                              <span class="course_type">-->
                                                                                                    <?//= \App\Classes\Helper::typeOfCourseToString($schedule[6]["type"]) ?>
                                                                                                        <!--</span>-->
                                                                                                        <!--                              <span class="separitor">-</span>-->
                                                                                                        <!--                              <span class="course_place">-->
                                                                                                        <?//= $schedule[6]["place"] ?>
                                                                                                            <!--</span>-->
                                                                                                            <!--                           </li>-->
                                                                                                            <!--                        </ul>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12 main" id="main-posts">
                        <div class="new-post" id="add-post">
                            <form class="add" action="<?=URL_ROOT?>posts/addpost" method="post">
                                <div class="row text-pub">
                                    <textarea class="autosize" name="text_post" placeholder="Publier quelque chose..."></textarea>
                                </div>
                                <div class="row data text-center">
                                    <div class="col-md-4">
                                        <select class="level" name="level">
                                          <option disabled selected hidden="hidden">Module</option>
                                       </select>
                                       <input id="id-subject" type="hidden" value="" name="id_subject">
                                    </div>
                                    <div class="col-md-4">
                                        <select class="section" name="section" disabled>
                                          <option disabled selected hidden="hidden">Section</option>
                                       </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="group" name="group" disabled>
                                          <option disabled selected hidden="hidden">Group</option>
                                       </select>
                                    </div>
                                    <div class="col-md-12">
                                        <select class="Type" name="type">
                                          <option disabled selected hidden="hidden">Type du publication</option>
                                          <option value="1">Consultation</option>
                                          <option value="2">Affichage</option>
                                          <option value="3">Notes</option>
                                       </select>
                                    </div>
                                </div>
                                <div class="footer text-right">
                                    <input class="publier-btn" type="submit" name="submit" value="Publier">
                                </div>
                            </form>
                        </div>
                        <div class="loader"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php require_once APP_ROOT . '/views/inc/js_inc.php'; ?>
    <script src="<?=URL_ROOT?>js/plugins-posts.js"></script>
    <script src="<?=URL_ROOT?>js/plugins-comment.js"></script>
    <script src="<?=URL_ROOT?>js/plugins-profs.js"></script>
    <?php require_once APP_ROOT . '/views/inc/footer.php'; ?>
