<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0//EN"
        "http://www.w3.org/TR/html4/strict.dtd">



<html>
<head>
	<title>{t}Активация программы{/t}</title>
<META content="text/html; charset=utf8" http-equiv=Content-Type>
<style>
{literal}
BODY {padding: 0 0 0 0; margin: 0 0 0 0; color: #000; font-family: Arial, Tahoma, sans-serif; font-size: 85%; background: url({/literal}{$siteurl}{literal}/images/body_back.png) repeat-x #88ff1a;}
#logo {position: absolute; z-index: 3; top: 0; right: 0;}
#login {/*background: url({/literal}{$siteurl}{literal}/images/login_back.png) no-repeat #fff; */ width: 438px; height: 500px; margin: 166px auto 0 auto;  bgcolor:white; background-color:white;}
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
</head>

<body>
<div id="login">
{if $lang=='ru'}
<img src="{$siteurl}/images/kons.png" alt="{t}Консильери{/t}" class="kons" />
{elseif $lang=='de'}
<img src="{$siteurl}/images/de/kons.png" alt="{t}Консильери{/t}" class="kons" />
{/if}
<form method="POST" action = "{$siteurl}/index/activate">
<table cellpadding="0" cellspacing="0" border="0" class="blabla">
{if $mode != 2}
<tr>
	<td>
<span style = "padding-right: 30px">
{if ! $we_need_more_users}
{t}Для того, чтобы начать работу с программой, сначала нужно её активировать.{/t} <br>
{t url="$url" escape=no}Для этого необходимо посетить страницу %url , где зарегистрировать программу на своё имя, и при регистрации ввести этот «Запрос на активацию»:{/t}
{else}
{t}Вы зарегистрировали больше пользователей, чем это предусмотрено вашим лицензионным ключом. <br>
Обратитесь, пожалуйста, в службу техподдержки <a href = "mailto:support@consileri.ru">support@consileri.ru</a> , сообщите 
количество пользователей, которое наиболее точно соответствует потребностям вашего бизнеса
и этот «Запрос на активацию»:{/t}
{/if}
</span>
</td>
</tr>
<tr><td class="vr"></td></tr>
<tr>
	<td class="value"><textarea name = "act" readonly = "readonly" style="width: 250px; height: 75px;">{$activation_request}</textarea></td>
</tr>
<tr><td class="vr"></td></tr>
<tr>
	<td style = "padding-right:30px;">
<span style = "padding-right: 30px">
{if ! $we_need_more_users}
{t}После регистрации программы по указанному адресу, вы получите «Ключ активации».
Введите его сюда:{/t}
{else}
{t}После этого вы получите «Ключ активации».
Введите его сюда:{/t}
{/if}
<span style = "padding-right: 30px">
</td>
</tr>
<tr><td class="vr"></td></tr>
<tr>
	<td class="value">
<span style = "padding-right: 30px">
<input type="text" class="input"  name="code" id = "code" />
	{if ($mode == 1)}
	<br><small>{t}Был указан неверный код. Попробуйте его ввести ещё раз.{/t}</small>
	{/if}
</span>
	</td>
</tr>
<tr><td class="vr"></td></tr>
<tr>
	<td style="padding-top: 15px;"><input type="submit" class="submit" value="{t}Активировать программу{/t}"></td>
</tr>
{else}
<tr>
	<td style="padding-top: 15px;">{t}Программа успешно активирована.{/t}</td>
</tr>
<tr>
	<td style="padding-top: 15px;"><input type="button" class="submit" value="{t}Поработать!{/t}" onclick = "window.location = '{$siteurl}/';"></td>
</tr>
{/if}
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
