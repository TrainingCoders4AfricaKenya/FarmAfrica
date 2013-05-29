<?php
/* @var $this UsersController */
/* @var $model RUsers */
$this->breadcrumbs=array(
	Yii::t(Yii::app()->language, 'users')=>array('admin'),
	$model->userID=>array('view','id'=>$model->userID),
	Yii::t(Yii::app()->language, 'delete'),
);

$this->menu=array(
	array('label' => Yii::t(Yii::app()->language, 'createUsers'), 'url' => array('create')),
	array('label' => Yii::t(Yii::app()->language, 'viewUsers'), 'url' => array('view', 'id'=>$model->userID)),
	array('label' => Yii::t(Yii::app()->language, 'updateUsers'), 'url' => array('update', 'id'=>$model->userID)),
	array('label' => Yii::t(Yii::app()->language, 'manageUsers'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t(Yii::app()->language, 'deleteUsers'); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
        'htmlOptions'=>array('class'=>'table table-striped table-hover table-bordered resize-th'),
	'data'=>$model,
	'attributes'=>array(
		'userID',
		'userName',
		'firstName',
		'lastName',
		'emailAddress',
		'phoneNumber',
		'status_.entityStateName',
		'dateCreated',
		'createdBy_.userName',
		'dateModified',
		'modifiedBy_.userName',
	),
)); ?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
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