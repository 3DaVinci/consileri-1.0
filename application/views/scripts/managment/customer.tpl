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

{if isset($error.company)}
<span style="background-color:#f34320; padding:2px 5px 2px 5px; color:#fff; font-size:12px;">{$error.company}</span><br>
{/if}

{/if}

<div style="float:left;margin-top:10px;">
{include file="managment/managers.tpl"}

{include file="managment/leftmenu.tpl"}
</div>
</div>

<div style="float:left;margin-left:40px;margin-top:20px;">

{foreach from=$errors item=error}
{$error}<br>
{/foreach}
{if sizeof($errors)>0}<br>{/if}

<div class="managerControl">

<div style="padding:11px">
<b>{t}Ваша компания{/t}</b><br>


<form action="{$siteurl}/managment/customerSubmit" method="post">
<div class="managerInputLabel">{t}название{/t}</div>
<div style="float:left;margin-top:5px;">
<input type="text" name="customer" value="{$customer}" class="size12" style="width:300px"/>
</div>
<div id="clear"></div>

<div class="managerInputLabel"></div>
<div style="float:left;margin-top:5px;">
<input type="submit" value="{t}Сохранить изменения{/t}"/>
</div>
<div id="clear"></div>
</form>

</div>

</div>
</div>

</div>