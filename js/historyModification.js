function changeState(elem) {
	$('heih'+elem).style.visibility = 'visible';
	$('heic'+elem).style.visibility = 'visible';	
	$('heh'+elem).style.visibility = 'hidden';
	$('hec'+elem).style.visibility = 'hidden';
	$('heh'+elem).style.display = 'none';
	$('hec'+elem).style.display = 'none';	
	$('heic'+elem).style.display = 'block';	
	$('heih'+elem).style.display = 'block';
	
	
	
	$('cs'+elem).style.visibility = 'hidden';
	$('cs'+elem).style.display = 'none';

	$('css'+elem).style.visibility = 'visible';
	$('css'+elem).style.display = 'block';
	$('csc'+elem).style.visibility = 'visible';
	$('csc'+elem).style.display = 'block';
	
	$('csd'+elem).style.visibility = 'hidden';
	$('csd'+elem).style.display = 'none';	
	
}

function changeStateCancel(elem) {
	$('heih'+elem).style.visibility = 'hidden';
	$('heic'+elem).style.visibility = 'hidden';	
	$('heh'+elem).style.visibility = 'visible';
	$('hec'+elem).style.visibility = 'visible';
	$('heh'+elem).style.display = 'block';
	$('hec'+elem).style.display = 'block';	
	$('heic'+elem).style.display = 'none';	
	$('heih'+elem).style.display = 'none';
	
	$('cs'+elem).style.visibility = 'visible';
	$('cs'+elem).style.display = 'block';

	$('css'+elem).style.visibility = 'hidden';
	$('css'+elem).style.display = 'none';
	$('csc'+elem).style.visibility = 'hidden';
	$('csc'+elem).style.display = 'none';
	
	$('csd'+elem).style.visibility = 'visible';
	$('csd'+elem).style.display = 'block';
	
}

function changeStateSave(elem) {
	
	var url = window.siteurl + "/ajax.php";
	
	var header = $('hehData'+elem).value;
	var old_header = $('heh'+elem).getText();
	var comment = $('hecData'+elem).value;
	var old_comment = $('hec'+elem).getText();
	comment = comment.replace(/\n/g,"<br>");
	
	if (header != old_header || comment != old_comment)
	{ 
	new Ajax(url, {
		method: 'get',
		onSuccess: function () {
			$('heh'+elem).setHTML(header);
			$('hec'+elem).setHTML(comment);
			changeStateCancel(elem);		
		},
		onFailure: function () {
			alert(_('Изменение не удалось!'));
		}
	}).request("section=10&header="+header+"&comment="+comment+"&id="+elem);
	} else {
		changeStateCancel(elem);
	}
	
}

function changeStateDelete(elem) {
	if (!confirm(_('Вы уверены?'))) return;
	
	var url = window.siteurl + "/ajax.php";
	new Ajax(url, {
		method: 'get',
		onSuccess: function () {
			$('event'+elem).style.visibility = 'hidden';			
			$('event'+elem).style.display = 'none';			
			changeStateCancel(elem);		
		},
		onFailure: function () {
			alert(_('Ошибка запроса!'));
		}
	}).request("section=11&id="+elem);
	
}