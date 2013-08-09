<?php
/* @var $this UserGroupMappingsController */
/* @var $model RUserGroupMappings */

$this->breadcrumbs=array(
	Yii::t(Yii::app()->language, 'user Group Mappings')=>array('admin'),
	$model->userGroupMappingID,
);

$this->menu=array(
	array('label' => Yii::t(Yii::app()->language, 'createUserGroupMappings'), 'url' => array('create')),
	array('label' => Yii::t(Yii::app()->language, 'updateUserGroupMappings'), 'url' => array('update', 'id'=>$model->userGroupMappingID)),
	array('label' => Yii::t(Yii::app()->language, 'deleteUserGroupMappings'), 'url' => array('delete', 'id'=>$model->userGroupMappingID)),
	array('label' => Yii::t(Yii::app()->language, 'manageUserGroupMappings'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t(Yii::app()->language, 'viewUserGroupMappings'); ?></h1>
<?php
Utils::displayFlashMessage();
?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'htmlOptions'=>array('class'=>'table table-striped table-hover table-bordered resize-th'),
	'data'=>$model,
	'attributes'=>array(
		'userGroupMappingID',
		'userID',
		'groupID',
		'status_.entityStateName',
		'dateCreated',
		'createdBy_.userName',
		'dateModified',
		'modifiedBy_.userName',
	),
)); ?>
