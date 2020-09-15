
<div style="padding:0px 40px 0px 40px;">
<div style='float:left; margin-top: 20px;'>
<b>{t}Менеджеры{/t}</b><br>

{if isset($error)}
{if isset($error.username)}
<span style="background-color:#f34320; padding:2px 5px 2px 5px; color:#fff; font-size:12px;">{$error.username}</span><br>
{/if}

{if isset($error.nickname)}
<span style="background-color:#f34320; padding:2px 5px 2px 5px; color:#fff; font-size:12px;">{$error.nickname}</span><br>
{/if}

{if isset($error.password)}
<span style="background-color:#f34320; padding:2px 5px 2px 5px; color:#fff; font-size:12px;">{$error.password}</span><br>
{/if}

{if isset($error.email)}
<span style="background-color:#f34320; padding:2px 5px 2px 5px; color:#fff; font-size:12px;">{$error.email}</span><br>
{/if}

{/if}



{*{if $help.14}*}

{if $showInfo}

<div style="float:left;margin-top:10px;">
{foreach from=$managers item=cur}
<div style="font-size:12px;padding: 0px 10px 1px 5px;margin-top:3px;"><a href="{$siteurl}/managment/index?id={$cur.id}" style="font-size:12px; color:#000">{$cur.nickname}</a></div>
{/foreach}

{if $show_create_manager == true}

{if $actionName=="newManager" || $actionName=="newManagerSubmit"}
<div class="selectedManager">{t}Новый менеджер{/t}</div>
{else}
<div style="position:relative;left:-12px;font-size:12px;padding: 0px 10px 1px 5px;margin-top:3px;"><span style="color:#f4b715">+</span> <a href="{$siteurl}/managment/newManager" style="font-size:12px; color:#dc8009">{t}Новый менеджер{/t}</a></div>
{/if}
{/if}

{include file="managment/leftmenu.tpl"}
</div>
</div>
<div style="float:left;margin-left:40px;margin-top:20px;">
{include file="help/doc16.tpl"}<br><br><br>
</div>

{else}

<div style="float:left;margin-top:10px;">
{include file="managment/managers.tpl"}

{include file="managment/leftmenu.tpl"}
</div>

<div style="float:left;margin-left:40px;margin-top:5px;">

<div class="managerControl">
{include file="managment/manager.tpl"}
<div style="border-bottom:1px solid #cfcdc1; font-size:10px;"></div>
{include file="managment/editManagerInfo.tpl"}
<div style="border-bottom:1px solid #cfcdc1; font-size:10px;"></div>
{include file="managment/delete.tpl"}
</div>

</div>
</div>

<div id="clear"></div>
{/if}
