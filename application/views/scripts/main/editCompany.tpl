<script language="JavaScript" type="text/javascript" src="{$siteurl}/js/favoriteController.js"></script>
<div style="padding-left:40px; margin-bottom:14px;">
<div style="margin-bottom:7px;font-size:11px; font-family:tahoma;color:#000;"><< <a href="javascript:history.back()" style="color:#000;"> {t}Вернуться{/t}</a></div>
<b>{t}Редактирование компании{/t}</b>

{if $error}
<div class="errorPanel">
{t}Ошибка:{/t}<br>
 {if $error.email}{$error.email}<br>{/if}
 {if $error.address}{$error.address}<br>{/if} 
 {if $error.phone}{$error.phone}<br>{/if} 
 {if $error.site}{$error.site}<br>{/if} 
 {if $error.people}{$error.people}<br>{/if}   
 {if $error.name}{$error.name}<br>{/if}   
  
 {if $error.inn1}{$error.inn1}<br>{/if}   
 {if $error.kpp1}{$error.kpp1}<br>{/if}   
 {if $error.settlementAccount1}{$error.settlementAccount1}<br>{/if}   
 {if $error.bank1}{$error.bank1}<br>{/if}   
 {if $error.bik1}{$error.bik1}<br>{/if}   
 {if $error.account1}{$error.account1}<br>{/if}   
 {if $error.okpo1}{$error.okpo1}<br>{/if}   
 {if $error.okonh1}{$error.okonh1}<br>{/if}   
 {if $error.ogrn1}{$error.ogrn1}<br>{/if}   
 {if $error.okved1}{$error.okved1}<br>{/if}      
 {if $error.cname1}{$error.cname1}<br>{/if}   
 {if $error.director1}{$error.director1}<br>{/if}   
 {if $error.prop_address1}{$error.prop_address1}<br>{/if}    

 {if $error.inn2}{$error.inn2}<br>{/if}   
 {if $error.kpp2}{$error.kpp2}<br>{/if}   
 {if $error.settlementAccount2}{$error.settlementAccount2}<br>{/if}   
 {if $error.bank2}{$error.bank2}<br>{/if}   
 {if $error.bik2}{$error.bik2}<br>{/if}   
 {if $error.account2}{$error.account2}<br>{/if}   
 {if $error.okpo2}{$error.okpo2}<br>{/if}   
 {if $error.okonh2}{$error.okonh2}<br>{/if}   
 {if $error.ogrn2}{$error.ogrn2}<br>{/if}   
 {if $error.okved2}{$error.okved2}<br>{/if}      
 {if $error.cname2}{$error.cname2}<br>{/if}   
 {if $error.director2}{$error.director2}<br>{/if}   
 {if $error.prop_address2}{$error.prop_address2}<br>{/if}

 {if $error.inn3}{$error.inn3}<br>{/if}   
 {if $error.kpp3}{$error.kpp3}<br>{/if}   
 {if $error.settlementAccount3}{$error.settlementAccount3}<br>{/if}   
 {if $error.bank3}{$error.bank3}<br>{/if}   
 {if $error.bik3}{$error.bik3}<br>{/if}   
 {if $error.account3}{$error.account3}<br>{/if}   
 {if $error.okpo3}{$error.okpo3}<br>{/if}   
 {if $error.okonh3}{$error.okonh3}<br>{/if}   
 {if $error.ogrn3}{$error.ogrn3}<br>{/if}   
 {if $error.okved3}{$error.okved3}<br>{/if}      
 {if $error.cname3}{$error.cname3}<br>{/if}   
 {if $error.director3}{$error.director3}<br>{/if}
 {if $error.prop_address3}{$error.prop_address3}<br>{/if}         
 
 {if $error.inn4}{$error.inn4}<br>{/if}   
 {if $error.kpp4}{$error.kpp4}<br>{/if}   
 {if $error.settlementAccount4}{$error.settlementAccount4}<br>{/if}   
 {if $error.bank4}{$error.bank4}<br>{/if}   
 {if $error.bik4}{$error.bik4}<br>{/if}   
 {if $error.account4}{$error.account4}<br>{/if}   
 {if $error.okpo4}{$error.okpo4}<br>{/if}   
 {if $error.okonh4}{$error.okonh4}<br>{/if}   
 {if $error.ogrn4}{$error.ogrn4}<br>{/if}   
 {if $error.okved4}{$error.okved4}<br>{/if}      
 {if $error.cname4}{$error.cname4}<br>{/if}   
 {if $error.director4}{$error.director4}<br>{/if} 
 {if $error.prop_address4}{$error.prop_address4}<br>{/if}    
 
