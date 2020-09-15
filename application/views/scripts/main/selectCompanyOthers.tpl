<table cellpadding="0" border="0" class="content">
<tr><td width="40"></td>
<td width="620" valign="top" align="left">

{include file="main/selectCompany.tpl"}

<span class="size12" style="margin-left:80px;">{t manager=$companymanager escape=no}Эта компания есть в базе. Её курирует <b>%manager</b>{/t}
</span>
</td>
<td align="left" valign="top">
{include file="main/reminderAndFavoritesShort.tpl"}

{include file="main/searchCompany.tpl"}

{include file="main/managers.tpl"}

<div class="bookmarks">
{include file="main/history_v1.2.tpl"}
</div>
</td>
</table>