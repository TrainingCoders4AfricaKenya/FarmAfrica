<?php
/* @var $this InboundMessagesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Inbound Messages',
);

$this->menu=array(
	array('label'=>'Create InboundMessages', 'url'=>array('create')),
	array('label'=>'Manage InboundMessages', 'url'=>array('admin')),
);
?>

<h1>Inbound Messages</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
