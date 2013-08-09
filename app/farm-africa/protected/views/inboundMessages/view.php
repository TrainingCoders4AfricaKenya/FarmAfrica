<?php
/* @var $this InboundMessagesController */
/* @var $model RInboundMessages */

$this->breadcrumbs=array(
	Yii::t(Yii::app()->language, 'inbound Messages')=>array('admin'),
	$model->inboundMessageID,
);

$this->menu=array(
//	array('label' => Yii::t(Yii::app()->language, 'createInboundMessages'), 'url' => array('create')),
//	array('label' => Yii::t(Yii::app()->language, 'updateInboundMessages'), 'url' => array('update', 'id'=>$model->inboundMessageID)),
//	array('label' => Yii::t(Yii::app()->language, 'deleteInboundMessages'), 'url' => array('delete', 'id'=>$model->inboundMessageID)),
	array('label' => Yii::t(Yii::app()->language, 'manageInboundMessages'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t(Yii::app()->language, 'viewInboundMessages'); ?></h1>

<?php
Utils::displayFlashMessage();
?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'htmlOptions'=>array('class'=>'table table-striped table-hover table-bordered resize-th'),
	'data'=>$model,
	'attributes'=>array(
		'inboundMessageID',
		'sourceAddress',
		'messageContent',
		'externalTransactionID',
		'status_.entityStateName',
		'dateCreated',
		'dateModified',
	),
)); ?>
