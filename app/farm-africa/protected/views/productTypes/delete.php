<?php
/* @var $this ProductTypesController */
/* @var $model RProductTypes */
$this->breadcrumbs=array(
	Yii::t(Yii::app()->language, 'product Types')=>array('admin'),
	$model->productTypeID=>array('view','id'=>$model->productTypeID),
	Yii::t(Yii::app()->language, 'delete'),
);

$this->menu=array(
	array('label' => Yii::t(Yii::app()->language, 'createProductTypes'), 'url' => array('create')),
	array('label' => Yii::t(Yii::app()->language, 'viewProductTypes'), 'url' => array('view', 'id'=>$model->productTypeID)),
	array('label' => Yii::t(Yii::app()->language, 'updateProductTypes'), 'url' => array('update', 'id'=>$model->productTypeID)),
	array('label' => Yii::t(Yii::app()->language, 'manageProductTypes'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t(Yii::app()->language, 'deleteProductTypes'); ?></h1>

<?php
Utils::displayFlashMessage();
?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'htmlOptions'=>array('class'=>'table table-striped table-hover table-bordered resize-th'),
	'data'=>$model,
	'attributes'=>array(
		'productTypeID',
		'productTypeName',
		'status_.entityStateName',
		'dateCreated',
		'createdBy_.userName',
		'dateModified',
		'modifiedBy_.userName',
	),
)); ?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-types-form',
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