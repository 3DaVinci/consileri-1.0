{literal}
<script language="JavaScript" type="text/javascript"> 
var url = "{/literal}{$siteurl}{literal}/ajax.php";


function chCategoryImg(obj) {
	$('labelCategoryImg').setHTML("<img src=\""+obj.src+"\" id=\"categImg\"/>");
}



var DeleteCategoryWnd = new Class({
	
	initialize: function(){
		
	},
	
	show: function(id) {		
		this.id = id;
		$('deleteCategoryWnd').style.visibility = 'visible';
		$('deleteCategoryWnd').style.display = 'block';
		
		var x = (Math.floor(document.body.clientWidth/2))-129;
		var y = ((Math.floor(document.documentElement.clientHeight/2))-62)+document.documentElement.scrollTop;		
		$('deleteCategoryWnd').style.left = x+"px";
		$('deleteCategoryWnd').style.top = y+"px";		
		
	},
	
	request: function() {		
		this.hide();
		var data = 'section=36&id='+this.id+'&act='+$('moveTo').value;		
	
		new Ajax(url, {
		method: 'post',
		data: data,
		onSuccess: function () {
		   document.location = "/managment/";
		},
		onFailure: function () {
			alert('Error');
			this.hide();
		}
		}).request();
		
	},
	
	hide: function() {
		$('deleteCategoryWnd').style.visibility = 'hidden';
		$('deleteCategoryWnd').style.display = 'none';
	}
	
});	


var DeleteLabelWnd = new Class({
	
	initialize: function(){
	},
	
	show: function(id) {		
		this.id = id;
		$('deleteLabelWnd').style.visibility = 'visible';
		$('deleteLabelWnd').style.display = 'block';
//alert(document.documentElement.scrollTop+"-"+document.body.clientHeight+"-"+document.documentElement.clientHeight);
		var x = (Math.floor(document.body.clientWidth/2))-129;
		var y = ((Math.floor(document.documentElement.clientHeight/2))-62)+document.documentElement.scrollTop;		
		$('deleteLabelWnd').style.left = x+"px";
		$('deleteLabelWnd').style.top = y+"px";
		
	},
	
	request: function() {				
		this.hide();
		var data = 'section=35&id='+this.id+'&act='+$('deleteTo').value;		
	
		new Ajax(url, {
		method: 'post',
		data: data,
		onSuccess: function () {
		   document.location = "{/literal}{$siteurl}{literal}/managment/";
		},
		onFailure: function () {
			alert('Error');
			this.hide();
		}
		}).request();
		
	},
	
	hide: function() {
		$('deleteLabelWnd').style.visibility = 'hidden';
		$('deleteLabelWnd').style.display = 'none';
	}
	
});	




var LabelCategoryWnd = new Class({
	
	initialize: function(){
		this.mode = '1'; // new
	},
	
	load: function() {
		var data = 'section=30&id='+this.id;
		var thisObj = this;
	
		new Ajax(url, {
		method: 'post',
		data: data,
		onSuccess: function () {
		   eval('temp = '+this.response.text);		  
		   $('labelCategoryTxt').value = temp['name'];
		   $('categImg').src = '/images/labels/25/'+temp['picture'];
		   thisObj.name = temp['name'];
		   thisObj.picture = temp['picture'];		   
		   thisObj.showAfterReq();
		},
		onFailure: function () {
			alert('Error');
		}
		}).request();
		
	},
		
	request: function() {		
		if ($('labelCategoryTxt').value=="") {
				alert('no');
				return;
		}

		if (this.mode==1) {
			this.hide();
			var data = 'section=29&name='+$('labelCategoryTxt').value+'&pic='+$('categImg').src;						
			new Ajax(url, {
			method: 'post',
			data: data,
			onSuccess: function () {		   
			   document.location = "{/literal}{$siteurl}{literal}/managment/";
			},
			onFailure: function () {
				alert('Error');				
			}
			}).request();
		} else {
			this.hide();
			var data = 'section=31&id='+this.id+'&name='+$('labelCategoryTxt').value+'&pic='+$('categImg').src;			
			new Ajax(url, {
			method: 'post',
			data: data,
			onSuccess: function () {		   
			   document.location = "{/literal}{$siteurl}{literal}/managment/";
			},
			onFailure: function () {
				alert('Error');
				this.hide();
			}
			}).request();
		}	
	},
	
	deleteFn: function() {
		this.hide();
		deleteCategoryWnd.show(this.id);
	},
	
	showAfterReq: function() {
		$('labelCategoryWnd').style.visibility = 'visible';
		$('labelCategoryWnd').style.display = 'block';
		$('labelCategoryWnd').style.left = (this.event.page.x+5)+"px";
		$('labelCategoryWnd').style.top = (this.event.page.y+5)+"px";
		$('labelCategoryTxt').focus();
	},		
	
	show: function(event,id,load) {
		var e = new Event(event);
		
		labelWnd.hide();
		
		$('labelCategoryTxt').value = "";
		$('categImg').src = "{/literal}{$siteurl}{literal}/images/labels/25/label0.jpg";
		
		this.id = id;
		this.event = e;
		
		if (load == true) { 
			this.mode = 2; //edit
			$('categoryDelBtn').style.visibility = 'visible';
			this.load();
			return;
		} else {
			this.mode = 1;
			$('categoryDelBtn').style.visibility = 'hidden';
		}
			
		$('labelCategoryWnd').style.visibility = 'visible';
		$('labelCategoryWnd').style.display = 'block';
		$('labelCategoryWnd').style.left = (e.page.x+5)+"px";
		$('labelCategoryWnd').style.top = (e.page.y+5)+"px";		
		$('labelCategoryTxt').focus();
	},
	
	hide: function(){
		$('labelCategoryWnd').style.visibility = 'hidden';
		$('labelCategoryWnd').style.display = 'none';
	},
	
	hotkey: function(event)  {
		var e = new Event(event);
		if ((e.key == 'enter' && e.control) || e.code == 10) this.request();
	}

});	





