<? top('Password recovery') ?>

<h1>Recovery Password</h1>


<p><input type="text" placeholder="E-mail" id="email"></p>
<p><input type="text" placeholder="<?captcha_show()?>" id="captcha"></p>
<p><button onclick="post_query('gform', 'recovery', 'email.captcha')">Recovery</button> </p>


<? bottom() ?>