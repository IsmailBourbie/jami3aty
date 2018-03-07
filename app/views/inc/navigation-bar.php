<div class="aside-content">
    <div class="my_data">
        <a class="btn btn-default btn-block clearfix" role="button"
           data-toggle="collapse" href="#my_data" aria-expanded="false"
           aria-controls="ma_journee">
            <div class="user_img">
                <span>I</span>
            </div>
            <div class="user_info">
                <h3><?=$_SESSION['user_name']?></h3>
                <p class="lead"><?=$_SESSION['user_level']?></p>
            </div>

        </a>
        <!-- Navigation Menu start -->
        <div class="collapse in" id="my_data">
            <div class="well">
                <ul class="list-unstyled">
                    <li id="home">
                        <h4>
                            <i class="fa fa-home"></i>
                            <a href="#">Acueil</a>
                        </h4>
                    </li>
                    <li id="messages">
                        <h4>
                            <i class="fa fa-envelope-square"></i>
                            <a href="#">Messages</a>
                        </h4>
                    </li>
                    <li id="notif">
                        <h4>
                            <i class="fa fa-bell"></i>
                            <a href="#">Notifications</a>
                        </h4>
                    </li>
                    <li>
                        <hr>
                    </li>
                    <li id="fichiers">
                        <h4>
                            <i class="fa fa-book"></i>
                            <a href="#">Fichier</a>
                        </h4>
                    </li>
                    <li id="notes">
                        <h4>
                            <i class="fa fa-calculator"></i>
                            <a href="#">Notes</a>
                        </h4>
                    </li>
                    <li id="emploi">
                        <h4>
                            <i class="fa fa-calendar"></i>
                            <a href="#">Emploi du temps</a>
                        </h4>
                    </li>
                    <li id="evenment">
                        <h4>
                            <i class="fa fa-bullhorn"></i>
                            <a href="#">Évènements</a>
                        </h4>
                    </li>
                    <li id="enrg">
                        <h4>
                            <i class="fa fa-bookmark"></i>
                            <a href="#">Enregistrement</a>
                        </h4>
                    </li>
                    <li id="aide">
                        <h4>
                            <i class="fa fa-question-circle"></i>
                            <a href="#">Aide</a>
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
