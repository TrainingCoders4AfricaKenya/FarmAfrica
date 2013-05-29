<?php
/* @var $this UsersController */
/* @var $model RUsers */

$this->breadcrumbs=array(
	Yii::t(Yii::app()->language, 'users')=>array('admin'),
	$model->userID,
);

$this->menu=array(
	array('label' => Yii::t(Yii::app()->language, 'createUsers'), 'url' => array('create')),
	array('label' => Yii::t(Yii::app()->language, 'updateUsers'), 'url' => array('update', 'id'=>$model->userID)),
	array('label' => Yii::t(Yii::app()->language, 'deleteUsers'), 'url' => array('delete', 'id'=>$model->userID)),
	array('label' => Yii::t(Yii::app()->language, 'manageUsers'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t(Yii::app()->language, 'viewUsers'); ?></h1>

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
