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

{include file="backup/leftmenu.tpl"}


<div style="float:left;margin-left:40px;margin-top:5px;">
{t}Данные успешно экспортированы и доступны по адресу:{/t} <a href = "{$siteurl}/{$filename}">{$siteurl}/{$filename}</a>
</div>

</div>