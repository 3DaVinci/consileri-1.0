<script language="JavaScript" type="text/javascript" src="{$siteurl}/js/remindersPool.js"></script> 


{include file="main/selectCompany_v1.2.tpl"}
{include file="main/managers_v1.2.tpl"}

<div id="clear" style="margin-bottom:25px;"></div>  
<div style="padding:0px 40px 0px 40px; font-size:11px;">



<div class="cListLabel">
<a style="color: black;" href="{$siteurl}/main"><b>{t}Клиенты{/t}</b></a> / 
<img src="{$siteurl}/images/flag_own.gif" />
<b>{t}Напоминания{/t} (
</b><img src="{$siteurl}/images/remPool_r.gif"/> <span style="font-size:11px">{t}мои{/t}</span> &nbsp;
<img src="{$siteurl}/images/remPool_g.gif"/> <span style="font-size:11px">{t}от старшего менеджера{/t}</span> &nbsp;
<img src="{$siteurl}/images/remPool_b.gif"/> <span style="font-size:11px">{t}всеобщие{/t}</span><b>
)</b>

</div>
<div id="clear"></div>

<div style="width:430px;float:left;margin-top: 10px;">

{if $help.6}
{include file="help/doc6.tpl"}
{/if}

{if $help.15}
{include file="help/doc17.tpl"}
{/if}

{if sizeof($todayReminders)>0}
<div class="remindersToday">
<b>{t}Сегодня:{/t}</b>

<table border="0" cellpadding="0" cellspacing="0">
{foreach from=$todayReminders item=cur}
<tr id="rPoolTR{$cur.id}">
<td onmouseover="rPoolHightlight(this,{$cur.id})" onmouseout="rPoolUnHightlight(this,{$cur.id},'#f6f4e6')" style="height:28px;">

<div id="rPoolTRDiv{$cur.id}">
<div class="{if $cur.visibility=='own'}rpool_r_i{elseif $cur.visibility=='sm'}rpool_g_i{elseif $cur.visibility=='common'}rpool_b_i{/if}" id="rColor{$cur.id}">
&nbsp;&nbsp;&nbsp;&nbsp;<a href="{$siteurl}/main/companyBriefFromHistory?id={$cur.company_id}" style="color:#dc8009">{$cur.name}</a> - 
<span id="inlineText{$cur.id}">
<span id="rDate{$cur.id}">{if $smarty.session.auth.is_super_user!=1 && $cur.visibility=='sm'}{$cur.nickname}: «{/if}</span>{$cur.text}{if $smarty.session.auth.is_super_user!=1 && $cur.visibility=='sm'}»{/if}</span>

<span id="rpoolb{$cur.id}" class="rpoolb">
<span style="position:relative">
<img src="{$siteurl}/images/edit_delete.gif" width="30" height="12" border="0" usemap="#edit_delete{$cur.id}" class="edit_delete"/>
<map name="edit_delete{$cur.id}" id="edit_delete{$cur.id}" style="display:none">
<area shape="rect" coords="0,0,13,12" href="javascript:void(0)" onclick="rPoolEdit({$cur.id},'{$cur.visibility}')"/>
<area shape="rect" coords="19,0,32,12" href="javascript:void(0)" onclick="rPoolDeleteLineWithComp({$cur.id},{$cur.company_id})"/></map>
</span>

</span>

</div>
</div>

<div style="display:none;background-color:#fffc82;padding: 4px 0px 4px 0px;" id="rPoolTRForm{$cur.id}">

<input type="radio" name="visibility{$cur.id}" value="own" id="own{$cur.id}" {if $cur.visibility=='own'}checked="checked"{/if}{if $smarty.session.auth.is_super_user!=1 && $cur.visibility=='sm'} disabled="disabled"{/if}/><label for="own{$cur.id}" style="color:#e1131a">{t}себе{/t}</label>
<input type="radio" name="visibility{$cur.id}" value="sm" id="sm{$cur.id}" {if $cur.visibility=='sm'}checked="checked"{/if}{if $smarty.session.auth.is_super_user!=1 && $cur.visibility!='sm'} disabled="disabled"{/if}{if $cur.manager_id==$smarty.session.auth.id} disabled="disabled"{/if}/><label for="sm{$cur.id}" style="color:#10a007">{t}менеджеру{/t}</label>
<input type="radio" name="visibility{$cur.id}" value="common" id="common{$cur.id}" {if $cur.visibility=='common'}checked="checked"{/if}{if $smarty.session.auth.is_super_user!=1 && $cur.visibility=='sm'} disabled="disabled"{/if}/><label for="common{$cur.id}" style="color:#0a65ab">{t}всем{/t}</label>
<input type="text" name="rtext{$cur.id}" id="rText{$cur.id}" value="{if $cur.date!='2000-01-01 00:00:00'}{$cur.date|date_format:"%d.%m.%Y"} {/if}{$cur.text|htmlspecialchars}" style="width:165px;"/>
<input type="button" value="&nbsp;" onclick="rPoolSubmitEditForm2({$cur.id},{$cur.company_id})" class="button1 IEremoteBorder"/>
<input type="button" value="&nbsp;" onclick="rPoolHideEditForm({$cur.id});" class="button2"/>