</div>
{/if}

</div>

<form method="POST" action="{$siteurl}/main/editCompanySubmit">

<table border="0" width="1000"  cellpadding="0" cellspacing="0">
<tr>
<td width="710" valign="top">

<div id="fastcommandBrief" style="margin-left:17px;">

<div class="cisFav" style="visibility: {if $isFavorite}visible{else}hidden{/if}" id="isFav{$company_id}" onclick="favOff({$company_id})"></div>
<div class="cnotFav" style="visibility: {if !$isFavorite}visible{else}hidden{/if}" id="isnotFav{$company_id}" onclick="favOn({$company_id})"></div>

<div class="cisClip" style="visibility: {if $isClip}visible{else}hidden{/if}" id="isClip{$company_id}" onclick="clipOff({$company_id})"></div>
<div class="cnotClip" style="visibility: {if !$isClip}visible{else}hidden{/if}" id="isnotClip{$company_id}" onclick="clipOn({$company_id})"></div>




<div class="company" style="margin:0px 40px 0px 23px; padding:12px 15px 12px 15px; width:590px; background-image:url('{$siteurl}/images/creature1.gif');background-repeat:no-repeat; background-position:right 100px;">

<div class="companyDataH">{t}Компания{/t}</div>
<div><input type="text" name="name" value="{$name}" style="width:567px;font-size:18px;" tabindex="1"></div>

<div class="companyDataH" style="margin-top:18px;">{t}Контактная информация{/t}
{if $help.1}
{include file="help/doc1.tpl"}
{/if}
</div>
<table cellpadding="2" cellspacing="1" border="0" width="100%" style="font-family:tahoma; font-size:10px;">
<tr><td{if $error.phone} class="error"{/if} width="10">{t}телефоны{/t}</td>
<td><input type="text" name="phone" value="{$phone}" style="width: 275px" tabindex="2"></td>
</tr>
<tr><td{if $error.address} class="error"{/if} width="10">{t}адрес{/t}</td>
<td><input type="text" name="address" value="{$address}" style="width: 275px" tabindex="3"></td>
</tr>
<tr><td{if $error.site} class="error"{/if} width="10">{t}www сайт{/t}</td>
<td><input type="text" name="site" value="{$site}" style="width: 275px" tabindex="4"></td>
</tr>
<tr><td{if $error.email} class="error"{/if} width="10">{t}@почта{/t}</td>
<td><input type="text" name="email" value="{$email}" style="width: 275px" tabindex="5"></td>
</tr>
</table>

<div class="companyDataH" style="margin-top:18px;">{t}Люди{/t}
{if $help.2}
{include file="help/doc2.tpl"}
{/if}
</div>

<div><textarea name="people" id="people" wrap="on" class="companyPeopleF" tabindex="6">{$people}</textarea></div>


<div class="companyDataH" style="margin-top:18px;">{t}Примечания{/t}</div>
<div><textarea name="about" wrap="on" id="aboutcompanyedit" tabindex="7">{$about}</textarea></div>


<div id="slidein" style="font-size:11px;margin:20px 0px 10px 0px;padding:0px 9px 0px 0px;background-image:url('{$siteurl}/images/pointer11.gif');background-repeat:no-repeat;background-position:right 5px;float:left;"><div style="float:left;border-bottom:1px dashed #000;cursor:pointer;">{t}Реквизиты тоже заполнить{/t}</div></div>

<div id="slideoutWrap" style="display:none;font-size:11px;margin:20px 0px 0px 0px;padding-bottom:10px;float:left">

<span style="float:left; color:#dc8009"><b>{t}Реквизиты{/t} &nbsp;&nbsp;&nbsp;</b></span>

<div id="slideout" style="padding:0px 9px 0px 0px;cursor:pointer;float:left;background-image:url('{$siteurl}/images/pointer12.gif');background-repeat:no-repeat;background-position:right 5px;"><div style="border-bottom:1px dashed #000;cursor:pointer;float:left;">{t}да ну их{/t}</div></div>
</div>

