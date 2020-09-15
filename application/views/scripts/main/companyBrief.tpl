<script language="JavaScript" type="text/javascript" src="{$siteurl}/js/favoriteController.js"></script>
<script language="JavaScript" type="text/javascript" src="{$siteurl}/js/historyModification.js"></script>
<script language="JavaScript" type="text/javascript" src="{$siteurl}/js/propBlocks.js"></script>

{include file="main/selectCompany_v1.2.tpl"}
{include file="main/managers_v1.2.tpl"}
<div id="clear" style="margin-bottom:25px;"></div> 


{if $help.12}
{include file="help/doc12.tpl"}
{/if}


{if isset($backlink) || $smarty.session.auth.is_super_user == 1}

<table cellpadding="0" border="0" class="content">
<tr><td width="40" valign="top" align="right">
</td>
<td width="620" valign="top" align="left">

{if isset($backlink)}
<div class="cListLabel">
<a href="{$siteurl}/main/" style="color:black;"><b>{t}Клиенты{/t}</b></a> /
{$backlink}
</div>
<div style="clear:both;"></div>
{/if}


{if $smarty.session.auth.is_super_user == 1}



<div style="margin-bottom:5px; float:left">
{t nickname="<span class='black'><b>`$manager.nickname`</b></span>" escape=no}Компанию ведет менеджер %nickname{/t}

</div>
<div style="margin-bottom:5px; float:right">
{if !$smarty.session.auth.readonly}
<form method="GET" action="{$siteurl}/managment/transferCompany">
{/if}
<input type="hidden" name="returntobrief" value="1">
<select name="manager">
  {foreach from=$managersList item=cur}
    <option value="{$cur.id}">{$cur.nickname}</option>
  {/foreach}	
</select>
  <input type="hidden" name="company" value="{$company_id}"/>
  <input type="hidden" name="id" value="{$manager.id}"/>
{if !$smarty.session.auth.readonly}
  <input type="submit" value="{t}Передать{/t}"/>
</form>
{/if}
</div>
<div style="clear:both"></div>
{/if}
</td>
<td>
&nbsp;
</td>
</table>
{/if}

<table cellspacing="0" cellpadding="0" border="0" class="content">
<tr><td width="40" valign="top" align="right">


<div id="fastcommandBrief">

<div class="cisFav" style="visibility: {if $isFavorite}visible{else}hidden{/if}" id="isFav{$company_id}" onclick="favOff({$company_id})"></div>
<div class="cnotFav" style="visibility: {if !$isFavorite}visible{else}hidden{/if}" id="isnotFav{$company_id}" onclick="favOn({$company_id})"></div>

<div class="cisClip" style="visibility: {if $isClip}visible{else}hidden{/if}" id="isClip{$company_id}" onclick="clipOff({$company_id})"></div>
<div class="cnotClip" style="visibility: {if !$isClip}visible{else}hidden{/if}" id="isnotClip{$company_id}" onclick="clipOn({$company_id})"></div>


</div>

</td>

<td valign="top">
<div class="companyBrief">

<div class="cName">{$name|wordwrap:40:"<br>"}</div> 


<div class="cEdit"><a href="{$siteurl}/main/editCompany" class="cLink2">{t}править{/t}</a></div>
<div class="cPrint"><a href="{$siteurl}/printer/companyInfo" class="cLink2" target="_blank">{t}печать{/t}</a></div>
<div id="clear"></div>
<div></div>

<div id="reminderPool">
<div id="reminderPoolHead"><a href="javascript:void(0)" onclick="rPoolShowForm()" style="color:#000;text-decoration:none;border-bottom:1px dashed #000">{t}поставить напоминание{/t}</a></div>
<div id="reminderPoolHeadOpen"><b>{t}новое напоминание:{/t}</b></div>
<div id="reminderPoolForm">


