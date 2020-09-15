
<script language="JavaScript" type="text/javascript" src="{$siteurl}/js/remindersPool.js"></script> 

<div id="favandrem">

<div id="mainrem">
<a href="{$siteurl}/main/reminders">{t}Напоминания{/t}</a> &nbsp;
<img src="{$siteurl}/images/flag_own.gif"> <span style="color:#8f8f8f;font-weight:normal">{$reminderCount}</span>
</div>

<div id="clear"></div>

{if $help.10}
{include file="help/doc10.tpl"}
{/if}


<table border="0" cellpadding="0" cellspacing="0" width="100%" style="font-weight:normal;font-size:11px;">
{foreach from=$todayReminders item=cur}
<tr>
<td onmouseover="rPoolHightlight(this,{$cur.id})" onmouseout="rPoolUnHightlight(this,{$cur.id},'#f6f4e6')"{* style="height:28px;"*}>

<div id="rPoolTRDiv{$cur.id}">
<div class="{if $cur.visibility=='own'}rpool_r_i{elseif $cur.visibility=='sm'}rpool_g_i{elseif $cur.visibility=='common'}rpool_b_i{/if}" id="rColor{$cur.id}">
&nbsp;&nbsp;&nbsp;&nbsp;<a href="{$siteurl}/main/companyBriefFromHistory?id={$cur.company_id}" style="color:#dc8009">{$cur.name}</a> - 
<span id="inlineText{$cur.id}">
<span id="rDate{$cur.id}">{if $smarty.session.auth.is_super_user!=1 && $cur.visibility=='sm'}{$cur.nickname}: «{/if}</span>{$cur.text}{if $smarty.session.auth.is_super_user!=1 && $cur.visibility=='sm'}»{/if}</span>

<span id="rpoolb{$cur.id}" class="rpoolb" style="display:none">
<span style="position:relative">
<img src="{$siteurl}/images/edit_delete.gif" width="30" height="12" border="0" usemap="#edit_delete{$cur.id}" class="edit_delete"/>
<map name="edit_delete{$cur.id}" id="edit_delete{$cur.id}" style="display:none">
<area shape="rect" coords="0,0,13,12" href="javascript:void(0)" onclick="rPoolEdit({$cur.id},'{$cur.visibility}')"/>
<area shape="rect" coords="19,0,32,12" href="javascript:void(0)" onclick="rPoolDeleteLine({$cur.id}, {$cur.company_id})"/></map>
</span>
</span>

</div>
</div>

<div style="display:none;background-color:#fffc82;padding: 4px 5px 4px 0px;font-size:11px;" id="rPoolTRForm{$cur.id}">

<input type="radio" name="visibility{$cur.id}" value="own" id="own{$cur.id}" {if $cur.visibility=='own'}checked="checked"{/if}{if $smarty.session.auth.is_super_user!=1 && $cur.visibility=='sm'} disabled="disabled"{/if}/><label for="own{$cur.id}" style="color:#e1131a">{t}себе{/t}</label>
<input type="radio" name="visibility{$cur.id}" value="sm" id="sm{$cur.id}" {if $cur.visibility=='sm'}checked="checked"{/if}{if $smarty.session.auth.is_super_user!=1 && $cur.visibility!='sm'} disabled="disabled"{/if}{if $cur.manager_id==$smarty.session.auth.id} disabled="disabled"{/if}/><label for="sm{$cur.id}" style="color:#10a007">{t}менеджеру{/t}</label>
<input type="radio" name="visibility{$cur.id}" value="common" id="common{$cur.id}" {if $cur.visibility=='common'}checked="checked"{/if}{if $smarty.session.auth.is_super_user!=1 && $cur.visibility=='sm'} disabled="disabled"{/if}/><label for="common{$cur.id}" style="color:#0a65ab">{t}всем{/t}</label>
<input type="text" name="rtext{$cur.id}" id="rText{$cur.id}" value="{if $cur.date!='2000-01-01 00:00:00'}{$cur.date|date_format:"%d.%m.%Y"} {/if}{$cur.text|htmlspecialchars}" style="width:152px;"/>
<input type="button" value="&nbsp;" onclick="rPoolSubmitEditForm2({$cur.id},{$cur.company_id})" class="button1 IEremoteBorder"/>
<input type="button" value="&nbsp;" onclick="rPoolHideEditForm({$cur.id});" class="button2"/>

</div>

</td>
</tr>
{/foreach}





{*{foreach from=$todayReminders item=cur}

<tr>
<td>

<div id="rPoolTRDiv{$cur.id}">
<div class="{if $cur.visibility=='own'}rpool_r_i{elseif $cur.visibility=='sm'}rpool_g_i{elseif $cur.visibility=='common'}rpool_b_i{/if}" id="rColor{$cur.id}">
&nbsp;&nbsp;&nbsp;&nbsp;<a href="{$siteurl}/main/companyBriefFromHistory?id={$cur.company_id}" style="color:#dc8009">{$cur.name}</a> - 
<span id="inlineText{$cur.id}">
<span id="rDate{$cur.id}">{if $smarty.session.auth.is_super_user!=1 && $cur.visibility=='sm'}{$cur.nickname}: «{/if}</span>{$cur.text}{if $smarty.session.auth.is_super_user!=1 && $cur.visibility=='sm'}»{/if}</span>
</div>
</div>

</td>
</tr>
{/foreach}*}
</table>

</div>

