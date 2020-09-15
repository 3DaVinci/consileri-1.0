<div style="padding:20px 40px 0px 40px;">
{include file="backup/leftmenu.tpl"}

<div style="float:left;margin-top:5px;">

<table style="font-size:13px;width:720px;">
<tr><td valign="top">
<img src="{$siteurl}/images/help/helpointer.gif">
</td><td>

{t}Импорт из Excel является удобным средством для заполнения базы данных клиентов. Все клиенты ипортированные через Excel добавляются в базу данных, не изменяя существующую информацию. Для того, чтобы произвести импорт выполните следующие действия:{/t}
<ol>

<li>{t url=$template_url escape='none'}Скачайте <a href='%url'>шаблон</a> Excel для импорта.{/t}</li>
<li>{t}Перенесите соответсвующие колонки из вашего файла в шаблон. Обязательно должна быть заполнена колонка НазваниеКомпании.{/t}</li>
<li>{t}Закачайте ваш файл и нажмите кнопку Импорт.{/t}</li>
</ol>
<br><br>
<div class="managerControl" style='width:380px;'>

<div style="padding:11px">
<form action="{$siteurl}/backup/importexcelgo" method="POST" enctype="multipart/form-data">
<input type='hidden' name='go' value='1' />
{t}Файл:{/t} <input type='file' name='uploadfile' /><br>
{t}Менеджер, который будет вести импортируемые компании:{/t}<br>
<select name="manager" style="width: 200px;">
  {foreach from=$managers item=cur}
    <option value="{$cur.id}">{$cur.nickname}</option>
  {/foreach}
  </select><br>
<div style="float:left;margin-top:5px;">
<input type="submit" value="{t}Импортировать данные{/t}"/>
</div>
<div id="clear"></div>
</form>

</div>

</td>
</tr>
</table>


</div>

</div>

</div>