</div>

</td>
</tr>
{/foreach}
</table>
</div>
{/if}

{php}
	include('incl/month.php');
    $this->assign('month',$month2);
{/php}	


{if $help.3 && !$help.6}
{if sizeof($todayReminders)==0 && sizeof($futureReminders)==0 && sizeof($expiredReminders)==0 && sizeof($withoutDateReminders)==0}
	{include file="help/doc18.tpl"}
{else}
	{include file="help/doc3.tpl"}
{/if}
{/if}

{assign var="curmonth" value=""}
<table border="0" cellpadding="0" cellspacing="0" width="100%">

{foreach from=$futureReminders item=cur}
{if $curmonth!=$cur.date|date_format:"%m"}
{assign var="curmonth" value=$cur.date|date_format:"%m"}
<tr><td colspan="2" style="padding-top:30px;padding-bottom:5px;"><b>{$month.$curmonth} {$cur.date|date_format:"%Y"}</b></td></tr>
{/if}


<tr id="rPoolTR{$cur.id}">

<td width="28" valign="top">
<div id="reminderDate">{$cur.date|date_format:"%d"}</div>
</td>
<td onmouseover="rPoolHightlight(this,{$cur.id})" onmouseout="rPoolUnHightlight(this,{$cur.id},'#fff')" style="height:28px;">

<div id="rPoolTRDiv{$cur.id}">
<div class="{if $cur.visibility=='own'}rpool_r_i{elseif $cur.visibility=='sm'}rpool_g_i{elseif $cur.visibility=='common'}rpool_b_i{/if}" id="rColor{$cur.id}">
&nbsp;&nbsp;&nbsp;&nbsp;<a href="{$siteurl}/main/companyBriefFromHistory?id={$cur.company_id}" style="color:#dc8009">{$cur.name}</a> - 
<span id="inlineText{$cur.id}">
<span id="rDate{$cur.id}">{if $smarty.session.auth.is_super_user!=1 && $cur.visibility=='sm'}{$cur.nickname}: «{/if}</span>{$cur.text}{if $smarty.session.auth.is_super_user!=1 && $cur.visibility=='sm'}»{/if}</span>

<span id="rpoolb{$cur.id}" class="rpoolb">

<span style="position:relative">
<img src="{$siteurl}/images/edit_delete.gif" width="30" height="12" border="0" usemap="#edit_delete{$cur.id}" class="edit_delete"/>
<map name="edit_delete{$cur.id}" id="edit_delete{$cur.id}" style="display:none">
<area shape="rect" coords="0,0,13,12" href="javascript:void(0)" onclick="rPoolEdit({$cur.id},'{$cur.visibility}')"/>
<area shape="rect" coords="19,0,32,12" href="javascript:void(0)" onclick="rPoolDeleteLineWithComp({$cur.id},{$cur.company_id})"/></map>
</span>

</span>

</div>
</div>

<div style="display:none;background-color:#fffc82;padding: 4px 0px 4px 0px;" id="rPoolTRForm{$cur.id}">

<input type="radio" name="visibility{$cur.id}" value="own" id="own{$cur.id}" {if $cur.visibility=='own'}checked="checked"{/if}{if $smarty.session.auth.is_super_user!=1 && $cur.visibility=='sm'} disabled="disabled"{/if}/><label for="own{$cur.id}" style="color:#e1131a">{t}себе{/t}</label>
<input type="radio" name="visibility{$cur.id}" value="sm" id="sm{$cur.id}" {if $cur.visibility=='sm'}checked="checked"{/if}{if $smarty.session.auth.is_super_user!=1 && $cur.visibility!='sm'} disabled="disabled"{/if}{if $cur.manager_id==$smarty.session.auth.id} disabled="disabled"{/if}/><label for="sm{$cur.id}" style="color:#10a007">{t}менеджеру{/t}</label>
<input type="radio" name="visibility{$cur.id}" value="common" id="common{$cur.id}" {if $cur.visibility=='common'}checked="checked"{/if}{if $smarty.session.auth.is_super_user!=1 && $cur.visibility=='sm'} disabled="disabled"{/if}/><label for="common{$cur.id}" style="color:#0a65ab">{t}всем{/t}</label>
<input type="text" name="rtext{$cur.id}" id="rText{$cur.id}" value="{if $cur.date!='2000-01-01 00:00:00'}{$cur.date|date_format:"%d.%m.%Y"} {/if}{$cur.text|htmlspecialchars}" style="width:165px;"/>
<input type="button" value="&nbsp;" onclick="rPoolSubmitEditForm2({$cur.id},{$cur.company_id})" class="button1 IEremoteBorder"/>
<input type="button" value="&nbsp;" onclick="rPoolHideEditForm({$cur.id});" class="button2"/>

