<?php
require_once APP_ROOT . '/views/inc/css_inc.php';
require_once APP_ROOT . '/views/inc/header.php';
$schedule = $data["data"];
?>
<div class="row reset-margin">
    <div class="aside-left reset-padding">
       <?php require_once APP_ROOT . '/views/inc/navigation-bar.php'; ?>
    </div>
    <div class="content">
       <?php require_once APP_ROOT . '/views/inc/nav.php'; ?>
        <div class="main">
            <div class="schedules">
                <div class="row">
                    <div class="table-responsive">
                        <div class="color-index">
                            <div class="course-c">
                                <span class="square"></span>
                                <span>Cours</span>
                            </div>
                            <div class="td-c">
                                <span class="square"></span>
                                <span>TD</span>
                            </div>
                            <div class="tp-c">
                                <span class="square"></span>
                                <span>TP</span>
                            </div>
                            <div class="empty-c">
                                <span class="square"></span>
                                <span>Vide</span>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="time">#</th>
                                <th>Dimanche</th>
                                <th>Lundi</th>
                                <th>Mardi</th>
                                <th>Mercredi</th>
                                <th>Jeudi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="time">08h00</td>
                                <td class="type<?= $schedule[1][1]["type"] ?>">
                                    <h4><?= $schedule[1][1]["title"] ?></h4>
                                    <h5><?= $schedule[1][1]["fullName"] ?></h5>
                                    <span><?= $schedule[1][1]["place"] ?></span>
                                </td>
                                <td class="type<?= $schedule[2][1]["type"] ?>">
                                    <h4><?= $schedule[2][1]["title"] ?></h4>
                                    <h5><?= $schedule[2][1]["fullName"] ?></h5>
                                    <span><?= $schedule[2][1]["place"] ?></span>
                                </td>
                                <td class="type<?= $schedule[3][1]["type"] ?>">
                                    <h4><?= $schedule[3][1]["title"] ?></h4>
                                    <h5><?= $schedule[3][1]["fullName"] ?></h5>
                                    <span><?= $schedule[3][1]["place"] ?></span>
                                </td>
                                <td class="type<?= $schedule[4][1]["type"] ?>">
                                    <h4><?= $schedule[4][1]["title"] ?></h4>
                                    <h5><?= $schedule[4][1]["fullName"] ?></h5>
                                    <span><?= $schedule[4][1]["place"] ?></span>
                                </td>
                                <td class="type<?= $schedule[5][1]["type"] ?>">
                                    <h4><?= $schedule[5][1]["title"] ?></h4>
                                    <h5><?= $schedule[5][1]["fullName"] ?></h5>
                                    <span><?= $schedule[5][1]["place"] ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="time">09h30</td>
                                <td class="type<?= $schedule[1][2]["type"] ?>">
                                    <h4><?= $schedule[1][2]["title"] ?></h4>
                                    <h5><?= $schedule[1][2]["fullName"] ?></h5>
                                    <span><?= $schedule[1][2]["place"] ?></span>
                                </td>
                                <td class="type<?= $schedule[2][2]["type"] ?>">
                                    <h4><?= $schedule[2][2]["title"] ?></h4>
                                    <h5><?= $schedule[2][2]["fullName"] ?></h5>
                                    <span><?= $schedule[2][2]["place"] ?></span>
                                </td>
                                <td class="type<?= $schedule[3][2]["type"] ?>">
                                    <h4><?= $schedule[3][2]["title"] ?></h4>
                                    <h5><?= $schedule[3][2]["fullName"] ?></h5>
                                    <span><?= $schedule[3][2]["place"] ?></span>
                                </td>
                                <td class="type<?= $schedule[4][2]["type"] ?>">
                                    <h4><?= $schedule[4][2]["title"] ?></h4>
                                    <h5><?= $schedule[4][2]["fullName"] ?></h5>
                                    <span><?= $schedule[4][2]["place"] ?></span>
                                </td>
                                <td class="type<?= $schedule[5][2]["type"] ?>">
                                    <h4><?= $schedule[5][2]["title"] ?></h4>
                                    <h5><?= $schedule[5][2]["fullName"] ?></h5>
                                    <span><?= $schedule[5][2]["place"] ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="time">11h00</td>
                                <td class="type<?= $schedule[1][3]["type"] ?>">
                                    <h4><?= $schedule[1][3]["title"] ?></h4>
                                    <h5><?= $schedule[1][3]["fullName"] ?></h5>
                                    <span><?= $schedule[1][3]["place"] ?></span>
                                </td>
                                <td class="type<?= $schedule[2][3]["type"] ?>">
                                    <h4><?= $schedule[2][3]["title"] ?></h4>
                                    <h5><?= $schedule[2][3]["fullName"] ?></h5>
                                    <span><?= $schedule[2][3]["place"] ?></span>
                                </td>
                                <td class="type<?= $schedule[3][3]["type"] ?>">
                                    <h4><?= $schedule[3][3]["title"] ?></h4>
                                    <h5><?= $schedule[3][3]["fullName"] ?></h5>
                                    <span><?= $schedule[3][3]["place"] ?></span>
                                </td>
                                <td class="type<?= $schedule[4][3]["type"] ?>">
                                    <h4><?= $schedule[4][3]["title"] ?></h4>
                                    <h5><?= $schedule[4][3]["fullName"] ?></h5>
                                    <span><?= $schedule[4][3]["place"] ?></span>
                                </td>
                                <td class="type<?= $schedule[5][3]["type"] ?>">
                                    <h4><?= $schedule[5][3]["title"] ?></h4>
                                    <h5><?= $schedule[5][3]["fullName"] ?></h5>
                                    <span><?= $schedule[5][3]["place"] ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="time">12h30</td>
                                <td class="type<?= $schedule[1][4]["type"] ?>">
                                    <h4><?= $schedule[1][4]["title"] ?></h4>
                                    <h5><?= $schedule[1][4]["fullName"] ?></h5>
                                    <span><?= $schedule[1][4]["place"] ?></span>
                                </td>
                                <td class="type<?= $schedule[2][4]["type"] ?>">
                                    <h4><?= $schedule[2][4]["title"] ?></h4>
                                    <h5><?= $schedule[2][4]["fullName"] ?></h5>
                                    <span><?= $schedule[2][4]["place"] ?></span>
                                </td>
                                <td class="type<?= $schedule[3][4]["type"] ?>">
                                    <h4><?= $schedule[3][4]["title"] ?></h4>
                                    <h5><?= $schedule[3][4]["fullName"] ?></h5>
                                    <span><?= $schedule[3][4]["place"] ?></span>
                                </td>
                                <td class="type<?= $schedule[4][4]["type"] ?>">
                                    <h4><?= $schedule[4][4]["title"] ?></h4>
                                    <h5><?= $schedule[4][4]["fullName"] ?></h5>
                                    <span><?= $schedule[4][4]["place"] ?></span>
                                </td>
                                <td class="type<?= $schedule[5][4]["type"] ?>">
                                    <h4><?= $schedule[5][4]["title"] ?></h4>
                                    <h5><?= $schedule[5][4]["fullName"] ?></h5>
                                    <span><?= $schedule[5][4]["place"] ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="time">14h00</td>
                                <td class="type<?= $schedule[1][5]["type"] ?>">
                                    <h4><?= $schedule[1][5]["title"] ?></h4>
                                    <h5><?= $schedule[1][5]["fullName"] ?></h5>
                                    <span><?= $schedule[1][5]["place"] ?></span>
                                </td>
                                <td class="type<?= $schedule[2][5]["type"] ?>">
                                    <h4><?= $schedule[2][5]["title"] ?></h4>
                                    <h5><?= $schedule[2][5]["fullName"] ?></h5>
                                    <span><?= $schedule[2][5]["place"] ?></span>
                                </td>
                                <td class="type<?= $schedule[3][5]["type"] ?>">
                                    <h4><?= $schedule[3][5]["title"] ?></h4>
                                    <h5><?= $schedule[3][5]["fullName"] ?></h5>
                                    <span><?= $schedule[3][5]["place"] ?></span>
                                </td>
                                <td class="type<?= $schedule[4][5]["type"] ?>">
                                    <h4><?= $schedule[4][5]["title"] ?></h4>
                                    <h5><?= $schedule[4][5]["fullName"] ?></h5>
                                    <span><?= $schedule[4][5]["place"] ?></span>
                                </td>
                                <td class="type<?= $schedule[5][5]["type"] ?>">
                                    <h4><?= $schedule[5][5]["title"] ?></h4>
                                    <h5><?= $schedule[5][5]["fullName"] ?></h5>
                                    <span><?= $schedule[5][5]["place"] ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="time">15h30</td>
                                <td class="type<?= $schedule[1][6]["type"] ?>">
                                    <h4><?= $schedule[1][6]["title"] ?></h4>
                                    <h5><?= $schedule[1][6]["fullName"] ?></h5>
                                    <span><?= $schedule[1][6]["place"] ?></span>
                                </td>
                                <td class="type<?= $schedule[2][6]["type"] ?>">
                                    <h4><?= $schedule[2][6]["title"] ?></h4>
                                    <h5><?= $schedule[2][6]["fullName"] ?></h5>
                                    <span><?= $schedule[2][6]["place"] ?></span>
                                </td>
                                <td class="type<?= $schedule[3][6]["type"] ?>">
                                    <h4><?= $schedule[3][6]["title"] ?></h4>
                                    <h5><?= $schedule[3][6]["fullName"] ?></h5>
                                    <span><?= $schedule[3][6]["place"] ?></span>
                                </td>
                                <td class="type<?= $schedule[4][6]["type"] ?>">
                                    <h4><?= $schedule[4][6]["title"] ?></h4>
                                    <h5><?= $schedule[4][6]["fullName"] ?></h5>
                                    <span><?= $schedule[4][6]["place"] ?></span>
                                </td>
                                <td class="type<?= $schedule[5][6]["type"] ?>">
                                    <h4><?= $schedule[5][6]["title"] ?></h4>
                                    <h5><?= $schedule[5][6]["fullName"] ?></h5>
                                    <span><?= $schedule[5][6]["place"] ?></span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <?php require_once APP_ROOT . '/views/inc/js_inc.php'; ?>
   <?php require_once APP_ROOT . '/views/inc/footer.php'; ?>
