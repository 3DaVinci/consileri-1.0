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

<div style="margin-left:40px;margin-top:5px;">
<table style="font-size:13px;width:720px;margin-left:30px;">
<tr><td valign="top">
<img src="{$siteurl}/images/help/helpointer.gif">
</td><td>
{t}Данный раздел предназначен для управления базой данных.{/t}
<ol>
{if !$is_saas}<li>{t}При любых изменениях в системе (обновления, установка новых модулей и т.д.) обязательно производите резервное копирование данных в формат SQL.{/t}</li>{/if}
<li>{t}Формат CSV предназначен для резервного копирования только самой необходимой информация из базы данных (контактной данные компании и сотрудников, отсутствует история работы, метки и др.). Его можно использовать для работы с базой данных в Excel.{/t}</li>
{if !$is_saas}<li>{t}Востановление данных производится из формата SQL. Имейте ввиду, что после восстановления, вся информация в базе заменяется. Будьте аккуратны при использовании этой функции, чтобы не удалить последние изменения.{/t}</li>{/if}
<li>{t}Импорт из Excel является удобным средством для заполнения базы данных клиентов. Все клиенты ипортированные через Excel добавляются в базу данных, не изменяя существующую информацию.{/t}</li>
</ol>
</td>
</tr>
</table>


</div>