</div>

</td>
</tr>


{/foreach}

</table>


<div style="border-bottom:1px solid #d9d9d9; margin-bottom:30px;margin-top:19px;">&nbsp;</div>
{if sizeof($expiredReminders)>0}

<b><span style="color:#ff9228">(!)</span> {t}просроченные{/t}</b><br>
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:5px;">
{foreach from=$expiredReminders item=cur}
<tr id="rPoolTR{$cur.id}">
<td onmouseover="rPoolHightlight(this,{$cur.id})" onmouseout="rPoolUnHightlight(this,{$cur.id},'#fff')" style="height:28px;">

<div id="rPoolTRDiv{$cur.id}">
<div class="{if $cur.visibility=='own'}rpool_r_i{elseif $cur.visibility=='sm'}rpool_g_i{elseif $cur.visibility=='common'}rpool_b_i{/if}" id="rColor{$cur.id}">
&nbsp;&nbsp;&nbsp;&nbsp;{if $cur.date!='2000-01-01 00:00:00'}{$cur.date|date_format:"%d.%m.%Y"} {/if}<a href="{$siteurl}/main/companyBriefFromHistory?id={$cur.company_id}" style="color:#dc8009">{$cur.name}</a> - 
<span id="inlineText{$cur.id}">
<span id="rDate{$cur.id}">{if $smarty.session.auth.is_super_user!=1 && $cur.visibility=='sm'}{$cur.nickname}: «{/if}</span>{$cur.text}{if $smarty.session.auth.is_super_user!=1 && $cur.visibility=='sm'}»{/if}</span>

<span id="rpoolb{$cur.id}" class="rpoolb">
<span style="position:relative">
<img src="{$siteurl}/images/edit_delete.gif" width="30" height="12" border="0" usemap="#edit_delete{$cur.id}" class="edit_delete"/>
<map name="edit_delete{$cur.id}" id="edit_delete{$cur.id}" style="display:none">
<area shape="rect" coords="0,0,13,12" href="javascript:void(0)" onclick="rPoolEdit({$cur.id},'{$cur.visibility}')"/>
<area shape="rect" coords="19,0,32,12" href="javascript:void(0)" onclick="rPoolDeleteLineWithComp({$cur.id},{$cur.company_id})"/></map>
</span>
</span>
</div>
</div>

<div style="display:none;background-color:#fffc82;padding: 4px 0px 4px 0px;" id="rPoolTRForm{$cur.id}">

<input type="radio" name="visibility{$cur.id}" value="own" id="own{$cur.id}" {if $cur.visibility=='own'}checked="checked"{/if}{if $smarty.session.auth.is_super_user!=1 && $cur.visibility=='sm'} disabled="disabled"{/if}/><label for="own{$cur.id}" style="color:#e1131a">{t}себе{/t}</label>
<input type="radio" name="visibility{$cur.id}" value="sm" id="sm{$cur.id}" {if $cur.visibility=='sm'}checked="checked"{/if}{if $smarty.session.auth.is_super_user!=1 && $cur.visibility!='sm'} disabled="disabled"{/if}{if $cur.manager_id==$smarty.session.auth.id} disabled="disabled"{/if}/><label for="sm{$cur.id}" style="color:#10a007">{t}менеджеру{/t}</label>
<input type="radio" name="visibility{$cur.id}" value="common" id="common{$cur.id}" {if $cur.visibility=='common'}checked="checked"{/if}{if $smarty.session.auth.is_super_user!=1 && $cur.visibility=='sm'} disabled="disabled"{/if}/><label for="common{$cur.id}" style="color:#0a65ab">{t}всем{/t}</label>
<input type="text" name="rtext{$cur.id}" id="rText{$cur.id}" value="{if $cur.date!='2000-01-01 00:00:00'}{$cur.date|date_format:"%d.%m.%Y"} {/if}{$cur.text|htmlspecialchars}" style="width:165px;"/>
<input type="button" value="&nbsp;" onclick="rPoolSubmitEditForm2({$cur.id},{$cur.company_id})" class="button1 IEremoteBorder"/>
<input type="button" value="&nbsp;" onclick="rPoolHideEditForm({$cur.id});" class="button2"/>

