

<div style="padding-top:10px;">

<div style="float:left">
<a href="{$siteurl}/main/searchCompany?mode=all&page=1" style="font-size:12px;color:#000"><b>{t}Все компании{/t}</b></a>
<span style="color:#8f8f8f;font-size:12px">{$allCompanyByManager}</span>
</div>

<div style="float:left">
<a href="{$siteurl}/main/searchCompany?mode=favorites&page=1" style="color:#000; font-size:12px;padding-left:35px;background-image:url('{$siteurl}/images/star_on.gif'); background-repeat:no-repeat; background-position: 16px 0px;">{t}Избранное{/t}</a>
<span style="color:#8f8f8f;font-size:12px">{$favoriteCount}</span>
</div>

<div id="clear" style="height:15px"></div>
{if $locale_conf.alphabet_national}
{foreach from=$locale_conf.alphabet_national key=key item=row}
<a href="{$siteurl}/main/searchCompany?mode=word&mparam={$key}&page=1" class="allCompanyWLink">{$row.view}</a>
{/foreach}
<br>
{/if}


<a href="{$siteurl}/main/searchCompany?mode=word&mparam=1&page=1" class="allCompanyWLinkS">1</a>
<a href="{$siteurl}/main/searchCompany?mode=word&mparam=2&page=1" class="allCompanyWLinkS">2</a>
<a href="{$siteurl}/main/searchCompany?mode=word&mparam=3&page=1" class="allCompanyWLinkS">3</a>
<a href="{$siteurl}/main/searchCompany?mode=word&mparam=4&page=1" class="allCompanyWLinkS">4</a>
<a href="{$siteurl}/main/searchCompany?mode=word&mparam=5&page=1" class="allCompanyWLinkS">5</a>
<a href="{$siteurl}/main/searchCompany?mode=word&mparam=6&page=1" class="allCompanyWLinkS">6</a>
<a href="{$siteurl}/main/searchCompany?mode=word&mparam=7&page=1" class="allCompanyWLinkS">7</a>
<a href="{$siteurl}/main/searchCompany?mode=word&mparam=8&page=1" class="allCompanyWLinkS">8</a>
<a href="{$siteurl}/main/searchCompany?mode=word&mparam=9&page=1" class="allCompanyWLinkS">9</a>
<a href="{$siteurl}/main/searchCompany?mode=word&mparam=0&page=1" class="allCompanyWLinkS">0</a>

&nbsp;&nbsp;&nbsp;&nbsp;

{foreach from=$locale_conf.alphabet key=key item=row}
<a href="{$siteurl}/main/searchCompany?mode=word&mparam={$key}&page=1" class="allCompanyWLinkS">{$row.view}</a>
{/foreach}

</div>
