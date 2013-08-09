<?php
/* @var $this InboundMessagesController */
/* @var $model RInboundMessages */
$this->breadcrumbs=array(
	Yii::t(Yii::app()->language, 'inbound Messages')=>array('admin'),
	$model->inboundMessageID=>array('view','id'=>$model->inboundMessageID),
	Yii::t(Yii::app()->language, 'delete'),
);

$this->menu=array(
	array('label' => Yii::t(Yii::app()->language, 'createInboundMessages'), 'url' => array('create')),
	array('label' => Yii::t(Yii::app()->language, 'viewInboundMessages'), 'url' => array('view', 'id'=>$model->inboundMessageID)),
	array('label' => Yii::t(Yii::app()->language, 'updateInboundMessages'), 'url' => array('update', 'id'=>$model->inboundMessageID)),
	array('label' => Yii::t(Yii::app()->language, 'manageInboundMessages'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t(Yii::app()->language, 'deleteInboundMessages'); ?></h1>

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

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'inbound-messages-form',
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