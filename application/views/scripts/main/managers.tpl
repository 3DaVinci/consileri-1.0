{if $smarty.session.auth.is_super_user}
<div id="managersfilterFix2">
	<span class="managertext">{t}Менеджеры:{/t}</span><br><br>	

	
	{if $managerFilter==-1}
		<div class="managersel"><span>{t}Все менеджеры{/t}</span></div>		
	{else}
		<div class="managerunsel">
		<a href="{$siteurl}/main/searchCompany?mode=manager&mparam=-1&page=1&fakemode={$mode}&fakemparam={$mparam}">{t}Все менеджеры{/t}</a>		
		</div>
	{/if}

	
	{foreach  from=$managers item=cur}
		{if $cur.id==$managerFilter}
			<div class="managersel"><span>{$cur.nickname}</span></div>
		{else}
			<div class="managerunsel">
			<a href="{$siteurl}/main/searchCompany?mode=manager&mparam={$cur.id}&page=1&fakemode={$mode}&fakemparam={$mparam}">{$cur.nickname}</a>		
			</div>
		{/if}
		
	{/foreach}
</div>
{/if}