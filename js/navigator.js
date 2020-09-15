    //------------------------------------------------------------------------------
    // Scroll Pages Control
    // 2007 (c) by theOnlyBoy
    // http://theonlyboy.habrahabr.ru
    //------------------------------------------------------------------------------

    var divPages,
        divPos,
        iters = 7,
        curX  = 0;
    
    pMaxFix = pMax;
	stay = pMax % pTo;
	if (stay != 0) { pMax = (pMax - stay) + pTo; }
    
        
    function initPages()
    {
      divPages = document.getElementById('divPages');
      divPos   = document.getElementById('divPos');
      divPos.style.width = parseInt(250*divPages.clientWidth/divPages.scrollWidth) + 'px';
      
      var nowpage = 25 * Math.floor(curPage/25);
     
      if (curPage % 25 == 0) {nowpage = nowpage - 25;}           
      
      setPages(nowpage);
    }

   // onload = initPages;
    
    
    // Sets red marker at a proper position
    function setMark()
    {
      if (curPage>=pFrom && curPage<=pTo)
      {
        document.getElementById('tdMark').style.backgroundImage    = 'url(mark.gif)';
        document.getElementById('tdMark').style.backgroundPosition = parseInt((curPage-pFrom)/(pTo-pFrom)*100) + "% 0%";
      }
      else
      {
        document.getElementById('tdMark').style.backgroundImage = 'url(blank.gif)';
      }
    }

    // Returns object size & position
    function getObjectSize(obj)
    {
      var l=0, t=0, o = obj;
      while (o)
      {
          l += o.offsetLeft;
          t += o.offsetTop;
          o  = o.offsetParent;
      }
      return [l, t, obj.offsetWidth, obj.offsetHeight];
    }


    // Calculates scroll delta X coord
    function getDX(c, n)
    {
      var dx = (n-c) / iters;
      if (Math.abs(dx)<1)
        dx = Math.abs(dx)/dx;
        
      return c + ((c!=n) ? dx : 0);
    }


    var lastX = 0;

    // Proceeds div scrolling
    function scrollPages()
    {
      var size = getObjectSize(divPages);

      if (divPages.scrollWidth > divPages.offsetWidth-20)
      {
          var dx = size[2]*0.1;
          var percentX = ((curX - document.body.scrollLeft) - size[0]-dx) / (size[2]-dx*2);
          divPages.scrollLeft = getDX(divPages.scrollLeft, parseInt(percentX*(divPages.scrollWidth - size[2])));
      }

      percentX = Math.min(1, Math.max(0, percentX));
      divPos.style.left = parseInt((divPages.offsetWidth - divPos.offsetWidth)*percentX) + 'px';
    }


    // Runs smooth pages scrolling
    function startScrolling()
    {
      if (!timer)
        timer = setInterval("scrollPages()", 10);
    }

    function stopScrolling()
    {
      if (timer)
        clearInterval(timer);
    }
    

    function moveScrolling(ev)
    {
      curX = ev.clientX;
    }


    // Returns HTML for pages list
    function getPages(from, to)
    {
      var s = '';

	  if (to<pMaxFix) {
	      for (var i=from; i<=to; i++)
	      {
	        if (i==curPage)
	          s += '<a href="'+page+i+'" id="p'+i+'" onclick="setActivePage(this)" class="cur">'+i+'</a>&nbsp;&nbsp;';
	        else
	          s += '<a href="'+page+i+'" id="p'+i+'" onclick="setActivePage(this)" class="sel">'+i+'</a>&nbsp;&nbsp;';
	      }
	  } else {
	  	 for (var i=from; i<=pMaxFix; i++)
	      {
	        if (i==curPage)
	          s += '<a href="'+page+i+'" id="p'+i+'" onclick="setActivePage(this)" class="cur">'+i+'</a>&nbsp;&nbsp;';
	        else
	          s += '<a href="'+page+i+'" id="p'+i+'" onclick="setActivePage(this)" class="sel">'+i+'</a>&nbsp;&nbsp;';
	      }
	  }
      
      return s;
    }
    

    function setActivePage(aObj)
    {
      var a = document.getElementById('p'+curPage);
      if (a) a.className = '';
      
      aObj.className="cur";
      curPage = parseInt(aObj.innerHTML);
      setMark();
    }
    

    // Changes pages limits and writes HTML for pages list
    function setPages(delta)
    {
   
      if (pFrom+delta>0 && pTo+delta<=pMax)
      {
        pFrom += delta;
        pTo   += delta;
      }
	
      divPages.innerHTML = getPages(pFrom, pTo);
      var div = document.getElementById('divStat');
      div.innerHTML = pFrom + '..' + pTo + '&nbsp;/&nbsp;' + pMax
      div.style.width = parseInt(pTo/pMax*100) + '%';

      setMark();
    }
    

    
    