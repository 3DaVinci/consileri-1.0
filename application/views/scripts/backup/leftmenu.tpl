{*
<br><br>
<b>{t}Клиентская база{/t}</b><br>
<div style="font-size:12px;padding: 0px 10px 1px 5px;margin-top:3px;"><a href="{$siteurl}/managment/exportcsv" style="font-size:12px; color:#000">{t}Экспорт в csv{/t}</a></div>
*}
<!--{if $smarty.session.auth.is_admin == 1}
	<div style="font-size:12px;padding: 0px 10px 1px 5px;margin-top:3px;"><a href="{$siteurl}/managment/delclient" style="font-size:12px; color:#000">Удаление клиентов</a></div>
{/if}-->

{if $smarty.session.auth.is_admin == 1}
<div style="float:left; width:170px;">
<b>{t}Резервное
копирование{/t}</b><br>
{if !$is_saas}<div style="font-size:12px;padding: 0px 10px 1px 5px;margin-top:3px;"><a href="{$siteurl}/backup/sqlbackup" style="font-size:12px; color:#000">{t}SQL{/t}</a></div>{/if}
<div style="font-size:12px;padding: 0px 10px 1px 5px;margin-top:3px;"><a href="{$siteurl}/backup/csvbackup" style="font-size:12px; color:#000">{t}CSV{/t}</a></div>
<br><br>
<b>{t}Восстановление
данных{/t}</b><br>
{if !$is_saas}<div style="font-size:12px;padding: 0px 10px 1px 5px;margin-top:3px;"><a href="{$siteurl}/backup/sqlrestore" style="font-size:12px; color:#000">{t}SQL{/t}</a></div>{/if}
<div style="font-size:12px;padding: 0px 10px 1px 5px;margin-top:3px;"><a href="{$siteurl}/backup/importexcel" style="font-size:12px; color:#000">{t}Excel{/t}</a></div>
</div>
{/if}