<?php
/* @var $this GroupsController */
/* @var $model RGroups */

$this->breadcrumbs=array(
	Yii::t(Yii::app()->language, 'groups')=>array('admin'),
	$model->groupID,
);

$this->menu=array(
	array('label' => Yii::t(Yii::app()->language, 'createGroups'), 'url' => array('create')),
	array('label' => Yii::t(Yii::app()->language, 'updateGroups'), 'url' => array('update', 'id'=>$model->groupID)),
	array('label' => Yii::t(Yii::app()->language, 'deleteGroups'), 'url' => array('delete', 'id'=>$model->groupID)),
	array('label' => Yii::t(Yii::app()->language, 'manageGroups'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t(Yii::app()->language, 'viewGroups'); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'htmlOptions'=>array('class'=>'table table-striped table-hover table-bordered resize-th'),
	'data'=>$model,
	'attributes'=>array(
		'groupID',
		'groupName',
		'description',
		'status_.entityStateName',
		'dateCreated',
		'createdBy_.userName',
		'dateModified',
		'modifiedBy_.userName',
	),
)); ?>
