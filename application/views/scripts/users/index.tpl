<a href="{$siteurl}/users/addUser?retpath=users/">{t}Добавить{/t}</a>
<table>
<tr>
<td></td>
<td></td>
<td></td>
</tr>
{foreach from=$users item=cur}
<tr>
<td>{$cur.id}</td>
<td>{$cur.username}</td>
<td><a href="{$siteurl}/users/editUser?id={$cur.id}&retpath=users/">{t}Изменить{/t}</a><br>
</td>
</tr>
{/foreach}
</table>