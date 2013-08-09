<?php
/* @var $this ProductsController */
/* @var $model RProducts */

$this->breadcrumbs=array(
	Yii::t(Yii::app()->language, 'products')=>array('admin'),
	Yii::t(Yii::app()->language, 'manage'),
);

$this->menu=array(
	array('label' => Yii::t(Yii::app()->language, 'createProducts'), 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#products-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t(Yii::app()->language, 'manageProducts'); ?></h1>

<?php echo CHtml::link('<i class="icon-filter"></i> '.Yii::t(Yii::app()->language, 'filterRecords'),'#',array('class'=>'search-button btn')); ?>

<?php
Utils::displayFlashMessage();
?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'products-grid',
    'itemsCssClass'=>'table table-striped table-hover ',
	'dataProvider'=>$dataProvider,
	'columns' => CMap::mergeArray(RestUtils::getDataProviderColumnNames($model, array(
				'productID',
		'productName',
		'description',
		'productTypeID',
		'status',
		'dateCreated',
		/*
		'createdBy',
		'dateModified',
		'modifiedBy',
		*/
	)), array(
        array(
        	'header'=>Yii::t(Yii::app()->language, 'actions'),
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{view}{update}{delete}',
            'buttons' => array(
            	'view' => array(
            		'label' => Yii::t(Yii::app()->language, 'view'),
            		'url' => 'Yii::app()->createUrl("products/view/", array("id"=>$data->productID))',
            		'imageUrl' => Yii::app()->request->baseUrl . '/images/view.png',
            		//'options' => array(),
            		//'click' => '',
            		'visible' => 'PermissionUtils::checkModuleActionPermission($moduleName = "products", $action = "view")',
            	),
            	'update' => array(
            		'label' => Yii::t(Yii::app()->language, 'update'),
            		'url' => 'Yii::app()->createUrl("products/update/", array("id"=>$data->productID))',
            		'imageUrl' => Yii::app()->request->baseUrl . '/images/update.png',
            		//'options' => array(),
            		//'click' => '',
            		'visible' => 'PermissionUtils::checkModuleActionPermission($moduleName = "products", $action = "update")',
            	),
            	'delete' => array(
            		'label' => Yii::t(Yii::app()->language, 'delete'),
            		'url' => 'Yii::app()->createUrl("products/delete/", array("id"=>$data->productID))',
            		'imageUrl' => Yii::app()->request->baseUrl . '/images/delete.png',
            		//'options' => array(),
            		//'click' => '',
            		'visible' => 'PermissionUtils::checkModuleActionPermission($moduleName = "products", $action = "delete")',
            	),
            ),
        )
    )),
)); 
?>