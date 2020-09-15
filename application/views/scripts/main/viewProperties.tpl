<table cellpadding="0" border="0" class="content">
<tr><td width="40"></td>
<td width="620" valign="top" align="left">

{include file="main/selectCompany.tpl"}

{assign var="prop_i" value=1}

{foreach from=$props item=cur}

{if $cur.cname!="" || $cur.director!="" || $cur.INN!="" || $cur.KPP!="" || $cur.settlementAccount!="" || $cur.bank!="" || $cur.BIK!="" || $cur.account!="" || $cur.OKPO!="" || $cur.OKONH!="" || $cur.OGRN!="" || $cur.OKVED!="" || $cur.address!=""}

{t}Реквизиты{/t} #{$prop_i}:<br>
{if $cur.cname!=""}{t}Наимен.:{/t} {$cur.cname}<br>{/if}
{if $cur.director!=""}{t}Руководитель:{/t} {$cur.director}<br>{/if}
{if $cur.address!=""}{t}Адрес:{/t} {$cur.address}<br>{/if}
{if $cur.INN!=""}{t}ИНН:{/t} {$cur.INN}<br>{/if}
{if $cur.KPP!=""}{t}КПП:{/t} {$cur.KPP}<br>{/if}
{if $cur.settlementAccount!=""}{t}p/c:{/t} {$cur.settlementAccount}<br>{/if}
{if $cur.bank!=""}{t}В банке:{/t} {$cur.bank}<br>{/if}
{if $cur.BIK!=""}{t}БИК:{/t} {$cur.BIK}<br>{/if}
{if $cur.account!=""}{t}к/c:{/t} {$cur.account}<br>{/if}
{if $cur.OKPO!=""}{t}ОКПО:{/t} {$cur.OKPO}<br>{/if}
{if $cur.OKONH!=""}{t}ОКОНХ:{/t} {$cur.OKONH}<br>{/if}
{if $cur.OGRN!=""}{t}ОГРН:{/t} {$cur.OGRN}<br>{/if}
{if $cur.OKVED!=""}{t}ОКВЕД:{/t} {$cur.OKVED}<br>{/if}

{assign var="notEmpty" value=true}
{assign var="prop_i" value=$prop_i+1}
<br><br>
{/if}

{/foreach}

{if !isset($notEmpty)}
{t}Реквизиты не указаны.{/t}
{/if}

</td>
<td align="left" valign="top">
<div class="bookmarks">
{include file="main/history_v1.2.tpl"}
</div>
</td>
</tr>
</table>
