<h6>{t}Восстановление пароля{/t}</h6>

{if $error!=""}<span style="color:red">{$error}</span><br><br>{/if}

<form method="POST" action="{$siteurl}/companies/restoreSubmit">

{t}Введите e-mail:{/t}<br>

<input type="text" name="email"/>
  
<input type="submit" value="{t}Восстановить{/t}"/>
  

</form>