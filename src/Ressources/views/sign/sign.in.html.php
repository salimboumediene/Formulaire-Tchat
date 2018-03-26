
<?php include __DIR__ . "/../navigation/navigation.top.html.php"; ?>

<h1 class="col-xs-8 col-xs-offset-2 text-center">
	Sign in
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
  
<br />
<input type="hidden" name="token" value="<?= $user->token ?>">
<div class="input-group">
	<button class="form-control btn btn-info submit-btn">SignIn</button>
</div>
<br/>
</form>

<?php else: ?>

<div class="col-xs-8 col-xs-offset-2 text-right">
	<a href="">Home</a>
</div>

<?php endif; ?>

<?php include __DIR__ . "/../sitelinks/sitelinks.bottom.html.php"; ?>