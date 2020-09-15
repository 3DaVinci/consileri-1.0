function changeClipState(el,id) {
  	var el = el;
  	var id = id;
  	state = (el.className == 'clip_on' ? '0' : '1'); 	
  	
  	var url = window.siteurl + "/ajax.php";
	new Ajax(url, {
		method: 'post',
		onSuccess: function () {
			el.className = (el.className == 'clip_on' ? 'clip_off' : 'clip_on');
		},
		onFailure: function () {
			alert(_('Ошибка запроса!'));
		}
	}).request("section=42&id="+id+"&state="+state);
  	
}