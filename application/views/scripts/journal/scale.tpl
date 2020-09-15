<span class="scaletext">{t}Масштаб:{/t}</span><br><br>
{if $scale==1}
<div class="scalesel"><span>{t}День{/t}</span></div>
{else}
<div class="scaleunsel">
<a href="{$siteurl}/journal?scale=1&manager={$manager}">{t}День{/t}</a>
</div>
{/if}

{if $scale==2}
<div class="scalesel"><span>{t}Неделя{/t}</span></div>
{else}
<div class="scaleunsel">
<a href="{$siteurl}/journal?scale=2&manager={$manager}">{t}Неделя{/t}</a>
</div>
{/if}

{if $scale==3}
<div class="scalesel"><span>{t}Месяц{/t}</span></div>
{else}
<div class="scaleunsel">
<a href="{$siteurl}/journal?scale=3&manager={$manager}">{t}Месяц{/t}</a>
</div>
{/if}