<?php
/* @var $this TransactionsController */
/* @var $model RTransactions */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'transactionID'); ?>
		<?php echo $form->textField($model,'transactionID',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'serviceID'); ?>
		<?php echo $form->textField($model,'serviceID',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'productID'); ?>
		<?php echo $form->textField($model,'productID',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'initiatorID'); ?>
		<?php echo $form->textField($model,'initiatorID',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'initiatorMSISDN'); ?>
		<?php echo $form->textField($model,'initiatorMSISDN',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'receiverID'); ?>
		<?php echo $form->textField($model,'receiverID',array('size'=>11,'maxlength'=>11)); ?>
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