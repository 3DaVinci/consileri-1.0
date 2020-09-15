{if $smarty.session.auth.is_admin == 1}
	<div style="font-size:12px;padding: 0px 10px 1px 5px;margin-top:3px;"><a href="{$siteurl}/managment/delclient" style="font-size:12px; color:#000">Удаление клиентов</a></div>
{/if}

{if $smarty.session.auth.is_admin == 1}
<br><br>
<b>{t}Информация о
компании{/t}</b><br>
<div style="font-size:12px;padding: 0px 10px 1px 5px;margin-top:3px;"><a href="{$siteurl}/managment/customer" style="font-size:12px; color:#000">{t}Название компании{/t}</a></div>
{/if}