<form method="POST" action="{$siteurl}/people/editPersonSubmit">
{t}ФИО:{/t}<input type="text" name="fio" value="{$fio}">{$error.fio}<br>
{t}E-mail:{/t}<input type="text" name="email" value="{$email}">{$error.email}<br>
{t}Коментарий:{/t}<br><textarea name="comment" rows="10" cols="50" wrap="off">{$comment}</textarea>
{$error.comment}<br>

{t}Компании:{/t} <br>
<a href="{$siteurl}/people/addpersonincompany?pid={$id}&retpath=people/editPerson&retpathparam=id={$id}">{t}Добавить{/t}</a><br>
{foreach from=$companies item=cur}
{$cur.name}  
{t}Должность:{/t} <input type="text" name="appointment[]" value="{$cur.appointment}">{$error.appointment}
<a href="{$siteurl}/people/delPersonFromCompany?pid={$id}&pid={$cur.company_id}">{t}Удалить{/t}</a><br>
<input type="hidden" name="appointment_id[]" value="{$cur.id}">
{/foreach}  

{t}Телефоны:{/t} <br>
<a href="{$siteurl}/phones/addpersonphone?pid={$id}&retpath=people/editPerson&retpathparam=id={$id}">{t}Добавить{/t}</a><br>
{foreach from=$phones item=cur}
{$cur.phone} {$cur.comment} <a href="{$siteurl}/phones/editPhone?id={$cur.id}&pid={$id}&retpath=people/editPerson&retpathparam=id={$id}">{t]Изменить{/t}</a> <a href="{$siteurl}/phones/delPhone?id={$cur.id}&pid={$id}&retpath=people/editPerson&retpathparam=id={$id}">{t}Удалить{/t}</a><br>
{/foreach}
  
<input type="hidden" name="id" value="{$id}">
<input type="hidden" name="isForm" value="1">  
<input type="submit" value="{t}Изменить{/t}">
</form>