<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getARModelClass(); ?> */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php echo "<?php \$form=\$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl(\$this->route),
	'method'=>'get',
)); ?>\n"; ?>

<?php foreach($this->tableSchema->columns as $column): ?>
<?php
	$field=$this->generateInputField($this->modelClass,$column);
	if(strpos($field,'password')!==false)
		continue;
	if(strpos($field,'dateCreated')!==false)
		continue;
	if(strpos($field,'createdBy')!==false)
		continue;
	if(strpos($field,'dateModified')!==false)
		continue;
	if(strpos($field,'modifiedBy')!==false)
		continue;
	if(strpos($field,'dateActivated')!==false)
		continue;
?>
	<div class="row">
		<?php echo "<?php echo \$form->label(\$model,'{$column->name}'); ?>\n"; ?>
		<?php echo "<?php echo ".$this->generateActiveField($this->modelClass,$column)."; ?>\n"; ?>
	</div>

<?php endforeach; ?>
	<div class="row buttons">
		<?php echo "<?php echo CHtml::submitButton('Search', array('class' => 'btn btn-info')); ?>\n"; ?>
	</div>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>

</div><!-- search-form -->