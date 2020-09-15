<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0//EN"
        "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<META content="text/html; charset=utf8" http-equiv=Content-Type>

<link href="{$siteurl}/images/main.css" rel="stylesheet" type="text/css">
<link rel="icon" href="{$siteurl}/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="{$siteurl}/favicon.ico" type="image/x-icon"> 

{literal}
<!--[if IE 6]>
<style>
#content { float:left; width:100%; }
#footer { clear:left; }
#wrapper { height:100%; }
</style>
<![endif]-->
{/literal}    

<title>Консильери - бесплатная онлайн CRM-система</title>

</head>

<body>

<div id="wrapper">		
	<div id="content2">


<table cellpadding="0" cellspacing="0" width="100%" border="0">
<tr>
<td><div id="logo2">&nbsp;</div></td>
<td>
{include file="index/login.tpl"}
</td>
<td align="right">
{if $controllerName!="companies" && $actionName!="registration"}
<div id="regman">
<a href="{$siteurl}/companies/registration">Регистрация</a><br>
Начните работать с<br>
Консильери!
</div>
{else}
<div style="width: 215px;">

</div>
{/if}
</td>
</tr>
</table>

<br><br>


<table cellpadding="0" cellspacing="0" border="0" width="100%">

<tr><td width="25%">
<div id="leftBlock">


{if $controllerName=="index" && $actionName=="index"}
<span id="sel">Прочти меня!</span><br><br>
{else}
<a href="{$siteurl}/" id="selFix">Прочти меня!</a><br><br>
{/if}

{if $controllerName=="index" && $actionName=="individuality"}
<span id="sel">Индивидуальность</span><br><br>
{else}
<a href="{$siteurl}/index/individuality" id="selFix">Индивидуальность</a><br><br>
{/if}

<a href="{$siteurl}/inpictures" id="selFix">Консильери в картинках</a><br><br>

{if $controllerName=="index" && $actionName=="nodoubt"}
<span id="sel">Уничтожитель сомнений</span><br><br>
{else}
<a href="{$siteurl}/index/nodoubt" id="selFix">Уничтожитель сомнений</a><br><br>
{/if}

{if $controllerName=="index" && $actionName=="official"}
<span id="sel">Официальное</span><br><br>
{else}
<a href="{$siteurl}/index/official" id="selFix">Официальное</a><br><br>
{/if}




<br><br>
<div id="feedback">
<b>Обратная связь</b>, пожелания,<br>
предложения и прочее:<br>
<a href="mailto:dacons@3davinci.ru">dacons@3davinci.ru</a>
</div>

<br><br>

<a href="http://3davinci.ru/daweb/" target="_blank"><img src="{$siteurl}/images/banners/banner1.jpg" style="position:relative; left:-5px;"></a>
<br><br>
<a href="{$siteurl}/index/buy"><img src="{$siteurl}/images/banners/banner2.jpg" style="position:relative; left:-5px;"></a>
<br><br>

Общение с настоящими<br>
людьми в нашем <a href="{$siteurl}/forum" style="color:#e0a70c">сообществе</a>!
<br><br><br>
<b>Информационные спонсоры:</b><br><br>
<a href="http://crm-jam.com" target="_blank" style="color:#000">CRM-JAM.com - Портал<br>посвященный теме CRM</a>

</div>
</td>

<td>

<div style="padding-right:30px; width:720px;">
