<div class="loginWrap">
{if !is_numeric($smarty.session.auth.id)}
<form action="{$siteurl}/users/login" method="POST">
<div style="float:left">

<div id="user">
<b>логин:</b><br>
<input type="text" name="login_username" value="{$login_username}"><br>
</div>

<div id="pass">
<b>пароль:</b><br>
<input type="password" name="login_password"><br>
</div>

<div style="clear:left"></div>
<input type="checkbox" name="remember_me" value="1" checked="checked" id="remember"/>
<label for="remember">запомнить меня на этом компьютере</label><br>

</div>

<div id="btn">
<input type="submit" name="submit" value="Поработать!" id="enter"/><br>
<a href="{$siteurl}/companies/restore">Забыли пароль?</a>
</div>


</form>
{else}
<div style="text-align:center; padding-top:20px;">
<a href="{$siteurl}/main" style="color:#000"><b>В CRM...</b></a>
</div>
{/if}
</div>