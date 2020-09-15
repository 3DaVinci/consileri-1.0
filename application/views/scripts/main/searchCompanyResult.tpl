<script language="JavaScript" type="text/javascript" src="{$siteurl}/js/favoriteController.js"></script>
<script language="JavaScript" type="text/javascript" src="{$siteurl}/js/remindersPoolList.js"></script>


{literal}
<script>
document.addEvent('click', function checkelements(e){		
		elem = e.target || e.srcElement;
		if (elem.id=="" && historyWnd!=0) hideActHistoryWnd();
});

var grCompanies = {/literal}{$grCompany};

var nowPage = "searchCompany?mode={$mode}&mparam={$mparam}&page={$page}";
var printPage = "printSelected?mode={$mode}&mparam={$mparam}&page={$page}";

{literal}
function groupAction() {

	if ($('grAction').value == 'none') return;
	
	var req = nowPage+"&gr="+$('grAction').value;
	var print = false;
	if ($('grAction').value=='print') {
		print = true;
		var req = printPage;
	}	
	
	var go = false;
	for (i=0; i < grCompanies.length; i++) {
		if ($('checkComp'+grCompanies[i]).getProperty('checked') == true) {
			go = true;
			req = req + '&checkComp'+grCompanies[i]+'=1';
		}
	}
	if (go)	{
		if (print) {			
			window.open('{/literal}{$siteurl}{literal}/printer/'+req,'{/literal}{t}Компании{/t}{literal}');
			$('grAction').value = 'none';
		} else {
			document.location = '{/literal}{$siteurl}{literal}/main/'+req; 
		}	
	} else {
		$('grAction').value = 'none';
		alert('{/literal}{t}Ничего не выбрано!{/t}{literal}');		
	}	
}

function markAll() {
	for (i=0; i < grCompanies.length; i++) {
		$('checkComp'+grCompanies[i]).setProperty('checked',true);
	}
}

function unmarkAll() {
	for (i=0; i < grCompanies.length; i++) {
		$('checkComp'+grCompanies[i]).setProperty('checked',false);
	}
}

function marking() {
	if ($('marking').getProperty('checked')==true) {
		markAll();
	} else {
		unmarkAll();
	}
}

</script>
{/literal}


<div style="margin-left:23px">

<div class="cListLabel">
<a href="{$siteurl}/main" style="color:black;"><b>{t}Клиенты{/t}</b></a> / 
{if $smarty.session.auth.is_super_user && $nowLocation=="все"}
{foreach  from=$managers item=cur}
		{if $cur.id==$managerFilter}
			<b>{$cur.nickname} /</b>
		{/if}	
{/foreach}
{/if}
<b>{$nowLocation}</b> [{$recordsFound}]
</div>
{if sizeof($companyList)!=0}
<div class="cListPrint">
<a href="{$siteurl}/printer/companiesList?mode={$mode}&mparam={$mparam}&page={$page}" class="cListPrintLink" target="_blank">{t}печать списка{/t}</a>
</div>
{/if}
<div style="clear:both;"></div>






{* pages *}

{if isset($pages) && $pages > 1 }
<div class="pages">

{if $pages>20}

<link href="{$siteurl}/images/navigator.css" rel="stylesheet" type="text/css">

<script type="text/javascript">
    var pFrom   = 1,
        pTo     = 25,
        pMax    = {$pages},
        curPage = {$page},
        timer, timer2,
        page = '{$siteurl}/{$controller}?mode={$mode}&mparam={$mparam}&page=';
</script>

<script src="{$siteurl}/js/navigator.js"></script>

<table cellspacing=0 cellpadding=0 border=0>
<tr>
  <td></td>
  <td width=510 height=2 style="background-repeat: no-repeat;" id="tdMark">
    <div id="divPos" style="filter: alpha(opacity=65); -moz-opacity: 0.65; height: 2px; position: relative; left: 0px; top: 0px; background-color: #AAAAAA;"><img src="{$siteurl}/blank.gif" width=50 height=1></div>
  </td>
  <td></td>
  <td></td>
