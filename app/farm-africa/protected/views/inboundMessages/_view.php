<?php
/* @var $this InboundMessagesController */
/* @var $data InboundMessages */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('inboundMessageID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->inboundMessageID), array('view', 'id'=>$data->inboundMessageID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sourceAddress')); ?>:</b>
	<?php echo CHtml::encode($data->sourceAddress); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('messageContent')); ?>:</b>
	<?php echo CHtml::encode($data->messageContent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('externalTransactionID')); ?>:</b>
	<?php echo CHtml::encode($data->externalTransactionID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dateCreated')); ?>:</b>
	<?php echo CHtml::encode($data->dateCreated); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dateModified')); ?>:</b>
	<?php echo CHtml::encode($data->dateModified); ?>
	<br />


</div>