<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */
/* @var $form CActiveForm */
?>

<div class="form">

<?php echo "<?php \$form=\$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'".$this->class2id($this->modelClass)."-form',
	'enableAjaxValidation'=>false,
)); ?>\n"; ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo "<?php echo \$form->errorSummary(\$model); ?>\n"; ?>

<?php
foreach($this->tableSchema->columns as $column)
{
	if($column->autoIncrement)
		continue;
	if($column->name == 'createdBy')
		continue;
	if($column->name == 'dateCreated')
		continue;
	if($column->name == 'dateModified')
		continue;
	if($column->name == 'modifiedBy')
		continue;
	if($column->name == 'dateActivated')
		continue;
	if($column->name == 'status')
		continue;
?>
	<div class="row">
		<?php echo "<?php echo ".$this->generateActiveLabel($this->modelClass,$column)."; ?>\n"; ?>
		<?php echo "<?php echo ".$this->generateActiveField($this->modelClass,$column)."; ?>\n"; ?>
		<?php echo "<?php echo \$form->error(\$model,'{$column->name}'); ?>\n"; ?>
	</div>

<?php
}
?>
	<div class="row buttons row-fluid btn-group">
		<?php echo "<?php echo CHtml::submitButton(\$model->isNewResource ? 'Create' : 'Save', array('class' => 'btn btn-info')); ?>\n"; ?>
		<?php echo '<a href="<?php echo Yii::app()->request->urlReferrer; ?>" class="btn"> Cancel </a>'; ?>
	</div>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>

</div><!-- form -->