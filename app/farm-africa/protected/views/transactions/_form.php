<?php
/* @var $this TransactionsController */
/* @var $model Transactions */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'transactions-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'serviceID'); ?>
		<?php echo $form->textField($model,'serviceID',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'serviceID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'productID'); ?>
		<?php echo $form->textField($model,'productID',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'productID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'initiatorID'); ?>
		<?php echo $form->textField($model,'initiatorID',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'initiatorID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'initiatorMSISDN'); ?>
		<?php echo $form->textField($model,'initiatorMSISDN',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'initiatorMSISDN'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'receiverID'); ?>
		<?php echo $form->textField($model,'receiverID',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'receiverID'); ?>
	</div>

	<div class="row buttons row-fluid btn-group">
		<?php echo CHtml::submitButton($model->isNewResource ? 'Create' : 'Save', array('class' => 'btn btn-info')); ?>
		<a href="<?php echo Yii::app()->request->urlReferrer; ?>" class="btn"> Cancel </a>	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->