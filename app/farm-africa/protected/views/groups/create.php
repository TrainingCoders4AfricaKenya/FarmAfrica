<?php
/* @var $this GroupsController */
/* @var $model RGroups */

$this->breadcrumbs=array(
	Yii::t(Yii::app()->language, 'groups')=>array('admin'),
	Yii::t(Yii::app()->language, 'create'),
);

$this->menu=array(
	array('label' => Yii::t(Yii::app()->language, 'manageGroups'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t(Yii::app()->language, 'createGroups'); ?></h1>
<?php 
Utils::displayFlashMessage();
?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>