<?php
/* @var $this TransactionsController */
/* @var $model RTransactions */
$this->breadcrumbs=array(
	Yii::t(Yii::app()->language, 'transactions')=>array('admin'),
	$model->transactionID=>array('view','id'=>$model->transactionID),
	Yii::t(Yii::app()->language, 'delete'),
);

$this->menu=array(
	array('label' => Yii::t(Yii::app()->language, 'createTransactions'), 'url' => array('create')),
	array('label' => Yii::t(Yii::app()->language, 'viewTransactions'), 'url' => array('view', 'id'=>$model->transactionID)),
	array('label' => Yii::t(Yii::app()->language, 'updateTransactions'), 'url' => array('update', 'id'=>$model->transactionID)),
	array('label' => Yii::t(Yii::app()->language, 'manageTransactions'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t(Yii::app()->language, 'deleteTransactions'); ?></h1>

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

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'transactions-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

<div style="text-align:center">
	<div><br/>
		<?php echo $form->labelEx($model, 'narration'); ?>
<br/>
		<?php echo $form->textArea($model, 'narration', array('rows' => 2, 'cols' => 50)); ?>
		<?php echo $form->error($model,'narration'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Delete', array('class' => 'btn btn-danger')); ?>
	</div>
</div>
<?php $this->endWidget(); ?>

</div><!-- form -->