<?php
/* @var $this ProductTypesController */
/* @var $model RProductTypes */

$this->breadcrumbs=array(
	Yii::t(Yii::app()->language, 'product Types')=>array('admin'),
	Yii::t(Yii::app()->language, 'create'),
);

$this->menu=array(
	array('label' => Yii::t(Yii::app()->language, 'manageProductTypes'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t(Yii::app()->language, 'createProductTypes'); ?></h1>

<?php
Utils::displayFlashMessage();
?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>