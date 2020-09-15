
<div style="padding:20px 40px 0px 40px;">

{if isset($error)}
{if isset($error.username)}
<span style="background-color:#f34320; padding:2px 5px 2px 5px; color:#fff; font-size:12px;">{$error.username}</span><br>
{/if}

{if isset($error.nickname)}
<span style="background-color:#f34320; padding:2px 5px 2px 5px; color:#fff; font-size:12px;">{$error.nickname}</span><br>
{/if}

{if isset($error.password)}
<span style="background-color:#f34320; padding:2px 5px 2px 5px; color:#fff; font-size:12px;">{$error.password}</span><br>
{/if}

{if isset($error.email)}
<span style="background-color:#f34320; padding:2px 5px 2px 5px; color:#fff; font-size:12px;">{$error.email}</span><br>
{/if}

{/if}



{*{if $help.14}*}


{include file="backup/leftmenu.tpl"}

<div style="margin-top:5px;">
<table style="font-size:13px;width:720px;margin-left:30px;">
<tr><td valign="top">
<img src="{$siteurl}/images/help/helpointer.gif">
</td><td>
	{t}Данный раздел предназначен для полного бэкапа базы данных. Мы рекомендуем  производить резервное копирование базы данных не реже одного раза в неделю. Не храните всю информацию на хостинге, делайте копии на другие надежные носители и держите их в надежном месте.{/t}<br><br>

{if $is_demo}
{t}Вы не можете загрузить данные в демо-режиме.{/t}
{else}
<SCRIPT LANGUAGE="JavaScript">
	idTimer=window.setTimeout("reloadFrame();", 3 * 1000);
	function reloadFrame() {ldelim}
		frame1 = document.getElementById("frame1");
		if ((frame1.contentDocument == null)||(frame1.contentDocument.title == ""))
			if (navigator.userAgent.toLowerCase().indexOf('gecko')!=-1)
				frame1.src+='&'+new Date().getTime();
			else
				frame1.location.reload();
		return;
	{rdelim}
</SCRIPT>
 <iframe src="{$siteurl}/dumper/dumper.php?act=backup" noresize="noresize" frameborder="0" border="0" cellspacing="0" style="border: none ; width: 385px; height: 290px;" align="left" id='frame1'>
    {t}Ваш браузер не поддерживает плавающие фреймы!{/t}
 </iframe>
{/if}
 
</td>
</tr>
</table>

</div>

</div>