<div id="clear"></div>


<script language="JavaScript" type="text/javascript" src="{$siteurl}/js/propBlocks.js"></script>
  

<div id="props">

<div id="pblock1">1</div>

<div id="pblock1_1" onclick="changeBlock(1)">
<a href="javascript:void(0)" class="pblockLink" tabindex="8">&nbsp;&nbsp;&nbsp;1&nbsp;&nbsp;&nbsp;</a>
</div>

<div id="pblock2">2</div>

<div id="pblock2_2" onclick="changeBlock(2)">
<a href="javascript:void(0)" class="pblockLink" tabindex="9">&nbsp;&nbsp;&nbsp;2&nbsp;&nbsp;&nbsp;</a>
</div>

<div id="pblock3">3</div>

<div id="pblock3_3" onclick="changeBlock(3)">
<a href="javascript:void(0)" class="pblockLink" tabindex="10">&nbsp;&nbsp;&nbsp;3&nbsp;&nbsp;&nbsp;</a>
</div>

<div id="pblock4">4</div>

<div id="pblock4_4" onclick="changeBlock(4)">
<a href="javascript:void(0)" class="pblockLink" tabindex="11">&nbsp;&nbsp;&nbsp;4&nbsp;&nbsp;&nbsp;</a>
</div>


<div id="clear" style="height:23px;"></div>



<div id="pblock1_c" style="font-size:10px;padding-bottom:10px;">
<table cellpadding="2" cellspacing="1" border="0" width="100%" style="margin-left:5px;">
<tr><td{if $error.cname1} class="error"{/if}>{if $bank_properties_left>0}{t}Наимен.:{/t}{/if}</td>
<td>{if $bank_properties_left>0}<input type="text" name="cname1" value="{$cname1}" class="companyPropF" tabindex="12">{/if}</td>

<td{if $error.director1} class="error"{/if}>{if $bank_properties_right>0}{t}Руководитель:{/t}{/if}</td>
<td>{if $bank_properties_right>0}<input type="text" name="director1" value="{$director1}" class="companyPropF" tabindex="13">{/if}</td>
</tr>
<tr><td{if $error.prop_address1} class="error"{/if}>{if $bank_properties_left>1}{t}Адрес:{/t}{/if}</td>
<td>{if $bank_properties_left>1}<input type="text" name="prop_address1" value="{$prop_address1}" class="companyPropF" tabindex="14">{/if}</td>

<td{if $error.inn1} class="error"{/if}>{if $bank_properties_right>1}{t}ИНН:{/t}{/if}</td>
<td>{if $bank_properties_right>1}<input type="text" name="inn1" value="{$inn1}" class="companyPropF" tabindex="15">{/if}</td>
</tr>
<tr><td{if $error.kpp1} class="error"{/if}>{if $bank_properties_left>2}{t}КПП:{/t}{/if}</td>
<td>{if $bank_properties_left>2}<input type="text" name="kpp1" value="{$kpp1}" class="companyPropF" tabindex="16">{/if}</td>

<td{if $error.settlementAccount1} class="error"{/if}>{if $bank_properties_right>2}{t}p/c:{/t}{/if}</td>
<td>{if $bank_properties_right>2}<input type="text" name="settlementAccount1" value="{$settlementAccount1}" class="companyPropF" tabindex="17">{/if}</td>
</tr>
<tr><td nowrap{if $error.bank1} class="error"{/if}>{if $bank_properties_left>3}{t}В банке:{/t}{/if}</td>
<td>{if $bank_properties_left>3}<input type="text" name="bank1" value="{$bank1}" class="companyPropF" tabindex="18">{/if}</td>

<td{if $error.bik1} class="error"{/if}>{if $bank_properties_right>3}{t}БИК:{/t}{/if}</td>
<td>{if $bank_properties_right>3}<input type="text" name="bik1" value="{$bik1}" class="companyPropF" tabindex="19">{/if}</td>
</tr>
<tr><td{if $error.account1} class="error"{/if}>{if $bank_properties_left>4}{t}к/c:{/t}{/if}</td>
<td>{if $bank_properties_left>4}<input type="text" name="account1" value="{$account1}" class="companyPropF" tabindex="20">{/if}</td>

