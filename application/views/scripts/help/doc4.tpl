{*<table style="font-size:13px;margin-left:40px;">
<tr><td valign="top">
<img src="{$siteurl}/images/help/helpointer.gif">
</td><td>
{t img="<img src='$siteurl/images/help/help1.gif' style='position:relative;top:3px;'>" escape=none}В вашей базе нет клиентов - работать не с чем. Добавьте несколько %img (ссылка  справа от поиска) - начните с самых любимых, актуальных, востребованных.{/t}<br>
{if $smarty.session.auth.is_super_user}{t img="<img src='$siteurl/images/help/help2.jpg' style='position:relative;top:3px;'>" escape=none}Если вы хотите сначала создать учетные записи ваших менеджеров - перейдите во вкладку %img.{/t}{/if}
</td></tr>
</table>*}

<table style="font-size: 13px; margin-left: 40px;">
<tbody><tr><td valign="top">
<img src="{$siteurl}/images/help/helpointer.gif">
</td><td>
{t}В вашей базе нет клиентов - работать не с чем. Добавьте несколько (ссылка {/t}<img 
src="{$siteurl}/images/help/help1.gif" style="position: relative; top: 3px;"> <a href="{$siteurl}/main/addCompany" style="color: rgb(0, 0, 0);font-size: 11px;"><b>{t}новый{/t}</b></a> {t}справа от поиска) - начните с самых любимых, актуальных, востребованных{/t}.<br>

{t}Если вы хотите сначала создать учетные записи ваших менеджеров - перейдите во вкладку{/t} <table class="help2tb" style="vertical-align:text-bottom;" cellpadding="0" cellspacing="0" border="0"><tr><td class="help2td" style="background: url({$siteurl}/images/help/help2.jpg) no-repeat 0px 3px;"><a href="{$siteurl}/managment"
 style="color: rgb(0, 0, 0);">{t}Управление{/t}</a></td></tr></table>.</td></tr>
</tbody></table>

