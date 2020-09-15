
  
  <script type="text/javascript" src="{$siteurl}/libs/jscalendar/calendar.js"></script>
  <script type="text/javascript" src="{$siteurl}/libs/jscalendar/lang/calendar-{$lang}.js"></script>
  <script type="text/javascript" src="{$siteurl}/libs/jscalendar/calendar-setup.js"></script>


<div id="calendar-wrapper"><div id="calendar-container"></div></div>

{literal}
<script type="text/javascript">
  function dateChanged(calendar) {   
    if (calendar.dateClicked) {
      {/literal}
      var manager = {$manager};
      {literal}
      var y = calendar.date.getFullYear();
      var m = calendar.date.getMonth();     // integer, 0..11
      var d = calendar.date.getDate();      // integer, 1..31      
 	  window.location = window.siteurl+"/journal?scale=1&y=" + y + "&m=" + m + "&d=" + d + "&manager=" + manager;
    }
  };

	
  var JSONObject = {"bind": {/literal}
  {$json}
  {literal}
  };
		  
	var today = (new Date().getDate()) + "." + (new Date().getMonth()+1) + "." + (new Date().getFullYear());

	function dateStatus(date, y, m, d) {			
		var temp = y + "-" + (m + 1) + "-" + d;						 
		var temp2 = d + "." + (m + 1) + "." + y;						 
	
		if (temp2==today) { return false; }
	
		if (!JSONObject.bind.contains(temp2) && new Date(y,m,d) <= new Date()) {
			return 'special';
		}			
		
		if (new Date(y,m,d) > new Date()) return true; else
		return false;
	}

  Calendar.setup(
    {
      flat         : "calendar-container", // ID of the parent element
      flatCallback : dateChanged,           // our callback function
      weekNumbers  : false,
      dateStatusFunc : dateStatus,
      date : new Date({/literal}{$y},{$m},{$d}{literal})
    }
  );
 
</script>
{/literal}  
