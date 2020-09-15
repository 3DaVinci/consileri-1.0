<div style="padding: 12px;">

{if $manager.id == $smarty.session.auth.id && $smarty.session.auth.is_super_user == 1}
{*
{t}Вы не можете уволить себя!{/t}
*}
{else}

<form method="GET" action="{$siteurl}/managment/deleteManagerSubmit">
<b>{t}Увольнение менеджера{/t}</b><br><br>


<div class="managerInputLabel" style="margin-top:0px;">{t}передать фирмы{/t}</div>
<div style="float:left;margin-top:5px;">
<select name="manager" style="width:200px;">
  {foreach from=$managersList item=cur}
    <option value="{$cur.id}">{$cur.nickname}</option>
  {/foreach}	
</select>
</div>
<div id="clear"></div>

<input type="hidden" name="id" value="{$id}"/>
<div class="managerInputLabel"></div>
<div style="float:left;margin-top:5px;">
<input type="submit" style="float:left; background-color:#e0e0e0; border-right: 1px solid #a3a3a3; border-bottom: 1px solid #a3a3a3; margin-top:6px; cursor:pointer;color:#ff0042;font-weight: bold" value="{t}Уволить{/t}" onclick="return confirm('{t}Удалить менеджера?{/t}');" class="IEremoteBorder"/>
</div>
<div id="clear"></div>
</form>  

{/if}

</div>
