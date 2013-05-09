<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs = array(
    'Users' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Users', 'url' => array('index')),
    array('label' => 'Create Users', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#users-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Users</h1>

<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'users-grid',
//	'dataProvider'=>$model->search(),
    'dataProvider' => RestUtils::createDataProvider($model),
//	'filter'=>$model,
    'columns' => array(
        'userID',
        'userName',
        'firstName',
        'lastName',
        'emailAddress',
        'phoneNumber',
        'status',
        'dateCreated',
        'createdBy',
        'dateModified',
        'modifiedBy',
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}{update}{delete}',
//            'buttons' => array(
//                'view' => array(
//                    'imageUrl' => Yii::app()->request->baseUrl . '/images/view.png',
//                    'url' => 'Yii::app()->createUrl("/UI/' . $module . '/admin")',
//                    'visible' => '0',
//                ),
//                'update' => PermissionUtils::adminButtons($array = array(
//                    'imageUrl' => Yii::app()->request->baseUrl . '/images/update.png',
//                    'url' => 'Yii::app()->createUrl("/UI/bundles/update/",array("id"=>$data->bundleID))'), $action = 'update', $module = 'bundles'
//                ),
//                'remove' => PermissionUtils::adminButtons($array = array(
//                    'imageUrl' => Yii::app()->request->baseUrl . '/images/delete.png',
//                    'url' => 'Yii::app()->createUrl("/UI/bundles/delete/",array("id"=>$data->bundleID))'), $action = 'delete', $module = 'bundles'
//                ),
//            ),
        ),
    ),
));
?>
