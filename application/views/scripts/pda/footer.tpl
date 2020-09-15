</div>

<div id="footer">
{*if $controllerName=="users" && $actionName=="login"*}
{if (empty ($doNotShowPDAlink))}
<a href="{php}$_SERVER ['REQUEST_URI'] = str_replace (array ('&pda', '?pda'), '', $_SERVER ['REQUEST_URI']); echo $_SERVER ['REQUEST_URI']; echo (strpos ($_SERVER['REQUEST_URI'], '?') !== false) ? '&' : '?'; echo 'nopda';{/php}" style="color:#000">{t}Полная версия{/t}</a> &nbsp;&nbsp;&nbsp;&nbsp;
{/if}
{*/if*}
{*<a href="http://3davinci.ru/" target="_blank" style="color:#000">(c) 3DaVinci 2007</a>*}
</div>

</body>
</html>
