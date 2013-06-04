<?php
/* @var $this GroupsController */
/* @var $model RGroups */
$this->breadcrumbs=array(
	Yii::t(Yii::app()->language, 'groups')=>array('admin'),
	$model->groupID=>array('view','id'=>$model->groupID),
	Yii::t(Yii::app()->language, 'delete'),
);

$this->menu=array(
	array('label' => Yii::t(Yii::app()->language, 'createGroups'), 'url' => array('create')),
	array('label' => Yii::t(Yii::app()->language, 'viewGroups'), 'url' => array('view', 'id'=>$model->groupID)),
	array('label' => Yii::t(Yii::app()->language, 'updateGroups'), 'url' => array('update', 'id'=>$model->groupID)),
	array('label' => Yii::t(Yii::app()->language, 'manageGroups'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t(Yii::app()->language, 'deleteGroups'); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'htmlOptions'=>array('class'=>'table table-striped table-hover table-bordered resize-th'),
	'data'=>$model,
	'attributes'=>array(
		'groupID',
		'groupName',
		'description',
		'status_.entityStateName',
		'dateCreated',
		'createdBy_.userName',
		'dateModified',
		'modifiedBy_.userName',
	),
)); ?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'groups-form',
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