<?php
/* @var $this TransactionsController */
/* @var $model RTransactions */

$this->breadcrumbs=array(
	Yii::t(Yii::app()->language, 'transactions')=>array('admin'),
	Yii::t(Yii::app()->language, 'create'),
);

$this->menu=array(
	array('label' => Yii::t(Yii::app()->language, 'manageTransactions'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t(Yii::app()->language, 'createTransactions'); ?></h1>

<?php
Utils::displayFlashMessage();
?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>