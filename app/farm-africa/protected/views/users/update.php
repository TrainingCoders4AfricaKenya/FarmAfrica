<?php
/* @var $this UsersController */
/* @var $model RUsers */

$this->breadcrumbs=array(
	Yii::t(Yii::app()->language, 'users')=>array('admin'),
	$model->userID=>array('view','id'=>$model->userID),
	Yii::t(Yii::app()->language, 'update'),
);

$this->menu=array(
	array('label' => Yii::t(Yii::app()->language, 'createUsers'), 'url' => array('create')),
	array('label' => Yii::t(Yii::app()->language, 'viewUsers'), 'url' => array('view', 'id'=>$model->userID)),
	array('label' => Yii::t(Yii::app()->language, 'deleteUsers'), 'url' => array('delete', 'id'=>$model->userID)),
	array('label' => Yii::t(Yii::app()->language, 'manageUsers'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t(Yii::app()->language, 'updateUsers'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>