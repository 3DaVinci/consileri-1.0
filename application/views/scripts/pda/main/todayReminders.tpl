<a href="{$siteurl}/main" style="color:black;"><b>{t}Клиенты{/t}</b></a> / <b>{t}Сегодня:{/t}</b><br><br>

{if sizeof($remToday)>0 || sizeof($remTodayM)>0}

<span class="size2">
<table border="0" cellpadding="0" cellspacing="0" style="font-size:100%">
{foreach from=$remToday item=cur}
<tr>
<td valign="top">
<a href="{$siteurl}/mainpda/todayReminders?delrem={$cur.rid}"><img src="{$siteurl}/images/pda/remr.gif" /></a>
&nbsp;
</td>
<td style="padding-bottom:5px;">
<a href="{$siteurl}/main/companyBriefFromHistory?id={$cur.id}" style="color:#dc8009">{$cur.name}</a>
{$cur.text}
</td>
</tr>
{/foreach}

{foreach from=$remTodayM item=cur}
<tr>
<td valign="top">
<a href="{$siteurl}/mainpda/todayReminders?delrem={$cur.rid}&t=1"><img src="/images/pda/remg.gif" /></a>
&nbsp;
</td>
<td style="padding-bottom:5px;">
<a href="{$siteurl}/main/companyBriefFromHistory?id={$cur.id}" style="color:#dc8009">{$cur.name}</a>
{$cur.text}
</td>
</tr>
{/foreach}
</table>
</span>
{else}
<span class="size2">{t}Нет событий.{/t}</span>
{/if}