
<table cellpadding="0" border="0" class="content">
<tr><td width="40">&nbsp;</td>
<td width="620" valign="top" align="left">


<table>
<tr>
<td>
<div class="journalh">
{t}Журнал:{/t} 
</div>
</td>



{if $scale==1}
{include file="journal/topday.tpl"}
{elseif $scale==2} 
{include file="journal/topweek.tpl"}
{else}
{include file="journal/topmonth.tpl"}
{/if}

{if $help.5}
{include file="help/doc5.tpl"}
{/if}

{if $help.9}
{include file="help/doc9.tpl"}
{/if}

<br>

{if sizeof($journaldata)==0}
<table cellpadding="0" cellspacing="0" width="100%" id="journaldata"> 
<tr><td class="journalOdd pad2">
{t}Нет событий.{/t}
</td></tr>
<tr>
<td class="journalBottom">&nbsp;</td>
</tr>
</table>

{else}
<table cellpadding="0" cellspacing="0" width="100%" id="journaldata"> 
{assign var="odd" value="true"}

{php}
	include('incl/month.php');
    $this->assign('month',$month);
{/php}	

	{foreach from=$journaldata item=cur}
	
	<tr>
	
	{if $odd==true}{assign var="trs" value="journalOdd"}{else}{assign var="trs" value="journalEven"}{/if}
	
	<td class="{$trs} pad2 al-center eventPosted" width="71">
	

	{assign var="mdisplay" value=$cur.date|date_format:"%m"}
	
	{if $scale==1}
		{$cur.date|date_format:"%H:%M"}
	{elseif $scale == 2}
		{$cur.date|date_format:"%e"} {$month.$mdisplay}
	{else}
		{$cur.date|date_format:"%e"} {$month.$mdisplay|lower}
	{/if}
	</td>
	<td class="{$trs} pad2" style="font-size:12px;">
	<a href="{$siteurl}/main/companyBriefFromLabel?id={$cur.id}" class="journalCompany">{$cur.cname}</a>{if $cur.manager_name!=""} ({$cur.manager_name}){/if}<br>
	<span class="eventText">{$cur.ename}</span><br>
	<span class="eventComment">{$cur.comment}</span><br>
	</td>
		 
	</tr>
	{if $odd==true}{assign var="odd" value=false}
	{else}{assign var="odd" value=true}{/if}
	{/foreach}
	
<tr>
<td class="journalBottom">&nbsp;</td>
<td class="journalBottom">&nbsp;</td>
</tr>	
</table>
{/if}




</td>
<td valign="top">

<div id="scale">
{include file="journal/scale.tpl"}
</div>

{if $scale==1}
{include file="journal/day.tpl"}
{elseif $scale==2}
{include file="journal/week.tpl"}
{else}
{include file="journal/month.tpl"}
{/if}


{if $smarty.session.auth.is_super_user}



{if $scale==1}
{include file="journal/daymanagers.tpl"}
{elseif $scale==2}
{include file="journal/weekmanagers.tpl"}
{else}
{include file="journal/monthmanagers.tpl"}
{/if}
{/if}


</td></tr>
</table>
