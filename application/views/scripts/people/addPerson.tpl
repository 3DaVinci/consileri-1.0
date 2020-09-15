<form method="POST" action="{$siteurl}/people/addPersonSubmit">
{t}ФИО:{/t}<input type="text" name="fio" value="{$fio}">{$error.fio}<br>
{t}E-mail:{/t}<input type="text" name="email" value="{$email}">{$error.email}<br>
{t}Коментарий:{/t}<textarea name="comment" rows="10" cols="50" wrap="off">{$comment}</textarea>
{$error.comment}<br>

{t}Компания:{/t}<br>
<select name="companies[]">
   {html_options values=$companies_ids output=$companies_names selected=$companies_sel}
</select><br>
{t}Должность:{/t}<input type="text" name="appointment" value="{$appointment}">{$error.appointment}<br>
  
<input type="submit" value="{t}Добавить{/t}">
</form>