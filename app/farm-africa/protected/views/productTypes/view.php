<?php
/* @var $this ProductTypesController */
/* @var $model RProductTypes */

$this->breadcrumbs=array(
	Yii::t(Yii::app()->language, 'product Types')=>array('admin'),
	$model->productTypeID,
);

$this->menu=array(
	array('label' => Yii::t(Yii::app()->language, 'createProductTypes'), 'url' => array('create')),
	array('label' => Yii::t(Yii::app()->language, 'updateProductTypes'), 'url' => array('update', 'id'=>$model->productTypeID)),
	array('label' => Yii::t(Yii::app()->language, 'deleteProductTypes'), 'url' => array('delete', 'id'=>$model->productTypeID)),
	array('label' => Yii::t(Yii::app()->language, 'manageProductTypes'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t(Yii::app()->language, 'viewProductTypes'); ?></h1>

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
