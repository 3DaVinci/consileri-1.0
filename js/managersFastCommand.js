function showOut(el) {	
	rollDown();
	$('out'+el).style.visibility = 'visible';
	$('in'+el).style.visibility = 'hidden';		
}

function showIn(el) {
	$('out'+el).style.visibility = 'hidden';
	$('in'+el).style.visibility = 'visible';	
}

function rollDown() {
	for (i = 0; i < JSONObject.bind.length; i++) {
		showIn(JSONObject.bind[i]);
	}	
}


