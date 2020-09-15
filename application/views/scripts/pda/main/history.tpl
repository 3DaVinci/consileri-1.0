<b><a href="{$siteurl}/main" style="color:black;">{t}Клиенты{/t}</a> / <a href="{$siteurl}/main/companyBrief" style="color:#dc8009">{$company}</a> / {t}История{/t}</b><br><br>

<span class="size2">

<form action="{$siteurl}/mainpda/companyAddHistory" method="POST">
<table>
<tr>
<td valign="top">
<input type="text" name="name" tabindex="1" style="width:150px" value="{$smarty.get.pda_p1}"><br>
<textarea name="comment" wrap="on" tabindex="2" style="width:150px; height:50px;">{$smarty.get.pda_p2}</textarea>
</td>
<td valign="top">
<input type="Submit" value="{t}Добавить{/t}"><br>
</td>
</tr>
</table>
</form>
<br>

{assign var="color" value="background-color:#f0eab6"}
{assign var="odd" value=true}

<table cellpadding="2" cellspacing="0" style="font-size:100%;background-color:#faf9f0" border="0">
{assign var="odd" value="true"}
{foreach from=$events item=cur}	
{if $odd==true}{assign var="trs" value="cOdd"}{else}{assign var="trs" value="cEven"}{/if}
	<tr>
	{if $cur.date|date_format:"%d.%m.%Y"==$smarty.now|date_format:"%d.%m.%Y"}		
		<td style="{if $odd}{$color};{/if} color:#dc8009" align="center" valign="top" colspan="2">{t}Сегодня{/t}<br>{$cur.date|date_format:"%H:%M"}</td>
	{else}
		{php}
			include('incl/month.php');
            $this->assign('month',$month);
		{/php}	
		{assign var="m" value=$cur.date|date_format:"%m"}		
		<td style="{if $odd}{$color};{/if} color:#dc8009" align="center" valign="top" colspan="2">{$cur.date|date_format:"%d"} {$month.$m|lower}</td>
	{/if}
	</tr>
	<tr>
	<td {if $odd}style="{$color}"{/if}>	
	<div style="float:left">
	<div>{$cur.name}</div>
	<div style="color:#909090">{$cur.comment}</div>
	</div>
	</div>
	</td>

	<td style="{if $odd}{$color};{/if} padding-left:10px;" valign="top">
	{* редактирование *}
	
	{if $cur.date|date_format:"%d.%m.%Y" == $smarty.now|date_format:"%d.%m.%Y" || $cur.date|date_format:"%d.%m.%Y" == $yesterday|date_format:"%d.%m.%Y" || $smarty.session.auth.is_super_user}

	<a href="{$siteurl}/mainpda/deleteEvent?id={$cur.id}"><img src="{$siteurl}/images/delete.gif"></a>&nbsp;&nbsp;
	<a href="{$siteurl}/mainpda/editEvent?id={$cur.id}"><img src="{$siteurl}/images/edit.gif"></a>

	{/if}
	</td>
	</tr>
	{if $odd==true}{assign var="odd" value=false}
	{else}{assign var="odd" value=true}{/if}
{/foreach}
</table>

<br>
{if $actionName!="historyAll"}<a href="{$siteurl}/mainpda/historyAll">{t}Вся история{/t}</a>{/if}

</span>
