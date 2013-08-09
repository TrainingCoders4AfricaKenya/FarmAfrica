<?php
/* @var $this UserGroupMappingsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Group Mappings',
);

$this->menu=array(
	array('label'=>'Create UserGroupMappings', 'url'=>array('create')),
	array('label'=>'Manage UserGroupMappings', 'url'=>array('admin')),
);
?>

<h1>User Group Mappings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
