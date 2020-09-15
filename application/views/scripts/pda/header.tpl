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
<b>{t}Консильери{/t}</b>
</td>
</tr>

{if $smarty.session.auth.nickname!=""}
<tr>
<td align="left">
{$smarty.session.auth.nickname}
</td>
<td align="right" valign="top">
<img src="{$siteurl}/images/pda/exit.gif" />
<a href="{$siteurl}/users/logout?pda" style="color:#fff">{t}выйти{/t}</a>
<span style="font-size:10%"><br><br></span>
</td>
</tr>
{/if}

</table>

{if $actionName!="logoutStatus" && $actionName!="login"}
<div id="search">
<form action="{$siteurl}/main/selectCompanySubmit" method="POST">
<input type="text" name="company"/>
<input type="submit" value="{t}Поиск{/t}"/>
</form> 
</div>
{/if}

<div id="content">
