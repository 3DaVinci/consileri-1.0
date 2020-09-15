<h3>Регистрация. Ура!</h3>
Всего несколько полей и одна кнопка отделяют вас от настоящей онлайн-CRM<br>
<br>
<div style="padding-left:25px; font-size:11px">

{literal}
<script language="JavaScript" type="text/javascript">
  function block() {
  	document.getElementById('enter').disabled = true;
  }
</script>
{/literal}  

<form method="POST" action="{$siteurl}/companies/registrationSubmit" onsubmit="block();">
{foreach from=$errors item=error}
<span style="color:red">{$error}</span><br>
{/foreach}
{if sizeof($errors)!=0}
<br>
{/if}

<span style="color:#0f8904"><b>Название вашей компании</b></span><br>
<input type="text" name="company" value="{$company}"/><br>
<br>

<span style="color:#0f8904"><b>Имя самого первого и главного менеджера</b></span><br>
<input type="text" name="manager" value="{$manager}"/>
&nbsp;&nbsp;&nbsp;<span style="color:#9f9f9f">Мирское имя, например «Алексей Первачев»</span><br>
<br>

<span style="color:#0f8904"><b>Его логин</b></span><br>
<input type="text" name="manager_login" value="{$manager_login}"/>
&nbsp;&nbsp;&nbsp;<span style="color:#9f9f9f">Латиницей, что-нибудь вроде «firma_pervachev»</span><br>
<br>
<span style="color:#0f8904"><b>И пароль</b></span><br>
<input type="password" name="manager_pass1" value="{$manager_pass1}"/>
&nbsp;&nbsp;&nbsp;<span style="color:#9f9f9f">Пароль, пожалуйста, повторите два раза. Для надежности.</span><br>
<input type="password" name="manager_pass2" value="{$manager_pass2}"/><br>
<br>

<span style="color:#0f8904"><b>Часовой пояс</b></span><br>
<select name="gmt">
    <option value="-12"{if $gmt==-12} selected="selected"{/if}>GMT -12:00</option>
    <option value="-11"{if $gmt==-11} selected="selected"{/if}>GMT -11:00</option>
    <option value="-10"{if $gmt==-10} selected="selected"{/if}>GMT -10:00</option>    
    <option value="-9"{if $gmt==-9} selected="selected"{/if}>GMT -9:00</option>
    <option value="-8"{if $gmt==-8} selected="selected"{/if}>GMT -8:00</option>
    <option value="-7"{if $gmt==-7} selected="selected"{/if}>GMT -7:00</option>
    <option value="-6"{if $gmt==-6} selected="selected"{/if}>GMT -6:00</option>
    <option value="-5"{if $gmt==-5} selected="selected"{/if}>GMT -5:00</option>
    <option value="-4"{if $gmt==-4} selected="selected"{/if}>GMT -4:00</option>
    <option value="-3"{if $gmt==-3} selected="selected"{/if}>GMT -3:00</option>
    <option value="-2"{if $gmt==-2} selected="selected"{/if}>GMT -2:00</option>
    <option value="-1"{if $gmt==-1} selected="selected"{/if}>GMT -1:00</option>
    <option value="0"{if $gmt==0} selected="selected"{/if}>GMT</option>
    <option value="1"{if $gmt==1} selected="selected"{/if}>GMT +1:00</option>
    <option value="2"{if $gmt==2} selected="selected"{/if}>GMT +2:00</option>
    <option value="3"{if !isset($gmt)} selected="selected"{/if}{if $gmt==3} selected="selected"{/if}>GMT +3:00</option>
    <option value="4"{if $gmt==4} selected="selected"{/if}>GMT +4:00</option>
    <option value="5"{if $gmt==5} selected="selected"{/if}>GMT +5:00</option>
    <option value="6"{if $gmt==6} selected="selected"{/if}>GMT +6:00</option>
    <option value="7"{if $gmt==7} selected="selected"{/if}>GMT +7:00</option>
    <option value="8"{if $gmt==8} selected="selected"{/if}>GMT +8:00</option>
    <option value="9"{if $gmt==9} selected="selected"{/if}>GMT +9:00</option>
    <option value="10"{if $gmt==10} selected="selected"{/if}>GMT +10:00</option>
    <option value="11"{if $gmt==11} selected="selected"{/if}>GMT +11:00</option>
    <option value="12"{if $gmt==12} selected="selected"{/if}>GMT +12:00</option>
    <option value="13"{if $gmt==13} selected="selected"{/if}>GMT +13:00</option>
    
</select> &nbsp;&nbsp;&nbsp;<span style="color:#9f9f9f"></span><br>
<br>

<span style="color:#0f8904"><b>Контактный емэйл</b></span><br>
<input type="text" name="email" value="{$email}"/>
&nbsp;&nbsp;&nbsp;<span style="color:#9f9f9f">Будет здорово, если укажете настоящий. Информация закрытая, для
технических целей.</span><br>
<br>
<input type="checkbox" name="subscribe" value="1" checked="checked" id="subscribe"/>
<label for="subscribe">Я хочу знать о новых функциях Консильери и других интересных штуках! (высылаются на емэйл)</label>

<span style="color:#0f8904"><b>Лицензионный ключ</b></span><br>
<input type="text" name="key" id = 'key' value="{$key}"/><br>
Стандартные ключи:
<ul>
<li>5 пользователей: <a onclick = "document.getElementById('key').value=this.innerHTML;" href = "#key">SBZZ-0ZN1-MUDA</a></li>
<li>10 пользователей: <a onclick = "document.getElementById('key').value=this.innerHTML;" href = "#key">QBZZ-0ZN2-MUDA</a></li>
<li>15 пользователей: <a onclick = "document.getElementById('key').value=this.innerHTML;" href = "#key">PBZZ-0ZN3-MUDA</a></li>
<li>20 пользователей: <a onclick = "document.getElementById('key').value=this.innerHTML;" href = "#key">NBZZ-0Z54-S3GA</a></li>
<li>50 пользователей: <a onclick = "document.getElementById('key').value=this.innerHTML;" href = "#key">MBZZ-1ZN0-B7XA</a></li>
<li> > 50 пользователей: <a onclick = "document.getElementById('key').value=this.innerHTML;" href = "#key">KBZZ-9ZK9-CB9A</a></li>
</ul>
<br>

</div>

<div id="regman2">

<input type="submit" value="Поехали!" id="enter" style="position:relative; top:4px;"/>

&nbsp;&nbsp;&nbsp;Нажимая на эту большую зеленую кнопку,
вы принимаете <a href="{$siteurl}/index/official" style="color:#000">пользовательское соглашение</a>.

</form>  
</div>

<br><br>
