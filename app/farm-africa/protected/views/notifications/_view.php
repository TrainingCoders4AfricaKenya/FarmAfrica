<?php
/* @var $this NotificationsController */
/* @var $data Notifications */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('notificationID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->notificationID), array('view', 'id'=>$data->notificationID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notificationTypeID')); ?>:</b>
	<?php echo CHtml::encode($data->notificationTypeID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('message')); ?>:</b>
	<?php echo CHtml::encode($data->message); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('destinationAddress')); ?>:</b>
	<?php echo CHtml::encode($data->destinationAddress); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('messageDetails')); ?>:</b>
	<?php echo CHtml::encode($data->messageDetails); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dateCreated')); ?>:</b>
	<?php echo CHtml::encode($data->dateCreated); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('dateModified')); ?>:</b>
	<?php echo CHtml::encode($data->dateModified); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createdBy')); ?>:</b>
	<?php echo CHtml::encode($data->createdBy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modifiedBy')); ?>:</b>
	<?php echo CHtml::encode($data->modifiedBy); ?>
	<br />

	*/ ?>

</div>