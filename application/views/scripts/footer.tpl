

<div style="clear:both"></div>
<div style="height:35px"></div> 


</div>
</div>
{if (empty ($doNotShowPDAlink))}
<a style = "font-size: 12x; color:#000;" href="{php}
$_SERVER ['REQUEST_URI'] = str_replace (array ('&nopda', '?nopda'), '', $_SERVER ['REQUEST_URI']); echo $_SERVER ['REQUEST_URI']; echo (strpos ($_SERVER['REQUEST_URI'], '?') !== false) ? '&' : '?'; echo 'pda';{/php}" style="color:#000">{t}КПК версия{/t}</a> &nbsp;&nbsp;&nbsp;&nbsp;
{/if}
{*
<div id="footer">
<a href="{php}echo $_SERVER ['REQUEST_URI']; echo (strpos ($_SERVER['REQUEST_URI'], '?') !== null) ? '&' : '?'; echo 'pda';{/php}" style="color:#000">КПК версия</a> &nbsp;&nbsp;&nbsp;&nbsp;
<div id="developer">
Проект с удовольствием разработан<br> студией <a href="http://daweb.3davinci.ru/" target="_blank">3DaVinci</a>
</div>

<div class="footerText"><a href="/index/official" class="footerLink">Соглашение пользователя</a></div>
</div>
*}
{if ! empty ($change_pass_question)}
<table cellspacing = "0" cellpadding = "0" bgcolor = "yellow" width = "100%"><tr><td><span style = "padding:3px; padding-left:10px;font-weight:bold">{t}Необходимо сменить пароль для учётной записи администратора.{/t}</span></td></tr></table>
{/if}
{if ! empty ($is_demo)}
<table cellspacing = "0" cellpadding = "0" bgcolor = "red" width = "100%"><tr><td style = "color: white;padding:3px; padding-left:10px;font-weight:bold">{t}Внимание! Это демо-версия. Вы не сможете сохранять информацию.{/t}</td></tr></table>
{literal}
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-230226-14");
pageTracker._trackPageview();
} catch(err) {}</script>
{/literal}
{/if}


</body>
</html>
