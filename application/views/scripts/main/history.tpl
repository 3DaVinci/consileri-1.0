<br><br><br>
<div class="bookmarks">
<strong>{t}Рабочий день:{/t}</strong><br>
{if sizeof($history)==0}
<br>
{t}Список пуст.{/t}
{/if}
{foreach from=$history item=cur}
	<div class="historyEl" width="100">
	<a href="{$siteurl}/main/companyBriefFromHistory?id={$cur.company_id}" style="color:black">{$cur.name|wordwrap:35:"<br>"}</a>
	</div>
{/foreach}
</div>