<?php
/* @var $this NotificationsController */
/* @var $model RNotifications */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'notificationID'); ?>
		<?php echo $form->textField($model,'notificationID',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'notificationTypeID'); ?>
		<?php echo $form->textField($model,'notificationTypeID',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'message'); ?>
		<?php echo $form->textArea($model,'message',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'destinationAddress'); ?>
		<?php echo $form->textField($model,'destinationAddress',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'messageDetails'); ?>
		<?php echo $form->textArea($model,'messageDetails',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search', array('class' => 'btn btn-info')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->