<table>
<tr>
<td></td>
<td></td>
<td></td>
</tr>
{foreach from=$groups item=cur}
<tr>
<td>{$cur}</td>
<td><a href="{$siteurl}/user/editGroupRights?id={$cur}">{t}Изменить права доступа{/t}</a>
</td>
</tr>
{/foreach}
</table>