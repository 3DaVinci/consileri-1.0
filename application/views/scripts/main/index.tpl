
{include file="main/selectCompany_v1.2.tpl"}


{include file="main/managers_v1.2.tpl"}

<div id="clear" style="margin-bottom:25px;"></div>  

{if isset($selectError)}<div style="padding-left:40px;">{$selectError}</div>{/if}

{if $help.4}
{include file="help/doc4.tpl"}
{/if}

<div style="padding:0px 40px 0px 40px;">

<table width="100%" border="0">
<tr>
<td width="420" style="padding-right:70px" valign="top">

{include file="main/reminderAndFavorites_v1.2.tpl"}

{include file="main/expireReminders.tpl"}

<br><br>
{include file="main/history_v1.2.tpl"}

</td>
<td valign="top">
{include file="main/searchCompany_v1.2.tpl"}

<div style="border-bottom:1px solid #e5e5e5; width:400px; height:30px; margin-bottom:27px;">&nbsp;</div>

{if isset($smarty.get.editLabels)}
	<div style="margin-bottom:10px;font-size:12px;padding:3px 15px 0px 18px; background-image:url('{$siteurl}/images/label.gif'); background-repeat:no-repeat;float:left;background-position: 0px 4px">
	<b>{t}Метки{/t}</b>
	</div>
	<div class="mode" style="float:left">{t}режим правки{/t}</div>
	<div style="float:left; font-size:11px; padding-top:3px; padding-left:15px;">
	<img src="{$siteurl}/images/pointer10.gif"/> 
	<a href="{$siteurl}/main/" style="color:#0ca414"><b>{t}обычный режим{/t}</b></a>
	</div>
	<div id="clear"></div>
	
	<div style="margin-left:9px; border-left:5px solid #fffc82; padding-left:5px;font-face:georgia;font-size:12px;">
	{t}Чтобы изменить, удалить категорию или метку, кликните по ней. Категория - это то, что черным шрифтом написано. Обобщающий признак (например, «Чудища»).  Метки - это варианты категории (например, «бегемоты», «слоны», «левиафаны»).{/t}<br>
	</div>
	<br>
	
	{include file="main/labelsEdit_v1.2.tpl"}
{else}

<div style="margin-bottom:10px;font-size:12px;padding:3px 15px 0px 18px; background-image:url('{$siteurl}/images/label.gif'); background-repeat:no-repeat;float:left;background-position: 0px 4px">
<b>{t}Метки{/t}</b>
</div>
<div style="float:left; font-size:11px;">
<span style="color:#8f8f8f">(</span>
<img src="{$siteurl}/images/edit.gif" style="position:relative;top:2px;"/><a href="{$siteurl}/main/?editLabels" style="color:#000">{t}править{/t}</a>
<span style="color:#8f8f8f">)</span>
</div>
<div id="clear"></div>

{if $help.8}
{include file="help/doc8.tpl"}
{/if}

	{include file="main/labels_v1.2.tpl"}
{/if}



</td>
</tr>
</table>

</div>

