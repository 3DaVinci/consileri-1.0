
  <script type="text/javascript" src="{$siteurl}/libs/jscalendar/calendar.js"></script>
  <script type="text/javascript" src="{$siteurl}/libs/jscalendar/lang/calendar-{$lang}.js"></script>
  <script type="text/javascript" src="{$siteurl}/libs/jscalendar/calendar-setup.js"></script>

  
  
<div id="calendar-wrapper"><div id="calendar-container"></div></div>

{literal}
<style type="text/css">
<!--
.calendar tbody .rowhilite td {
	background: #e69020; 
}
.calendar tbody td.hilite {
  border-color: #e69020;
}
-->
</style>
{/literal}

<script type="text/javascript">
var block = new Array();
	var i = 0;
	{foreach from=$blokeddays item=cur}
		block[i] = "{$cur}";
		i++;
	{/foreach}
	{literal}

 var JSONObject = {"bind": {/literal}
  {$json}
  {literal}
  };
		  
var today = (new Date().getDate()) + "." + (new Date().getMonth()+1) + "." + (new Date().getFullYear());


  function dateStatus(date, y, m, d) {	
	
	var temp = y + "-" + (m + 1) + "-" + d;		

	var temp2 = d + "." + (m + 1) + "." + y;						 
	
	//if (temp2==today) { return false; }
	
	if (!JSONObject.bind.contains(temp2) && (new Date(y,m,d) <= new Date()) && !block.contains(temp)) {
			return 'special';
	}			
/*
	for (i = 0; i < 7; i++ ) {
		if (block[i] == temp)	{
			return true;
		}
	}*/
	if (block.contains(temp))  return true;

	if (new Date(y,m,d) > new Date()) return true;
	
	return false;
  }

  function dateChanged(calendar) { 
    if (calendar.dateClicked) {
      {/literal}
      var manager = {$manager};
      {literal}
      var y = calendar.date.getFullYear();
      var m = calendar.date.getMonth();     // integer, 0..11
      var d = calendar.date.getDate();      // integer, 1..31      
 	  window.location = window.siteurl+"/journal?scale=2&y=" + y + "&m=" + m + "&d=" + d + "&manager=" + manager;
    }
  };


  Calendar.setup(
    {
      flat         : "calendar-container", // ID of the parent element
      flatCallback : dateChanged,           // our callback function
      weekNumbers  : false,
      dateStatusFunc : dateStatus,      
      showOthers : false,
      date : new Date({/literal}{$y},{$m},{$d}{literal})
    }
  );
 
</script>
{/literal}  
