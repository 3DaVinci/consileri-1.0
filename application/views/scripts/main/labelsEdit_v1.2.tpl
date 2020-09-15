{literal}
<script language="JavaScript" type="text/javascript" src="{/literal}{$siteurl}{literal}/js/editLabels.js"></script>
{/literal}  


<div id="labelCategoryWnd" class="categoryWndWrap">
		<div class="categoryWnd">
			<div style="clear:both">
			<div id="labelCategoryImg" class="selectCatImg"><img src="{$siteurl}/images/labels/25/label0.jpg" id="categImg"/></div>
			<div style="float:left; padding:4px 0px 0px 10px;"><input type="text" id="labelCategoryTxt" value="" style="width:160px;"/></div>
			</div>
			<div id="clear"></div>
			<div id="newCategoryImgs">
				<!--{$labelsImgs}-->
			</div>
			<div>			
				<div style="padding:10px 5px 0px 5px;">
				<div onclick="labelCategoryWnd.deleteFn();" style="cursor:pointer; color: #e62726;	text-decoration: underline; float:left" id="categoryDelBtn">{t}Удалить!{/t}</div>
				<div style="float:right">
				<img src="{$siteurl}/images/confirm.gif" style="cursor:pointer" onclick="labelCategoryWnd.request();">
				<img src="{$siteurl}/images/cencel.gif" style="cursor:pointer" onclick="labelCategoryWnd.hide();">
				</div>
				</div>
			</div>	
		</div>
</div>


<div id="labelWnd" class="labelWndWrap">
<div class="labelWnd">	
	<textarea name="nl" id="labelName" wrap="on" class="labelTxt" onkeypress="labelWnd.hotkey(event);"></textarea>
	<div style="padding:2px 0px 0px 0px;">
	
	<div onclick="labelWnd.deleteFn();" style="cursor:pointer; color: #e62726;	text-decoration: underline; float:left" id="labelDelBtn">{t}Удалить!{/t}</div>
	<div style="float:right">
	<img src="{$siteurl}/images/confirm.gif" style="cursor:pointer" onclick="labelWnd.request();">
	<img src="{$siteurl}/images/cencel.gif" style="cursor:pointer" onclick="labelWnd.hide();">
	</div>
	</div>
</div>
</div>

<div id="deleteCategoryWnd" class="deleteWndWrap">
<div class="deleteWnd">
<center style="color:#cc3406">{t}Внимание! Удаление категории!{/t}</center><br>
{t}Вы желаете удалить категорию и перенести метки в другую категорию?{/t}<br>
<div style="padding-top:10px;">
  <div style="float:left">
  <select name="moveTo" id="moveTo" style="width:130px;">
	<option value="-1">{t}Не переносить{/t}</option>
  	{foreach from=$delCategories item=cur}
	  	{if $cur.parent_id==0}
		  	<option value="{$cur.id}" class="grElGr">{$cur.name}</option>	
	  	{/if}		
	{/foreach}
  </select>
  </div>
  	<div style="float:right; padding-top:1px;">
	<img src="{$siteurl}/images/confirm.gif" style="cursor:pointer" onclick="deleteCategoryWnd.request()">
	<img src="{$siteurl}/images/cencel.gif" style="cursor:pointer" onclick="deleteCategoryWnd.hide()">
	</div>
</div>

</div>
</div>



<div id="deleteLabelWnd" class="deleteWndWrap">
<div class="deleteWnd">
<center style="color:#cc3406">{t}Внимание! Удаление метки!{/t}</center><br>
{t}Вы желаете удалить метку и присвоить фирмам под этой меткой другую метку?{/t}<br>

<div style="padding-top:10px;">
  <div style="float:left">
  <select name="deleteTo" id="deleteTo" style="width:130px;">
  	<option value="-1">{t}Не присваивать{/t}</option>	
  	{foreach from=$delCategories item=cur}
	  	{if $cur.parent_id==0}
	  		<optgroup label="{$cur.name}" class="grElGr">
	  	{else}
		  	<option value="{$cur.id}" class="grElGr">{$cur.name}</option>	
	  	{/if}		
	{/foreach}
  </select>
  </div>
  
	<div style="float:right; padding-top:1px;">  
	<img src="{$siteurl}/images/confirm.gif" style="cursor:pointer" onclick="deleteLabelWnd.request();">
	<img src="{$siteurl}/images/cencel.gif" style="cursor:pointer" onclick="deleteLabelWnd.hide();">
	</div>
</div>
	
</div>
</div>



<table border="0" style="font-size:11px;" width="95%" cellpadding="0" cellspacing="0">
<tr>

<td style="padding-bottom:10px;"><span onClick="labelCategoryWnd.show(event,0,false);" style="font-size:11px; color:#000; cursor:pointer; background-color:#fbfacc; padding: 2px 5px 4px 3px;"><span style="color:#f4b715;"><b>+</b></span>&nbsp;&nbsp;<u><b>{t}Новая категория{/t}</b></u></span>
	
</td>
</tr>


{foreach from=$labelsRoot item=cur}
<tr>
<td style="padding-bottom:12px;line-height:150%">
<div style="padding-left:20px">
<div style="padding-top:5px; padding-bottom:5px;"><span onclick="labelCategoryWnd.show(event,{$cur.id},true);" style="cursor:pointer;"><u><b>{$cur.name}</b></u></span></div>
{assign var="isFirst" value=true}
<span onclick="labelWnd.show(event,0,false,{$cur.id})" style="font-size:11px; color:#000; cursor:pointer; background-color:#fbfacc; padding: 0px 5px 2px 3px;"><span style="color:#f4b715;"><b>+</b></span> <u>{t}метка{/t}</u></span>{foreach from=$cur.labels item=item}<span onclick="labelWnd.show(event,{$item.id},true,{$cur.id})" style="color:#0ca414; cursor:pointer">{if $isFirst==false}, &nbsp;{else} &nbsp;{/if}{$item.name}</span>{assign var="isFirst" value=false}{/foreach}
</div>
</td>
</tr>
{/foreach}

</table>
