<?php
/* @var $this NotificationsController */
/* @var $model RNotifications */

$this->breadcrumbs=array(
	Yii::t(Yii::app()->language, 'notifications')=>array('admin'),
	$model->notificationID=>array('view','id'=>$model->notificationID),
	Yii::t(Yii::app()->language, 'update'),
);

$this->menu=array(
	array('label' => Yii::t(Yii::app()->language, 'createNotifications'), 'url' => array('create')),
	array('label' => Yii::t(Yii::app()->language, 'viewNotifications'), 'url' => array('view', 'id'=>$model->notificationID)),
	array('label' => Yii::t(Yii::app()->language, 'deleteNotifications'), 'url' => array('delete', 'id'=>$model->notificationID)),
	array('label' => Yii::t(Yii::app()->language, 'manageNotifications'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t(Yii::app()->language, 'updateNotifications'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>