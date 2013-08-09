<?php
/* @var $this TransactionsController */
/* @var $model RTransactions */

$this->breadcrumbs=array(
	Yii::t(Yii::app()->language, 'transactions')=>array('admin'),
	$model->transactionID,
);

$this->menu=array(
	array('label' => Yii::t(Yii::app()->language, 'createTransactions'), 'url' => array('create')),
	array('label' => Yii::t(Yii::app()->language, 'updateTransactions'), 'url' => array('update', 'id'=>$model->transactionID)),
	array('label' => Yii::t(Yii::app()->language, 'deleteTransactions'), 'url' => array('delete', 'id'=>$model->transactionID)),
	array('label' => Yii::t(Yii::app()->language, 'manageTransactions'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t(Yii::app()->language, 'viewTransactions'); ?></h1>

<?php
Utils::displayFlashMessage();
?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'htmlOptions'=>array('class'=>'table table-striped table-hover table-bordered resize-th'),
	'data'=>$model,
	'attributes'=>array(
		'transactionID',
		'serviceID',
		'productID',
		'initiatorID',
		'initiatorMSISDN',
		'receiverID',
		'status_.entityStateName',
		'dateCreated',
		'dateModified',
	),
)); ?>