<td{if $error.okpo1} class="error"{/if}>{if $bank_properties_right>4}{t}ОКПО:{/t}{/if}</td>
<td>{if $bank_properties_right>4}<input type="text" name="okpo1" value="{$okpo1}" class="companyPropF" tabindex="21">{/if}</td>
</tr>
<tr><td{if $error.okonh1} class="error"{/if}>{if $bank_properties_left>5}{t}ОКОНХ:{/t}{/if}</td>
<td>{if $bank_properties_left>5}<input type="text" name="okonh1" value="{$okonh1}" class="companyPropF" tabindex="22">{/if}</td>

<td{if $error.ogrn1} class="error"{/if}>{if $bank_properties_right>5}{t}ОГРН:{/t}{/if}</td>
<td>{if $bank_properties_right>5}<input type="text" name="ogrn1" value="{$ogrn1}" class="companyPropF" tabindex="23">{/if}</td>
</tr>
<tr>
<td></td>
<td></td>
<td{if $error.okved1} class="error"{/if}>{if $bank_properties_right>6}{t}ОКВЕД:{/t}{/if}</td>
<td>{if $bank_properties_right>6}<input type="text" name="okved1" value="{$okved1}" class="companyPropF" tabindex="24">{/if}</td>
</tr>
</table>
</div>




<div id="pblock2_c" style="font-size:10px;padding-bottom:10px;">
<table cellpadding="2" cellspacing="1" border="0" width="100%" style="margin-left:5px;">
<tr><td{if $error.cname2} class="error"{/if}>{if $bank_properties_left>0}{t}Наимен.:{/t}{/if}</td>
<td>{if $bank_properties_left>0}<input type="text" name="cname2" value="{$cname2}" class="companyPropF" tabindex="25">{/if}</td>

<td{if $error.director2} class="error"{/if}>{if $bank_properties_right>0}{t}Руководитель:{/t}{/if}</td>
<td>{if $bank_properties_right>0}<input type="text" name="director2" value="{$director2}" class="companyPropF" tabindex="26">{/if}</td>
</tr>
<tr><td{if $error.prop_address2} class="error"{/if}>{if $bank_properties_left>1}{t}Адрес:{/t}{/if}</td>
<td>{if $bank_properties_left>1}<input type="text" name="prop_address2" value="{$prop_address2}" class="companyPropF" tabindex="27">{/if}</td>

<td{if $error.inn2} class="error"{/if}>{if $bank_properties_right>1}{t}ИНН:{/t}{/if}</td>
<td>{if $bank_properties_right>1}<input type="text" name="inn2" value="{$inn2}" class="companyPropF" tabindex="28">{/if}</td>
</tr>
<tr><td{if $error.kpp2} class="error"{/if}>{if $bank_properties_left>2}{t}КПП:{/t}{/if}</td>
<td>{if $bank_properties_left>2}<input type="text" name="kpp2" value="{$kpp2}" class="companyPropF" tabindex="29">{/if}</td>

<td{if $error.settlementAccount2} class="error"{/if}>{if $bank_properties_right>2}{t}p/c:{/t}{/if}</td>
<td>{if $bank_properties_right>3}<input type="text" name="settlementAccount2" value="{$settlementAccount2}" class="companyPropF" tabindex="30">{/if}</td>
</tr>
<tr><td nowrap{if $error.bank2} class="error"{/if}>{if $bank_properties_left>3}{t}В банке:{/t}{/if}</td>
<td>{if $bank_properties_left>3}<input type="text" name="bank2" value="{$bank2}" class="companyPropF" tabindex="31">{/if}</td>

<td{if $error.bik2} class="error"{/if}>{if $bank_properties_right>3}{t}БИК:{/t}{/if}</td>
<td>{if $bank_properties_right>3}<input type="text" name="bik2" value="{$bik2}" class="companyPropF" tabindex="32">{/if}</td>
</tr>
<tr><td{if $error.account2} class="error"{/if}>{if $bank_properties_left>4}{t}к/c:{/t}{/if}</td>
<td>{if $bank_properties_left>4}<input type="text" name="account2" value="{$account2}" class="companyPropF" tabindex="33">{/if}</td>

