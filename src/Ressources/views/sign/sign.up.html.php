<?php include __DIR__ . "/../navigation/navigation.top.html.php"; ?>

<h1 class="col-xs-8 col-xs-offset-2 text-center">
	Sign up
	<br/>
	<br/>
</h1>

<?php

if ($error || $success)
    include __DIR__ . "/../form/alert/form.alert.bootstrap.php";
if (!$success):

?>

<form class="col-xs-8 col-xs-offset-2" method="POST" action="">
 
<?php include __DIR__ . "/../form/input/form.input.email.php"; ?>

<br/>
  
<?php include __DIR__ . "/../form/input/form.input.pswd.php"; ?>
  
<br/>
<div class="input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
    <input type="text"
           class="form-control"
           name="<?= \App\Form\Form::NAME_CONFIRM ?>"
           placeholder="Confirm"
           value="<?= (string) filter_input(INPUT_POST, \App\Form\Form::NAME_CONFIRM, FILTER_SANITIZE_FULL_SPECIAL_CHARS)?>">
</div>
<br />
<input type="hidden" name="token" value="<?= $user->token ?>">
<div class="input-group">
	<button class="form-control btn btn-info submit-btn">SignUp</button>
</div>
<br/>
</form>

<?php else: ?>

<div class="col-xs-8 col-xs-offset-2 text-right">
	<a href="signin">Sign in</a>
</div>

<?php

endif;
include __DIR__ . "/../sitelinks/sitelinks.bottom.html.php";

?>
