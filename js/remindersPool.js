  var rPoolBlocking = false;
  var url = window.siteurl + "/ajax.php";
  function rPoolShowForm() {
  	$('reminderPoolHead').style.display = 'none';
  	$('reminderPoolHeadOpen').style.display = 'block';  	
  	formSlide.slideIn();
  }
  function rPoolHideForm() {
  	
  	formSlide.slideOut().chain(function(){
  	$('own').checked = 'checked';
  	$('rText').value = "";
  	$('reminderPoolHeadOpen').style.display = 'none';  
  	$('reminderPoolHead').style.display = 'block';  	
  	});
  	
  }
  function rPoolHightlight(el,id) {  	
  	if (rPoolBlocking) return;
  	el.style.backgroundColor = "#fffc82";
  	$('rpoolb'+id).style.visibility = 'visible';
  	$('rpoolb'+id).style.display = 'inline';  	
  }
  function rPoolUnHightlight(el,id,mColor) {
  	if (rPoolBlocking) return;
  	el.style.backgroundColor = mColor;
  	$('rpoolb'+id).style.visibility = 'hidden';
  	$('rpoolb'+id).style.display = 'none';  	  	
  }


  
  function rPoolDeleteLine(id, cid) {
	if (!confirm(_('Удалить?'))) return;	
	var id = id;
	var cid = cid;
	new Ajax(url, {
		method: 'post',
		onSuccess: function () {
			var tt = new Fx.Slide('rPoolTRDiv'+id);
			var fx = $('rPoolTRDiv'+id).effects({duration: 300, transition: Fx.Transitions.linear});
			fx.start({
				'opacity': 0
			});
		  	
		  	tt.slideOut().chain(function(){
		  		$('rPoolTR'+id).remove();
			});		
		},
		onFailure: function () {
			alert(_('Ошибка запроса!'));
		}
	}).request("section=40&id="+id+"&cid="+cid);
  }
  
   function rPoolDeleteLineWithComp(id,cid) {
	if (!confirm(_('Удалить?'))) return;	
	var id = id;
	new Ajax(url, {
		method: 'post',
		onSuccess: function () {
			var tt = new Fx.Slide('rPoolTRDiv'+id);
			var fx = $('rPoolTRDiv'+id).effects({duration: 300, transition: Fx.Transitions.linear});
			fx.start({
				'opacity': 0
			});
		  	
		  	tt.slideOut().chain(function(){
		  		$('rPoolTR'+id).remove();
			});		
		},
		onFailure: function () {
			alert(_('Ошибка запроса!'));
		}
	}).request("section=40&id="+id+"&cid="+cid);
  }
  
  function rPoolEdit(id,vis) {
  	rPoolBlocking = true;
	//if (vis=='sm') $('sm'+id).checked = 'checked';
	//if (vis=='common') $('common'+id).checked = 'checked';	
  	$('rPoolTRDiv'+id).style.display = 'none';
  	$('rPoolTRForm'+id).style.display = 'block';  
  		
  }
  
  function rPoolHideEditForm(id) {
  	rPoolBlocking = false;
  	$('rPoolTRForm'+id).style.display = 'none';  	
  	$('rPoolTRDiv'+id).style.display = 'block';
  	//$('own'+id).checked = 'checked';
  	//$('rText'+id).value = "";
  }
  
  function rPoolSubmitEditForm(id) {
	// ajax
	var id = id;
	if ($('rText'+id).value=="") {
		alert(_('Ничего не введено'));
		return;
	}
	
	var vis = 'own';
	if ($('own'+id).checked == true) vis = 'own';
	if ($('sm'+id).checked == true) vis = 'sm';
	if ($('common'+id).checked == true) vis = 'common';
	var text = $('rText'+id).value;
	
	new Ajax(url, {
		method: 'post',
		onSuccess: function () {
			
			if (this.response.text == 1) {
				$('inlineText'+id).setHTML(text);
				if ($('own'+id).checked == true) {
					$('rColor'+id).setStyle('color', '#e1131a');	
				} else if ($('sm'+id).checked == true) {
					$('rColor'+id).setStyle('color', '#10a007');	
				} else {
					$('rColor'+id).setStyle('color', '#0a65ab');	
				}							
				rPoolHideEditForm(id);
			} else {
				alert(_('Ошибка запроса!'));
			}
		},
		onFailure: function () {
			alert(_('Ошибка запроса!'));
		}
	}).request("section=41&id="+id+"&vis="+vis+"&t="+text);
	
	
  }
  
  
  function rPoolSubmitEditForm2(id,cid) {
	// ajax
	var id = id;
	if ($('rText'+id).value=="") {
		alert(_('Ничего не введено'));
		return;
	}
	
	var vis = 'own';
	if ($('own'+id).checked == true) vis = 'own';
	if ($('sm'+id).checked == true) vis = 'sm';
	if ($('common'+id).checked == true) vis = 'common';
	var text = $('rText'+id).value;
	
	new Ajax(url, {
		method: 'post',
		onSuccess: function () {
			
			if (this.response.text == 1) {
				$('inlineText'+id).setHTML(text);				
				if (vis=='own')	{
					$('rColor'+id).className = 'rpool_r_i';
				} else if (vis=='sm')	{
					$('rColor'+id).className = 'rpool_g_i';
				} else {
					$('rColor'+id).className = 'rpool_b_i';
				}
				rPoolHideEditForm(id);
			} else {
				alert('Ошибка запроса!');
			}
		},
		onFailure: function () {
			alert(_('Ошибка запроса!'));
		}
	}).request("section=41&id="+id+"&vis="+vis+"&t="+text+"&cid="+cid);
	
	
  }
  
  
  function rPoolAddReminder() {
  	if ($('rText').value!="") {
		var vis = 'own';
		if ($('sm').checked == true) vis = 'sm';
		if ($('common').checked == true) vis = 'common';		
  		document.location = window.siteurl+'/main/addReminder?t='+$('rText').value+'&v='+vis;
  	} else {
  		alert(_('Ничего не введено!'));
  	}
  }
  