<td{if $error.okpo2} class="error"{/if}>{if $bank_properties_right>4}{t}ОКПО:{/t}{/if}</td>
<td>{if $bank_properties_right>4}<input type="text" name="okpo2" value="{$okpo2}" class="companyPropF" tabindex="34">{/if}</td>
</tr>
<tr><td{if $error.okonh2} class="error"{/if}>{if $bank_properties_left>5}{t}ОКОНХ:{/t}{/if}</td>
<td>{if $bank_properties_left>5}<input type="text" name="okonh2" value="{$okonh2}" class="companyPropF" tabindex="35">{/if}</td>

<td{if $error.ogrn2} class="error"{/if}>{if $bank_properties_right>5}{t}ОГРН:{/t}{/if}</td>
<td>{if $bank_properties_right>5}<input type="text" name="ogrn2" value="{$ogrn2}" class="companyPropF" tabindex="36">{/if}</td>
</tr>
<tr>
<td></td>
<td></td>
<td{if $error.okved2} class="error"{/if}>{if $bank_properties_right>6}{t}ОКВЕД:{/t}{/if}</td>
<td>{if $bank_properties_right>6}<input type="text" name="okved2" value="{$okved2}" class="companyPropF" tabindex="37">{/if}</td>
</tr>
</table>
</div>



<div id="pblock3_c" style="font-size:10px;padding-bottom:10px;">
<table cellpadding="2" cellspacing="1" border="0" width="100%" style="margin-left:5px;">
<tr><td{if $error.cname3} class="error"{/if}>{if $bank_properties_left>0}{t}Наимен.:{/t}{/if}</td>
<td>{if $bank_properties_left>0}<input type="text" name="cname3" value="{$cname3}" class="companyPropF" tabindex="38">{/if}</td>

<td{if $error.director3} class="error"{/if}>{if $bank_properties_right>0}{t}Руководитель:{/t}{/if}</td>
<td>{if $bank_properties_right>0}<input type="text" name="director3" value="{$director3}" class="companyPropF" tabindex="39">{/if}</td>
</tr>
<tr><td{if $error.prop_address3} class="error"{/if}>{if $bank_properties_left>1}{t}Адрес:{/t}{/if}</td>
<td>{if $bank_properties_left>1}<input type="text" name="prop_address3" value="{$prop_address3}" class="companyPropF" tabindex="40">{/if}</td>

<td{if $error.inn3} class="error"{/if}>{if $bank_properties_right>1}{t}ИНН:{/t}{/if}</td>
<td>{if $bank_properties_right>1}<input type="text" name="inn3" value="{$inn3}" class="companyPropF" tabindex="41">{/if}</td>
</tr>
<tr><td{if $error.kpp3} class="error"{/if}>{if $bank_properties_left>2}{t}КПП:{/t}{/if}</td>
<td>{if $bank_properties_left>2}<input type="text" name="kpp3" value="{$kpp3}" class="companyPropF" tabindex="42">{/if}</td>

<td{if $error.settlementAccount3} class="error"{/if}>{if $bank_properties_right>2}{t}p/c:{/t}{/if}</td>
<td>{if $bank_properties_right>2}<input type="text" name="settlementAccount3" value="{$settlementAccount3}" class="companyPropF" tabindex="43">{/if}</td>
</tr>
<tr><td nowrap{if $error.bank3} class="error"{/if}>{if $bank_properties_left>3}{t}В банке:{/t}{/if}</td>
<td>{if $bank_properties_left>3}<input type="text" name="bank3" value="{$bank3}" class="companyPropF" tabindex="44">{/if}</td>

<td{if $error.bik3} class="error"{/if}>{if $bank_properties_right>3}{t}БИК:{/t}{/if}</td>
<td>{if $bank_properties_right>3}<input type="text" name="bik3" value="{$bik3}" class="companyPropF" tabindex="45">{/if}</td>
</tr>
<tr><td{if $error.account3} class="error"{/if}>{if $bank_properties_left>4}{t}к/c:{/t}{/if}</td>
<td>{if $bank_properties_left>4}<input type="text" name="account3" value="{$account3}" class="companyPropF" tabindex="46">{/if}</td>

