<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0//EN"
        "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>{t}Компании{/t}</title>
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




{if sizeof($companyList)==0}
Не найдено.
{/if}

{assign var="ci" value=true}

{foreach from=$companyList item=cur}


<div class="companyBriefShort" {if $ci==true}style="background-color:#f6f2df"{assign var="ci" value=false}{else}{assign var="ci" value=true}{/if}>

<div style="position:relative;z-index:1000;">
<div id="editWnd{$cur.prop.id}" class="editWnd">
<div id="editWndCnt{$cur.prop.id}" class="editWndCnt"></div>
</div>
</div>

<div style="position:relative;z-index:1000;">
<div id="editMWnd{$cur.prop.id}" class="editMWnd">
<div id="editMWndCnt{$cur.prop.id}" class="editMWndCnt"></div>
</div>
</div>

<div class="cNameShort"><a href="#" class="cNameShortLink">{$cur.prop.name}</a></div> 

<div style="clear:both;"></div>


<table border="0" width="100%">
<tr>
<td rowspan="3" valign="top" width="200" style="padding-right:10px;">





<div class="cContactsShort">
{if $cur.prop.phone!=""}{$cur.prop.phone}<br>{/if}
{assign var="isFirst" value=true}
{foreach from=$cur.site item=elem}{if !$isFirst}, {/if}<a href="#" class="cLink size13" target="_blank">{$elem|trim}</a>{if $elem|trim!=""}{assign var="isFirst" value=false}{/if}{/foreach}
{if $isFirst==false}<br>{/if}

{assign var="isFirst" value=true}
{foreach from=$cur.email item=elem}{if !$isFirst}, {/if}<a href="#" class="cLink size13">{$elem|trim}</a>{if $elem|trim!=""}{assign var="isFirst" value=false}{/if}{/foreach}
{if $isFirst==false}<br>{/if}

{$cur.prop.address}<br>
</div>

</td>
<td rowspan="3" width="1" style="font-size:0px;"><div style="height:72px;"></div>
</td>
<tr><td style="padding-bottom:5px; padding-right:5px;">

<div class="cPeopleShort">

{assign var="isPFirst" value=true}
{foreach from=$cur.people item=curp}
	{if $isPFirst!=true}<div id="line">&nbsp;</div>{else}{assign var="isPFirst" value=false}{/if}
	{$curp.fio} 
	{if $curp.phone!=""}, {$curp.phone}{/if}
	{if $curp.email!=""}, <a href="#" class="cLink">{$curp.email}</a>{/if} 	
	{if $curp.comment!=""}, {$curp.comment}{/if}<br><div style="height:5px; font-size:5px;"></div>	
{/foreach}


</div>
</td></tr>
<tr><td valign="bottom">


{if sizeof($cur.labels)>0}

<div class="cLabel">
{assign var="isFirst" value=true}
{assign var="n" value=0}
{foreach from=$cur.labels item=item1}
{*
{if $n!=$item1.parent_id}
<div class="cLabelImg" style="background-image: url('/images/labels/15/{$item1.picture}');">&nbsp;</div>
{assign var="isFirst" value=true}
{/if}
*}
<div style="display:inline; height:15px;">{if !$isFirst}, {/if}<a href="#" class="cLink3">{$item1.name}</a></div>{assign var="isFirst" value=false}
{assign var="n" value=$item1.parent_id}
{/foreach}
</div>
<div id="clear"></div>

{/if}


</td></tr>
</table>


</div>

</div>
{/foreach}



</body>
</html>