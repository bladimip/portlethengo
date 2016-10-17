<? top('Register') ?>

<h1>Registration</h1>

<p><input type="text" placeholder="E-mail" id="email"></p>
<p><input type="password" placeholder="Password" id="password"></p>
<p><input type="text" placeholder="<?captcha_show()?>" id="captcha"></p>
<p><button onclick="post_query('gform', 'register', 'email.password.captcha')">Register</button> </p>


<? bottom() ?>