<?php
$this->pageTitle = Yii::app()->name . ' - ' . Yii::t(Yii::app()->language, 'setPassword');
$this->breadcrumbs = array(
    Yii::t(Yii::app()->language, 'setPassword'),
);
?>
<div class="row-fluid controls-row">

    <div class="span4 offset3">
        <?php
        $this->beginWidget('zii.widgets.CPortlet', array(
            'title' => Yii::t(Yii::app()->language, 'setPassword'),
        ));
        ?>
        <p>Please enter your preferred password below</p>

        <div class="form">
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'set-password-form',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
        ));
?>

            <div class="row">
                <?php
                echo CHtml::activeLabel($model, 'newPassword');
                echo CHtml::activePasswordField($model, 'newPassword', array('class' => 'span6'));
//              ?>
            </div>
            <div class="row">
                <?php
                echo CHtml::activeLabel($model, 'newPassword_repeat');
                echo CHtml::activePasswordField($model, 'newPassword_repeat', array('class' => 'span6'));
                ?>
            </div>
            <div class="row" style="float: right">
	    	<?php echo CHtml::link(Yii::t(Yii::app()->language, 'getNewToken'),array('/UI/users/getToken?action=reset&e='.$_GET['e']));?>
	    </div>
            <div class="row buttons">
                <?php echo CHtml::submitButton(Yii::t(Yii::app()->language, 'setPassword'), array('class' => 'btn btn-info')); ?>
            </div>

            <?php $this->endWidget(); ?>
        </div><!-- form -->

        <?php $this->endWidget(); ?>

    </div>

</div>