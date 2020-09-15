{literal}
<script language="JavaScript" type="text/javascript">
  function subscribeDef() {
  	//$('subscribed').checked = true;
  }
</script> 
{/literal}

<div style="padding: 12px">
<b>{t}Добавление нового менеджера{/t}</b><br><br>

<form action="{$siteurl}/managment/newManagerSubmit" method="POST">


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


<div class="managerInputLabel">{t}статус{/t}</div>
<div style="float:left;margin-top:5px;">
<select name="type">
  <option value="0"{if $type==0} selected{/if}>{t}Менеджер{/t}</option>
  <option value="1"{if $type==1} selected{/if}>{t}Супер-менеджер{/t}&nbsp;&nbsp;</option>  
</select>
</div>
<div id="clear"></div>

{*
<div class="managerInputLabel" {if isset($error.email)}style="color:#f34320"{/if}>{t}e-mail{/t}</div>
<div style="float:left;margin-top:5px;">
<input type="email" name="email" value="{$email}" class="size12" style="width:300px" onkeypress="subscribeDef()"/>
</div>
<div id="clear"></div>
*}
{*
<div class="managerInputLabel">{t}подписка{/t}</div>
<div style="float:left;margin-top:5px;">
<input type="checkbox" name="subscribed" id="subscribed" class="size12" {if $subscribed==true}checked{/if}/>
</div>
<div id="clear"></div>
*}
<div class="managerInputLabel">{t}пароль{/t}</div>
<div style="float:left;margin-top:5px;">
<input type="password" name="password" value="{$password}" class="size12" style="width:300px"/>
</div>
<div id="clear"></div>

<div class="managerInputLabel">{t}ещё раз{/t}</div>
<div style="float:left;margin-top:5px;">
<input type="password" name="passwordagain" value="{$passwordagain}" class="size12" style="width:300px"/>
</div>
<div id="clear"></div>


<div class="managerInputLabel"></div>
<div style="float:left;margin-top:5px;">
<input type="submit" style="float:left; background-color:#68c248; border-right: 1px solid #2c6d15; border-bottom: 1px solid #2c6d15; margin-top:6px; cursor:pointer;color:#fff;font-weight: bold" value="{t}Добавить{/t}" class="IEremoteBorder"/>
</div>
<div id="clear"></div>


</form>

</div>




{*
<div style="padding: 20px 20px 20px 20px;">
{if !$smarty.session.auth.readonly}
<form action="/managment/newManagerSubmit" method="POST">
{/if}
<b>{t}Добавить нового менеджера{/t}</b><br><br>

<div style="float:left{if isset($error.username)}; color:#f34320{/if}">
{t}Логин:{/t}</div>
<div style="float:right">
<input type="text" name="username" value="{$username}"/></div>
<div id="clear"></div>

<div style="float:left{if isset($error.nickname)}; color:#f34320{/if}">
{t}Имя:{/t} </div>
<div style="float:right">
<input type="text" name="nickname" value="{$nickname}"/></div>
<div id="clear"></div>

{literal}
<script language="JavaScript" type="text/javascript">
  function subscribeDef() {
  	//$('subscribed').checked = true;
  }
</script>
  
{/literal}

<div style="float:left{if isset($error.email)}; color:#f34320{/if}">{t}E-mail:{/t}</div>
<div style="float:right">
<input type="email" name="email" value="{$email}" class="size12" onkeypress="subscribeDef()"/>
</div>
<div id="clear"></div>

<div style="float:left">{t}Рассылка:{/t}</div>
<div style="float:right">
<input type="checkbox" name="subscribed" id="subscribed" class="size12" {if $subscribed==true}checked{/if}/>
</div>
<div id="clear"></div>

<div style="float:left{if isset($error.password)}; color:#f34320{/if}">
{t}Пароль:{/t} 
</div>
<div style="float:right">
<input type="password" name="password" value="{$password}"/></div>
<div id="clear"></div>

<div style="float:left">
{t}Повтор пароля: {/t}
</div>
<div style="float:right">
<input type="password" name="passwordagain" value="{$passwordagain}"/>
</div>
<div id="clear"></div>


<div style="float:left">
{t}Тип:{/t} 
</div>
<div style="float:right">

<select name="type">
  <option value="0">{t}Менеджер{/t}</option>
  <option value="1"{if $type==1} selected{/if}>{t}Супер-менеджер{/t}&nbsp;&nbsp;</option>  
</select>
  
</div>

<div id="clear"></div>
{if !$smarty.session.auth.readonly}
<input type="submit" style="float:right; background-color:#fff; border: 2px solid #45cf0f; margin-top:6px; cursor:pointer;" value="{t}Добавить{/t}"/>
{/if}
<div id="clear"></div>
{if !$smarty.session.auth.readonly}
</form>
{/if}

*}