<td{if $error.okpo3} class="error"{/if}>{if $bank_properties_right>4}{t}ОКПО:{/t}{/if}</td>
<td>{if $bank_properties_right>4}<input type="text" name="okpo3" value="{$okpo3}" class="companyPropF" tabindex="47">{/if}</td>
</tr>
<tr><td{if $error.okonh3} class="error"{/if}>{if $bank_properties_left>5}{t}ОКОНХ:{/t}{/if}</td>
<td>{if $bank_properties_left>5}<input type="text" name="okonh3" value="{$okonh3}" class="companyPropF" tabindex="48">{/if}</td>

<td{if $error.ogrn3} class="error"{/if}>{if $bank_properties_right>5}{t}ОГРН:{/t}{/if}</td>
<td>{if $bank_properties_right>5}<input type="text" name="ogrn3" value="{$ogrn3}" class="companyPropF" tabindex="49">{/if}</td>
</tr>
<tr>
<td></td>
<td></td>
<td{if $error.okved3} class="error"{/if}>{if $bank_properties_right>6}{t}ОКВЕД:{/t}{/if}</td>
<td>{if $bank_properties_right>6}<input type="text" name="okved3" value="{$okved3}" class="companyPropF" tabindex="50">{/if}</td>
</tr>
</table>
</div>

<div id="pblock4_c" style="font-size:10px;padding-bottom:10px;">
<table cellpadding="2" cellspacing="1" border="0" width="100%" style="margin-left:5px;">
<tr><td{if $error.cname4} class="error"{/if}>{if $bank_properties_left>0}{t}Наимен.:{/t}{/if}</td>
<td>{if $bank_properties_left>0}<input type="text" name="cname4" value="{$cname4}" class="companyPropF" tabindex="51">{/if}</td>

<td{if $error.director4} class="error"{/if}>{if $bank_properties_right>0}{t}Руководитель:{/t}{/if}</td>
<td>{if $bank_properties_right>0}<input type="text" name="director4" value="{$director4}" class="companyPropF" tabindex="52">{/if}</td>
</tr>
<tr><td{if $error.prop_address4} class="error"{/if}>{if $bank_properties_left>1}{t}Адрес:{/t}{/if}</td>
<td>{if $bank_properties_left>1}<input type="text" name="prop_address4" value="{$prop_address4}" class="companyPropF" tabindex="53">{/if}</td>

<td{if $error.inn4} class="error"{/if}>{if $bank_properties_right>1}{t}ИНН:{/t}{/if}</td>
<td>{if $bank_properties_right>1}<input type="text" name="inn4" value="{$inn4}" class="companyPropF" tabindex="54">{/if}</td>
</tr>
<tr><td{if $error.kpp4} class="error"{/if}>{if $bank_properties_left>2}{t}КПП:{/t}{/if}</td>
<td>{if $bank_properties_left>2}<input type="text" name="kpp4" value="{$kpp4}" class="companyPropF" tabindex="55">{/if}</td>

<td{if $error.settlementAccount4} class="error"{/if}>{if $bank_properties_right>2}{t}p/c:{/t}{/if}</td>
<td>{if $bank_properties_right>2}<input type="text" name="settlementAccount4" value="{$settlementAccount4}" class="companyPropF" tabindex="56">{/if}</td>
</tr>
<tr><td nowrap{if $error.bank4} class="error"{/if}>{if $bank_properties_left>3}{t}В банке:{/t}{/if}</td>
<td>{if $bank_properties_left>3}<input type="text" name="bank4" value="{$bank4}" class="companyPropF" tabindex="57">{/if}</td>

<td{if $error.bik4} class="error"{/if}>{if $bank_properties_right>3}{t}БИК:{/t}{/if}</td>
<td>{if $bank_properties_right>3}<input type="text" name="bik4" value="{$bik4}" class="companyPropF" tabindex="58">{/if}</td>
</tr>
<tr><td{if $error.account4} class="error"{/if}>{if $bank_properties_left>4}{t}к/c:{/t}{/if}</td>
<td>{if $bank_properties_left>4}<input type="text" name="account4" value="{$account4}" class="companyPropF" tabindex="59">{/if}</td>