</div>

</td>
</tr>
{/foreach}
</table>

{/if}
</div>


<div style="margin-left:470px;margin-top: 10px;width:430px;">

{if sizeof($withoutDateReminders)>0}

<div id="remindersUnDated">
<b>{t}не привязаны к дате{/t}</b><br>
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:5px;">
{foreach from=$withoutDateReminders item=cur}

<tr id="rPoolTR{$cur.id}">
<td onmouseover="rPoolHightlight(this,{$cur.id})" onmouseout="rPoolUnHightlight(this,{$cur.id},'#f2f2f2')" style="height:28px;">

<div id="rPoolTRDiv{$cur.id}">
<div class="{if $cur.visibility=='own'}rpool_r_i{elseif $cur.visibility=='sm'}rpool_g_i{elseif $cur.visibility=='common'}rpool_b_i{/if}" id="rColor{$cur.id}">
&nbsp;&nbsp;&nbsp;&nbsp;<a href="{$siteurl}/main/companyBriefFromHistory?id={$cur.company_id}" style="color:#dc8009">{$cur.name}</a> - 
<span id="inlineText{$cur.id}">
<span id="rDate{$cur.id}">{if $smarty.session.auth.is_super_user!=1 && $cur.visibility=='sm'}{$cur.nickname}: «{/if}</span>{$cur.text}{if $smarty.session.auth.is_super_user!=1 && $cur.visibility=='sm'}»{/if}</span>

<span id="rpoolb{$cur.id}" class="rpoolb">
<span style="position:relative">
<img src="{$siteurl}/images/edit_delete.gif" width="30" height="12" border="0" usemap="#edit_delete{$cur.id}" class="edit_delete"/>
<map name="edit_delete{$cur.id}" id="edit_delete{$cur.id}" style="display:none">
<area shape="rect" coords="0,0,13,12" href="javascript:void(0)" onclick="rPoolEdit({$cur.id},'{$cur.visibility}')"/>
<area shape="rect" coords="19,0,32,12" href="javascript:void(0)" onclick="rPoolDeleteLineWithComp({$cur.id},{$cur.company_id})"/></map>
</span>
</span>
</div>
</div>

<div style="display:none;background-color:#fffc82;padding: 4px 0px 4px 0px;" id="rPoolTRForm{$cur.id}">

<input type="radio" name="visibility{$cur.id}" value="own" id="own{$cur.id}" {if $cur.visibility=='own'}checked="checked"{/if}{if $smarty.session.auth.is_super_user!=1 && $cur.visibility=='sm'} disabled="disabled"{/if}/><label for="own{$cur.id}" style="color:#e1131a">{t}себе{/t}</label>
<input type="radio" name="visibility{$cur.id}" value="sm" id="sm{$cur.id}" {if $cur.visibility=='sm'}checked="checked"{/if}{if $smarty.session.auth.is_super_user!=1 && $cur.visibility!='sm'} disabled="disabled"{/if}{if $cur.manager_id==$smarty.session.auth.id} disabled="disabled"{/if}/><label for="sm{$cur.id}" style="color:#10a007">{t}менеджеру{/t}</label>
<input type="radio" name="visibility{$cur.id}" value="common" id="common{$cur.id}" {if $cur.visibility=='common'}checked="checked"{/if}{if $smarty.session.auth.is_super_user!=1 && $cur.visibility=='sm'} disabled="disabled"{/if}/><label for="common{$cur.id}" style="color:#0a65ab">{t}всем{/t}</label>
<input type="text" name="rtext{$cur.id}" id="rText{$cur.id}" value="{if $cur.date!='2000-01-01 00:00:00'}{$cur.date|date_format:"%d.%m.%Y"} {/if}{$cur.text|htmlspecialchars}" style="width:165px;"/>
<input type="button" value="&nbsp;" onclick="rPoolSubmitEditForm2({$cur.id},{$cur.company_id})" class="button1 IEremoteBorder"/>
<input type="button" value="&nbsp;" onclick="rPoolHideEditForm({$cur.id});" class="button2"/>

</div>

</td>
</tr>

{/foreach}
</table>
</div>

{/if}

</div>

</div>
