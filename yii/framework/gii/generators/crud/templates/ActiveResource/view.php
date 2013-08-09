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
	\$model->{$nameColumn},
);\n";
?>

$this->menu=array(
	array('label' => Yii::t(Yii::app()->language, 'create<?php echo $this->modelClass; ?>'), 'url' => array('create')),
	array('label' => Yii::t(Yii::app()->language, 'update<?php echo $this->modelClass; ?>'), 'url' => array('update', 'id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>)),
	array('label' => Yii::t(Yii::app()->language, 'delete<?php echo $this->modelClass; ?>'), 'url' => array('delete', 'id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>)),
	array('label' => Yii::t(Yii::app()->language, 'manage<?php echo $this->modelClass; ?>'), 'url' => array('admin')),
);
?>

<h1><?php echo "<?php echo Yii::t(Yii::app()->language, 'view".$this->pluralize($this->modelClass)."'); ?>"; ?></h1>
<?php 
echo "\n<?php\nUtils::displayFlashMessage();\n?>\n";
?>
<?php echo "<?php"; ?> $this->widget('zii.widgets.CDetailView', array(
	'htmlOptions'=>array('class'=>'table table-striped table-hover table-bordered resize-th'),
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
