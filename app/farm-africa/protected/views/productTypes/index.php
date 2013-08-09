<?php
/* @var $this ProductTypesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Product Types',
);

$this->menu=array(
	array('label'=>'Create ProductTypes', 'url'=>array('create')),
	array('label'=>'Manage ProductTypes', 'url'=>array('admin')),
);
?>

<h1>Product Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
