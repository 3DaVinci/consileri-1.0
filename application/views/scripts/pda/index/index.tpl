<html>
<head>
<title>{t}Консильери{/t}</title>
<link rel="stylesheet" type="text/css" href="{$siteurl}/images/pda.css" media="handheld, all">
<meta name="viewport" content="width=240">
<META content="text/html; charset=utf8" http-equiv=Content-Type>
</head>
<body>

<table border=0 id="header" cellpadding=3>
<tr>
<td align="left" class="size4" {if $smarty.session.auth.nickname!=""}colspan=2{/if}>
<b>{t}Консильери «связи»{/t}</b>
</td>
</tr>
{if $smarty.session.auth.nickname!=""}
<tr>
<td align="left">
{$smarty.session.auth.nickname}
</td>
<td align="right">
<img src="{$siteurl}/images/pda/exit.gif" />
<a href="{$siteurl}/users/logout?pda" style="color:#fff">{t}выйти{/t}</a>
</td>
</tr>
{/if}

</table>

<div id="content">

{if $smarty.session.auth.nickname==""}
<center>
<form action="{$siteurl}/users/login" method="POST" class="size2">
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

</div>

<div id="footer">
<a href="/?nopda" style="color:#000">{t}Полная версия{/t}</a> &nbsp;&nbsp;&nbsp;&nbsp;
<a href="http://3davinci.ru/" target="_blank" style="color:#000">(c) 3DaVinci 2007</a>
</div>

</body>
</html>
