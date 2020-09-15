<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0//EN"
        "http://www.w3.org/TR/html4/strict.dtd">



<html>
<head>
	<title>{t}Вход в Консильери{/t}</title>
<META content="text/html; charset=utf-8" http-equiv=Content-Type>
<style>
{literal}
BODY {padding: 0 0 0 0; margin: 0 0 0 0; color: #000; font-family: Arial, Tahoma, sans-serif; font-size: 85%; background: url({/literal}{$siteurl}{literal}/images/body_back.png) repeat-x #88ff1a;}
#logo {position: absolute; z-index: 3; top: 0; right: 0;}
#login {background: url({/literal}{$siteurl}{literal}/images/login_back.png) no-repeat #fff; width: 438px; height: 261px; margin: 166px auto 0 auto;  }
.kons {margin: 20px 0 0 35px;}
.blabla { margin: 10px 0 0 40px;}
.label { vertical-align: middle; text-align: right; padding-right: 17px;}
.input { height: 28px; width: 215px; background: #feffed; border-top: 1px solid #989898; border-left: 1px solid #989898; border-right: 1px solid #cfcfcf; border-bottom: 1px solid #cfcfcf;}
.vr { height: 15px;}
.value { vertical-align: middle;}

small {font-size: .8em;}
A {color: #000; text-decoration: underline;}

.submit { height: 34px;  line-height: 30px; padding: 0 25px 0 25px;  background: #159f04;  border-right: 2px solid #0e6a03;
 color: #fff; font-weight: bold; border-bottom: 2px solid #0e6a03; border-top: 2px solid #159f04; border-left: 2px solid #159f04;  font-family: Arial, Tahoma, sans-serif; font-size: 1em;}
{/literal}
</style>

{if $lang=='de'}
<link href="{$siteurl}/images/deutsch.css" rel="stylesheet" type="text/css">
{/if}

</head>

<body>
<div id="login">
<form action="{$siteurl}/users/login" method="POST">
{if $lang=='ru'}
<img src="{$siteurl}/images/kons.png" alt="{t}Консильери{/t}" class="kons" />
{elseif $lang=='de'}
<img src="{$siteurl}/images/de/kons.png" alt="{t}Консильери{/t}" class="kons" />
{/if}
<table cellpadding="0" cellspacing="0" border="0" class="blabla">
<tr>
	<td class="label">{t}логин{/t}</td>
	<td class="value"><input type="text" class="input" name="login_username" value="{$login_username}"></td>
</tr>
<tr><td colspan="2" class="vr">{if (! empty($error))}<small style = "color:red">{t}Была указана неправильная пара логин-пароль{/t}{/if}</small></td></tr>
<tr>
	<td class="label">{t}пароль{/t}</td>
	<td class="value"><input type="password" class="input"  name="login_password"> &nbsp;  <!--<small><a href="{$siteurl}/companies/restore">{t}забыли?{/t}</a></small>--></td>
</tr>
<tr>
	<td></td>
	<td style="padding-top: 5px;"><input type="checkbox" name="remember_me" value="1" checked="checked" id="remember"> <small>{t}запомнить меня на этом компьютере{/t}</small></td>
</tr>
<tr>
	<td></td>
	<td style="padding-top: 15px;"><input type="submit" class="submit" value="{t}Поработать!{/t}"></td>
</tr>
</table>

</form>
</div>


{if $lang=='ru'}
<div id=logo><img src="{$siteurl}/images/logo_reg.png" alt="K" /></div>
{elseif $lang=='de'}
<div id=logo><img src="{$siteurl}/images/de/logo_reg.png" alt="K" /></div>
{/if}
</body>
</html>
