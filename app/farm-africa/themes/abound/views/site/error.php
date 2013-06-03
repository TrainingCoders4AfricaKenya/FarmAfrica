<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>	
<?php
/*function ETtesting(){
switch ($code){
case 404:
echo "Page not Found";
//$this->renderPartial('_404');
//die();
break;
case 502:
echo "Slow Internet Connection";
break;
case 400:
echo"Bad Request";
}
}*/
?>
<h2>
<img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/err.png" width="300" height="300" />
<p align=middle>Sorry, seems like <?php echo $code; ?> error has occurred.</p>
<div class="error" align=middle>
<?php echo CHtml::encode($message); ?><br>
Go Back<a href="<?php echo Yii::app()->baseUrl?>"> HOME</a></p>

</div>
