<?php
/* @var $this InboundMessagesController */
/* @var $model InboundMessages */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'inbound-messages-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'sourceAddress'); ?>
		<?php echo $form->textField($model,'sourceAddress',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'sourceAddress'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'messageContent'); ?>
		<?php echo $form->textArea($model,'messageContent',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'messageContent'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'externalTransactionID'); ?>
		<?php echo $form->textField($model,'externalTransactionID',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'externalTransactionID'); ?>
	</div>

	<div class="row buttons row-fluid btn-group">
		<?php echo CHtml::submitButton($model->isNewResource ? 'Create' : 'Save', array('class' => 'btn btn-info')); ?>
		<a href="<?php echo Yii::app()->request->urlReferrer; ?>" class="btn"> Cancel </a>	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->