</tr>
<tr>
  <td></td>
  <td style="background-color: #EFEFEF; padding: 5px 0px 5px 0px;">
    <div id="divPages" style="width: 510px; overflow: hidden;"
         onmousemove="moveScrolling(event)" onmouseover="startScrolling()">
      <script type="text/javascript">document.write(getPages(pFrom, pTo))</script>
    </div>
  </td>  
  <td colspan="2" nowrap>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <a href="{$siteurl}/{$controller}?mode={$mode}&mparam={$mparam}" class="pagesAllList"  onclick="if ({$pages}>50 && !confirm('{t}Вывод всех данных может выполняться долго!\nВы уверены?{/t}')) return false;">{t}весь список{/t}</a>   
  </td>
</tr>
<tr>
  <td><a href="javascript: setPages(-25)" class="arr">&lt;&lt;</a></td>
  <td class="stat"><div id="divStat"></div></td>
  <td><a href="javascript: setPages(25)" class="arr">&gt;&gt;</a></td>
  <td></td>
</tr>
</table>

{else}

	{section name=name start=1 loop=$pages+1}
	{if $smarty.section.name.index==$page} 
		<span class="pageActive">{$smarty.section.name.index}</span>
		{else}
		<span class="pageInactive"><a href="{$siteurl}/{$controller}?mode={$mode}&mparam={$mparam}&page={$smarty.section.name.index}" class="pageInactiveLink">{$smarty.section.name.index}</a></span>
		{/if}
	{/section}
	&nbsp;&nbsp;&nbsp;
	<a href="{$siteurl}/{$controller}?mode={$mode}&mparam={$mparam}" class="pagesAllList">{t}весь список{/t}</a>
{/if}
	
</div>
{/if}

</div> {* 23px *}



<div>

{if $help.7}
{include file="help/doc7.tpl"}
{/if}


{if sizeof($companyList)>0}

<div style="position:relative; top:-1px;left:-4px;float:left;margin-right:2px;">
<img src="{$siteurl}/images/pointer14.gif">
<input type="checkbox" id="marking" onclick="marking()"/>
</div>  

<select id="grAction" style="margin-bottom:5px;" onchange="groupAction()">
<option value="none">{t}Выберите действие{/t}</option>
<optgroup label="{t}Выполнить действие:{/t}">
<option value="print">{t}печать выбранного{/t}</option>
</optgroup>


<optgroup label="{t}Передать менеджеру:{/t}">
{foreach from=$managers item=cur}
<option value="manager:{$cur.id}">{$cur.nickname}</option>	
{/foreach}
</optgroup>

<optgroup label="{t}Присвоить метку:{/t}">
{foreach from=$labelsRoot item=cur}
<optgroup label="&nbsp;&nbsp;&nbsp;{t category=$cur.name}В категории %category{/t}">
{foreach from=$cur.labels item=item}
<option value="label:{$item.id}">{$item.name}</option>
{/foreach}
{/foreach}

</optgroup>
</select>
{/if}
</div>




{if sizeof($companyList)==0}
<div style="margin-left:25px;margin-top:30px;">{t}Не найдено.{/t}</div>
{/if}

{assign var="ci" value=true}

{foreach from=$companyList item=cur}
<div class="companyBriefWrap">


<div class="fastcommandWrap">

<div class="checkCompany">
<input type="checkbox" name="check" id="checkComp{$cur.prop.id}">
</div>

<div id="fastcommand">

<div class="cisFav" style="visibility: {if $cur.prop.isFavorite}visible{else}hidden{/if};top:1px;" id="isFav{$cur.prop.id}" onclick="favOff({$cur.prop.id})"></div>
<div class="cnotFav" style="visibility: {if !$cur.prop.isFavorite}visible{else}hidden{/if};top:1px;" id="isnotFav{$cur.prop.id}" onclick="favOn({$cur.prop.id})"></div>


<div class="cisClip" style="visibility: {if $cur.prop.isClip}visible{else}hidden{/if};top:21px;" id="isClip{$cur.prop.id}" onclick="clipOff({$cur.prop.id})"></div>
<div class="cnotClip" style="visibility: {if !$cur.prop.isClip}visible{else}hidden{/if};top:21px;" id="isnotClip{$cur.prop.id}" onclick="clipOn({$cur.prop.id})"></div>


</div>

</div>




<div class="companyBriefShort" {if $ci==true}style="background-color:#f6f2df"{assign var="ci" value=false}{else}{assign var="ci" value=true}{/if}>


