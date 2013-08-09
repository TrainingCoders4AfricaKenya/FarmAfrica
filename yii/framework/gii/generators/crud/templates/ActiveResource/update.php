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
	Yii::t(Yii::app()->language, 'update'),
);\n";
?>

$this->menu=array(
	array('label' => Yii::t(Yii::app()->language, 'create<?php echo $this->modelClass; ?>'), 'url' => array('create')),
	array('label' => Yii::t(Yii::app()->language, 'view<?php echo $this->modelClass; ?>'), 'url' => array('view', 'id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>)),
	array('label' => Yii::t(Yii::app()->language, 'delete<?php echo $this->modelClass; ?>'), 'url' => array('delete', 'id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>)),
	array('label' => Yii::t(Yii::app()->language, 'manage<?php echo $this->modelClass; ?>'), 'url' => array('admin')),
);
?>

<h1><?php echo "<?php echo Yii::t(Yii::app()->language, 'update".$this->pluralize($this->modelClass)."'); ?>"; ?></h1>
<?php 
echo "\n<?php\nUtils::displayFlashMessage();\n?>\n";
?>
<?php echo "<?php echo \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>