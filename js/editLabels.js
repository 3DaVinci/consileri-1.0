var url = window.siteurl + "/ajax.php";


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
		   document.location = window.siteurl + "/main/?editLabels";
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
		   document.location = window.siteurl + "/main/?editLabels";
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
		   $('categImg').src = window.siteurl + '/images/labels/25/'+temp['picture'];
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
			   document.location = window.siteurl + "/main/?editLabels";
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
			   document.location = window.siteurl + "/main/?editLabels";
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
		$('categImg').src = window.siteurl + "/images/labels/25/label0.jpg";
		
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
			   document.location = window.siteurl + "/main/?editLabels";
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
			   document.location = window.siteurl + "/main/?editLabels";
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

