<div style="padding-left:20px">

</div>


<table border="0" style="font-size:11px;" width="95%" cellpadding="0" cellspacing="0">
{foreach from=$labelsRoot item=cur}
<tr>
<td style="padding-bottom:12px;line-height:150%">
<div style="padding-left:20px">
<div style="padding-top:5px; padding-bottom:5px;"><b>{$cur.name}</b></div>

{assign var="isFirst" value=true}
{foreach from=$cur.labels item=item}{if !$isFirst}<span style="color:#0ca414">,</span> &nbsp;{else}{assign var="isFirst" value=false}{/if}<a href="{$siteurl}/main/searchCompanyLabels?mode=label&mparam={$item.id}&page=1" style="color:#0ca414"> {$item.name}</a>{/foreach}
</div>
</td>
</tr>
{/foreach}
</table>



