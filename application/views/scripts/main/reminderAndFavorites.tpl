

<div id="favandrem">

<div id="mainrem">
<a href="{$siteurl}/main/reminders">{t}Напоминаний:{/t}</a> {$reminderCount}
</div>

<div id="mainfav">
<a href="{$siteurl}/main/searchCompany?mode=favorites&page=1">{t}Избранное:{/t}</a> {$favoriteCount}
</div>

<div id="clear"></div>

{if sizeof($remToday)>0 || sizeof($remTodayM)>0}
<div style="padding-left:27px; padding-top:15px; padding-bottom:10px;">{t}Сегодня:{/t}
</div>
<table border="0" cellpadding="0" cellspacing="0" class="todayrem">
{foreach from=$remToday item=cur}
<tr>
<td valign="top" style="padding-top:1px;">
<div class="todayremButton" onclick="if (confirm('{t}Вы уверены что хотите удалить напоминание?{/t}')) window.location = '{$siteurl}/main?delrem={$cur.rid}'"></div>
</td>
<td style="padding-bottom:5px;">
<a href="{$siteurl}/main/companyBriefFromHistory?id={$cur.id}" style="color:#dc8009">{$cur.name}</a>
{$cur.text}
</td>
</tr>
{/foreach}

{foreach from=$remTodayM item=cur}
<tr>
<td valign="top" style="padding-top:1px;">
<div class="todayremButtonM" onclick="if (confirm('{t}Вы уверены что хотите удалить напоминание?{/t}')) window.location = '{$siteurl}/main?delrem={$cur.rid}&t=1'"></div>
</td>
<td style="padding-bottom:5px;">
<a href="{$siteurl}/main/companyBriefFromHistory?id={$cur.id}" style="color:#dc8009">{$cur.name}</a>
{$cur.text}
</td>
</tr>
{/foreach}


</table>

{/if}

</div>

