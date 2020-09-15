  
<div class="selectCompanyBlock1">
<div class="selectCompanyBlock2">  

<form action="{$siteurl}/main/selectCompanySubmit" method="POST">
<div style="float:left"><strong>{t}Клиент:{/t}</strong>&nbsp;</div>

<div style="float:left;">

<input type="text" name="company" id="company" value="" style="width:440px;"/>
<div id="company_cont">
<select name="company_vrnt" id="company_vrnt"></select>
</div>
</div>


&nbsp; <input type="submit" value="&rarr;" class="selectCompanyButton"/>


<div style="clear:both"></div>
</form> 

</div>
</div>
{if isset($selectError)}<br>{$selectError}{/if}

