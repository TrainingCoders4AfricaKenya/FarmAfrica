<?php
/* @var $this ProductsController */
/* @var $model RProducts */

$this->breadcrumbs=array(
	Yii::t(Yii::app()->language, 'products')=>array('admin'),
	$model->productID=>array('view','id'=>$model->productID),
	Yii::t(Yii::app()->language, 'update'),
);

$this->menu=array(
	array('label' => Yii::t(Yii::app()->language, 'createProducts'), 'url' => array('create')),
	array('label' => Yii::t(Yii::app()->language, 'viewProducts'), 'url' => array('view', 'id'=>$model->productID)),
	array('label' => Yii::t(Yii::app()->language, 'deleteProducts'), 'url' => array('delete', 'id'=>$model->productID)),
	array('label' => Yii::t(Yii::app()->language, 'manageProducts'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t(Yii::app()->language, 'updateProducts'); ?></h1>

<?php
Utils::displayFlashMessage();
?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>