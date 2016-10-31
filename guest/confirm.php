<?
if ( !$_SESSION['confirm']['code'] ) not_found();

top('Confirmation') ?>

<h1>Confirmation</h1>

<p><input type="text" placeholder="Code" id="code"></p>
<p><button onclick="post_query('gform', 'confirm', 'code.captcha')">Confirm</button> </p>


<? bottom() ?>
