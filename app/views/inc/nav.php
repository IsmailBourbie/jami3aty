<nav class="navbar navbar-default navbar-fixed-top">
    <?php if ($_SESSION['isConfirmed'] == 0 && !strchr(basename($_SERVER['REQUEST_URI']),"confirm")): ?>
    <div class="alert alert-danger alert-dismissible" role="alert" style="padding: 0;
                                                                          margin: auto;
                                                                          text-align: center">

        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="right: 11px;">
               <span aria-hidden=" true ">&times;</span>
        </button>

        <a class="alert-link " href="<?=URL_ROOT ?>auth/confirmation"> 
           You don't confirm your email! please confirm it now
        </a>
    </div>
    <?php endif; ?>
    <div class="row items_icons reset-margin">
        <div class="col-md-3 col-xs-5 page-title">
            <button id="show-menubar" class="button-menu">
                <i class="fa fa-bars fa-2x"></i>
            </button>
            <span><?=$data["page_title"]?></span>
        </div>
        <!-- Liste items container Start -->
        <div class="col-md-4 col-xs-7 col-md-push-5 list_items ">
            <ul class="nav navbar-nav navbar-right reset-margin">
                <li class="dropdown notifications" id="notif-btn">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bell fa-2x"></i>
                    </a>
                    <ul class="dropdown-menu reset-padding" id="notif-list">
                        <div class="loader lodear-sm"></div>
                        <div class="see_more_notif text-center">
                            <a href="<?=URL_ROOT?>notifications">Voir tous</a>
                        </div>
                    </ul>
                </li>
                <li class="dropdown messages">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-envelope fa-2x"></i>
                            </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">message1</a></li>
                        <li><a href="#">message2</a></li>
                        <li><a href="#">message3</a></li>
                        <li><a href="#">message4</a></li>
                        <li><a href="#">message5</a></li>
                        <li><a href="#">message6</a></li>
                        <li><a href="#">message7</a></li>
                        <li><a href="#">message8</a></li>
                    </ul>
                </li>
                <li class="dropdown list_gestion">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-chevron-down fa-2x"></i>
                            </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Setting</a></li>
                        <li><a href="<?= URL_ROOT ?>users/logout">Log out</a></li>
                        <li><a href="#">Signialer un prblm</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </li>
            </ul>

        </div>
        <!-- Liste items container End -->
        <!-- search container Start -->
        <div class="col-md-5 col-md-pull-4 col-xs-12 search_container">
            <form class="navbar-form navbar-left">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Rechercher" aria-describedby="basic-addon1">
                    <span class="input-group-addon" id="basic-addon1">
                         <button type="submit">
                              <i class="fa fa-search"></i>
                         </button>
                      </span>
                </div>
            </form>
        </div>
        <!-- search container Start -->
    </div>
</nav>
