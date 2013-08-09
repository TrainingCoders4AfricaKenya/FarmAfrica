<?php
/* @var $this ProductsController */
/* @var $data Products */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('productID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->productID), array('view', 'id'=>$data->productID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('productName')); ?>:</b>
	<?php echo CHtml::encode($data->productName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('productTypeID')); ?>:</b>
	<?php echo CHtml::encode($data->productTypeID); ?>
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

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('dateModified')); ?>:</b>
	<?php echo CHtml::encode($data->dateModified); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modifiedBy')); ?>:</b>
	<?php echo CHtml::encode($data->modifiedBy); ?>
	<br />

	*/ ?>

</div>