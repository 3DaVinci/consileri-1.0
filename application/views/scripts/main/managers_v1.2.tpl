{if $smarty.session.auth.is_super_user}


{literal}
<script language="JavaScript" type="text/javascript">
  function managerSwitcher() {
  	if ($('managerSwitcher').value!='') {
  		document.location = $('managerSwitcher').value;
  	}
  }
</script>
  
{/literal}
{php}
global $conf;
//if (substr ($_SERVER ['REQUEST_URI'], -5) != "/main") 
{
{/php}
<div style="margin-top:5px; background-image:url('{$siteurl}/images/creature2.gif'); background-repeat:no-repeat; padding:4px 0px 0px 23px; height:28px;background-position:2px 1px;float:left">
  
<select name="name" style="font-size:12px;" id="managerSwitcher" onchange="managerSwitcher()">
	{if $managerFilter==-1}	
		<option value="" selected>{t}Клиенты всех менеджеров{/t}</option>
	{else}
		<option value="{$siteurl}/main/searchCompany?mode=manager&mparam=-1&page=1&fakemode={$mode}&fakemparam={$mparam}&return=1" checked>{t}Клиенты всех менеджеров{/t}</option>
	{/if}
	{if $managerFilter==$smarty.session.auth.id}	
		<option value="" selected>{t}Только МОИ клиенты{/t}</option>
	{else}
		<option value="{$siteurl}/main/searchCompany?mode=manager&mparam={$smarty.session.auth.id}&page=1&fakemode={$mode}&fakemparam={$mparam}&return=1" checked>{t}Только МОИ клиенты{/t}</option>
	{/if}
{foreach  from=$managers item=cur}
	
		{if $cur.id!=$smarty.session.auth.id}
		{if $cur.id==$managerFilter}
			<option value="" selected>{$cur.nickname}</option>
		{else}
			
			<option value="{$siteurl}/main/searchCompany?mode=manager&mparam={$cur.id}&page=1&fakemode={$mode}&fakemparam={$mparam}&return=1">{$cur.nickname}</option>
		{/if}
		{/if}
		
		
		
{/foreach}
</select>


</div>
{php}
}
{/php}
{/if}
