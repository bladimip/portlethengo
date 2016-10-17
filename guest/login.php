<? top('Login') ?>

<h1>Login</h1>

<p><input type="text" placeholder="E-mail" id="email"></p>
<p><input type="password" placeholder="Password" id="password"></p>
<p><input type="text" placeholder="<?captcha_show()?>" id="captcha"></p>
<p><button onclick="post_query('gform', 'login', 'email.password.captcha')">Confirm</button> <button>Recovery Password</button></p>

<? bottom() ?>