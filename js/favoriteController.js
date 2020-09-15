url = window.siteurl+"/ajax.php";

var blocking = false;
var historyWnd = 0;

function favOff(comp) {
	new Ajax(url, {
		method: 'get',
		onSuccess: function () {
		    if (this.response.text == 1) {
				$('isnotFav'+comp).style.visibility = 'visible';
				$('isFav'+comp).style.visibility = 'hidden';
			}	
		},
		onFailure: function () {
			alert('Error');
		}
	}).request("section=15&action=remove&id="+comp);
}

function favOn(comp) {	
	new Ajax(url, {
		method: 'get',
		onSuccess: function () {
		    if (this.response.text == 1) {
				$('isFav'+comp).style.visibility = 'visible';
				$('isnotFav'+comp).style.visibility = 'hidden';
			}
		},
		onFailure: function () {
			alert('Error');
		}
	}).request("section=15&action=add&id="+comp);
}

function clipOff(comp) {
	new Ajax(url, {
		method: 'get',
		onSuccess: function () {
		    if (this.response.text == 1) {
				$('isnotClip'+comp).style.visibility = 'visible';
				$('isClip'+comp).style.visibility = 'hidden';
			}	
		},
		onFailure: function () {
			alert('Error');
		}
	}).request("section=42&state=0&id="+comp);
}

function clipOn(comp) {	
	new Ajax(url, {
		method: 'get',
		onSuccess: function () {
		    if (this.response.text == 1) {
				$('isClip'+comp).style.visibility = 'visible';
				$('isnotClip'+comp).style.visibility = 'hidden';
			}
		},
		onFailure: function () {
			alert('Error');
		}
	}).request("section=42&state=1&id="+comp);
}


/* history */

function hideActHistoryWnd() {
	hideHistoryWnd(historyWnd);
}

function clearHistory(comp) {
	$('name'+comp).value = "";
	$('comment'+comp).value = "";	
}

function hideHistoryWnd(comp) {
	$('historyWnd'+comp).style.visibility = 'hidden';
	$('historyWnd'+comp).style.display = 'none';
	$('historyWndBtn'+comp).style.visibility = 'visible';
	blocking = false;
	historyWnd = 0;
	clearHistory(comp);
}

function showHistoryWnd(comp) {
	if (historyWnd!=0) {
		hideHistoryWnd(comp)
		return;
	}
	blocking = true;
	historyWnd = comp;
	$('historyWnd'+comp).style.visibility = 'visible';
	$('historyWnd'+comp).style.display = 'block';
	$('historyWndBtn'+comp).style.visibility = 'visible';//'hidden';	
	$('name'+comp).focus();	
}

function beforeAddHistory() {
    if ($('newEventHeader').value == '') {
        alert(_('Введите текст!'));
        return false;
    }
    return true;
}

function addHistoryReq(comp) {

	var comp = comp;
	var text = $('name'+comp).value;
	var com = $('comment'+comp).value;	

	if (text!="") {
		new Ajax(url, {
		method: 'post',
		data: "section=28&id="+comp+"&htext="+text+"&hcom="+com,
		onSuccess: function () {		    	
			hideHistoryWnd(comp);
			alert(_('Добавлено.'));
		},
		evalScripts: false,
		onFailure: function () {
			alert('Error');
		}
		}).request();	
	} else {
		alert(_('Введите текст!'));
	}

}
