<div id="menubar" class="aside-content">
    <div class="my_data">
        <a>
            <div class="user_img">
                <i class="fa fa-user"></i>
                <!--                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>-->

            </div>
            <div class="user_info">
                <h3>
                   <?= $_SESSION['user_firstname'] . ' ' . $_SESSION['user_lastname'] ?>
                </h3>
                <p class="lead">
                   <?= $_SESSION['user_branch'] ?>
                </p>
            </div>

        </a>
        <!-- Navigation Menu start -->
        <div class="collapse in" id="my_data">
            <div class="well">
                <ul class="list-unstyled">
                    <li id="home">
                        <h4>
                            <i class="fa fa-home"></i>
                            <a href="<?= URL_ROOT ?>home">Acueil</a>
                        </h4>
                    </li>
                    <li id="messages">
                        <h4>
                            <i class="fa fa-envelope"></i>
                            <a href="<?= URL_ROOT ?>messages">Messages</a>
                        </h4>
                    </li>
                    <li id="notifications">
                        <h4>
                            <i class="fa fa-bell"></i>
                            <a href="<?= URL_ROOT ?>notifications">Notifications</a>
                        </h4>
                    </li>
                    <li>
                        <hr>
                    </li>
                    <li id="modules">
                        <h4>
                            <i class="fa fa-book"></i>
                            <a href="<?= URL_ROOT ?>modules">Modules</a>
                        </h4>
                    </li>
                    <li id="notes">
                        <h4>
                            <i class="fa fa-calculator"></i>
                            <a href="<?= URL_ROOT ?>notes">Notes</a>
                        </h4>
                    </li>
                    <li id="planning">
                        <h4>
                            <i class="fa fa-calendar"></i>
                            <a href="<?= URL_ROOT ?>schedules">Planning</a>
                        </h4>
                    </li>
                    <li id="évènements">
                        <h4>
                            <i class="fa fa-bullhorn"></i>
                            <a href="<?= URL_ROOT ?>events">Évènements</a>
                        </h4>
                    </li>
                    <li id="Enregistré">
                        <h4>
                            <i class="fa fa-bookmark"></i>
                            <a href="<?= URL_ROOT ?>saved">Enregistrement</a>
                        </h4>
                    </li>
                    <li id="aide">
                        <h4>
                            <i class="fa fa-question-circle"></i>
                            <a href="<?= URL_ROOT ?>help">Aide</a>
                        </h4>
                    </li>
                </ul>
                <div class="copyright">
                    <p>
                        <span>&copy; </span>Ismail Bourbie, Inc. 2018
                    </p>
                </div>
            </div>
        </div>
        <!-- Navigation Menu End -->
    </div>
</div>
