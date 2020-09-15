<!--
<div style="padding:20px 40px 0px 40px;">
{t}Форма изменения пароля{/t}
{if $error}
<br><br>{$error}<br><br>
{/if}
<form action = "profile/change" method = "post">
<table>
<tr>
    <td>{t}Пароль: {/t}</td>
    <td><input type = "password" name = "password">
</tr>
<tr>
    <td>{t}Подтверждение пароля:{/t}</td>
    <td><input type = "password" name = "password_confirm">
</tr>
<tr>
    <td></td>
    <td><input type = "submit" value = "{t}Изменить{/t}!">
</tr>
</table>
</form>
</div>
-->
<div style="padding: 12px">
<b>{t}Форма изменения пароля{/t}</b><br><br>
{if $error}
<br><br>{$error}<br><br>
{/if}
<form action = "{$siteurl}/profile/change" method = "post">

<div class="managerInputLabel">{t}Пароль: {/t}</div>
<div style="float:left;margin-top:5px;">
<input type="password" name="password" value="" class="size12" style="width:300px"/>
</div>
<div id="clear"></div>

<div class="managerInputLabel">{t}Подтверждение пароля:{/t}</div>
<div style="float:left;margin-top:5px;">
<input type="password" name="password_confirm" value="" class="size12" style="width:300px"/>
</div>
<div id="clear"></div>


<div class="managerInputLabel"></div>
<div style="float:left;margin-top:5px;">
<input type="submit" style="float:left; background-color:#68c248; border-right: 1px solid #2c6d15; border-bottom: 1px solid #2c6d15; margin-top:6px; cursor:pointer;color:#fff;font-weight: bold" value="{t}Изменить{/t}!" class="IEremoteBorder"/>
</div>
<div id="clear"></div>


</form>

</div>
