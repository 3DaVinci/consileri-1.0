
{foreach from=$managers item=cur}
{if $cur.id==$manager.id}
<div class="selectedManager">{$cur.nickname}</div>
{else}
<div style="font-size:12px;padding: 0px 10px 1px 5px;margin-top:3px;"><a href="{$siteurl}/managment/index?id={$cur.id}" style="font-size:12px; color:#000">{$cur.nickname}</a></div>
{/if}
{/foreach}

{if $show_create_manager == true}
{if $actionName=="newManager" || $actionName=="newManagerSubmit"}
<div class="selectedManager">{t}Новый менеджер{/t}</div>
{else}
<div style="position:relative;left:-12px;font-size:12px;padding: 0px 10px 1px 5px;margin-top:3px;"><span style="color:#f4b715">+</span> <a href="{$siteurl}/managment/newManager" style="font-size:12px; color:#dc8009">{t}Новый менеджер{/t}</a></div>
{/if}
{/if}
