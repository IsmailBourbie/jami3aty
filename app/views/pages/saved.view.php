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
            <div class="saved">
               <?php foreach ($responses as $response): ?>
                   <div class="saved_mold">
                       <div class="left">
                           <a href="#" class='header'>
                               <div class="icon">
                                   <i class="fa fa-bookmark fa-3x"></i>
                               </div>
                               <div class="info">
                                   <h3 class="reset-margin"><?= $response->title ?></h3>
                                   <div class="description">
                                       <h4><?= \App\Classes\Helper::typeOfPostToString($response->type); ?></h4>
                                       <span class="separitor">.</span>
                                       <span class="time"><?= Time::formatTime($response->date_post) ?></span>
                                   </div>
                               </div>
                           </a>
                           <div class="body">
                               <p class="lead"><?= $response->text_post ?></p>
                           </div>
                       </div>
                       <div class="right">
                           <a href="<?= URL_ROOT ?>saved/state/0/<?= $response->_id_post ?>" title="unsaved"><i
                                       class="fa fa-times"></i></a>
                       </div>
                   </div>
               <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<?php require_once APP_ROOT . '/views/inc/js_inc.php'; ?>
<?php require_once APP_ROOT . '/views/inc/footer.php'; ?>