<input type="radio" name="visibility" value="own" id="own" checked/><label for="own" style="color:#e1131a">{t}себе{/t}</label>
<input type="radio" name="visibility" value="sm" id="sm"/ {if $smarty.session.auth.is_super_user!=1}disabled="disabled"{/if}{if $manager.id==$smarty.session.auth.id}disabled="disabled"{/if}><label for="sm" style="color:#10a007">{t}менеджеру{/t}</label>
<input type="radio" name="visibility" value="common" id="common"/><label for="common" style="color:#0a65ab">{t}всем{/t}</label>
<input type="text" name="rtext" id="rText" value="" style="width:350px;"/>
<input type="button" value="&nbsp;" onclick="rPoolAddReminder();" class="button1 IEremoteBorder"/>
<input type="button" value="&nbsp;" onclick="rPoolHideForm();" class="button2"/>

{if $help.11}
{include file="help/doc11.tpl"}
{/if}

</div>


</div>

<div style="margin: 0px 15px 15px 15px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="reminderPoolContent">
{foreach from=$remindersPool item=cur}
<tr id="rPoolTR{$cur.id}">
<td onmouseover="rPoolHightlight(this,{$cur.id})" onmouseout="rPoolUnHightlight(this,{$cur.id},'#fff')" style="border-bottom:1px solid #f6f4e6;height:20px;">
<div id="rPoolTRDiv{$cur.id}">
<div class="{if $cur.visibility=='own'}rpool_r{elseif $cur.visibility=='sm'}rpool_g{elseif $cur.visibility=='common'}rpool_b{/if}" id="rColor{$cur.id}">
<span id="inlineText{$cur.id}">

<span id="rDate{$cur.id}">{if $smarty.session.auth.is_super_user!=1 && $cur.visibility=='sm'}{$cur.nickname}: «{/if}{if $cur.date!='2000-01-01 00:00:00'}<b>{$cur.date|date_format:"%d.%m.%Y"}</b> {/if}</span>{$cur.text}{if $smarty.session.auth.is_super_user!=1 && $cur.visibility=='sm'}»{/if}</span>

<span id="rpoolb{$cur.id}" class="rpoolb" style="display:none">

<span style="position:relative">
<img src="{$siteurl}/images/edit_delete.gif" width="30" height="12" border="0" usemap="#edit_delete{$cur.id}" class="edit_delete"/>
<map name="edit_delete{$cur.id}" id="edit_delete{$cur.id}" style="display:none">
<area shape="rect" coords="0,0,13,12" href="javascript:void(0)" onclick="rPoolEdit({$cur.id},'{$cur.visibility}')"/>
<area shape="rect" coords="19,0,32,12" href="javascript:void(0)" onclick="rPoolDeleteLine({$cur.id})"/></map>
</span>
</span>

</div>
</div>

<div style="display:none;background-color:#fffc82;padding: 4px 0px 4px 0px;" id="rPoolTRForm{$cur.id}">

<input type="radio" name="visibility{$cur.id}" value="own" id="own{$cur.id}" {if $cur.visibility=='own'}checked="checked"{/if}{if $smarty.session.auth.is_super_user!=1 && $cur.visibility=='sm'} disabled="disabled"{/if}/><label for="own{$cur.id}" style="color:#e1131a">{t}себе{/t}</label>
<input type="radio" name="visibility{$cur.id}" value="sm" id="sm{$cur.id}" {if $cur.visibility=='sm'}checked="checked"{/if}{if $smarty.session.auth.is_super_user!=1 && $cur.visibility!='sm'} disabled="disabled"{/if}{if $manager.id==$smarty.session.auth.id} disabled="disabled"{/if}/><label for="sm{$cur.id}" style="color:#10a007">{t}менеджеру{/t}</label>
<input type="radio" name="visibility{$cur.id}" value="common" id="common{$cur.id}" {if $cur.visibility=='common'}checked="checked"{/if}{if $smarty.session.auth.is_super_user!=1 && $cur.visibility=='sm'} disabled="disabled"{/if}/><label for="common{$cur.id}" style="color:#0a65ab">{t}всем{/t}</label>
<input type="text" name="rtext{$cur.id}" id="rText{$cur.id}" value="{if $cur.date!='2000-01-01 00:00:00'}{$cur.date|date_format:"%d.%m.%Y"} {/if}{$cur.text|htmlspecialchars}" style="width:350px;"/>
<input type="button" value="&nbsp;" onclick="rPoolSubmitEditForm({$cur.id})" class="button1 IEremoteBorder"/>
<input type="button" value="&nbsp;" onclick="rPoolHideEditForm({$cur.id});" class="button2"/>

