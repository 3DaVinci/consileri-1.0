{if isset($backlink)}
<a href="{$siteurl}/main/" style="color:black;"><b>{t}Клиенты{/t}</b></a> /
{$backlink}
{else}
<a href="{$siteurl}/main/" style="color:black;"><b>{t}Клиенты{/t}</b></a> / 
{/if}
<b style="color:#dc8009">{$name}</b>

{if $RemCount!=0}<img src="{$siteurl}/images/pda/rem.gif" /> : <a href="{$siteurl}/mainpda/remindersByCompany" style="color:#000">{$RemCount}</a>&nbsp;{/if}
{if $MRemCount!=0}<img src="{$siteurl}/images/pda/rem2.gif" /> : <a href="{$siteurl}/mainpda/remindersByCompany" style="color:#000">{$MRemCount}</a>{/if}


<span class="size2">
<br><br>
{if $phone!=""}{$phone}<br>{/if}

{assign var="isFirst" value=true}
{foreach from=$site item=cur}{if !$isFirst}, {/if}<a href="http://{$cur|trim}" target="_blank" style="color:#0553f2">{$cur|trim}</a>{if $cur|trim!=""}{assign var="isFirst" value=false}{/if}{/foreach}
{if $isFirst==false}<br>{/if}

{assign var="isFirst" value=true}
{foreach from=$email item=cur}{if !$isFirst}, {/if}<a href="mailto:{$cur|trim}" style="color:#0553f2">{$cur|trim}</a>{if $cur|trim!=""}{assign var="isFirst" value=false}{/if}{/foreach}
{if $isFirst==false}<br>{/if}

{$address}<br>
</span>

</div>

<div id="people">


{assign var="isFirst" value=true}
{foreach from=$people item=cur}
{if $isFirst==false}
<div style="border-top:1px solid black; font-size:1px;margin-top:3px;">&nbsp;</div>
{/if}
{$cur.fio}{if $cur.phone!=""}, {$cur.phone}{/if}{if $cur.email!=""}, {$cur.email|many_emails}{/if}{if $cur.comment!=""}, {$cur.comment}{/if}{assign var="isFirst" value=false}{/foreach}


</div>


<div id="content">
<span class="size2">

{if sizeof($labels)>0}
<div style="text-align:right">
{t}Метки:{/t} 
{assign var="isFirst" value=true}
{foreach from=$labels item=cur}
{if !$isFirst}, {/if}<a href="{$siteurl}/main/searchCompanyLabels?mode=label&mparam={$cur.id}&page=1" style="color:#0ca414">{$cur.name}</a>{assign var="isFirst" value=false}
{/foreach}
</div>

{/if}

<form action="{$siteurl}/main/companyAddHistory" method="POST">
<table>
<tr>
<td valign="top">
<input type="text" name="name" tabindex="1" style="width:150px" value="{$smarty.get.pda_p1}"><br>
<textarea name="comment" wrap="on" tabindex="2" style="width:150px; height:50px;">{$smarty.get.pda_p2}</textarea>
</td>
<td valign="top">
<input type="Submit" value="{t}Добавить{/t}"><br>
<span class="size2">
{if $smarty.get.pda_added==1}
<span style="color:#dc8009">{t}Добавлено.{/t}</span><br>
{/if}
{if $smarty.get.pda_added==2}
<span style="color:#dc8009">{t}Не добавлено.{/t}</span><br>
{/if}
<br>
<a href="{$siteurl}/mainpda/history" style="color:#a3a3a3">
{t}Загрузить
историю{/t}</a>
</span>
</td>
</tr>
</table>
</form>

</span>
