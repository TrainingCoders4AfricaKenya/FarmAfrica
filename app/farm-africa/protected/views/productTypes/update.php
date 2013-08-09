<?php
/* @var $this ProductTypesController */
/* @var $model RProductTypes */

$this->breadcrumbs=array(
	Yii::t(Yii::app()->language, 'product Types')=>array('admin'),
	$model->productTypeID=>array('view','id'=>$model->productTypeID),
	Yii::t(Yii::app()->language, 'update'),
);

$this->menu=array(
	array('label' => Yii::t(Yii::app()->language, 'createProductTypes'), 'url' => array('create')),
	array('label' => Yii::t(Yii::app()->language, 'viewProductTypes'), 'url' => array('view', 'id'=>$model->productTypeID)),
	array('label' => Yii::t(Yii::app()->language, 'deleteProductTypes'), 'url' => array('delete', 'id'=>$model->productTypeID)),
	array('label' => Yii::t(Yii::app()->language, 'manageProductTypes'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t(Yii::app()->language, 'updateProductTypes'); ?></h1>

<?php
Utils::displayFlashMessage();
?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>