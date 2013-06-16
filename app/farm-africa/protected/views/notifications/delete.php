<?php
/* @var $this NotificationsController */
/* @var $model RNotifications */
$this->breadcrumbs=array(
	Yii::t(Yii::app()->language, 'notifications')=>array('admin'),
	$model->notificationID=>array('view','id'=>$model->notificationID),
	Yii::t(Yii::app()->language, 'delete'),
);

$this->menu=array(
	array('label' => Yii::t(Yii::app()->language, 'createNotifications'), 'url' => array('create')),
	array('label' => Yii::t(Yii::app()->language, 'viewNotifications'), 'url' => array('view', 'id'=>$model->notificationID)),
	array('label' => Yii::t(Yii::app()->language, 'updateNotifications'), 'url' => array('update', 'id'=>$model->notificationID)),
	array('label' => Yii::t(Yii::app()->language, 'manageNotifications'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t(Yii::app()->language, 'deleteNotifications'); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'htmlOptions'=>array('class'=>'table table-striped table-hover table-bordered resize-th'),
	'data'=>$model,
	'attributes'=>array(
		'notificationID',
		'notificationTypeID',
		'message',
		'destinationAddress',
		'messageDetails',
		'status_.entityStateName',
		'dateCreated',
		'dateModified',
		'createdBy_.userName',
		'modifiedBy_.userName',
	),
)); ?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'notifications-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

<div style="text-align:center">
	<div><br/>
		<?php echo $form->labelEx($model, 'narration'); ?>
<br/>
		<?php echo $form->textArea($model, 'narration', array('rows' => 2, 'cols' => 50)); ?>
		<?php echo $form->error($model,'narration'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Delete', array('class' => 'btn btn-danger')); ?>
	</div>
</div>
<?php $this->endWidget(); ?>

</div><!-- form -->