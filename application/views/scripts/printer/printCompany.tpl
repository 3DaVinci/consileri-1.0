<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0//EN"
        "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>{t name=$name}Компания %name{/t}</title>
<META content="text/html; charset=utf8" http-equiv=Content-Type>
<link href="{$siteurl}/images/style_IE6.css" rel="stylesheet" type="text/css">
<script src="{$siteurl}/js/mootools.v1.11.js"></script>

<script language="JavaScript" type="text/javascript">
{literal}
	window.addEvent('load', function() {
		window.print();
	});
{/literal}
</script>

</head>

<body id="docbody" style="background-image:none;">

<div class="companyBrief">
<div class="cName">{$name}</div> 
<div class="cRep"></div>
<div style="clear:both"></div>

<div class="cContacts">
{$phone}<br>
<a href="#" class="cLink" target="_blank">{$site}</a><br>
<a href="#" class="cLink">{$email}</a><br>
{$address}<br>
</div>
<div class="cPeople">
{foreach from=$people item=cur}
	{$cur.fio} 
	{if $cur.phone!=""}, {$cur.phone}{/if}
	{if $cur.email!=""}, <a href="#" class="cLink">{$cur.email}</a>{/if} 	
	{if $cur.comment!=""}, {$cur.comment}{/if}<br>
{/foreach}

</div>
<div style="clear:both; height:10px;"></div>

<div id="aboutcompany">{$about|nl2br}</div>

<div class="cLabel">
{assign var="isFirst" value=true}
{foreach from=$labels item=cur}
{if !$isFirst}, {/if}<a href="#" class="cLink3">{$cur.name}</a>{assign var="isFirst" value=false}
{/foreach}
</div>
<div style="clear:both;"></div>

<div style="padding-left:10px;">{t}Реквизиты:{/t}</div>

{foreach from=$props item=prop}
{assign var="isFirst" value=true}

<div id="pblock{$prop_id}_c" style="font-size:10px;padding-bottom:10px;">
<table cellpadding="2" cellspacing="1" border="0" width="100%" class="briefPropCont">
{if $prop.cname!=""}
<tr{if $isFirst} class="lnClear"{assign var="isFirst" value=false}{/if}>
<td class="ln1">{t}Организация{/t}</td>
<td class="ln2">&nbsp;</td>
<td class="ln3">{$prop.cname}</td>
</tr>
{/if}
{if $prop.INN!=""}
<tr{if $isFirst} class="lnClear"{assign var="isFirst" value=false}{/if}>
<td class="ln1">{t}ИНН{/t}</td>
<td class="ln2">&nbsp;</td>
<td class="ln3">{$prop.INN}</td>
</tr>
{/if}
{if $prop.KPP!=""}
<tr{if $isFirst} class="lnClear"{assign var="isFirst" value=false}{/if}>
<td class="ln1">{t}КПП{/t}</td>
<td class="ln2">&nbsp;</td>
<td class="ln3">{$prop.KPP}</td>
</tr>
{/if}
{if $prop.settlementAccount!=""}
<tr{if $isFirst} class="lnClear"{assign var="isFirst" value=false}{/if}>
<td class="ln1">{t}p/c{/t}</td>
<td class="ln2">&nbsp;</td>
<td class="ln3">{$prop.settlementAccount}</td>
</tr>
{/if}
{if $prop.bank!=""}
<tr{if $isFirst} class="lnClear"{assign var="isFirst" value=false}{/if}>
<td class="ln1">{t}В банке{/t}</td>
<td class="ln2">&nbsp;</td>
<td class="ln3">{$prop.bank}</td>
</tr>
{/if}
{if $prop.BIK!=""}
<tr{if $isFirst} class="lnClear"{assign var="isFirst" value=false}{/if}>
<td class="ln1">{t}БИК{/t}</td>
<td class="ln2">&nbsp;</td>
<td class="ln3">{$prop.BIK}</td>
</tr>
{/if}
{if $prop.account!=""}
<tr{if $isFirst} class="lnClear"{assign var="isFirst" value=false}{/if}>
<td class="ln1">{t}к/c{/t}</td>
<td class="ln2">&nbsp;</td>
<td class="ln3">{$prop.account}</td>
</tr>
{/if}
{if $prop.OKPO!=""}
<tr{if $isFirst} class="lnClear"{assign var="isFirst" value=false}{/if}>
<td class="ln1">{t}ОКПО{/t}</td>
<td class="ln2">&nbsp;</td>
<td class="ln3">{$prop.OKPO}</td>
</tr>
{/if}
{if $prop.OKONH!=""}
<tr{if $isFirst} class="lnClear"{assign var="isFirst" value=false}{/if}>
<td class="ln1">{t}ОКОНХ{/t}</td>
<td class="ln2">&nbsp;</td>
<td class="ln3">{$prop.OKONH}</td>
</tr>
{/if}
{if $prop.OGRN!=""}
<tr{if $isFirst} class="lnClear"{assign var="isFirst" value=false}{/if}>
<td class="ln1">{t}ОГРН{/t}</td>
<td class="ln2">&nbsp;</td>
<td class="ln3">{$prop.OGRN}</td>
</tr>
{/if}
{if $prop.OKVED!=""}
<tr{if $isFirst} class="lnClear"{assign var="isFirst" value=false}{/if}>
<td class="ln1">{t}ОКВЕД{/t}</td>
<td class="ln2">&nbsp;</td>
<td class="ln3">{$prop.OKVED}</td>
</tr>
{/if}
{if $prop.director!=""}
<tr{if $isFirst} class="lnClear"{assign var="isFirst" value=false}{/if}>
<td class="ln1">{t}Ген. директор{/t}</td>
<td class="ln2">&nbsp;</td>
<td class="ln3">{$prop.director}</td>
</tr>
{/if}
</table>

</div>

{assign var="prop_id" value=$prop_id+1}

{/foreach}

</div>

</body>
</html>