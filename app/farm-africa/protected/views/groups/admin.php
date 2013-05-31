<?php
/* @var $this GroupsController */
/* @var $model RGroups */

$this->breadcrumbs=array(
	Yii::t(Yii::app()->language, 'groups')=>array('admin'),
	Yii::t(Yii::app()->language, 'manage'),
);

$this->menu=array(
	array('label' => Yii::t(Yii::app()->language, 'createGroups'), 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#groups-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t(Yii::app()->language, 'manageGroups'); ?></h1>

<?php echo CHtml::link('<i class="icon-filter"></i> '.Yii::t(Yii::app()->language, 'filterRecords'),'#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'groups-grid',
    'itemsCssClass'=>'table table-striped table-hover ',
	'dataProvider'=>$dataProvider,
	'columns' => CMap::mergeArray(RestUtils::getDataProviderColumnNames($model, array(
				'groupID',
		'groupName',
		'description',
		'status',
		'dateCreated',
		'createdBy',
		/*
		'dateModified',
		'modifiedBy',
		*/
	)), array(
        array(
        	'header'=>Yii::t(Yii::app()->language, 'actions'),
            'class' => 'CButtonColumn',
            'template' => '{view}{update}{delete}',
            'buttons' => array(
            	'view' => array(
            		'label' => Yii::t(Yii::app()->language, 'view'),
            		'url' => 'Yii::app()->createUrl("groups/view/", array("id"=>$data->groupID))',
            		'imageUrl' => Yii::app()->request->baseUrl . '/images/view.png',
            		//'options' => array(),
            		//'click' => '',
            		'visible' => 'PermissionUtils::checkModuleActionPermission($moduleName = "groups", $action = "view")',
            	),
            	'update' => array(
            		'label' => Yii::t(Yii::app()->language, 'update'),
            		'url' => 'Yii::app()->createUrl("groups/update/", array("id"=>$data->groupID))',
            		'imageUrl' => Yii::app()->request->baseUrl . '/images/update.png',
            		//'options' => array(),
            		//'click' => '',
            		'visible' => 'PermissionUtils::checkModuleActionPermission($moduleName = "groups", $action = "update")',
            	),
            	'delete' => array(
            		'label' => Yii::t(Yii::app()->language, 'delete'),
            		'url' => 'Yii::app()->createUrl("groups/delete/", array("id"=>$data->groupID))',
            		'imageUrl' => Yii::app()->request->baseUrl . '/images/delete.png',
            		//'options' => array(),
            		//'click' => '',
            		'visible' => 'PermissionUtils::checkModuleActionPermission($moduleName = "groups", $action = "delete")',
            	),
            ),
        )
    )),
)); 
?>