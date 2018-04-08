<?php
require_once APP_ROOT . '/views/inc/css_inc.php';
require_once APP_ROOT . '/views/inc/header.php';
$responses = $data["data"];
?>
    <?php require_once APP_ROOT . '/views/inc/header.php'; ?>
    <div class="row reset-margin">
        <div class="aside-left reset-padding">
            <?php require_once APP_ROOT . '/views/inc/navigation-bar.php'; ?>
        </div>
        <div class="content">
            <?php require_once APP_ROOT . '/views/inc/nav.php'; ?>
            <div class="main">
                <div class="posts">
                    <article class="publication_mold">
                        <div class="row publication_head reset-margin">
                            <div class="col-xs-10 course_info">
                                <div class="teacher_logo">
                                    <span>O</span>
                                </div>
                                <div class="module_teacher">
                                    <h3>
                                        <?= $responses->fullName?>
                                    </h3>
                                    <span class="separitor">.</span>
                                    <span class="time_pub"><?= Time::formatTime($responses->date_post)?></span>
                                    <span class="module_name show"><?= $responses->title?></span>
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
                            <p class="lead">
                                <?= $responses->text_post?>
                            </p>

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
                            <div class="current_comments"></div>
                            <div class="input_comment"></div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
    <?php require_once APP_ROOT . '/views/inc/js_inc.php'; ?>
    <?php require_once APP_ROOT . '/views/inc/footer.php'; ?>