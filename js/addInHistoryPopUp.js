
var isVis = false;

function showComment() {
	isVis = true;
	$('aihc').style.display = 'block';
}



document.addEvent('click', function checkelements(){	
	if (isVis == false) {
		$('aihc').style.display = 'none';
	} else {
		isVis = false;
	}
});

document.addEvent('keyup', function checkelements(e){	
	if (e.keyCode==9)
	if (isVis == false) {
		$('aihc').style.display = 'none';
	} else {
		isVis = false;
	}
});
