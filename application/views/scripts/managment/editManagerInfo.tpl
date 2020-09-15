<div style="padding: 12px 12px 12px 12px;">
<b>{t}Профиль менеджера{/t}</b><br><br>

<form action="{$siteurl}/managment/editManagerInfoSubmit" method="POST">


<div class="managerInputLabel" {if isset($error.username)}style="color:#f34320"{/if}">{t}логин{/t}</div>
<div style="float:left;margin-top:5px;">
<input type="text" name="username" value="{$username}" class="size12" style="width:300px"/>
</div>
<div id="clear"></div>

<div class="managerInputLabel" {if isset($error.nickname)}style="color:#f34320"{/if}>{t}имя{/t}</div>
<div style="float:left;margin-top:5px;">
<input type="text" name="nickname" value="{$nickname}" class="size12" style="width:300px"/>
</div>
<div id="clear"></div>


{if $manager.id == $smarty.session.auth.id && $smarty.session.auth.is_super_user == 1}
<input type="hidden" name="type" value="1"/>
{else}
<div class="managerInputLabel">{t}статус{/t}</div>
<div style="float:left;margin-top:5px;">
<select name="type">
  <option value="0"{if $type==0} selected{/if}>{t}Менеджер{/t}</option>
  <option value="1"{if $type==1} selected{/if}>{t}Супер-менеджер{/t}&nbsp;&nbsp;</option>  
</select>
</div>
<div id="clear"></div>
{/if}

{*
<div class="managerInputLabel" {if isset($error.email)}style="color:#f34320"{/if}>{t}e-mail{/t}</div>
<div style="float:left;margin-top:5px;">
<input type="email" name="email" value="{$email}" class="size12" style="width:300px"/>
</div>
<div id="clear"></div>
*}
{*
<div class="managerInputLabel">{t}подписка{/t}</div>
<div style="float:left;margin-top:5px;">
<input type="checkbox" name="subscribed" class="size12" {if $subscribed==true}checked{/if}/>
</div>
<div id="clear"></div>
*}
<div class="managerInputLabel">{t}новый пароль{/t}</div>
<div style="float:left;margin-top:5px;">
<input type="password" name="password" value="{$password}" class="size12" style="width:300px"/>
</div>
<div id="clear"></div>

<div class="managerInputLabel">{t}ещё раз{/t}</div>
<div style="float:left;margin-top:5px;">
<input type="password" name="passwordagain" value="{$passwordagain}" class="size12" style="width:300px"/>
</div>
<div id="clear"></div>

<input type="hidden" name="id" value="{$id}"/>
<input type="hidden" name="isForm" value="1"/>

<div class="managerInputLabel">&nbsp;</div>
<div style="float:left;margin-top:5px;">
<input type="submit" style="float:left; background-color:#68c248; border-right: 1px solid #2c6d15; border-bottom: 1px solid #2c6d15; margin-top:6px; cursor:pointer;color:#fff;font-weight: bold" value="{t}Сохранить изменения{/t}" class="IEremoteBorder"/>
</div>
<div id="clear"></div>

</form>
</div>
