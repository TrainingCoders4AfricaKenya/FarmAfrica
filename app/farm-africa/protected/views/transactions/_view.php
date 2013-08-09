<?php
/* @var $this TransactionsController */
/* @var $data Transactions */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('transactionID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->transactionID), array('view', 'id'=>$data->transactionID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('serviceID')); ?>:</b>
	<?php echo CHtml::encode($data->serviceID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('productID')); ?>:</b>
	<?php echo CHtml::encode($data->productID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('initiatorID')); ?>:</b>
	<?php echo CHtml::encode($data->initiatorID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('initiatorMSISDN')); ?>:</b>
	<?php echo CHtml::encode($data->initiatorMSISDN); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('receiverID')); ?>:</b>
	<?php echo CHtml::encode($data->receiverID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('dateCreated')); ?>:</b>
	<?php echo CHtml::encode($data->dateCreated); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dateModified')); ?>:</b>
	<?php echo CHtml::encode($data->dateModified); ?>
	<br />

	*/ ?>

</div>