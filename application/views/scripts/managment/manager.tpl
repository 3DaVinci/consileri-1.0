<div style="padding: 12px 12px 12px 12px;">
<b>{t}Передача фирмы{/t}</b><br><br>

<form method="POST" action="{$siteurl}/managment/transferCompany">

<div class="managerInputLabel">&nbsp;</div>
<div style="float:left;">
 
  <select name="company" style="width: 200px;">
  {foreach from=$allCompanies item=cur}
    <option value="{$cur.id}">{$cur.name}</option>
  {/foreach}	
  </select>
<img src="{$siteurl}/images/managmentTransfer.gif" style="position:relative; top:5px; margin-left:15px; margin-right:20px;">
  <select name="manager" style="width: 200px;">
  {foreach from=$managersList item=cur}
    <option value="{$cur.id}">{$cur.nickname}</option>
  {/foreach}	
  </select>

</div>
<div id="clear"></div>

<div class="managerInputLabel">{t}причина{/t}</div>
<div style="float:left;margin-top:5px;">

<input type="text" name="comment" style="width:420px;" value="{$comment}">
</div>  

<div id="clear"></div>
  
<input type="hidden" name="page" value="{$page}"/>
<input type="hidden" name="id" value="{$manager.id}"/>

<div class="managerInputLabel">&nbsp;</div>
<div style="float:left;">
<input style="float:left; background-color:#68c248; border-right: 1px solid #2c6d15; border-bottom: 1px solid #2c6d15; margin-top:6px; cursor:pointer;color:#fff;font-weight: bold" type="submit" value="{t}Передать{/t}" class="IEremoteBorder"/>   
{if $transfer_notify}<br><br><br><b>{$transfer_notify}</b>{/if} 
</div>
<div id="clear"></div>

</form>

</div>
