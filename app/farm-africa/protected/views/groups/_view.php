<?php
/* @var $this GroupsController */
/* @var $data Groups */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('groupID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->groupID), array('view', 'id'=>$data->groupID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('groupName')); ?>:</b>
	<?php echo CHtml::encode($data->groupName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dateCreated')); ?>:</b>
	<?php echo CHtml::encode($data->dateCreated); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createdBy')); ?>:</b>
	<?php echo CHtml::encode($data->createdBy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dateModified')); ?>:</b>
	<?php echo CHtml::encode($data->dateModified); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('modifiedBy')); ?>:</b>
	<?php echo CHtml::encode($data->modifiedBy); ?>
	<br />

	*/ ?>

</div>