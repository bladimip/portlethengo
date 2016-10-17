<? top('Enter') ?>

<h1>Enter</h1>


<p><input type="text" placeholder="Код" id="code"></p>
<p><input type="text" placeholder="<?captcha_show()?>" id="captcha"></p>
<p><button onclick="post_query('gform', 'confirm', 'code.captcha')">Enter</button> </p>


<? bottom() ?>