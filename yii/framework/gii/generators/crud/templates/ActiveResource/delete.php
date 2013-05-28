<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getARModelClass(); ?> */
<?php
$nameColumn=$this->guessNameColumn($this->tableSchema->columns);
$label=$this->pluralize($this->class2name($this->modelClass));
$lcFirstLabel = lcfirst($label);
echo "\$this->breadcrumbs=array(
	Yii::t(Yii::app()->language, '$lcFirstLabel')=>array('admin'),
	\$model->{$nameColumn}=>array('view','id'=>\$model->{$this->tableSchema->primaryKey}),
	Yii::t(Yii::app()->language, 'delete'),
);\n";
?>

$this->menu=array(
	array('label' => Yii::t(Yii::app()->language, 'create<?php echo $this->modelClass; ?>'), 'url' => array('create')),
	array('label' => Yii::t(Yii::app()->language, 'view<?php echo $this->modelClass; ?>'), 'url' => array('view', 'id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>)),
	array('label' => Yii::t(Yii::app()->language, 'update<?php echo $this->modelClass; ?>'), 'url' => array('update', 'id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>)),
	array('label' => Yii::t(Yii::app()->language, 'manage<?php echo $this->modelClass; ?>'), 'url' => array('admin')),
);
?>

<h1><?php echo "<?php echo Yii::t(Yii::app()->language, 'delete".$this->pluralize($this->class2name($this->modelClass))."'); ?>"; ?></h1>

<?php echo "<?php"; ?> $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
<?php
foreach($this->tableSchema->columns as $column)
	if(($column->name == 'modifiedBy') || ($column->name == 'createdBy')){
		echo "\t\t'".$column->name."_.userName',\n";
	}
	else if($column->name == 'status'){
		echo "\t\t'status_.entityStateName',\n";
	}
	// else if($column->name == $this->tableSchema->primaryKey){
	// 	//if this is the primary key field, do not display
	// }
	else{
		echo "\t\t'".$column->name."',\n";
	}
?>
	),
)); ?>

<div class="form">

<?php echo "<?php \$form=\$this->beginWidget('CActiveForm', array(
	'id'=>'".$this->class2id($this->modelClass)."-form',
	'enableAjaxValidation'=>false,
)); ?>\n"; ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo "<?php echo \$form->errorSummary(\$model); ?>\n"; ?>

<div style="text-align:center">
	<div><br/>
		<?php echo "<?php echo \$form->labelEx(\$model, 'narration'); ?>\n"; ?><br/>
		<?php echo "<?php echo \$form->textArea(\$model, 'narration', array('rows' => 2, 'cols' => 50)); ?>\n"; ?>
		<?php echo "<?php echo \$form->error(\$model,'narration'); ?>\n"; ?>
	</div>
	<div class="row buttons">
		<?php echo "<?php echo CHtml::submitButton('Delete', array('class' => 'btn btn-danger')); ?>\n"; ?>
	</div>
</div>
<?php echo "<?php \$this->endWidget(); ?>\n"; ?>

</div><!-- form -->