<td{if $error.okpo4} class="error"{/if}>{if $bank_properties_right>4}{t}ОКПО:{/t}{/if}</td>
<td>{if $bank_properties_right>4}<input type="text" name="okpo4" value="{$okpo4}" class="companyPropF" tabindex="60">{/if}</td>
</tr>
<tr><td{if $error.okonh4} class="error"{/if}>{if $bank_properties_left>5}{t}ОКОНХ:{/t}{/if}</td>
<td>{if $bank_properties_left>5}<input type="text" name="okonh4" value="{$okonh4}" class="companyPropF" tabindex="61">{/if}</td>

<td{if $error.ogrn4} class="error"{/if}>{if $bank_properties_right>5}{t}ОГРН:{/t}{/if}</td>
<td>{if $bank_properties_right>5}<input type="text" name="ogrn4" value="{$ogrn4}" class="companyPropF" tabindex="62">{/if}</td>
</tr>
<tr>
<td></td>
<td></td>
<td{if $error.okved4} class="error"{/if}>{if $bank_properties_right>6}{t}ОКВЕД:{/t}{/if}</td>
<td>{if $bank_properties_right>6}<input type="text" name="okved4" value="{$okved4}" class="companyPropF" tabindex="63">{/if}</td>
</tr>
</table>
</div>

</div>


{literal}
<script language="JavaScript" type="text/javascript">
var propSlide = new Fx.Slide('props');
{/literal}

{if $cname1!="" || $director1!="" || $prop_address1!="" || $inn1!="" || $kpp!="" || $settlementAccount1!="" || $bank1!="" || $bik1!="" || $account1!="" || $okpo1!="" || $okonh1!="" || $ogrn1!="" || $okved1!=""} 
 $('slidein').style.display = 'none';
 $('slideoutWrap').style.display = 'block';
{else} 
 propSlide.hide();
{/if}

{literal}	
$('slidein').addEvent('click', function(e){
	e = new Event(e);
	$('slidein').style.display = 'none';
	$('slideoutWrap').style.display = 'block';	
	propSlide.slideIn();
	e.stop();
});
 
$('slideout').addEvent('click', function(e){
	e = new Event(e);
	$('slidein').style.display = 'block';
	$('slideoutWrap').style.display = 'none';
	propSlide.slideOut();
	e.stop();
});

</script>
  
{/literal}

<div style="float:right">
<input type="submit" value="{t}Изменить{/t}" id="lockButton" style="background-color:#68c248;font-family:arial;font-size:16px;color:#fff;font-weight:bold;border-bottom:1px solid #2c6d15;border-right:1px solid #2c6d15" tabindex="200">
<input type="button" value="{t}Отмена{/t}" id="lockButton" onclick="document.location='{$siteurl}/main/companyBrief'" style="background-color:#68c248;font-family:arial;font-size:16px;color:#fff;font-weight:bold;border-bottom:1px solid #2c6d15;border-right:1px solid #2c6d15" tabindex="201">
<input type="hidden" name="isForm" value="1">
</div>
<div id="clear"></div>

</div>

</div>

</td>
<td align="left" valign="top" style="font-size:11px;">




<div style="color:#0ca414; padding: 12px 0px 15px 0px; font-size:11px; font-weight:bold;">{t}Метки{/t}</div>

{assign var="ti" value=65}
{foreach from=$labelsRoot item=cur}

{assign var="i" value=0}
<b>{$cur.name}</b>

<div>
{assign var="isFirst" value=true}
{foreach from=$cur.labels item=item}
<div style="float:left; width:49%">
<input type="checkbox" name="ch{$item.id}"{if in_array($item.id,$lb)} checked{/if} id="ch{$item.id}" style="margin-left:0px; margin-top:5px;" class="checkboxFix" tabindex="{$ti}"><label for="ch{$item.id}">{$item.name}</label>
</div>

{assign var="i" value=$i+1}
{if $i>2}{assign var="i" value=1}{/if}
{if $i==2}<div id="clear"></div>{/if}

{assign var="ti" value=$ti+1}
{/foreach}
<div id="clear"></div>
<span style="color:#f4b715">+</span> <input type="text" name="newch{$cur.id}" value="{$nlb[$cur.id]}" style="width:90px;margin-top:5px;" tabindex="{$ti}">
<br><br>
</div>

{assign var="ti" value=$ti+1}
{/foreach}

</div>


</td>
</tr>
</table>

</form>
