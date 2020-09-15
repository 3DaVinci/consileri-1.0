<form method="POST" action="{$siteurl}/people/addPersonInCompanySubmit">

{t}Компания:{/t} <select name="company">
{foreach from=$companies item=cur}
<option value="{$cur.id}"{if $company==$cur.id} selected{/if}>{$cur.name}</option>
{/foreach}
</select><br>

{t}Должность:{/t}<input type="text" name="appointment" value="{$appointment}">{$error.appointment}<br>
  
<input type="hidden" name="pid" value="{$pid}">
<input type="submit" value="{t]Добавить{/t}">
</form>