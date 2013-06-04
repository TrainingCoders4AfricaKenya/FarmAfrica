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
$label=$this->pluralize($this->class2name($this->modelClass));
$lcFirstLabel = lcfirst($label);
echo "\$this->breadcrumbs=array(
	Yii::t(Yii::app()->language, '$lcFirstLabel')=>array('admin'),
	Yii::t(Yii::app()->language, 'manage'),
);\n";
?>

$this->menu=array(
	array('label' => Yii::t(Yii::app()->language, 'create<?php echo $this->modelClass; ?>'), 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#<?php echo $this->class2id($this->modelClass); ?>-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo "<?php echo Yii::t(Yii::app()->language, 'manage".$this->pluralize($this->class2name($this->modelClass))."'); ?>"; ?></h1>

<?php echo "<?php echo CHtml::link('<i class=\"icon-filter\"></i> '.Yii::t(Yii::app()->language, 'filterRecords'),'#',array('class'=>'search-button btn')); ?>"; ?>

<div class="search-form" style="display:none">
<?php echo "<?php \$this->renderPartial('_search',array(
	'model'=>\$model,
)); ?>\n"; ?>
</div><!-- search-form -->

<?php echo "<?php"; ?> $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'<?php echo $this->class2id($this->modelClass); ?>-grid',
    'itemsCssClass'=>'table table-striped table-hover ',
	'dataProvider'=>$dataProvider,
	'columns' => CMap::mergeArray(RestUtils::getDataProviderColumnNames($model, array(
		<?php
$count=0;
foreach($this->tableSchema->columns as $column)
{
	if(++$count==7)
		echo "\t\t/*\n";
	echo "\t\t'".$column->name."',\n";
}
if($count>=7)
	echo "\t\t*/\n";
// 'buttonID' => array(
//     'label'=>'...',     // text label of the button
//     'url'=>'...',       // a PHP expression for generating the URL of the button
//     'imageUrl'=>'...',  // image URL of the button. If not set or false, a text link is used
//     'options'=>array(...), // HTML options for the button tag
//     'click'=>'...',     // a JS function to be invoked when the button is clicked
//     'visible'=>'...',   // a PHP expression for determining whether the button is visible
// )
?>
	)), array(
        array(
        	'header'=>Yii::t(Yii::app()->language, 'actions'),
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{view}{update}{delete}',
            'buttons' => array(
            	'view' => array(
            		'label' => Yii::t(Yii::app()->language, 'view'),
            		'url' => 'Yii::app()->createUrl("<?php echo lcfirst($this->modelClass); ?>/view/", array("id"=>$data-><?php echo $this->tableSchema->primaryKey; ?>))',
            		'imageUrl' => Yii::app()->request->baseUrl . '/images/view.png',
            		//'options' => array(),
            		//'click' => '',
            		'visible' => 'PermissionUtils::checkModuleActionPermission($moduleName = "<?php echo lcfirst($this->modelClass); ?>", $action = "view")',
            	),
            	'update' => array(
            		'label' => Yii::t(Yii::app()->language, 'update'),
            		'url' => 'Yii::app()->createUrl("<?php echo lcfirst($this->modelClass); ?>/update/", array("id"=>$data-><?php echo $this->tableSchema->primaryKey; ?>))',
            		'imageUrl' => Yii::app()->request->baseUrl . '/images/update.png',
            		//'options' => array(),
            		//'click' => '',
            		'visible' => 'PermissionUtils::checkModuleActionPermission($moduleName = "<?php echo lcfirst($this->modelClass); ?>", $action = "update")',
            	),
            	'delete' => array(
            		'label' => Yii::t(Yii::app()->language, 'delete'),
            		'url' => 'Yii::app()->createUrl("<?php echo lcfirst($this->modelClass); ?>/delete/", array("id"=>$data-><?php echo $this->tableSchema->primaryKey; ?>))',
            		'imageUrl' => Yii::app()->request->baseUrl . '/images/delete.png',
            		//'options' => array(),
            		//'click' => '',
            		'visible' => 'PermissionUtils::checkModuleActionPermission($moduleName = "<?php echo lcfirst($this->modelClass); ?>", $action = "delete")',
            	),
            ),
        )
    )),
)); 
?>