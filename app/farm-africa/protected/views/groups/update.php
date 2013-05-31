<?php
/* @var $this GroupsController */
/* @var $model RGroups */

$this->breadcrumbs=array(
	Yii::t(Yii::app()->language, 'groups')=>array('admin'),
	$model->groupID=>array('view','id'=>$model->groupID),
	Yii::t(Yii::app()->language, 'update'),
);

$this->menu=array(
	array('label' => Yii::t(Yii::app()->language, 'createGroups'), 'url' => array('create')),
	array('label' => Yii::t(Yii::app()->language, 'viewGroups'), 'url' => array('view', 'id'=>$model->groupID)),
	array('label' => Yii::t(Yii::app()->language, 'deleteGroups'), 'url' => array('delete', 'id'=>$model->groupID)),
	array('label' => Yii::t(Yii::app()->language, 'manageGroups'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t(Yii::app()->language, 'updateGroups'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>