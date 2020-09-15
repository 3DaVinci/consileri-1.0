
<table border="0" style="font-size:11px;" width="95%" cellpadding="0" cellspacing="0">
{foreach from=$labelsRoot item=cur}
<tr>
<td width="40" align="center" valign="top" style="padding-bottom:10px;"><img src="{$siteurl}/images/labels/25/{$cur.picture}" /></td>
<td style="padding-bottom:10px;">

<div style="padding-top:5px; padding-bottom:10px;"><b>{$cur.name}</b></div>

{assign var="isFirst" value=true}
{foreach from=$cur.labels item=item}{if !$isFirst}, {else}{assign var="isFirst" value=false}{/if}<a href="{$siteurl}/main/searchCompanyLabels?mode=label&mparam={$item.id}&page=1" style="color:#0ca414"> {$item.name}</a>{/foreach}
</td>
</tr>
{/foreach}
</table>