<?php
/* @var $this UserGroupMappingsController */
/* @var $model RUserGroupMappings */

$this->breadcrumbs=array(
	Yii::t(Yii::app()->language, 'user Group Mappings')=>array('admin'),
	$model->userGroupMappingID=>array('view','id'=>$model->userGroupMappingID),
	Yii::t(Yii::app()->language, 'update'),
);

$this->menu=array(
	array('label' => Yii::t(Yii::app()->language, 'createUserGroupMappings'), 'url' => array('create')),
	array('label' => Yii::t(Yii::app()->language, 'viewUserGroupMappings'), 'url' => array('view', 'id'=>$model->userGroupMappingID)),
	array('label' => Yii::t(Yii::app()->language, 'deleteUserGroupMappings'), 'url' => array('delete', 'id'=>$model->userGroupMappingID)),
	array('label' => Yii::t(Yii::app()->language, 'manageUserGroupMappings'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t(Yii::app()->language, 'updateUserGroupMappings'); ?></h1>
<?php
Utils::displayFlashMessage();
?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>