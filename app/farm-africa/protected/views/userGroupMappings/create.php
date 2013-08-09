<?php
/* @var $this UserGroupMappingsController */
/* @var $model RUserGroupMappings */

$this->breadcrumbs=array(
	Yii::t(Yii::app()->language, 'user Group Mappings')=>array('admin'),
	Yii::t(Yii::app()->language, 'create'),
);

$this->menu=array(
	array('label' => Yii::t(Yii::app()->language, 'manageUserGroupMappings'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t(Yii::app()->language, 'createUserGroupMappings'); ?></h1>
<?php
Utils::displayFlashMessage();
?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>