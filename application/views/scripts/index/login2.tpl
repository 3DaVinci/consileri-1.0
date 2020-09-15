<div id="leftSpacer">&nbsp;</div>
<div id="contextBlock">


<span style="color:red">{$error}<br><br></span>

<form action="{$siteurl}/users/login" method="POST">
Пользователь: <input type="text" name="login_username" value="{$login_username}"><br>
Пароль: <input type="password" name="login_password"><br>
<input type="checkbox" name="remember_me" value="1" checked="checked" id="remember"/>
<label for="remember">запомнить меня</label><br>
<br>
<input type="submit" name="submit" value="Войти"/>
</form>

</div>