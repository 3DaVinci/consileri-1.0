<div id="managersfilter">
	<span class="managertext">{t}Менеджеры:{/t}</span><br><br>
	{if $manager==-1}
		<div class="managersel"><span>{t}Все менеджеры{/t}</span></div>
	{else}
		<div class="managerunsel">
		<a href="{$siteurl}/journal?scale=2&d={$d}&m={$m}&y={$y}">{t}Все менеджеры{/t}</a>
		</div>
	{/if}
	
	{foreach from=$managers item=cur}
		{if $cur.id==$manager}
			<div class="managersel"><span>{$cur.nickname} [{$cur.cnt}]</span></div>
		{else}
			<div class="managerunsel">
			<a href="{$siteurl}/journal?scale=2&d={$d}&m={$m}&y={$y}&manager={$cur.id}">{$cur.nickname}</a> [{$cur.cnt}]	
			</div>
		{/if}
		
	{/foreach}		
</div>