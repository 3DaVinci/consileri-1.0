
<script>
	var y = {$y};
	var sourcey = {$y};
	var sourcem = {$m};	
	var manager = {$manager};
{literal}	
	function nextYear(){
		y = y + 1;

		if (new Date(y,1,1).getYear() > new Date().getYear()) y = y - 1;

		removePointer();
		
		if (y != sourcey) {

			for (i = 0; i<12; i++) {			
					$('m'+i).removeClass('monthCurrent');
					$('m'+i).addClass('month');	
					$('m'+i).style.backgroundColor = 'white';								
			}
				
		} else {

			for (i = 0; i<12; i++) {
				if (i != sourcem) {
					$('m'+i).removeClass('monthCurrent');
					$('m'+i).addClass('month');	
											
				} else {
					$('m'+i).removeClass('month');
					$('m'+i).addClass('monthCurrent');	
					$('m'+i).style.backgroundColor = '#eca242';
				}	
			}

		}
		
		$('curmonth').setHTML(y);
	}
	
	function prevYear(){
		y = y - 1;
//		if (y<2000) y = 2000;
		
		removePointer();
			
		if (y != sourcey) {

			for (i = 0; i<12; i++) {			
					$('m'+i).removeClass('monthCurrent');
					$('m'+i).addClass('month');	
					$('m'+i).style.backgroundColor = 'white';								
			}						

				
		} else {

			for (i = 0; i<12; i++) {
				if (i != sourcem) {
					$('m'+i).removeClass('monthCurrent');
					$('m'+i).addClass('month');	
											
				} else {
					$('m'+i).removeClass('month');
					$('m'+i).addClass('monthCurrent');	
					$('m'+i).style.backgroundColor = '#eca242';										
				}	
				
			}

		}
		
		$('curmonth').setHTML(y);
	}		
	
	function dateChanged(month) {
		if (y == sourcey && sourcem == month) return;
		if (new Date(y,month,1)>new Date()) return;
		
		window.location = window.siteurl+"/journal?scale=3&y=" + y + "&m=" + month + "&manager=" + manager;
	}
	
	function highlight(elem,mode) {	
		if (mode==1) {
			if(elem.style.cursor == 'pointer') elem.style.backgroundColor = '#f6f4e6';
		} else {
			if(elem.style.cursor == 'pointer') elem.style.backgroundColor = 'white';		
		}
	}
	
</script>
{/literal}

<div id="select-month">

<div id="monthcontrol">
<div id="scroolbuttonleft2" onclick="prevYear();"></div>
<div id="curmonth">{$y}</div>
<div id="scroolbuttonright2" onclick="nextYear();"></div>
</div>

<br>

<div id="selmonth">
<div {if $m!=0}class="month"{else}class="monthCurrent"{/if} onclick="dateChanged(0)" id="m0" onmouseover="highlight(this,1)" onmouseout="highlight(this,2)">{t}Январь{/t}</div>
<div {if $m!=1}class="month"{else}class="monthCurrent"{/if} onclick="dateChanged(1)" id="m1" onmouseover="highlight(this,1)" onmouseout="highlight(this,2)">{t}Февраль{/t}</div>
<div {if $m!=2}class="month"{else}class="monthCurrent"{/if} onclick="dateChanged(2)" id="m2" onmouseover="highlight(this,1)" onmouseout="highlight(this,2)">{t}Март{/t}</div>
<div {if $m!=3}class="month"{else}class="monthCurrent"{/if} onclick="dateChanged(3)" id="m3" onmouseover="highlight(this,1)" onmouseout="highlight(this,2)">{t}Апрель{/t}</div>
<div {if $m!=4}class="month"{else}class="monthCurrent"{/if} onclick="dateChanged(4)" id="m4" onmouseover="highlight(this,1)" onmouseout="highlight(this,2)">{t}Май{/t}</div>
<div {if $m!=5}class="month"{else}class="monthCurrent"{/if} onclick="dateChanged(5)" id="m5" onmouseover="highlight(this,1)" onmouseout="highlight(this,2)">{t}Июнь{/t}</div>
<div {if $m!=6}class="month"{else}class="monthCurrent"{/if} onclick="dateChanged(6)" id="m6" onmouseover="highlight(this,1)" onmouseout="highlight(this,2)">{t}Июль{/t}</div>
<div {if $m!=7}class="month"{else}class="monthCurrent"{/if} onclick="dateChanged(7)" id="m7" onmouseover="highlight(this,1)" onmouseout="highlight(this,2)">{t}Август{/t}</div>
<div {if $m!=8}class="month"{else}class="monthCurrent"{/if} onclick="dateChanged(8)" id="m8" onmouseover="highlight(this,1)" onmouseout="highlight(this,2)">{t}Сентябрь{/t}</div>
<div {if $m!=9}class="month"{else}class="monthCurrent"{/if} onclick="dateChanged(9)" id="m9" onmouseover="highlight(this,1)" onmouseout="highlight(this,2)">{t}Октябрь{/t}</div>
<div {if $m!=10}class="month"{else}class="monthCurrent"{/if} onclick="dateChanged(10)" id="m10" onmouseover="highlight(this,1)" onmouseout="highlight(this,2)">{t}Ноябрь{/t}</div>
<div {if $m!=11}class="month"{else}class="monthCurrent"{/if} onclick="dateChanged(11)" id="m11" onmouseover="highlight(this,1)" onmouseout="highlight(this,2)">{t}Декабрь{/t}</div>

</div>

{literal}
<script>
  function removePointer() {
		if (new Date(y,1,1).getYear() == new Date().getYear()) {
			for (i = 0; i<12; i++) {			
				if (new Date(y,i,1).getMonth() > new Date().getMonth()) {
					$('m'+i).style.cursor = 'default';
				} else {
					if (sourcem==i){
						$('m'+i).style.cursor = 'default';
					} else {
						$('m'+i).style.cursor = 'pointer';
					}
				}
			}
		} else {	
			for (i = 0; i<12; i++) {			
				if (i!=sourcem || y!=sourcey) {
					$('m'+i).style.cursor = 'pointer';			
				} else {
					$('m'+i).style.cursor = 'default';			
				}
			}			
		}		
  }
  removePointer();
</script>
{/literal}  
</div>
