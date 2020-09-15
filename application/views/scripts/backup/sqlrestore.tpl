
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

<div style="float:left;margin-left:40px;margin-top:5px;">
<div style="background-color:#f34320; padding:2px 5px 2px 5px; color:#fff; font-size:12px;margin-bottom:10px;">{t}Внимание! После восстановления базы данных вы потеряете все изменения, сделанные с момента бэкапа!{/t}</div>

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
 <iframe src="{$siteurl}/dumper/dumper.php?act=restore"  noresize="noresize" frameborder="0" border="0" cellspacing="0" style="border: none ; width: 385px; height: 290px;" align="left" id='frame1'>
    {t}Ваш браузер не поддерживает плавающие фреймы!{/t}
 </iframe>
{/if}

</div>

</div>