<div class="cNameShort"><a href="{$siteurl}/main/companyBriefFromLabel?id={$cur.prop.id}&mode={$mode}&mparam={$mparam}&page=1" class="cNameShortLink">{$cur.prop.name}</a></div> 
<div class="cEdit"><a href="{$siteurl}/main/gotoEditCompany?id={$cur.prop.id}" style="color:#000;font-size:10px;">{t}править{/t}</a></div>
<div style="clear:both;"></div>



<div id="reminderPool{$cur.prop.id}" class="reminderPool">
<div id="reminderPoolHead{$cur.prop.id}" class="reminderPoolHead"><a href="javascript:void(0)" onclick="rPoolShowForm({$cur.prop.id})" style="color:#000;text-decoration:none;border-bottom:1px dashed #000">{t}поставить напоминание{/t}</a></div>
<div id="reminderPoolHeadOpen{$cur.prop.id}" class="reminderPoolHeadOpen"><b>{t}новое напоминание:{/t}</b></div>
<div id="reminderPoolForm{$cur.prop.id}" class="reminderPoolForm">


<input type="radio" name="visibility" value="own" id="own{$cur.prop.id}" checked/><label for="own" style="color:#e1131a">{t}себе{/t}</label>
<input type="radio" name="visibility" value="sm" id="sm{$cur.prop.id}"/ {if $smarty.session.auth.is_super_user!=1}disabled="disabled"{/if}{if $cur.prop.manager==$smarty.session.auth.id} disabled="disabled"{/if}><label for="sm" style="color:#10a007">{t}менеджеру{/t}</label>
<input type="radio" name="visibility" value="common" id="common{$cur.prop.id}"/><label for="common" style="color:#0a65ab">{t}всем{/t}</label>
<input type="text" name="rtext" id="rText{$cur.prop.id}" value="" style="width:350px;"/>
<input type="button" value="&nbsp;" onclick="rPoolAddReminder({$cur.prop.id});" class="button1 IEremoteBorder"/>
<input type="button" value="&nbsp;" onclick="rPoolHideForm({$cur.prop.id});" class="button2"/>
{if $help.11}
{include file="help/doc11.tpl"}
{/if}

</div>
</div>


<div style="margin: 0px 15px 15px 0px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="reminderPoolContent">
{foreach from=$cur.prop.remindersPool item=reminder}
<tr id="rPoolTR{$reminder.id}">
<td onmouseover="rPoolHightlight(this,{$reminder.id})" onmouseout="rPoolUnHightlight(this,{$reminder.id},'#fff')" style="border-bottom:1px solid #f6f4e6;height:20px;">
<div id="rPoolTRDiv{$reminder.id}">
<div class="{if $reminder.visibility=='own'}rpool_r{elseif $reminder.visibility=='sm'}rpool_g{elseif $reminder.visibility=='common'}rpool_b{/if}" id="rColor{$reminder.id}">
<span id="inlineText{$reminder.id}">

<span id="rDate{$reminder.id}">{if $smarty.session.auth.is_super_user!=1 && $reminder.visibility=='sm'}{$reminder.nickname}: «{/if}{if $reminder.date!='2000-01-01 00:00:00'}<b>{$reminder.date|date_format:"%d.%m.%Y"}</b> {/if}</span>{$reminder.text}{if $smarty.session.auth.is_super_user!=1 && $reminder.visibility=='sm'}»{/if}</span>

<span id="rpoolb{$reminder.id}" class="rpoolb" style="display:none">

<span style="position:relative">
<img src="{$siteurl}/images/edit_delete.gif" width="30" height="12" border="0" usemap="#edit_delete{$reminder.id}" class="edit_delete"/>
<map name="edit_delete{$reminder.id}" id="edit_delete{$reminder.id}" style="display:none">
<area shape="rect" coords="0,0,13,12" href="javascript:void(0)" onclick="rPoolEdit({$reminder.id},'{$reminder.visibility}')"/>
<area shape="rect" coords="19,0,32,12" href="javascript:void(0)" onclick="rPoolDeleteLine({$reminder.id},{$cur.prop.id})"/></map>
</span>

</span>

</div>
</div>

<div style="display:none;background-color:#fffc82;padding: 4px 0px 4px 0px;" id="rPoolTRForm{$reminder.id}">

