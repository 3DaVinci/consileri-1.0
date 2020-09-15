<div style="font-size:12px;margin-bottom:15px;"><b>{t}Рабочий день:{/t}</b></div>
{if sizeof($history)==0}

{t}Список пуст.{/t}
{/if}
{foreach from=$history item=cur}	
<div style="margin-bottom:5px;">
<div class="{if $cur.locked==1}clip_on{else}clip_off{/if}" onclick="changeClipState(this,{$cur.company_id})"></div>{*|wordwrap:35:"<br>"*}
<a href="{$siteurl}/main/companyBriefFromHistory?id={$cur.company_id}" style="color:#dc8009;font-size:12px;">{$cur.name}</a>	
</div>
{/foreach}

{literal}
<script language="JavaScript" type="text/javascript" src="{/literal}{$siteurl}{literal}/js/historyClips.js"></script>
{/literal}
