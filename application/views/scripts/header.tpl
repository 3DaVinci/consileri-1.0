{if empty ($do_not_render_header)}
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0//EN"
        "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<META content="text/html; charset=utf-8" http-equiv=Content-Type>
<link href="{$siteurl}/images/style_IE6.css" rel="stylesheet" type="text/css" />
<link href="{$siteurl}/images/st.css" rel="stylesheet" type="text/css" />

{literal}
<script>
if (!window.opera) {
document.write('<link href="{/literal}{$siteurl}{literal}/images/fixOpera.css" rel="stylesheet" type="text/css">');
}
{/literal}
window.siteurl = "{$siteurl}";
{include file="jscontacts.tpl"}
</script>


<link rel="icon" href="{$siteurl}/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="{$siteurl}/favicon.ico" type="image/x-icon"> 
{if $lang=='de'}
<link href="{$siteurl}/images/deutsch.css" rel="stylesheet" type="text/css">
{/if}
<script src="{$siteurl}/js/mootools-1.2.4-with-1.1-classes.js"></script>
<script src="{$siteurl}/js/mootools-1.1-to-1.2-upgrade-helper.js"></script>
{if $controllerName=="journal"}
<link rel="stylesheet" type="text/css" media="all" href="{$siteurl}/libs/jscalendar/calendar.css"/> 
{/if}

{if $smarty.session.auth.study==true}
<link href="{$siteurl}/images/help.css" rel="stylesheet" type="text/css">
<script src="{$siteurl}/js/help.js"></script>
{/if}

{literal}
<!--[if IE 6]>
<style>
#content { float:left; width:100%; }
#footer { clear:left; }
#wrapper { height:100%; }
</style>
<![endif]-->
{/literal}    


{if $controllerName=="users" && $actionName=="logoutStatus"}
<meta http-equiv="refresh" content="1;url={$conf_url}/" />
{/if}

<title>
{if $smarty.session.auth.nickname!=""}
{t nickname=$smarty.session.auth.nickname}%nickname - Консильери{/t}
{else}
{t}Консильери{/t}
{/if}
</title>

</head>

<body id="docbody">



<div id="wrapper">		

	<div id="content">

<!--в случае редактирования сайта изменить false на true-->
{if false}
{include file="update/index.tpl"}
{/if}
{if $lang=='ru'}
<div id="logo"><img src="{$siteurl}/images/logo.jpg" width="235" height="46"></div>
{else}
<div id="logo"><img src="{$siteurl}/images/{$lang}/logo.jpg" width="235" height="46"></div>
{/if}
{if $smarty.session.auth.id!=""}
{php}
	include('incl/month.php');
    $this->assign('month',$month);
    $this->assign('day', date ("j"));
{/php}	
{assign var="monthh" value=$smarty.now|date_format:"%m"}
<div id="userinfo">
<div><span class="today">{lang_echo_day day=$day month=$month.$monthh}</span></div>

<div class="user">
{t nickname=$smarty.session.auth.nickname}Работает %nickname{/t}&nbsp;&nbsp;
<span class="exit"><a href="{$conf_url}/users/logout" class="size12 cWhite">{t}выйти{/t}</a>  {*| <a href = "http://consileri.ru">Купить полноценную версию</a>*}</span><br>
{t company=$smarty.session.auth.usercompany}из компании «%company»{/t}
</div>
</div> 

<div class="help"><div class="helpInner">
<a href="{$siteurl}/" class="helpLink">{t}главная{/t}</a>
</div></div>

{/if}


<div class="help"></div>
<div style="clear:both"></div>



{* {$controllerName} *}

<div class="menuBlock">
{if $smarty.session.auth.id!=""}

{if $smarty.session.auth.is_admin!=1}
    
    {if $controllerName=="main"}
    <div class="menu"><a href="{$siteurl}/main" style="color:#000000">{t}Клиенты{/t}</a></div>
    {else}
    <div class="menuSel"><a href="{$siteurl}/main" style="color:#000000">{t}Клиенты{/t}</a></div>
    {/if}
    
    {if $controllerName=="journal"}
    <div class="menu"><a href="{$siteurl}/journal" style="color:#000000">{t}Журнал{/t}</a></div>
    {else}
    <div class="menuSel"><a href="{$siteurl}/journal" style="color:#000000">{t}Журнал{/t}</a></div>
    {/if}
    
    {php}
    if (file_exists ('application/controllers/ProfileController.php')) :
    {/php}
    {if $controllerName=="profile"}
    <div class="menu"><a href="{$siteurl}/profile" style="color:#000000">{t}Смена пароля{/t}</a></div>
    {else}
    <div class="menuSel"><a href="{$siteurl}/profile" style="color:#000000">{t}Смена пароля{/t}</a></div>
    {/if}
    {php}
    endif;
    {/php}
    
    <!--<div class="menuSel"><a href="#" style="color:#000000">Отчеты</a></div>-->
    {if $smarty.session.auth.is_super_user == 1}
	    {if $controllerName=="managment"}
	    <div class="menu"><a href="{$siteurl}/managment" style="color:#000000;">{t}Управление{/t}</a></div>
	    {else}
	    <div class="menuSel"><a href="{$siteurl}/managment" style="color:#000000;">{t}Управление{/t}</a></div>
	    {/if}
    {/if}
    
{else}
	{if $controllerName=="managment"}
	<div class="menu"><a href="{$siteurl}/managment" style="color:#000000;">{t}Управление{/t}</a></div>
	{else}
	<div class="menuSel"><a href="{$siteurl}/managment" style="color:#000000;">{t}Управление{/t}</a></div>
	{/if}

	{if $controllerName=="backup"}
	<div class="menu"><a href="{$siteurl}/backup" style="color:#000000;">{t}База данных{/t}</a></div>
	{else}
	<div class="menuSel"><a href="{$siteurl}/backup" style="color:#000000;">{t}База данных{/t}</a></div>
	{/if}
{/if}    

{else}
<div class="menu"><a href="{$siteurl}/" style="color:#000000">{t}Главная{/t}</a></div>
{/if}




</div>
{*   
<div style="height:18px"></div>
<!--LiveInternet counter--><script type="text/javascript"><!--
document.write("<img src='http://counter.yadro.ru/hit?r"+escape(document.referrer)+((typeof(screen)=="undefined")?"":";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+";"+Math.random()+"' width=1 height=1 alt=''>")//--></script>
<!--/LiveInternet-->
*}
{/if}
