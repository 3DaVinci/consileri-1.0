{if isset($selectError)}<span class="size2">{$selectError}<br></span>{/if}

<b>{t}Метки{/t}</b>&nbsp;&nbsp;
{*
[<a href="{$siteurl}/main/searchCompany?mode=relations&mparam=2&page=1" style="color:#45cf0f;text-decoration:none;font-size: 80%;">:)</a>]
[<a href="{$siteurl}/main/searchCompany?mode=relations&mparam=3&page=1" style="color:#ec392e;text-decoration:none;font-size: 80%;">:(</a>]
[<a href="{$siteurl}/main/searchCompany?mode=relations&mparam=1&page=1" style="text-decoration:none;font-size: 80%;">&nbsp;&nbsp;</a>]
&nbsp;&nbsp;
*}
<img src="{$siteurl}/images/pda/fav.gif" />:<a href="{$siteurl}/main/searchCompany?mode=favorites&page=1" style="color:#000">{$favoriteCount}</a>&nbsp;
{* <img src="{$siteurl}/images/pda/rem.gif" />:<a href="{$siteurl}/main/reminders" style="color:#000">{$reminderCount}</a> *}
{if sizeof($remToday)>0 || sizeof($remTodayM)>0}
<a href="{$siteurl}/mainpda/todayReminders" style="color:#ec392e">!</a>{/if}

<span class="size2">
{foreach from=$labelsRoot item=cur}
<br><br>
<b>{$cur.name}</b>
{assign var="isFirst" value=true}
{foreach from=$cur.labels item=item}{if !$isFirst} <span style="color:gray">|</span> {else}{assign var="isFirst" value=false}{/if}<a href="{$siteurl}/main/searchCompanyLabels?mode=label&mparam={$item.id}&page=1" style="color:#0ca414"> {$item.name}</a>{/foreach}
{/foreach}

<br><br>

<a href="{$siteurl}/main/searchCompany?mode=all&page=1" class="allCompanyLink"><b>{t}Все компании:{/t}</b></a> &nbsp;
{foreach from=$locale_conf.alphabet_national key=key item=row}
<a href="{$siteurl}/main/searchCompany?mode=word&mparam={$key}&page=1" class="allCompanyWLink">{$row.view}</a>&nbsp;
{/foreach}

&nbsp;&nbsp;

{foreach from=$locale_conf.alphabet key=key item=row}
<a href="{$siteurl}/main/searchCompany?mode=word&mparam={$key}&page=1" class="allCompanyWLinkS">{$row.view}</a>&nbsp;
{/foreach}
&nbsp;&nbsp;

<a href="{$siteurl}/main/searchCompany?mode=word&mparam=0&page=1" class="allCompanyWLink">0</a>
<a href="{$siteurl}/main/searchCompany?mode=word&mparam=1&page=1" class="allCompanyWLink">1</a>
<a href="{$siteurl}/main/searchCompany?mode=word&mparam=2&page=1" class="allCompanyWLink">2</a>
<a href="{$siteurl}/main/searchCompany?mode=word&mparam=3&page=1" class="allCompanyWLink">3</a>
<a href="{$siteurl}/main/searchCompany?mode=word&mparam=4&page=1" class="allCompanyWLink">4</a>
<a href="{$siteurl}/main/searchCompany?mode=word&mparam=5&page=1" class="allCompanyWLink">5</a>
<a href="{$siteurl}/main/searchCompany?mode=word&mparam=6&page=1" class="allCompanyWLink">6</a>
<a href="{$siteurl}/main/searchCompany?mode=word&mparam=7&page=1" class="allCompanyWLink">7</a>
<a href="{$siteurl}/main/searchCompany?mode=word&mparam=8&page=1" class="allCompanyWLink">8</a>
<a href="{$siteurl}/main/searchCompany?mode=word&mparam=9&page=1" class="allCompanyWLink">9</a>

</span>

