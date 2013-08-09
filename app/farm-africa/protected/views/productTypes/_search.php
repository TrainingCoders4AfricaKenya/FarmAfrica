<?php
/* @var $this ProductTypesController */
/* @var $model RProductTypes */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'productTypeID'); ?>
		<?php echo $form->textField($model,'productTypeID',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'productTypeName'); ?>
		<?php echo $form->textField($model,'productTypeName',array('size'=>45,'maxlength'=>45)); ?>
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