
<div style="padding:20px 40px 0px 40px;">

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



{*{if $help.14}*}


{include file="backup/leftmenu.tpl"}

<div style="float:left;margin-top:5px;">

{foreach from=$errors item=error}
{$error}<br>
{/foreach}
{if sizeof($errors)>0}<br>{/if}

<table style="font-size:13px;width:720px;">
<tr><td valign="top">
<img src="{$siteurl}/images/help/helpointer.gif">
</td><td>

{t}Формат CSV предназначен для резервного копирования только самой необходимой информация из базы данных (контактной данные компании и сотрудников, отсутствует история работы, метки и др.). Его можно использовать для работы с базой данных в Exel.
Для бэкапа данных используйте формат SQL{/t}<br><br>

<div class="managerControl" style='width:310px'>

<div style="padding:11px">
<form action="{$siteurl}/backup/exportcsvgo" method="POST">
<input type='hidden' name='go' value='1' />
<div style="float:left;margin-top:5px;">
<input type="submit" value="{t}Экспортировать данные{/t}"/>
</div>
<div id="clear"></div>
</form>
<hr style='border: none; 
 color: #D6D4C6; 
 background-color: #D6D4C6; 
 height: 1px; margin:10px 0;'>
<div>
{t}Существующие файлы экспорта:{/t}<br>
<select id="fileselect" style='width:200px;'>
{foreach from=$csvfiles key=filename item=url}
   <option value="{$siteurl}{$url}">{$filename}</option>
{/foreach}
</select>
<input type="button" value="{t}Загрузить{/t}" onclick="location.href=document.getElementById('fileselect').options[document.getElementById('fileselect').selectedIndex].value" />
</div>


</div>

</div>
</td>
</tr>
</table>


</div>

</div>
