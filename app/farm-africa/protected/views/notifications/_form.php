<?php
/* @var $this NotificationsController */
/* @var $model Notifications */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'notifications-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'notificationTypeID'); ?>
		<?php echo $form->textField($model,'notificationTypeID',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'notificationTypeID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'message'); ?>
		<?php echo $form->textArea($model,'message',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'message'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'destinationAddress'); ?>
		<?php echo $form->textField($model,'destinationAddress',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'destinationAddress'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'messageDetails'); ?>
		<?php echo $form->textArea($model,'messageDetails',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'messageDetails'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewResource ? 'Create' : 'Save', array('class' => 'btn btn-info')); ?>
		<a href="<?php echo Yii::app()->request->urlReferrer; ?>" class="btn"> Cancel </a>	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->