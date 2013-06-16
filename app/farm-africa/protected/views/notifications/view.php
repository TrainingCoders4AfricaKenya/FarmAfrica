<?php
/* @var $this NotificationsController */
/* @var $model RNotifications */

$this->breadcrumbs=array(
	Yii::t(Yii::app()->language, 'notifications')=>array('admin'),
	$model->notificationID,
);

$this->menu=array(
	array('label' => Yii::t(Yii::app()->language, 'createNotifications'), 'url' => array('create')),
	array('label' => Yii::t(Yii::app()->language, 'updateNotifications'), 'url' => array('update', 'id'=>$model->notificationID)),
	array('label' => Yii::t(Yii::app()->language, 'deleteNotifications'), 'url' => array('delete', 'id'=>$model->notificationID)),
	array('label' => Yii::t(Yii::app()->language, 'manageNotifications'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t(Yii::app()->language, 'viewNotifications'); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'htmlOptions'=>array('class'=>'table table-striped table-hover table-bordered resize-th'),
	'data'=>$model,
	'attributes'=>array(
		'notificationID',
		'notificationTypeID',
                'fk_notificationTypeID_notificationTypeName',
		'message',
		'destinationAddress',
		'messageDetails',            
                'fk_status_statusDesc',
		'dateCreated',
		'dateModified',
		'createdBy_.userName',
		'modifiedBy_.userName',
	),
)); ?>
