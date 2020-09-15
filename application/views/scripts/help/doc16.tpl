<table style="font-size:13px;width:720px;margin-left:30px;">
<tr><td valign="top">
<img src="{$siteurl}/images/help/helpointer.gif">
</td><td>
{php}
//print_r ($_SESSION);
if ($_SESSION ['auth']['is_admin'] == 1) { {/php}
{t}В данный момент вы находитесь в профиле администратора системы. Администратор не может работать с основным функционалом системы. Его задача - управлять профилями пользователей (создавать и удалять профили пользователей, восстанавливать забытые пароли и т.д.). Администратора невозможно ни удалить, ни создать. Он остается невидимым для всех групп пользователей.
Чтобы начать работу с основным функционалом CRM вам необходимо проделать следующие шаги:{/t}
<ol>
<li>{t}Создайте нового менеджера и назовите его своим именем.{/t}</li>
<li>{t}Присвойте ему статус Суперменеджер.{/t}</li>
<li>{t}Запомните логин и пароль для данного Суперменеджера (впредь вы будете работать под его именем).{/t}</li>
<li>{t}Выйдете из системы и войдите снова, но уже под логиным и паролем созданного вами Суперменеджера.{/t}</li>
</ol>
{php} } else { {/php}
{t}Вам доступна вкладка «Управление» - значит вы супер-менеджер. А бывают еще простые менеджеры.
Как супер-менеджер, вы можете добавлять новых менеджеров, редактировать их профили.{/t}<br>
{t}Другие отличия:{/t}<br><br>
{php} } {/php}

<table border="0" cellspacing="0" cellpadding="0" style="font-size:11px">
  <tr>
    <td style="border-bottom:1px solid #dbdbdb;padding:5px 25px 5px 0px;"><b>{t}супер-менеджер{/t}</b></td>
    <td style="border-bottom:1px solid #dbdbdb;padding:5px 0px 5px 0px;"><b>{t}менеджер{/t}</b></td>
  </tr>
  <tr>
    <td style="border-bottom:1px solid #dbdbdb;padding:5px 25px 5px 0px;">{t}Может править профили других менеджеров, добавлять новые{/t}</td>
    <td style="border-bottom:1px solid #dbdbdb;padding:5px 0px 5px 0px;">{t}не может{/t}</td>
  </tr>
  <tr>
    <td style="border-bottom:1px solid #dbdbdb;padding:5px 25px 5px 0px;">{t}Видит всю клиентскую базу, может работать с компаниями всех менеджеров{/t}</td>
    <td style="border-bottom:1px solid #dbdbdb;padding:5px 0px 5px 0px;">{t}Видит только часть общей клиентской базы, только те компании которые приписаны ему{/t}</td>
  </tr>
  <tr>
    <td style="border-bottom:1px solid #dbdbdb;padding:5px 25px 5px 0px;">{t}Может передавать компании от одного менеджера другому{/t}</td>
    <td style="border-bottom:1px solid #dbdbdb;padding:5px 0px 5px 0px;">{t}Может только добавлять новые компании{/t}</td>
  </tr>
  <tr>
    <td style="border-bottom:1px solid #dbdbdb;padding:5px 25px 5px 0px;">{t}Может поставить задачу-напоминание менеджеру, вещудему данного клиента{/t}</td>
    <td style="border-bottom:1px solid #dbdbdb;padding:5px 0px 5px 0px;">{t}Может ставить напоминания только себе или всем сразу{/t}</td>
  </tr>
  <tr>
    <td style="border-bottom:1px solid #dbdbdb;padding:5px 25px 5px 0px;">{t}В журнале видит события всех менеджеров{/t}</td>
    <td style="border-bottom:1px solid #dbdbdb;padding:5px 0px 5px 0px;">{t}В журнале видит только свои события{/t}</td>
  </tr>
  <tr>
    <td style="padding:5px 5px 5px 0px;">{t}Может править категории и метки{/t}</td>
    <td style="padding:5px 0px 5px 0px;">{t}Может только добавлять метки в существующие категории при добавлении новой компании{/t}</td>
  </tr>
</table>


</td>
</tr>
</table>


