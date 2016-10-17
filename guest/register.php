<? top('Регистрация') ?>

<h1>Регистрация</h1>

<p><input type="text" placeholder="E-mail" id="email"></p>
<p><input type="password" placeholder="Пароль" id="password"></p>
<p><input type="text" placeholder="<?captcha_show()?>" id="captcha"></p>
<p><button onclick="post_query('gform', 'register', 'email.password.captcha')">Регистрация</button> </p>


<? bottom() ?>