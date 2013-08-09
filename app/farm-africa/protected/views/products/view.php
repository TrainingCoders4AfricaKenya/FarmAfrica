<?php
/* @var $this ProductsController */
/* @var $model RProducts */

$this->breadcrumbs=array(
	Yii::t(Yii::app()->language, 'products')=>array('admin'),
	$model->productID,
);

$this->menu=array(
	array('label' => Yii::t(Yii::app()->language, 'createProducts'), 'url' => array('create')),
	array('label' => Yii::t(Yii::app()->language, 'updateProducts'), 'url' => array('update', 'id'=>$model->productID)),
	array('label' => Yii::t(Yii::app()->language, 'deleteProducts'), 'url' => array('delete', 'id'=>$model->productID)),
	array('label' => Yii::t(Yii::app()->language, 'manageProducts'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t(Yii::app()->language, 'viewProducts'); ?></h1>

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
