function menus(time,menuid){
	if(menuid=="menu"){
		$('#menu').toggle(time);
		$('#history').hide(time);
		$('#mymenu').hide(time);
	}
	else if(menuid=="history"){
		$('#history').toggle(time);
		$('#menu').hide(time);
		$('#mymenu').hide(time);
	}
	else if(menuid=="mymenu"){
		$('#mymenu').toggle(time);
		$('#history').hide(time);
		$('#menu').hide(time);
	}
	else{
		$('#menu').hide(time);
		$('#history').hide(time);
		$('#mymenu').hide(time);
	}
}