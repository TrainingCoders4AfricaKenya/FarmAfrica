<?php
/* @var $this NotificationsController */
/* @var $model RNotifications */

$this->breadcrumbs=array(
	Yii::t(Yii::app()->language, 'notifications')=>array('admin'),
	Yii::t(Yii::app()->language, 'manage'),
);

$this->menu=array(
	array('label' => Yii::t(Yii::app()->language, 'createNotifications'), 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#notifications-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t(Yii::app()->language, 'manageNotifications'); ?></h1>

<?php echo CHtml::link('<i class="icon-filter"></i> '.Yii::t(Yii::app()->language, 'filterRecords'),'#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'notifications-grid',
    'itemsCssClass'=>'table table-striped table-hover ',
	'dataProvider'=>$dataProvider,
	'columns' => CMap::mergeArray(RestUtils::getDataProviderColumnNames($model, array(
				'notificationID',
		'notificationTypeID',
                'fk_notificationTypeID_notificationTypeName',
//		'message',
		'destinationAddress',
//		'messageDetails',
//		'status',
                'fk_status_statusDesc',
		/*
		'dateCreated',
		'dateModified',
		'createdBy',
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
            		'url' => 'Yii::app()->createUrl("notifications/view/", array("id"=>$data->notificationID))',
            		'imageUrl' => Yii::app()->request->baseUrl . '/images/view.png',
            		//'options' => array(),
            		//'click' => '',
            		'visible' => 'PermissionUtils::checkModuleActionPermission($moduleName = "notifications", $action = "view")',
            	),
            	'update' => array(
            		'label' => Yii::t(Yii::app()->language, 'update'),
            		'url' => 'Yii::app()->createUrl("notifications/update/", array("id"=>$data->notificationID))',
            		'imageUrl' => Yii::app()->request->baseUrl . '/images/update.png',
            		//'options' => array(),
            		//'click' => '',
            		'visible' => 'PermissionUtils::checkModuleActionPermission($moduleName = "notifications", $action = "update")',
            	),
            	'delete' => array(
            		'label' => Yii::t(Yii::app()->language, 'delete'),
            		'url' => 'Yii::app()->createUrl("notifications/delete/", array("id"=>$data->notificationID))',
            		'imageUrl' => Yii::app()->request->baseUrl . '/images/delete.png',
            		//'options' => array(),
            		//'click' => '',
            		'visible' => 'PermissionUtils::checkModuleActionPermission($moduleName = "notifications", $action = "delete")',
            	),
            ),
        )
    )),
)); 
?>