
function executeRequest(field,section) {			
		var url = window.siteurl + "/ajax.php?section="+section+"&search="+$(field).value+"&fix="+new Date().getTime();
		
		var complete = function(){

			if ($(field+'_vrnt').options.length == 0)
			{
				$(field+'_cont').style.display = 'none';
			} else {
				$(field+'_cont').style.display = 'block';
			}			
		}
		
		var request = function(){}
		
		var ajax = new Ajax(url, {	method: 'get',
									update: $(field+'_cont'),
									
									onComplete: complete,
									onRequest: request  });
		
		ajax.request();
}

var InlineInput = new Class({
	
	initialize: function(field,section){
		this.inlineField = $(field);
		this.field = field;			
		this.inlineFieldVariant = $(field+'_vrnt');
		this.inlineFieldContent = $(field+'_cont');				
		
		var eventname;
		if (window.opera) {
			eventname = 'keydown';
		} else {
			eventname = 'keyup';
		}
				
		$(field).addEvent(eventname, function(e) {					
			if(window.event) // IE
			{ keynum = e.keyCode	}
			else if(e.which) // Netscape/Firefox/Opera
			{ keynum = e.which		}

			if (keynum==40) { // down
			 	$(field+'_vrnt').focus();
			 	$(field+'_vrnt').selectedIndex = 0;
			 	return;
			}	
			
			if (keynum!=39 && keynum!=37 && keynum!=38 && keynum!=9){
				setTimeout("executeRequest('"+field+"','"+section+"')",100);
			}
		});
		
		
		$(field+'_vrnt').addEvent('keyup', function(e) {					
			alert(1);
			if(window.event) // IE
			{ keynum = e.keyCode	}
			else if(e.which) // Netscape/Firefox/Opera
			{ keynum = e.which		}
			
		});
		
	},
	
	vrnt_keydown: function(e,val) {

		keynum = e.keyCode;			
		var field = this.field;					
			
		if (keynum==13) { // enter		
			$(field).value = val.options[val.selectedIndex].text;
			$(field).focus();
			$(field+'_cont').style.display = 'none';
			new Event(e).stop();	
			return;		
		}
		
		if (keynum==27) { //esc
			$(field).focus();
			$(field+'_cont').style.display = 'none'; 	
			new Event(e).stop();
		 	return;
		}
		
		if (keynum==38) { // up == 0
		 	if ($(field+'_vrnt').selectedIndex == 0) {		 		 	
				$(field).focus(); 							
		 	}
		 	return;
		}
		
		if (keynum==40) { // down == length		
		 	if ($(field+'_vrnt').selectedIndex == $(field+'_vrnt').options.length-1) {		 		 									
				$(field).focus(); 			
		 	}
		 	return;
		}
			
		
	},
			
	vrnt_dblclick: function() {		
		var field = this.field;	
		$(field).value = $(field+'_vrnt').options[$(field+'_vrnt').selectedIndex].text;
		$(field).focus();
		$(field+'_cont').style.display = 'none';	
	}
	
});	
