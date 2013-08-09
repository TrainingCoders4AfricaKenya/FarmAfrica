<?php
/* @var $this InboundMessagesController */
/* @var $model RInboundMessages */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'inboundMessageID'); ?>
		<?php echo $form->textField($model,'inboundMessageID',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sourceAddress'); ?>
		<?php echo $form->textField($model,'sourceAddress',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'messageContent'); ?>
		<?php echo $form->textArea($model,'messageContent',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'externalTransactionID'); ?>
		<?php echo $form->textField($model,'externalTransactionID',array('size'=>60,'maxlength'=>250)); ?>
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