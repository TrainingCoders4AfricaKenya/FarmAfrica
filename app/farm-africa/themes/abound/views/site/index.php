<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
$baseUrl = Yii::app()->theme->baseUrl;
?>

<?php
if (Yii::app()->user->isGuest && $this->action != 'signup') {
    $this->redirect(array('login'));
    ?>
    <?php
}
else {
    ?>
    
    <?php
}
?>

