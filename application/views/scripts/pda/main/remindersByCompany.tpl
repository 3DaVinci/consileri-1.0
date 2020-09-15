<b>{t}Напоминания для{/t} <a href="{$siteurl}/main/companyBrief" style="color:#dc8009">{$company}</a>:</b><br><br>

<span class="size2">

{if sizeof($reminderDated)==0 && sizeof($reminderUnDated)==0}
	{t}Нет напоминаний.{/t}
{/if}



<table border="0" cellpadding="0" cellspacing="0" style="font-size:100%">
{foreach from=$reminderDated item=cur}
<tr>
<td valign="top">
{if $cur.t==2}
<a href="{$siteurl}/main/remindersByCompany?delrem={$cur.id}&t=1"><img src="{$siteurl}/images/pda/remg.gif" /></a>
{else}
<a href="{$siteurl}/main/remindersByCompany?delrem={$cur.id}"><img src="{$siteurl}/images/pda/remr.gif" /></a>
{/if}&nbsp;
</td>
<td style="padding-bottom:5px;">

<span style="color:#339913">{$cur.date|date_format:"%e.%m.%y"}</span>
{$cur.text}<br><br>

</td>
</tr>
{/foreach}


<tr>
<td></td>
<td><b>{t}Без даты{/t}</b><br><br></td>
</tr>

{foreach from=$reminderUnDated item=cur}
<tr>
<td valign="top">
{if $cur.t==2}
<a href="{$siteurl}/main/remindersByCompany?delrem={$cur.id}&t=1"><img src="{$siteurl}/images/pda/remg.gif" /></a>
{else}
<a href="{$siteurl}/main/remindersByCompany?delrem={$cur.id}"><img src="{$siteurl}/images/pda/remr.gif" /></a>
{/if}&nbsp;
</td>
<td style="padding-bottom:5px;">
{$cur.text}<br><br>
</td>
</tr>
{/foreach}

{if sizeof($reminderUnDated)>0}
<tr><td></td><td>
<b>{t}Помеченные{/t}</b><br><br>
</td></tr>
{/if}

{assign var="isEmpty" value=true}
{foreach from=$reminderChecked item=cur}
{if ($cur.t==1 && !in_array($cur.name,$exclude)) || ($cur.t==2 && !in_array($cur.name,$exclude2)) }
{assign var="isEmpty" value=false}
<tr>
<td valign="top">
{if $cur.t==2}
<a href="{$siteurl}/main/remindersByCompany?delrem2={$cur.company_id}&t=1"><img src="{$siteurl}/images/pda/remg.gif" /></a>
{else}
<a href="{$siteurl}/main/remindersByCompany?delrem2={$cur.company_id}"><img src="{$siteurl}/images/pda/remr.gif" /></a>
{/if}&nbsp;
</td>
<td style="padding-bottom:5px;">
</td>
</tr>
{/if}
{/foreach}

{if $isEmpty==true}
<tr><td colspan="2">
<span style="font-size:11px">{t}Список пуст.{/t}</span><br><br>
</td></tr>
{/if}

</table>
</span>