var LabelWnd = new Class({
	
	initialize: function(){		
		this.mode = 1;
	},
	
	load: function() {
		var data = 'section=33&id='+this.id;
		var thisObj = this;
	
		new Ajax(url, {
		method: 'post',
		data: data,
		onSuccess: function () {
		   eval('temp = '+this.response.text);		  
		   $('labelName').value = temp['name'];		   
		   thisObj.name = temp['name'];		   	   
		   thisObj.showAfterReq();
		},
		onFailure: function () {
			alert('Error');
		}
		}).request();
	},
	
	request: function() {		
	
		if ($('labelName').value=="") {
				alert('no');
				return;
		}

		if (this.mode==1) {
			this.hide();
			var data = 'section=32&category='+this.category+'&name='+$('labelName').value;			
			
			new Ajax(url, {
			method: 'post',
			data: data,
			onSuccess: function () {		   
			   document.location = "{/literal}{$siteurl}{literal}/managment/";
			},
			onFailure: function () {
				alert('Error');
				this.hide();
			}
			}).request();
		} else {
			this.hide();
			var data = 'section=34&id='+this.id+'&name='+$('labelName').value;
					
			new Ajax(url, {
			method: 'post',
			data: data,
			onSuccess: function () {		   
			   document.location = "{/literal}{$siteurl}{literal}/managment/";
			},
			onFailure: function () {
				alert('Error');
				this.hide();
			}
			}).request();
		}	
	},
	
	deleteFn: function() {
		this.hide();
		deleteLabelWnd.show(this.id);
	},
	
	showAfterReq: function() {
		$('labelWnd').style.visibility = 'visible';
		$('labelWnd').style.display = 'block';
		$('labelWnd').style.left = (this.event.page.x+5)+"px";
		$('labelWnd').style.top = (this.event.page.y+5)+"px";
		$('labelName').focus();
	},
	
	show: function(event,id,load,category) {
		var e = new Event(event);		
		
		labelCategoryWnd.hide();
		
		$('labelName').value = "";
		this.id = id;
		this.event = e;
		this.category = category;						
		
		if (load == true) { 
			this.mode = 2; //edit
			$('labelDelBtn').style.visibility = 'visible';
			this.load();
			return;
		} else {
			this.mode = 1;
			$('labelDelBtn').style.visibility = 'hidden';			
		}
		
		$('labelWnd').style.visibility = 'visible';
		$('labelWnd').style.display = 'block';
		$('labelWnd').style.left = (e.page.x+5)+"px";
		$('labelWnd').style.top = (e.page.y+5)+"px";
		$('labelName').focus();
	},
	
	hide: function() {
		$('labelWnd').style.visibility = 'hidden';
		$('labelWnd').style.display = 'none';
	},
	
	hotkey: function(event)  {
		var e = new Event(event);	
		if ((e.key == 'enter' && e.control) || e.code == 10) this.request();
	}
	
});	

	var labelCategoryWnd = new LabelCategoryWnd();
	var deleteCategoryWnd = new DeleteCategoryWnd();
	var labelWnd = new LabelWnd();
	var deleteLabelWnd = new DeleteLabelWnd();



</script>
{/literal}  





<div id="labelCategoryWnd" class="categoryWndWrap">
		<div class="categoryWnd">
			<div style="clear:both">
			<div id="labelCategoryImg" class="selectCatImg"><img src="/images/labels/25/label0.jpg" id="categImg"/></div>
			<div style="float:left; padding:4px 0px 0px 10px;"><input type="text" id="labelCategoryTxt" value="" style="width:160px;"/></div>
			</div>
			<div id="clear"></div>
			<div id="newCategoryImgs">
				{$labelsImgs}
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


<div style="font-size:16px; padding-left: 10px"><b>{t}Редактирование категорий и меток{/t}</b></div><br>

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
<td width="40" align="center" style="padding-bottom:10px;"><img src="/images/labels/25/label0.jpg"/></td>
<td style="padding-bottom:10px;"><span onClick="labelCategoryWnd.show(event,0,false);" style="font-size:12px; color:#dc8009; cursor:pointer"><u><b>{t}Новая категория{/t}</b></u></span>
	
</td>
</tr>


{foreach from=$labelsRoot item=cur}
<tr>
<td valign="top" align="center" style="padding-bottom:10px;"><img src="/images/labels/25/{$cur.picture}" /></td>
<td style="padding-bottom:10px;">

<div style="padding-top:5px; padding-bottom:10px;"><span onclick="labelCategoryWnd.show(event,{$cur.id},true);" style="cursor:pointer;"><u><b>{$cur.name}</b></u></span></div>

<span onclick="labelWnd.show(event,0,false,{$cur.id})" style="color:#dc8009; cursor:pointer">{t}Новая метка{/t}</span>{foreach from=$cur.labels item=item}, <span onclick="labelWnd.show(event,{$item.id},true,{$cur.id})" style="color:#0ca414; cursor:pointer">{$item.name}</span>{/foreach}
</td>
</tr>
{/foreach}
</table>


