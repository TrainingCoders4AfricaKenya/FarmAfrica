<?php
$this->pageTitle = Yii::app()->name . ' - Sign Up';
?>

<div class="container">
    <div class="span6 offset3">
        <form class="form-signin" id="signup-form" method="post" action="<?php echo $this->createUrl('users/signup') ?>">
            <h2 class="form-signin-heading">Please provide a few details about yourself</h2>
            <div class="controls">
                <input type="text" class="span6" placeholder="Username" name="RUsers[userName]" id="userName">
            </div>
            <div class="controls controls-row">
                <input type="text" class="span3" placeholder="First Name" name="RUsers[firstName]"  id="firstName">
                <input type="text" class="span3" placeholder="Last Name" name="RUsers[lastName]"  id="lastName">
            </div>
            <div class="controls">
                <input type="email" class="span6" placeholder="Email" name="RUsers[emailAddress]" id="emailAddress" >
            </div>
            <div class="controls">
                <input type="text" class="span6" placeholder="Phone number" name="RUsers[phoneNumber]" id="phoneNumber">
            </div>
            <div class="controls control-group controls-row">
                <label class="radio inline  control-label">
                    <input type="radio" name="RUsers[group]" id="seller" value="seller" checked class="input-large">I have farm produce to sell
                </label>
                <label class="radio inline  control-label">
                    <input type="radio" name="RUsers[group]" id="buyer" value="buyer"  class="input-large">I want to buy farm produce
                </label>
            </div>
            <div class="controls" style="text-align: center">
                <button class="btn btn-large btn-block btn-info" type="submit">Sign Up!</button>
                <h2>OR</h2>
                <a class="btn btn-large btn-block" href="<?php echo $this->createUrl('/site/login') ?>">Log In</a>
            </div>
        </form>
    </div>
</div>
<?php
if($model->hasErrors()){
    echo '<script type="text/javascript">loadErrors('.CJSON::encode($model->errors).');</script>';
    echo '<script type="text/javascript">loadValues('.CJSON::encode($model).');</script>';
}
else{
    echo 'No Errors';
}
?>