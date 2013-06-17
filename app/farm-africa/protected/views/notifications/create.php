<?php
/* @var $this NotificationsController */
/* @var $model RNotifications */

$this->breadcrumbs=array(
	Yii::t(Yii::app()->language, 'notifications')=>array('admin'),
	Yii::t(Yii::app()->language, 'create'),
);

$this->menu=array(
	array('label' => Yii::t(Yii::app()->language, 'manageNotifications'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t(Yii::app()->language, 'createNotifications'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>