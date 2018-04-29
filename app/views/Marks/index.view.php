<?php
require_once APP_ROOT . '/views/inc/css_inc.php';
require_once APP_ROOT . '/views/inc/header.php';
$marks = $data["data"];
$minus_font = "<i class='fa fa-minus text-red'></i>"
//die(var_dump($marks));
?>
    <div class="row reset-margin">
        <div class="aside-left reset-padding">
            <?php require_once APP_ROOT . '/views/inc/navigation-bar.php'; ?>
        </div>
        <div class="content">
            <?php require_once APP_ROOT . '/views/inc/nav.php'; ?>
            <div class="main">
                <div class="marks">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="text-center">
                                <tr>
                                    <th><i class="fa fa-hashtag"></i></th>
                                    <th>Examn</th>
                                    <th>TD</th>
                                    <th>TP</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($marks as $mark): ?>
                                <tr>
                                    <td class="module_name"><strong><?= $mark->title ?></strong></td>
                                    <td class="examn_mark">
                                        <?php if (is_null($mark->course_mark)) echo $minus_font;
                                   echo $mark->course_mark ?>
                                    </td>
                                    <td class="td_mark">
                                        <?php if (is_null($mark->td_mark)) echo $minus_font;
                                   echo $mark->td_mark ?>
                                    </td>
                                    <td class="tp_mark">
                                        <?php if (is_null($mark->tp_mark)) echo $minus_font;
                                   echo $mark->tp_mark ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once APP_ROOT . '/views/inc/js_inc.php'; ?>
        <script src="<?= URL_ROOT ?>js/plugins-mails.js"></script>
        <?php require_once APP_ROOT . '/views/inc/footer.php'; ?>
