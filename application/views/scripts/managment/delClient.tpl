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

<div style="float:left;margin-top:10px;">
{include file="managment/managers.tpl"}

{include file="managment/leftmenu.tpl"}
</div>

<div style="float:left;margin-left:40px;margin-top:5px;">

{foreach from=$errors item=error}
{$error}<br>
{/foreach}
{if sizeof($errors)>0}<br>{/if}

<div class="managerControl">

<div style="padding:11px">
<b>{t}Удаление клиентов{/t}</b><br><br>

<form method="GET" action="{$siteurl}/managment/delClient">

<div style="float:left;">
 
  <select name="company" style="width: 400px;">
  {foreach from=$allCompanies item=cur}
    <option value="{$cur.id}">{$cur.name}</option>
  {/foreach}	
  </select>

<input style="background-color:#68c248; border-right: 1px solid #2c6d15; border-bottom: 1px solid #2c6d15; margin-top:6px; cursor:pointer;color:#fff;font-weight: bold" type="submit" value="{t}Удалить{/t}" class="IEremoteBorder"/>    
</div>
<div id="clear"></div>

</form>

</div>


</div>


</div>
</div>

<div id="clear"></div>
</div>