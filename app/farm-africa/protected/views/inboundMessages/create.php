<?php
/* @var $this InboundMessagesController */
/* @var $model RInboundMessages */

$this->breadcrumbs=array(
	Yii::t(Yii::app()->language, 'inbound Messages')=>array('admin'),
	Yii::t(Yii::app()->language, 'create'),
);

$this->menu=array(
	array('label' => Yii::t(Yii::app()->language, 'manageInboundMessages'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t(Yii::app()->language, 'createInboundMessages'); ?></h1>

<?php
Utils::displayFlashMessage();
?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>