<input type="radio" name="visibility{$reminder.id}" value="own" id="own{$reminder.id}" {if $reminder.visibility=='own'}checked="checked"{/if}{if $smarty.session.auth.is_super_user!=1 && $reminder.visibility=='sm'} disabled="disabled"{/if}/><label for="own{$reminder.id}" style="color:#e1131a">{t}себе{/t}</label>
<input type="radio" name="visibility{$reminder.id}" value="sm" id="sm{$reminder.id}" {if $reminder.visibility=='sm'}checked="checked"{/if}{if $smarty.session.auth.is_super_user!=1 && $reminder.visibility!='sm'} disabled="disabled"{/if}{if $cur.prop.manager==$smarty.session.auth.id} disabled="disabled"{/if}/><label for="sm{$reminder.id}" style="color:#10a007">{t}менеджеру{/t}</label>
<input type="radio" name="visibility{$reminder.id}" value="common" id="common{$reminder.id}" {if $reminder.visibility=='common'}checked="checked"{/if}{if $smarty.session.auth.is_super_user!=1 && $reminder.visibility=='sm'} disabled="disabled"{/if}/><label for="common{$reminder.id}" style="color:#0a65ab">{t}всем{/t}</label>
<input type="text" name="rtext{$reminder.id}" id="rText{$reminder.id}" value="{if $reminder.date!='2000-01-01 00:00:00'}{$reminder.date|date_format:"%d.%m.%Y"} {/if}{$reminder.text|htmlspecialchars}" style="width:350px;"/>
<input type="button" value="&nbsp;" onclick="rPoolSubmitEditForm2({$reminder.id},{$cur.prop.id})" class="button1 IEremoteBorder"/>
<input type="button" value="&nbsp;" onclick="rPoolHideEditForm({$reminder.id});" class="button2"/>

</div>

</td></tr>
{/foreach}
</table>
</div>


<table border="0" width="100%">
{assign var="cursite" value=false}
{assign var="curemail" value=false}
{assign var="curpeople" value=false}
{foreach from=$cur.site item=bnm}{if $bnm!=""}{assign var="cursite" value=true}{/if}{/foreach}
{foreach from=$cur.email item=bnm}{if $bnm!=""}{assign var="curemail" value=true}{/if}{/foreach}
{foreach from=$cur.people item=bnm}{if $bnm!=""}{assign var="curpeople" value=true}{/if}{/foreach}

{if $cur.prop.phone!="" || $cur.prop.address!="" || $cursite==true || $curemail==true || $curpeople==true}
<tr>
<td rowspan="3" valign="top" width="200" style="padding-right:10px;">



<div class="cContactsShort">
{if $cur.prop.phone!=""}{$cur.prop.phone}<br>{/if}
{assign var="isFirst" value=true}
{foreach from=$cur.site item=elem}{if !$isFirst}, {/if}<a href="http://{$elem|trim}" class="cLink size13" target="_blank">{$elem|trim}</a>{if $elem|trim!=""}{assign var="isFirst" value=false}{/if}{/foreach}
{if $isFirst==false}<br>{/if}

{assign var="isFirst" value=true}
{foreach from=$cur.email item=elem}{if !$isFirst}, {/if}<a href="mailto:{$elem|trim}" class="cLink size13">{$elem|trim}</a>{if $elem|trim!=""}{assign var="isFirst" value=false}{/if}{/foreach}
{if $isFirst==false}<br>{/if}

{$cur.prop.address}<br><br>
</div>

</td>
<td rowspan="3" width="1" style="font-size:0px;"><div style="height:72px;"></div>
</td>
<tr><td style="padding-bottom:5px; padding-right:5px;">

<div class="cPeopleShort">

{assign var="isPFirst" value=true}
{foreach from=$cur.people item=curp}
	{if $isPFirst!=true}<div id="line">&nbsp;</div>{else}{assign var="isPFirst" value=false}{/if}
	{$curp.fio}{if $curp.phone!=""}, {$curp.phone}{/if}{if $curp.email!=""}, {$curp.email|many_emails}{/if}
	{if $curp.comment!=""}, {$curp.comment}{/if}<br><div style="height:5px; font-size:5px;"></div>	
{/foreach}


</div>
</td></tr>
{/if}
<tr><td valign="bottom">


