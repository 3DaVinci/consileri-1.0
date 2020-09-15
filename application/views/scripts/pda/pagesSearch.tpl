{if isset($pages)}


{if $company==""}
{assign var="company" value=$smarty.get.company}
{/if}
{assign var="forwardMode" value="&company=$company"}


{php}
	$pages = $this->get_template_vars('pages');
	$page = $this->get_template_vars('page');	
	$temp = floor($pages / 20) * 20;
	$this->assign('lastpagestart',$temp);
	$this->assign('prev',$temp - 1);
	$this->assign('start',$temp);
	$this->assign('end',$pages + 1);
	
//	$temp = ( floor($pages / 20) - floor($page / 20) ) * 20;
	$temp = ( floor($page / 20) ) * 20;
	$this->assign('start2',$temp );
	$this->assign('end2',$temp + 20);
	$this->assign('prev2',$temp - 1);
	$this->assign('next2',$temp + 20);
	
{/php}

{if $pages > 1 && $pages <= 20}
<div class="pages">
{section name=name start=1 loop=$pages+1}
	{if $smarty.section.name.index==$page} 
		<span class="pageActive">{$smarty.section.name.index}</span>
		{else}
		<span class="pageInactive"><a href="{$siteurl}/{$controllerName}/selectCompanyNotFound?page={$smarty.section.name.index}{$forwardMode}{$forwardMparam}" class="pageInactiveLink">{$smarty.section.name.index}</a></span>
		{/if}
{/section}
		
</div>

{elseif $pages > 20 && $page < 20 } {* start *}
<div class="pages">
	<table border=0 style="font-size:100%">
	<tr>
	<td>

{assign var="pre" value=true}
{section name=name start=1 loop=20}
	{if $smarty.section.name.index==$page} 
		{assign var="pre" value=false}
		<span class="pageActive">{$smarty.section.name.index}</span>
	{else}
		<span class="pageInactive"><a href="{$siteurl}/{$controllerName}/selectCompanyNotFound?page={$smarty.section.name.index}{$forwardMode}{$forwardMparam}" class="pageInactiveLink">{$smarty.section.name.index}</a></span>
	{/if}		
{/section}
	
	</td>
	<td>
	<a href="{$siteurl}/{$controllerName}/selectCompanyNotFound?page=20{$forwardMode}{$forwardMparam}"><img src="{$siteurl}/images/pointer3.gif" /></a>
	</td>
	<td>......</td>
	<td>
	<span class="pageInactive"><a href="{$siteurl}/{$controllerName}/selectCompanyNotFound?page={$pages}{$forwardMode}{$forwardMparam}" class="pageInactiveLink">{$pages}</a></span>
	</td>
	</tr>
	</table>
</div>
{elseif $pages > 20 && $page >= $lastpagestart}	{* last *}
<div class="pages">
	
	<table border=0 style="font-size:100%">
	<tr>
	<td>
	<span class="pageInactive"><a href="{$siteurl}/{$controllerName}/selectCompanyNotFound?page=1{$forwardMode}{$forwardMparam}" class="pageInactiveLink">1</a></span>	

	</td>
	<td>......</td>
	<td>
	<a href="{$siteurl}/{$controllerName}/selectCompanyNotFound?page={$prev}{$forwardMode}{$forwardMparam}"><img src="/images/pointer3_3.gif" /></a>
	</td>
	<td>
		
		{assign var="pre" value=true}
		{section name=name start=$start loop=$end}
			{if $smarty.section.name.index==$page} 
				{assign var="pre" value=false}
				<span class="pageActive">{$smarty.section.name.index}</span>
			{else}
				<span class="pageInactive"><a href="/{$controllerName}/selectCompanyNotFound?page={$smarty.section.name.index}{$forwardMode}{$forwardMparam}" class="pageInactiveLink">{$smarty.section.name.index}</a></span>
			{/if}		
		{/section}	
	</td>
	</tr>
	</table>
	
</div>	

{elseif $pages > 20 && $page < $lastpagestart}	{* center *}
	
<div class="pages">
	
	<table border=0 style="font-size:100%">
	<tr>
	<td>
	<span class="pageInactive"><a href="{$siteurl}/{$controllerName}/selectCompanyNotFound?page=1{$forwardMode}{$forwardMparam}" class="pageInactiveLink">1</a></span>	

	</td>
	<td>......</td>
	<td>
	<a href="{$siteurl}/{$controllerName}/selectCompanyNotFound?page={$prev2}{$forwardMode}{$forwardMparam}"><img src="{$siteurl}/images/pointer3_3.gif" /></a>
	</td>
	<td>
		
		{assign var="pre" value=true}
		{section name=name start=$start2 loop=$end2}
			{if $smarty.section.name.index==$page} 
				{assign var="pre" value=false}
				<span class="pageActive">{$smarty.section.name.index}</span>
			{else}
				<span class="pageInactive"><a href="{$siteurl}/{$controllerName}/selectCompanyNotFound?page={$smarty.section.name.index}{$forwardMode}{$forwardMparam}" class="pageInactiveLink">{$smarty.section.name.index}</a></span>
			{/if}		
		{/section}	
		
	</td>
	<td>
	<a href="{$siteurl}/{$controllerName}/selectCompanyNotFound?page={$next2}{$forwardMode}{$forwardMparam}"><img src="/images/pointer3.gif" /></a>
	</td>
	<td>......</td>
	<td>
	<span class="pageInactive"><a href="{$siteurl}/{$controllerName}/selectCompanyNotFound?page={$pages}{$forwardMode}{$forwardMparam}" class="pageInactiveLink">{$pages}</a></span>
	</td>
	</tr>
	</table>
	
</div>	
	
{/if}


{/if}