<form action="{$siteurl}/users/addusersubmit" method="POST">
{t}Пользователь:{/t} <input type="text" name="username" value="{$username}">{$error.username}<br>
{t}Пароль:{/t} <input type="text" name="password" value="{$password}">{$error.password}<br>

<input type="submit" value="{t}Добавить{/t}">
</form>