<div id="menubar" class="aside-content">
    <div class="my_data">
        <a>
            <div class="user_img">
                <i class="fa fa-user"></i>
                <!--                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>-->

            </div>
            <div class="user_info">
                   <span class="student_id" id="_user_id"><?= Session::get("user_id") ?></span>
                <h3>
                   <?= Session::get('user_fullname') ?>
                </h3>
                <p class="lead">
                   <?= Session::get('user_branch') ?>
                </p>
            </div>

        </a>
        <!-- Navigation Menu start -->
        <div class="collapse in" id="my_data">
            <div class="well">
                <ul class="list-unstyled">
                    <li id="home">
                        <a href="<?= URL_ROOT ?>home">
                            <h4>
                                <i class="fa fa-home"></i> Acueil
                            </h4>
                        </a>
                    </li>
                    <li id="messages">
                        <a href="<?= URL_ROOT ?>mails">
                            <h4>
                                <i class="fa fa-envelope"></i> Messages
                            </h4>
                        </a>
                    </li>
                    <li id="notifications">
                        <a href="<?= URL_ROOT ?>notifications">
                            <h4>
                                <i class="fa fa-bell"></i> Notifications
                            </h4>
                        </a>
                    </li>
                    <li>
                        <hr>
                    </li>
                    <li id="modules">
                        <a href="<?= URL_ROOT ?>modules">
                            <h4>
                                <i class="fa fa-book"></i> Modules
                            </h4>
                        </a>
                    </li>
                    <li id="notes">
                        <a href="<?= URL_ROOT ?>marks">
                            <h4>
                                <i class="fa fa-calculator"></i> Notes
                            </h4>
                        </a>
                    </li>
                    <li id="planning">
                        <a href="<?= URL_ROOT ?>schedules">
                            <h4>
                                <i class="fa fa-calendar"></i> Planning
                            </h4>
                        </a>
                    </li>
                    <li id="évènements">
                        <a href="<?= URL_ROOT ?>events">
                            <h4>
                                <i class="fa fa-bullhorn"></i> Évènements
                            </h4>
                        </a>
                    </li>
                    <li id="Enregistré">
                        <a href="<?= URL_ROOT ?>saved">
                            <h4>
                                <i class="fa fa-bookmark"></i> Enregistrement
                            </h4>
                        </a>
                    </li>
                    <li id="aide">
                        <a href="<?= URL_ROOT ?>help">
                            <h4>
                                <i class="fa fa-question-circle"></i> Aide
                            </h4>
                        </a>
                    </li>
                </ul>
                <div class="copyright">
                    <p>
                        <span>&copy; </span>Jami3aty, Inc. <?= date("Y") ?>
                    </p>
                </div>
            </div>
        </div>
        <!-- Navigation Menu End -->
    </div>
</div>
