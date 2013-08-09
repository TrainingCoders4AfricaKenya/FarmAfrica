<?php
/* @var $this ProductTypesController */
/* @var $data ProductTypes */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('productTypeID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->productTypeID), array('view', 'id'=>$data->productTypeID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('productTypeName')); ?>:</b>
	<?php echo CHtml::encode($data->productTypeName); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('modifiedBy')); ?>:</b>
	<?php echo CHtml::encode($data->modifiedBy); ?>
	<br />


</div>