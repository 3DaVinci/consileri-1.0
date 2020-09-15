

<div class="bookmarks">
<a href="{$siteurl}/main/searchCompany?mode=all&page=1" class="allCompanyLink">{t}Все компании:{/t}</a><br><br>



{foreach from=$locale_conf.alphabet_national key=key item=row}
<a href="{$siteurl}/main/searchCompany?mode=word&mparam={$key}&page=1" class="allCompanyWLink">{$row.view}</a>
{/foreach}
<br>

{foreach from=$locale_conf.alphabet key=key item=row}
<a href="{$siteurl}/main/searchCompany?mode=word&mparam={$key}&page=1" class="allCompanyWLink">{$row.view}</a>
{/foreach}


<!--
<br><br>
<div class="allCompanyLike"><a href="{$siteurl}/main/searchCompany?mode=relations&mparam=1&page=1" class="allCompanyLikeLink">любимые клиенты</a></div>
<div class="allCompanyUnlike"><a href="{$siteurl}/main/searchCompany?mode=relations&mparam=3&page=1" class="allCompanyLikeLink">нелюбимые клиенты</a></div>
<br>
-->
</div>
