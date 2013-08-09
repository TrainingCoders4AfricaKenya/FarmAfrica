<?php
/* @var $this UserGroupMappingsController */
/* @var $model UserGroupMappings */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'user-group-mappings-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'userID'); ?>
		<?php echo $form->textField($model,'userID',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'userID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'groupID'); ?>
		<?php echo $form->textField($model,'groupID',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'groupID'); ?>
	</div>

	<div class="row buttons row-fluid btn-group">
		<?php echo CHtml::submitButton($model->isNewResource ? 'Create' : 'Save', array('class' => 'btn btn-info')); ?>
		<a href="<?php echo Yii::app()->request->urlReferrer; ?>" class="btn"> Cancel </a>	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->