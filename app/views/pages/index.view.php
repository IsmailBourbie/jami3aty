<?php
require_once APP_ROOT . '/views/inc/header.php';
?>
    <div class="row">

        <div class="col-lg-3  col-md-12 aside-right">
            <div class="calnedar">
                <div class="aside-content">
                    <div class="ma_journee">
                        <a class="btn btn-default btn-block" role="button"
                           data-toggle="collapse" href="#ma_journee"
                           aria-expanded="false" aria-controls="ma_journee">
                            Ma Journée Universitaire
                        </a>
                        <div class="collapse in" id="ma_journee">
                            <div class="well">
                                <ul class="list-unstyled">
                                    <li>
                                        <h4>08:00 - 09:30</h4>
                                        <p>Coure Compilation à l'amphi A</p>
                                    </li>
                                    <li>
                                        <h4>09:30 - 11:00</h4>
                                        <p>TD à la salle 11</p>
                                    </li>
                                    <li>
                                        <h4>11:00 - 12:30</h4>
                                        <p>TP IHM labo 4</p>
                                    </li>
                                    <li>
                                        <h4>14:00 - 15:30</h4>
                                        <p>Vide</p>
                                    </li>
                                    <li>
                                        <h4>15:30 - 17:00</h4>
                                        <p>Coure l'amphi B</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3  col-md-12 aside-left">
           <?php
           require_once APP_ROOT . '/views/inc/navigation-bar.php';
           ?>
        </div>
        <div class="col-lg-6  col-md-12 main">
            <div class="welcom_day">

            </div>
            <div class="publication_mold"></div>
            <div class="publication_mold"></div>
            <div class="publication_mold"></div>
            <div class="publication_mold"></div>
            <div class="publication_mold"></div>
            <div class="publication_mold"></div>
            <div class="publication_mold"></div>
            <div class="publication_mold"></div>
        </div>

    </div>

<?php
require_once APP_ROOT . '/views/inc/footer.php';
?>