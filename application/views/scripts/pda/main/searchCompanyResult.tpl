
<a href="{$siteurl}/main" style="color:black;"><b>{t}Клиенты{/t}</b></a> / 
<b>{$nowLocation}</b>
<br>

<span class="size2">

{if $pages==1}<br>{/if}

{include file="pda/pages.tpl"}


{if sizeof($companyList)==0}
<br>{t}Не найдено.{/t}
{/if}

{assign var="odd" value=true}
{foreach from=$companyList item=cur}
{if $odd==true}<div style="background-color:#ededeb">{else}<div>{/if}
<a href="{$siteurl}/main/companyBriefFromLabel?id={$cur.prop.id}&mode={$mode}&mparam={$mparam}&page=1" style="color:#ee9420"><b>{$cur.prop.name}</b></a>
</div>
{if $odd==true}{assign var="odd" value=false}{else}{assign var="odd" value=true}{/if}<br>
{/foreach}
</span>