<?php
/* @var $this InboundMessagesController */
/* @var $model RInboundMessages */

$this->breadcrumbs=array(
	Yii::t(Yii::app()->language, 'inbound Messages')=>array('admin'),
	$model->inboundMessageID=>array('view','id'=>$model->inboundMessageID),
	Yii::t(Yii::app()->language, 'update'),
);

$this->menu=array(
	array('label' => Yii::t(Yii::app()->language, 'createInboundMessages'), 'url' => array('create')),
	array('label' => Yii::t(Yii::app()->language, 'viewInboundMessages'), 'url' => array('view', 'id'=>$model->inboundMessageID)),
	array('label' => Yii::t(Yii::app()->language, 'deleteInboundMessages'), 'url' => array('delete', 'id'=>$model->inboundMessageID)),
	array('label' => Yii::t(Yii::app()->language, 'manageInboundMessages'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t(Yii::app()->language, 'updateInboundMessages'); ?></h1>

<?php
Utils::displayFlashMessage();
?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>