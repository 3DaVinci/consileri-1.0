<a href="{$siteurl}/main" style="color:black;"><b>{t}Клиенты{/t}</b></a><br>

<span class="size2">
{if sizeof($companyList)==0}
{t}Ничего не найдено.{/t}	
{/if}

{if $pages==1}<br>{/if}

{include file="pda/pagesSearch.tpl"}

{assign var="odd" value=true}
{foreach from=$companyList item=cur}

{if $odd==true}<div style="background-color:#ededeb">{else}<div>{/if}

{if $cur.blocked==false}
	<a href="{$siteurl}/main/companyBriefFromLabel?id={$cur.prop.id}&mode={$mode}&mparam={$mparam}&page=1" style="color:#ee9420"><b>{$cur.prop.name}</b></a><br>
{else}
	<b>{$cur.prop.name}</b> ({$cur.manager})<br>
{/if}

{if $odd==true}{assign var="odd" value=false}{else}{assign var="odd" value=true}{/if}<br>
{/foreach}
</span>


