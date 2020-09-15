    //------------------------------------------------------------------------------
    // Scroll Pages Control
    // 2007 (c) by theOnlyBoy
    // http://theonlyboy.habrahabr.ru
    //------------------------------------------------------------------------------

    var divPages2,
        divPos2,
        iters = 7,
        curX  = 0;
        
     
        
    function initPages2()
    {
      initPages();
      divPages2 = document.getElementById('divPages2');
      divPos2   = document.getElementById('divPos2');
      divPos2.style.width = parseInt(250*divPages2.clientWidth/divPages2.scrollWidth) + 'px';
     
      var nowpage = 25 * Math.floor(curPage/25);
      if (curPage % 25 == 0) {nowpage = nowpage - 25;}             
      setPagesStart();
    }

    onload = initPages2;
    
    
    // Sets red marker at a proper position
    function setMark2()
    {
      if (curPage>=pFrom && curPage<=pTo)
      {
        document.getElementById('tdMark2').style.backgroundImage    = 'url(mark.gif)';
        document.getElementById('tdMark2').style.backgroundPosition = parseInt((curPage-pFrom)/(pTo-pFrom)*100) + "% 0%";
      }
      else
      {
        document.getElementById('tdMark2').style.backgroundImage = 'url(blank.gif)';
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
    function scrollPages2()
    {
      var size = getObjectSize(divPages2);

      if (divPages2.scrollWidth > divPages2.offsetWidth-20)
      {
          var dx = size[2]*0.1;
          var percentX = ((curX - document.body.scrollLeft) - size[0]-dx) / (size[2]-dx*2);
          divPages2.scrollLeft = getDX(divPages2.scrollLeft, parseInt(percentX*(divPages2.scrollWidth - size[2])));
      }

      percentX = Math.min(1, Math.max(0, percentX));
      divPos2.style.left = parseInt((divPages2.offsetWidth - divPos2.offsetWidth)*percentX) + 'px';
    }


    // Runs smooth pages scrolling
    function startScrolling2()
    {
      if (!timer2)
        timer2 = setInterval("scrollPages2()", 10);
    }

    function stopScrolling2()
    {
      if (timer2)
        clearInterval(timer2);
    }
    

    function moveScrolling2(ev)
    {
      curX = ev.clientX;
    }


    // Returns HTML for pages list
    function getPages2(from, to)
    {
      var s = '';
      
      if (to<pMaxFix) {
	      for (var i=from; i<=to; i++)
	      {
	        if (i==curPage)
	          s += '<a href="'+page+i+'" id="p'+i+'" onclick="setActivePage2(this)" class="cur">'+i+'</a>&nbsp;&nbsp;';
	        else
	          s += '<a href="'+page+i+'" id="p'+i+'" onclick="setActivePage2(this)" class="sel">'+i+'</a>&nbsp;&nbsp;';
	      }
      } else {
 	      for (var i=from; i<=pMaxFix; i++)
	      {
	        if (i==curPage)
	          s += '<a href="'+page+i+'" id="p'+i+'" onclick="setActivePage2(this)" class="cur">'+i+'</a>&nbsp;&nbsp;';
	        else
	          s += '<a href="'+page+i+'" id="p'+i+'" onclick="setActivePage2(this)" class="sel">'+i+'</a>&nbsp;&nbsp;';
	      }
      }
      
      return s;
    }
    

    function setActivePage2(aObj)
    {
      var a = document.getElementById('p'+curPage);
      if (a) a.className = '';
      
      aObj.className="cur";
      curPage = parseInt(aObj.innerHTML);
      setMark2();
    }
    
    // Changes pages limits and writes HTML for pages list
    function setPages2(delta)
    {
      if (pFrom+delta>0 && pTo+delta<=pMax)
      {
        pFrom += delta;
        pTo   += delta;
      }

      divPages2.innerHTML = getPages2(pFrom, pTo);
      var div = document.getElementById('divStat2');
      div.innerHTML = pFrom + '..' + pTo + '&nbsp;/&nbsp;' + pMax
      div.style.width = parseInt(pTo/pMax*100) + '%';

      setMark2();
    }
    
    function setPagesStart()
    {
      divPages2.innerHTML = getPages2(pFrom, pTo);
      var div = document.getElementById('divStat2');
      div.innerHTML = pFrom + '..' + pTo + '&nbsp;/&nbsp;' + pMax
      div.style.width = parseInt(pTo/pMax*100) + '%';
      setMark2();
    }
        