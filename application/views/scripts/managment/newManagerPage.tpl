<div style="padding:0px 40px 0px 40px;">
<b>{t}Менеджеры{/t}</b><br>

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

<div style="float:left;margin-top:10px;">
{include file="managment/managers.tpl"}

{include file="managment/leftmenu.tpl"}
</div>

<div style="float:left;margin-left:40px;margin-top:5px;">
<div class="managerControl">
{include file="managment/newManager.tpl"}
</div>
</div>



</div>




