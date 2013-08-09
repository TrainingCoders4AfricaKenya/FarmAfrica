<?php
/* @var $this TransactionsController */
/* @var $model RTransactions */

$this->breadcrumbs=array(
	Yii::t(Yii::app()->language, 'transactions')=>array('admin'),
	$model->transactionID=>array('view','id'=>$model->transactionID),
	Yii::t(Yii::app()->language, 'update'),
);

$this->menu=array(
	array('label' => Yii::t(Yii::app()->language, 'createTransactions'), 'url' => array('create')),
	array('label' => Yii::t(Yii::app()->language, 'viewTransactions'), 'url' => array('view', 'id'=>$model->transactionID)),
	array('label' => Yii::t(Yii::app()->language, 'deleteTransactions'), 'url' => array('delete', 'id'=>$model->transactionID)),
	array('label' => Yii::t(Yii::app()->language, 'manageTransactions'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t(Yii::app()->language, 'updateTransactions'); ?></h1>

<?php
Utils::displayFlashMessage();
?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>