</div>

</td></tr>
{/foreach}
</table>
</div>

{literal}
<script language="JavaScript" type="text/javascript">
  var formSlide = new Fx.Slide('reminderPoolForm');
  formSlide.hide();
  $('reminderPoolForm').style.display = 'block';
</script>
<script language="JavaScript" type="text/javascript" src="{/literal}{$siteurl}{literal}/js/remindersPool.js"></script> 
{/literal}


<table border="0" style="width:100%">
<tr><td style="padding-left: 12px; padding-bottom: 10px; width:200px;" valign="top" align="left">

<div class="cContactsShort">
{if $phone!=""}{$phone}<br>{/if}

{assign var="isFirst" value=true}
{foreach from=$site item=cur}{if !$isFirst}, {/if}<a href="http://{$cur|trim}" class="cLink size13" target="_blank">{$cur|trim}</a>{if $cur|trim!=""}{assign var="isFirst" value=false}{/if}{/foreach}
{if $isFirst==false}<br>{/if}

{assign var="isFirst" value=true}
{foreach from=$email item=cur}{if !$isFirst}, {/if}<a href="mailto:{$cur|trim}" class="cLink size13">{$cur|trim}</a>{if $cur|trim!=""}{assign var="isFirst" value=false}{/if}{/foreach}
{if $isFirst==false}<br>{/if}

{$address}<br>
</div>


</td><td width="10"></td>

<td valign="top" align="left" style="padding-right: 12px;">

{assign var="isFirst" value=true} 
{foreach from=$people item=cur}{if $isFirst==false}<br><div id="line">&nbsp;</div>{/if}{$cur.fio}{if $cur.phone!=""}, {$cur.phone}{/if}{if $cur.email!=""}, {$cur.email|many_emails}{/if}{if $cur.comment!=""}, {$cur.comment}{/if}{assign var="isFirst" value=false}{/foreach}

</td></tr>
</table>

<div id="aboutcompany">{$about|nl2br}</div>


{if sizeof($labels)>0}


<div class="cLabel">
{assign var="isFirst" value=true}
{assign var="n" value=0}
{foreach from=$labels item=cur}
<div style="display:inline; height:15px;">{if !$isFirst}, {/if}<a href="{$siteurl}/main/searchCompanyLabels?mode=label&mparam={$cur.id}&page=1" class="cLink3">{$cur.name}</a></div>{assign var="isFirst" value=false}
{assign var="isFirst" value=false}
{/foreach}
</div>

{/if}


<div style="clear:both; height:20px;"></div>

