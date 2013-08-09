<?php
/* @var $this ProductTypesController */
/* @var $model ProductTypes */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'product-types-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'productTypeName'); ?>
		<?php echo $form->textField($model,'productTypeName',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'productTypeName'); ?>
	</div>

	<div class="row buttons row-fluid btn-group">
		<?php echo CHtml::submitButton($model->isNewResource ? 'Create' : 'Save', array('class' => 'btn btn-info')); ?>
		<a href="<?php echo Yii::app()->request->urlReferrer; ?>" class="btn"> Cancel </a>	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->