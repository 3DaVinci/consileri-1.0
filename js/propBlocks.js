function changeBlock(id) {
  	if (id==1) {
  		if ($('pblock1')!=null) $('pblock1').style.display = 'block';
  		if ($('pblock1_1')!=null) $('pblock1_1').style.display = 'none';
  		if ($('pblock1_c')!=null) $('pblock1_c').style.display = 'block';
  	} else {
  		if ($('pblock1')!=null) $('pblock1').style.display = 'none';
  		if ($('pblock1_1')!=null) $('pblock1_1').style.display = 'block';
  		if ($('pblock1_c')!=null) $('pblock1_c').style.display = 'none';  		
  	}
  
  	if (id==2) {
	  	if ($('pblock2')!=null) $('pblock2').style.display = 'block';
	  	if ($('pblock2_2')!=null) $('pblock2_2').style.display = 'none';	  	
  		if ($('pblock2_c')!=null) $('pblock2_c').style.display = 'block';	  	
  	} else {
  		if ($('pblock2')!=null) $('pblock2').style.display = 'none';
	  	if ($('pblock2_2')!=null) $('pblock2_2').style.display = 'block';	  
  		if ($('pblock2_c')!=null) $('pblock2_c').style.display = 'none';	
  	}
  	
  	if (id==3) {
  		if ($('pblock3')!=null) $('pblock3').style.display = 'block';
  		if ($('pblock3_3')!=null) $('pblock3_3').style.display = 'none';
  		if ($('pblock3_c')!=null) $('pblock3_c').style.display = 'block';  		
  	} else {
  		if ($('pblock3')!=null) $('pblock3').style.display = 'none';
  		if ($('pblock3_3')!=null) $('pblock3_3').style.display = 'block';
  		if ($('pblock3_c')!=null) $('pblock3_c').style.display = 'none';
  	}
  	
  	if (id==4) {
  		if ($('pblock4')!=null) $('pblock4').style.display = 'block';
  		if ($('pblock4_4')!=null) $('pblock4_4').style.display = 'none';  	
  		if ($('pblock4_c')!=null) $('pblock4_c').style.display = 'block';  		
  	} else {
  		if ($('pblock4')!=null) $('pblock4').style.display = 'none';
  		if ($('pblock4_4')!=null) $('pblock4_4').style.display = 'block';  	
  		if ($('pblock4_c')!=null) $('pblock4_c').style.display = 'none';  		
  	}
  }