<div class="tabs">
	<div class="tabs_title">
		<div class='active' id='tabHistory'>
			<div class='right'><div class='left'><span>{t}История{/t}</span></div></div>
		</div>
		<div class='tab' id='tabProps'>
			<div class='right'><div class='left'><span>{t}Реквизиты{/t} ({$props|@count})</span></div></div>
		</div>
		<div class='tab' id='tabFiles'>
			<div class='right'><div class='left'><span>{t}Файлы{/t} ({$files|@count})</span></div></div>
		</div>
		<div style='clear:both;'></div>
	</div>
	<div class="tab_content" id='tab_content'>
		<div id='tabHistoryContent' class='content active'>
			<div align="center">
				<form action="{$siteurl}/main/companyAddHistory" method="POST" style='text-align:left; margin-left:25px'>
				<table cellpadding="2" cellspacing="0" border="0" style="font-size:10px;">
				<tr>
				<td align="right" valign="bottom" ><div style="padding-bottom:5px; width:68px"><img src="{$siteurl}/images/plus.gif" /> {t}событие{/t}&nbsp;</div></td>
				<td>
				<input type="text" id="newEventHeader" name="name" tabindex="1" style="width:440px; height:13px;">
				</td>
				</tr>
				</table>

				<div id="newEventDetails">
				<table cellpadding="2" cellspacing="0" border="0" style="font-size:10px;">
				<tr><td align="right" valign="top"><div style="padding-top:2px">{t}подробности{/t}&nbsp;</div></td>
				<td>
				<textarea name="comment" id = "newEventDetailsComment" wrap="on" tabindex="2" style="width:440px; height:80px; font-size:11px;"></textarea>
				</td></tr>
				<tr>
				<td></td><td align="right">
				<input type="Submit" value="{t}Добавить{/t}" onclick="return beforeAddHistory();" class="buttonWithBorder">
				</td>
				</tr>
				</table>
				</div>

				</form>

				<div style="clear:both"></div>

				<table cellpadding="2" cellspacing="0" style="margin-top:20px;" border="0">
				{assign var="odd" value="true"}
				{foreach from=$events item=cur}	
				{if $odd==true}{assign var="trs" value="cOdd"}{else}{assign var="trs" value="cEven"}{/if}
					<tr id="event{$cur.id}">
					{if $cur.date|date_format:"%d.%m.%Y"==$smarty.now|date_format:"%d.%m.%Y"}		
						<td class="{$trs} eventPosted" width="71">{t}Сегодня{/t}<br>{$cur.date|date_format:"%H:%M"}</td>
					{else}
						{php}
							include('incl/month.php');
				            $this->assign('month',$month);
						{/php}	
						{assign var="m" value=$cur.date|date_format:"%m"}		
						<td class="{$trs} eventPosted" width="71">{$cur.date|date_format:"%d"} {$month.$m}</td>
					{/if}
					<td class="{$trs}r" width="537">	
					<div style="float:left">
					<div class="eventText" id="heh{$cur.id}">{$cur.name}</div><div id="heih{$cur.id}" class="heih"><input class="heihText" type="text" id="hehData{$cur.id}" value="{$cur.name|htmlspecialchars}"></div>
					<div class="eventComment" id="hec{$cur.id}">{$cur.comment}</div><div id="heic{$cur.id}" class="heic"><textarea class="heicText" id="hecData{$cur.id}" name="comment" wrap="on">{$cur.comment|regex_replace:"/[\r\t\n]/":""|regex_replace:"/<br>/":"\n"}</textarea>  
					</div>
					</div>
					<div style="float:right">
					
					{* редактирование *}
					
					{if $cur.date|date_format:"%d.%m.%Y" == $smarty.now|date_format:"%d.%m.%Y" || $cur.date|date_format:"%d.%m.%Y" == $yesterday|date_format:"%d.%m.%Y" || $smarty.session.auth.is_super_user}

				{if !$smarty.session.auth.readonly}
					<div style="width:60px;">
					<img src="{$siteurl}/images/delete.gif" id="csd{$cur.id}" onclick="changeStateDelete('{$cur.id}')" class="historyeditbutton">
					<img src="{$siteurl}/images/edit.gif" id="cs{$cur.id}" onclick="changeState('{$cur.id}')" class="historydelbutton">
					<div style="clear:both"></div>
					</div>
					
					<input type="button" id="css{$cur.id}" onclick="changeStateSave('{$cur.id}')" value="{t}Сохранить{/t}" style="visibility:hidden; display:none;" />
					<input type="button" id="csc{$cur.id}" onclick="changeStateCancel('{$cur.id}')" value="{t}Отменить{/t}" style="visibility:hidden; display:none;"/>
				{/if}	
					{/if}
					
					</div>
					<div style="clear:both"></div>
					</td>
					</tr>
					{if $odd==true}{assign var="odd" value=false}
					{else}{assign var="odd" value=true}{/if}
				{/foreach}


				<tr>
				<td colspan="2" height="40" style="font-size:11px; padding-left:15px; text-align:left;">


				{if sizeof($pages)>1}

				{assign var="isFirst" value=true}
				{foreach from=$pages item=cur}
				{assign var="m1" value=$cur.from|date_format:"%m"}	
				{assign var="m2" value=$cur.to|date_format:"%m"}	
					{if !$isFirst} | {/if}
					{if $cur.id==$page}
						{$cur.from|date_format:"%d"} {$month.$m1|lower} - 
						{$cur.to|date_format:"%d"} {$month.$m2|lower}
					{else}
						<a href="?page={$cur.id}" style="color:#0553f2">
						{$cur.from|date_format:"%d"} {$month.$m1|lower} - 
						{$cur.to|date_format:"%d"} {$month.$m2|lower}</a>
					{/if}
				{assign var="isFirst" value=false}	
				{/foreach}

				{/if}

				</td>
				</tr>
				</table>

			</div>
		</div>
		<div id='tabPropsContent' class='content'>
			<div id="propsView">
				{if sizeof($props)>1}
				<div id="props" style="padding:10px;">
				<div id="pblock1">1</div>
				<div id="pblock1_1" onclick="changeBlock(1)">
				<a href="javascript:void(0)" class="pblockLink">&nbsp;&nbsp;&nbsp;1&nbsp;&nbsp;&nbsp;</a>
				</div>

				{if sizeof($props)>=2}
				<div id="pblock2">2</div>
				<div id="pblock2_2" onclick="changeBlock(2)">
				<a href="javascript:void(0)" class="pblockLink">&nbsp;&nbsp;&nbsp;2&nbsp;&nbsp;&nbsp;</a>
				</div>
				{/if}

				{if sizeof($props)>=3}
				<div id="pblock3">3</div>
				<div id="pblock3_3" onclick="changeBlock(3)">
				<a href="javascript:void(0)" class="pblockLink">&nbsp;&nbsp;&nbsp;3&nbsp;&nbsp;&nbsp;</a>
				</div>
				{/if}

				{if sizeof($props)>=4}
				<div id="pblock4">4</div>
				<div id="pblock4_4" onclick="changeBlock(4)">
				<a href="javascript:void(0)" class="pblockLink">&nbsp;&nbsp;&nbsp;4&nbsp;&nbsp;&nbsp;</a>
				</div>
				{/if}

				</div>
				<div id="clear"></div>
				{/if}

				<div style="margin:0px 10px 0px 10px;">


				{assign var="prop_id" value=1}
				{foreach from=$props item=prop}
				{assign var="isFirst" value=true}

				<div id="pblock{$prop_id}_c" style="font-size:10px;padding-bottom:10px;">
				<table cellpadding="2" cellspacing="1" border="0" width="100%" class="briefPropCont">
				{if $prop.cname!=""}
				<tr{if $isFirst} class="lnClear"{assign var="isFirst" value=false}{/if}>
				<td class="ln1">{t}Наимен.:{/t}</td>
				<td class="ln2">&nbsp;</td>
				<td class="ln3">{$prop.cname}</td>
				</tr>
				{/if}
				{if $prop.address!=""}
				<tr{if $isFirst} class="lnClear"{assign var="isFirst" value=false}{/if}>
				<td class="ln1">{t}Адрес:{/t}</td>
				<td class="ln2">&nbsp;</td>
				<td class="ln3">{$prop.address}</td>
				</tr>
				{/if}
				{if $prop.KPP!=""}
				<tr{if $isFirst} class="lnClear"{assign var="isFirst" value=false}{/if}>
				<td class="ln1">{t}КПП:{/t}</td>
				<td class="ln2">&nbsp;</td>
				<td class="ln3">{$prop.KPP}</td>
				</tr>
				{/if}
				{if $prop.bank!=""}
				<tr{if $isFirst} class="lnClear"{assign var="isFirst" value=false}{/if}>
				<td class="ln1">{t}В банке:{/t}</td>
				<td class="ln2">&nbsp;</td>
				<td class="ln3">{$prop.bank}</td>
				</tr>
				{/if}
				{if $prop.account!=""}
				<tr{if $isFirst} class="lnClear"{assign var="isFirst" value=false}{/if}>
				<td class="ln1">{t}к/c:{/t}</td>
				<td class="ln2">&nbsp;</td>
				<td class="ln3">{$prop.account}</td>
				</tr>
				{/if}
				{if $prop.OKONH!=""}
				<tr{if $isFirst} class="lnClear"{assign var="isFirst" value=false}{/if}>
				<td class="ln1">{t}ОКОНХ:{/t}</td>
				<td class="ln2">&nbsp;</td>
				<td class="ln3">{$prop.OKONH}</td>
				</tr>
				{/if}
				{if $prop.director!=""}
				<tr{if $isFirst} class="lnClear"{assign var="isFirst" value=false}{/if}>
				<td class="ln1">{t}Руководитель:{/t}</td>
				<td class="ln2">&nbsp;</td>
				<td class="ln3">{$prop.director}</td>
				</tr>
				{/if}
				
				
				{if $prop.INN!=""}
				<tr{if $isFirst} class="lnClear"{assign var="isFirst" value=false}{/if}>
				<td class="ln1">{t}ИНН:{/t}</td>
				<td class="ln2">&nbsp;</td>
				<td class="ln3">{$prop.INN}</td>
				</tr>
				{/if}
				
				{if $prop.settlementAccount!=""}
				<tr{if $isFirst} class="lnClear"{assign var="isFirst" value=false}{/if}>
				<td class="ln1">{t}p/c:{/t}</td>
				<td class="ln2">&nbsp;</td>
				<td class="ln3">{$prop.settlementAccount}</td>
				</tr>
				{/if}
				
				{if $prop.BIK!=""}
				<tr{if $isFirst} class="lnClear"{assign var="isFirst" value=false}{/if}>
				<td class="ln1">{t}БИК:{/t}</td>
				<td class="ln2">&nbsp;</td>
				<td class="ln3">{$prop.BIK}</td>
				</tr>
				{/if}
				
				{if $prop.OKPO!=""}
				<tr{if $isFirst} class="lnClear"{assign var="isFirst" value=false}{/if}>
				<td class="ln1">{t}ОКПО:{/t}</td>
				<td class="ln2">&nbsp;</td>
				<td class="ln3">{$prop.OKPO}</td>
				</tr>
				{/if}
				
				{if $prop.OGRN!=""}
				<tr{if $isFirst} class="lnClear"{assign var="isFirst" value=false}{/if}>
				<td class="ln1">{t}ОГРН:{/t}</td>
				<td class="ln2">&nbsp;</td>
				<td class="ln3">{$prop.OGRN}</td>
				</tr>
				{/if}
				{if $prop.OKVED!=""}
				<tr{if $isFirst} class="lnClear"{assign var="isFirst" value=false}{/if}>
				<td class="ln1">{t}ОКВЕД:{/t}</td>
				<td class="ln2">&nbsp;</td>
				<td class="ln3">{$prop.OKVED}</td>
				</tr>
				{/if}
				
				</table>

				</div>



				{assign var="prop_id" value=$prop_id+1}

				{/foreach}

				{if $prop_id==2}<div id="pblock2_c"></div><div id="pblock3_c"></div><div id="pblock4_c"></div>{/if}
				{if $prop_id==3}<div id="pblock3_c"></div><div id="pblock4_c"></div>{/if}
				{if $prop_id==4}<div id="pblock4_c"></div>{/if}


				</div>

			</div>
		</div>
		<div id='tabFilesContent' class='content'>	
			<div id='attach_list'>
				<input type="Submit" class="buttonWithBorder" id="attach" value="{t}выбрать файлы{/t}">
				<div id='file-list'>
					{foreach from=$files item=file}
						<div class='file' id='file{$file.id}'>
							<div class='ico'>
								<img src='{$siteurl}/images/file{$file.type}.gif'>
							</div>
							<div class='fileinfo'>
								<div class='del'>
									<a href='#' onclick='delFile({$file.id});'><img src='{$siteurl}/images/delete.gif' style='border:none;'></a>
								</div>
								<div><a href='{$siteurl}/ajax.php?section=45&f={$file.id}' style='color:#000'>{$file.original_name}</a></div>
								<div style='color:#8c8a8a; font-size:11px; line-height:110%'>{$file.comment}</div>
								<div style='color:#8c8a8a; font-size:11px; line-height:110%'>{$file.size} / {$file.date|date_format:"%d.%m.%Y %H:%M"}</div>
							</div>
							<div style='clear:both'></div>
						</div>
					{/foreach}
				</div>
			</div>
			
			<div id="new_attach" style='display:none'>
				<div id='linux-file-upload' style='display:none;'>
					<script type="text/javascript" src="{$siteurl}/js/FileUploader/ajaxupload.js"></script>
					<input type="submit" class="buttonWithBorder" id="upload-file" value="{t}Прикрепить файл{/t}" /> 
				</div>
				<form id='files-form'>
					<input type='hidden' name='section' value='44'>
					<input type='hidden' name='company' value='{$smarty.session.auth.current_company}'>
					<table id='new-attach-list' cellpadding=0 cellspacing=0>
						<tr>
							<td>{t}Выбранные файлы:{/t}</td>
							<td style='min-width:250px;'>{t}примечание{/t}</td>
						</tr>
					</table>			 
					<a href='#' id="attach-2" style="border-bottom:1px dashed; color:#000; font-size: 12px;">{t}выбрать еще{/t}</a>
					<input type="button" class="buttonWithBorder" id="attachbtn" value="{t}загрузить{/t}" style='display:block; margin-top:7px;' onclick='filesSubmitForm()'>
				</form>
			</div>
			
			<script type="text/javascript" src="{$siteurl}/js/FileUploader/Fx.ProgressBar.js"></script>
			<script type="text/javascript" src="{$siteurl}/js/FileUploader/Swiff.Uploader.js"></script>
			<script type="text/javascript" src="{$siteurl}/js/FileUploader/FancyUpload3.js"></script>		
			<script type="text/javascript" src="{$siteurl}/js/FileUploader/script.js"></script>							
		</div>
	</div>
