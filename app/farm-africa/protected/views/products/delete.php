<?php
/* @var $this ProductsController */
/* @var $model RProducts */
$this->breadcrumbs=array(
	Yii::t(Yii::app()->language, 'products')=>array('admin'),
	$model->productID=>array('view','id'=>$model->productID),
	Yii::t(Yii::app()->language, 'delete'),
);

$this->menu=array(
	array('label' => Yii::t(Yii::app()->language, 'createProducts'), 'url' => array('create')),
	array('label' => Yii::t(Yii::app()->language, 'viewProducts'), 'url' => array('view', 'id'=>$model->productID)),
	array('label' => Yii::t(Yii::app()->language, 'updateProducts'), 'url' => array('update', 'id'=>$model->productID)),
	array('label' => Yii::t(Yii::app()->language, 'manageProducts'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t(Yii::app()->language, 'deleteProducts'); ?></h1>

<?php
Utils::displayFlashMessage();
?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'htmlOptions'=>array('class'=>'table table-striped table-hover table-bordered resize-th'),
	'data'=>$model,
	'attributes'=>array(
		'productID',
		'productName',
		'description',
		'productTypeID',
		'status_.entityStateName',
		'dateCreated',
		'createdBy_.userName',
		'dateModified',
		'modifiedBy_.userName',
	),
)); ?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'products-form',
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