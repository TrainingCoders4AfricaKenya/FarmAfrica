<?php
/* @var $this UsersController */
/* @var $model RUsers */

$this->breadcrumbs=array(
	Yii::t(Yii::app()->language, 'users')=>array('admin'),
	Yii::t(Yii::app()->language, 'create'),
);

$this->menu=array(
	array('label' => Yii::t(Yii::app()->language, 'manageUsers'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t(Yii::app()->language, 'createUsers'); ?></h1>

<?php 
Utils::displayFlashMessage();
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>