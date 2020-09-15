<a href="{$siteurl}/people/addPerson">{t}Добавить{/t}</a>
<table>
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
{foreach from=$people item=cur}
<tr>
<td>{$cur.id}</td>
<td>{$cur.fio}</td>
<td>{$cur.email}</td>
<td>{$cur.comment}</td>
<td><a href="{$siteurl}/people/editPerson?id={$cur.id}">{t}изменить{/t}</a><br>
<a href="{$siteurl}/people/delPerson?id={$cur.id}">{t}удалить{/t}</a></td>
</tr>
{/foreach}
</table>