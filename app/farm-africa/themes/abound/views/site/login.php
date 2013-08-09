<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Login';

?>

<div class="container">
    <div class="span6 offset3">
        <form class="form-signin" id="login-form" method="post" action="<?php echo $this->createUrl('login') ?>">
            <h2 class="form-signin-heading">Please sign in</h2>
            <input type="text" class="input-block-level" placeholder="Username" name="LoginForm[username]">
            <input type="password" class="input-block-level" placeholder="Password" name="LoginForm[password]">
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
            </label>
            <div class="btn-group offset2">
                <button class="btn btn-large btn-info" type="submit">Sign in</button>
                <a class="btn btn-large" href="<?php echo $this->createUrl('/site/signup') ?>">Sign Up</a>
            </div>
            
        </form>
    </div>
</div>