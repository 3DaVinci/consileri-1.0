
{if $smarty.session.auth.nickname==""}
<center class="size2">
<span style="color:red">{$error}<br><br></span>
<form action="{$siteurl}/users/login" method="POST">
{t}Пользователь:{/t}<br>
<input type="text" name="login_username" value="{$login_username}"><br><br>
{t}Пароль:{/t} <br>
<input type="password" name="login_password"><br>
<input type="checkbox" name="remember_me" value="1" checked="checked" id="remember" style="position:relative;top:3px;"/>
<label for="remember">{t}запомнить меня{/t}</label><br>
<br>
<input type="submit" name="submit" value="{t}Войти{/t}"/>
</form>
</center>
{else}
<a href="/main">{t}В CRM...{/t}</a>
{/if}
