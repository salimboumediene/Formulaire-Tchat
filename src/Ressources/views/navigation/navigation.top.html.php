<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Formation-PHP</title>
        <base href="http://localhost/formation-php/web/" />
        <link rel="stylesheet"
              type="text/css"
              href="node_modules/bootstrap/dist/css/bootstrap.css" />
        <link rel="stylesheet"
              type="text/css"
              href="assets/stylesheets/channel.css" />
        <script type="text/javascript" src="node_modules/jquery/dist/jquery.js"></script>
        <script type="text/javascript" src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-default" style="z-index: 9;">
                <div class="container-fluid">
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                      <span class="sr-only">Toggle</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="">
                    	Formation-PHP
                    </a>
                  </div>
                  <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
<?php if (!isset($user) || App\Role\Role::VISITOR === $user->role): ?>
                      <li><a href="signup">Signup</a></li>
                      <li><a href="signin">Signin</a></li>
<?php else: ?>
                      <li><a href="signout">Signout</a></li>
<?php endif; ?>
                    </ul>
                  </div>
                </div>
              </nav>
    	<main>