</div>

	{literal}
	<script language="JavaScript" type="text/javascript">
	var newEventSlide = new Fx.Slide('newEventDetails');
	newEventSlide.hide();
	
	var cont = new Fx.Slide('tab_content');
	cont.addEvent('complete', function(){
		cont.wrapper.setStyle('height', 'auto');
	});

	function changeTab(id, e) {
	  		if (($(id)!=null) && ($(id).hasClass('tab'))) {
				var e=new Event(e);
				e.stop();
				var active = $$('.tabs_title').getElement('.active');
				active.removeClass('active');
				active.addClass('tab');
				$(id).removeClass('tab');
				$(id).addClass('active');
				var activetab = $$('.tab_content').getElement('.active');
				cont.hide();
				activetab.removeClass('active');
				$(id+'Content').addClass('active');			
				cont.slideIn();			
			}
	}

	$('newEventHeader').addEvent('click', function(e){
		e = new Event(e);	
		newEventSlide.slideIn();
		e.stop();
	});
	
	$('tabHistory').addEvent('click', function(e){
		changeTab('tabHistory', e);
	})
	
	$('tabProps').addEvent('click', function(e){
		changeTab('tabProps', e);
	})
	
	$('tabFiles').addEvent('click', function(e){
		changeTab('tabFiles', e);
	})

	</script>	  
	{/literal}


</td>
<td valign="top" align="left">

{include file="main/rightBlock.tpl"}

</td>
</tr>
</table>






