<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>
       <?= $data['page_title'] ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" href="<?= URL_ROOT ?>images/ic_launcher-web.png">
    <link rel="stylesheet" href="<?= URL_ROOT ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= URL_ROOT ?>/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= URL_ROOT ?>/css/signin.css">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Lato');

    </style>
</head>

<body>

<div class="overlay"></div>
<div class="container">
    <div class="row">
        <!--Slider side Start-->
        <div class="col-md-5 col-md-offset-1 left">
            <div id="carousel-login" class="carousel slide" data-ride="carousel">
                <!-- Indicators of carousel -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel-login" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-login" data-slide-to="1"></li>
                    <li data-target="#carousel-login" data-slide-to="2"></li>
                    <li data-target="#carousel-login" data-slide-to="3"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <div class="overlay"></div>
                        <img src="<?= URL_ROOT ?>/images/slide_main.jpeg" alt="...">
                        <div class="carousel-caption">
                            <h3>Jami3aty welcomes you</h3>
                            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non arcu
                                euismod, venenatis arcu quis.</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="overlay"></div>
                        <img src="<?= URL_ROOT ?>/images/visual.jpg" alt="...">
                        <div class="carousel-caption">
                            <h3>Communication Easy</h3>
                            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non arcu
                                euismod, venenatis arcu quis.</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="overlay"></div>
                        <img src="<?= URL_ROOT ?>/images/planning.jpg" alt="...">
                        <div class="carousel-caption">
                            <h3>Planning of day</h3>
                            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non arcu
                                euismod, venenatis arcu quis.</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="overlay"></div>
                        <img src="<?= URL_ROOT ?>/images/courses.jpeg" alt="...">
                        <div class="carousel-caption">
                            <h3>Courses and Documents</h3>
                            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non arcu
                                euismod, venenatis arcu quis.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Slider side End-->

        <!--Form login Start-->
        <div class="col-md-5 right">
           <?php if ($data["status"] != OK): ?>
               <div class='error_form'>
                  <?= $data['message'] ?>
               </div>
           <?php endif; ?>
            <form action="<?= URL_ROOT ?>auth/login" method="post" class="form-login">
               <?php Session::flash("register_success");
               Session::flash("password_updated") ?>

                <div class="feild-input">
                    <!--Email input Start-->
                    <div class="input-group required">
                        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-envelope"></i></span>
                        <input type="email" data="email" name="email" class="form-control" placeholder="Email">
                    </div>
                    <!--Email input End-->
                    <div class='error'></div>
                    <!--Password input Start-->
                    <div class="input-group required">
                                <span class="input-group-addon" id="basic-addon1">
                               <span class="glyphicon glyphicon-lock" aria-hidden="true"></span></span>
                        <input type="password" data="password" name="password" class="form-control"
                               placeholder="Mot de passe" autocomplete="new-password">
                        <span class="glyphicon glyphicon-eye-open custom-icon"></span>
                    </div>
                    <!--Password input End-->
                    <div class='error'></div>
                    <!--Remember me input Start-->
                    <div class="input-group"></div>
                    <!--Remember me input End-->

                    <!--Button Sign in-->
                    <input id="login_btn" type="submit" class="btn btn-block btn-success" value="S'identifier">
                </div>
                <!--Ask Problem login Start-->
                <div class="filed_ask">
                    <hr>
                    <p class="lead text-center">Première visite?<span id="show_signup">Inscrivez-vous.</span></p>
                    <p class="lead text-center"><a href="<?= URL_ROOT ?>users/forgotpass">Mot de passe oublier?</a></p>
                </div>
                <!--Ask Problem login End-->
                <div class="footer_login">
                    <a href="#">
                        <button type="button">Aide</button>
                    </a>
                </div>
            </form>


            <form action="<?= URL_ROOT ?>auth/register" class="form-signup" method="post">
                <div class="feild-input">

                    <!-- User Card number Start -->
                    <div class="input-group required">
                        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-id-card"></i></span>
                        <input id="num_carte" type="text" data="num_carte" class="form-control"
                               placeholder="Numéro de la carte" name="number_card" style="padding-left:  7px;">
                        <i class="fa fa-question-circle-o custom-icon"
                           title="Ce numéro tu le trouve dans&#013;votre carte étudiant&#013;donnée par l'adminstration"></i>
                    </div>
                    <div class='error'></div>
                    <!-- User Card number End -->

                    <!-- Email Start -->
                    <div class="input-group required">
                        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-envelope"></i></span>
                        <input type="email" data="email" class="form-control" placeholder="Email" name="email">
                    </div>
                    <div class='error'></div>
                    <!-- Email End -->

                    <!-- Moyenne BAC Start -->
                    <div class="input-group required">
                        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-graduation-cap"></i></span>
                        <input id="average" type="text" data="moyenne" class="form-control" placeholder="Moyenne du BAC"
                               name="average">
                    </div>
                    <div class='error'></div>
                    <!-- Moyenne BAC End -->

                    <!-- Password Start -->
                    <div class="input-group required">
                                <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-lock"
                                                                                        aria-hidden="true"></span></span>
                        <input type="password" data="password" class="form-control" placeholder="Mot de passe"
                               name="password">
                        <span class="glyphicon glyphicon-eye-open custom-icon"></span>
                    </div>
                    <div class='error'></div>

                    <!-- Password End -->
                    <input id="signup_btn" type="submit" class="btn btn-block btn-success" value="S'inscrire">
                </div>
                <div class="footer_signup">
                    <button id="back_login" type="button"><i class="fa fa-arrow-left"> </i> S'identifier</button>
                    <a href="#">
                        <button type="button">Aide</button>
                    </a>
                </div>
            </form>
        </div>
        <!--Form login end-->
    </div>


</div>
<!-- </container> -->


<script src="<?= URL_ROOT ?>/js/jquery-1.12.1.min.js"></script>
<script src="<?= URL_ROOT ?>/js/bootstrap.min.js"></script>
<script src="<?= URL_ROOT ?>/js/plugins-login.js"></script>
</body>

</html>
