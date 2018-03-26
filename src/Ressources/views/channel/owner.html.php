<?php include __DIR__ . "/../navigation/navigation.top.html.php"; ?>

<h1 class="col-xs-8 col-xs-offset-2 text-center">
	Channel
	<br/>
	<br/>
</h1>

<div class="col-xs-10 col-xs-offset-1 tabbable">
  <ul class="nav nav-tabs">
    <li class="active">
    	<a>My channels</a>
    </li>
    <li>
    	<a href="channels">Channels</a>
    </li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="tab1">
    <br>
    <span style="margin-right: 1em;">Name</span>
    <span>Description</span>
    <span style="float: right;">Capacity</span>
    <div class="list-group">
        <br>
<?php foreach ($channels as $value): ?>

        <div style="position: relative">
            <a href="channel?<?= App\Form\Form::NAME_CHANNEL_ID ?>=<?= $value->getChannelId()?>" class="list-group-item list-group-item-action">
            <span class="col-xs-3" style="font-size: 1.2em;">
            	<?= $value->getChannelName() ?>
            </span>
            <em ><?= $value->getChannelDescr() ?></em>
            <b style="float: right;"><?= $value->getChannelCapacity() ?></b>
            </a>
            <a href="?<?= App\Form\Form::NAME_CHANNEL_ID ?>=<?= $value->getChannelId() ?>&action=delete"
        	   class="btn glyphicon glyphicon-trash"
               style="position: absolute; right: -4em">
            </a>
        </div>

<?php endforeach; ?>

    </div>

<?php

if ($error || $success):
    include __DIR__ . "/../form/alert/form.alert.bootstrap.php";
endif;

?>
        <form class="col-xs-12 text-left" method="POST" action="">
        	<h4 class="col-xs-12">Create a Channel</h4>
        	<br />
            <div class="col-xs-9 text-left" class="input-group">
                <input type="text"
                       class="form-control"
                       name="<?= \App\Form\Form::NAME_CHANNEL_NAME ?>"
                       placeholder="Name"
                       value="<?= filter_input(INPUT_POST, \App\Form\Form::NAME_CHANNEL_NAME, FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?>">
                <br />
                <input type="text"
                       class="form-control"
                       name="<?= \App\Form\Form::NAME_CHANNEL_DESCR ?>"
                       placeholder="Description"
                       value="<?= filter_input(INPUT_POST, \App\Form\Form::NAME_CHANNEL_DESCR, FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?>">
            </div>
            <div class="col-xs-3 text-left" class="input-group">
                <input type="number"
                       class="form-control"
                       min="0"
                       max="100"
                       name="<?= \App\Form\Form::NAME_CHANNEL_CAPACITY ?>"
                       placeholder="max"
                       value="<?= (int) filter_input(INPUT_POST, \App\Form\Form::NAME_CHANNEL_CAPACITY) ?>">
                <br />
            	<button class="form-control btn btn-info submit-btn">+</button>
            </div>
            <input type="hidden" name="token" value="<?= $user->token ?>">
        </form>
    </div>
  </div>
</div>
<br style="clear:both"/>
<br />
<br />
<br />
<br />

<?php include __DIR__ . "/../sitelinks/sitelinks.bottom.html.php"; ?>