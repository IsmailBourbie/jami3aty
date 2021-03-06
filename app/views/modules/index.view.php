<?php
require_once APP_ROOT . '/views/inc/css_inc.php';
require_once APP_ROOT . '/views/inc/header.php';
if ($data["status"] == OK) {
   $responses = $data["data"];
} else {
   $responses = array();
}
?>
<?php require_once APP_ROOT . '/views/inc/header.php'; ?>
<div class="row reset-margin">
    <div class="aside-left reset-padding">
       <?php require_once APP_ROOT . '/views/inc/navigation-bar.php'; ?>
    </div>
    <div class="content">
       <?php require_once APP_ROOT . '/views/inc/nav.php'; ?>
        <div class="main">
            <div class="modules">
                <div class="row reset-margin">

                   <?php foreach ($responses as $response): ?>

                       <div class="col-lg-5 card_mold">
                           <div class="front">
                               <div class="header">
                                   <div class="circle">
                                      <?= $response->short_title ?>
                                   </div>
                               </div>
                               <div class="body">
                                   <h3>
                                      <?= $response->title ?>
                                   </h3>
                                   <ul class="list-unstyled reset-margin description"
                                      <?php if (Session::isProf()) echo 'style="margin-bottom: 50px !important;"'?>>
                                      <?php if (Session::isProf()): ?>
                                          <li>Level<span class="pull-right">
                                                  <?=\App\Classes\Helper::levelToString($response->level, "")?>
                                        </span></li>
                                      <?php else: ?>
                                          <li>Enseignant de cours<span class="pull-right">
                                        <?php
                                        if (isset($response->course_prof)) {
                                           echo $response->course_prof;
                                        } else {
                                           echo "No Course";
                                        }
                                        ?></span></li>
                                          <li>Enseignant de TD<span class="pull-right">
                                        <?php
                                        if (isset($response->td_prof)) {
                                           echo $response->td_prof;
                                        } else {
                                           echo "No TD";
                                        }
                                        ?></span></li>
                                          <li>Enseignant de TP<span class="pull-right">
                                        <?php
                                        if (isset($response->tp_prof)) {
                                           echo $response->tp_prof;
                                        } else {
                                           echo "No TP";
                                        }
                                        ?></span></li>
                                      <?php endif; ?>
                                       <li>Coefficient<span class="number pull-right">
                                        <?= $response->coefficient ?>
                                        </span></li>
                                       <li>Crédit<span class="number pull-right">
                                        <?= $response->credit ?></span></li>
                                   </ul>
                                   <span class="clickme">Hover to see Contents</span>
                               </div>
                           </div>
                           <div class="back">
                               <h3>Index:</h3>
                               <ol class="reset-margin">
                                  <?php foreach (explode("$", $response->table_of_content) as $content): ?>
                                      <li><?= $content ?></li>
                                  <?php endforeach; ?>
                               </ol>
                           </div>
                       </div>
                   <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once APP_ROOT . '/views/inc/js_inc.php'; ?>
<?php require_once APP_ROOT . '/views/inc/footer.php'; ?>