{if sizeof($cur.labels)>0}
<div class="cLabelShort">
{assign var="isFirst" value=true}
{foreach from=$cur.labels item=curl}
{if !$isFirst}, {/if}<a href="{$siteurl}/{$controller}?mode=label&mparam={$curl.id}&page=1" class="cLink3">{$curl.name}</a>{assign var="isFirst" value=false}
{/foreach}
</div>
{/if}

<div id="clear"></div>

</td></tr>
</table>

{if !$smarty.session.auth.readonly}
<div style="position:relative; z-index:1;">
<div class="cHistoryBtn" onclick="showHistoryWnd({$cur.prop.id})" id="historyWndBtn{$cur.prop.id}">{t}Ист.{/t}</div>
</div>

<div style="position:relative; z-index:2;">
<div class="cHistoryShadow" id="historyWnd{$cur.prop.id}">
<div class="cHistoryPopup" id="na">


<span class="hisTxt" id="t">{t}История:{/t}</span>
<input type="text" id="name{$cur.prop.id}" tabindex="1" class="hisFld">
<input type="button" value="{t}Добавить{/t}" class="hisBtn" tabindex="3" id="t2" onclick="addHistoryReq({$cur.prop.id})"><br>
<textarea id="comment{$cur.prop.id}" wrap="on" tabindex="2" class="hisCom"></textarea>

</div>
</div>
</div>
{/if}

</div>

</div>
{/foreach}



{literal}
<script language="JavaScript" type="text/javascript">
  
  var formSlide = new Array();
  var formSlide_id = new Array();  
  for (i=0; i < grCompanies.length; i++) {

  	formSlide[i] = new Fx.Slide('reminderPoolForm'+grCompanies[i]);
  	formSlide[i].hide();
  	formSlide_id[i] = grCompanies[i];
  	$('reminderPoolForm'+grCompanies[i]).style.display = 'block';
	
  }
  
</script>
{/literal}


<div style="margin-left:23px">

{* pages *}

{if isset($pages) && $pages > 1 }
<div class="pages">
	
{if $pages>20}

<script src="{$siteurl}/js/navigator2.js"></script>

<table cellspacing=0 cellpadding=0 border=0>
<tr>
  <td></td>
  <td width=510 height=2 style="background-repeat: no-repeat;" id="tdMark2">
    <div id="divPos2" style="filter: alpha(opacity=65); -moz-opacity: 0.65; height: 2px; position: relative; left: 0px; top: 0px; background-color: #AAAAAA;"><img src="blank.gif" width=50 height=1></div>
  </td>
  <td></td>
  <td></td>
</tr>
<tr>
  <td></td>
  <td style="background-color: #EFEFEF; padding: 5px 0px 5px 0px;">
    <div id="divPages2" style="width: 510px; overflow: hidden;"
         onmousemove="moveScrolling2(event)" onmouseover="startScrolling2()">
      <script type="text/javascript">document.write(getPages(pFrom, pTo))</script>
    </div>
  </td> 
  <td colspan="2" nowrap>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <a href="{$siteurl}/{$controller}?mode={$mode}&mparam={$mparam}" class="pagesAllList" onclick="if ({$pages}>50 && !confirm('Вывод всех данных может выполняться долго!\nВы уверены?')) return false;">{t}весь список{/t}</a> 
  </td>
</tr>
<tr>
  <td><a href="javascript: setPages2(-25)" class="arr">&lt;&lt;</a></td>
  <td class="stat"><div id="divStat2"></div></td>
  <td><a href="javascript: setPages2(25)" class="arr">&gt;&gt;</a></td>
   <td></td>
</tr>
</table>

{else}
	{section name=name start=1 loop=$pages+1}
	{if $smarty.section.name.index==$page} 
		<span class="pageActive">{$smarty.section.name.index}</span>
		{else}
		<span class="pageInactive"><a href="{$siteurl}/{$controller}?mode={$mode}&mparam={$mparam}&page={$smarty.section.name.index}" class="pageInactiveLink">{$smarty.section.name.index}</a></span>
		{/if}
	{/section}
	&nbsp;&nbsp;&nbsp;
	<a href="{$siteurl}/{$controller}?mode={$mode}&mparam={$mparam}" class="pagesAllList">{t}весь список{/t}</a>
{/if}
		
</div>	
{/if}

</div> {* 23px *}
