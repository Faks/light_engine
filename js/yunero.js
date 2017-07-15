	//var youTubeURL = "http://www.youtube.com/playlist?list=PLZnxqowr6IKidF63-ybswuiO074g366-Y";
	//var youTubeURL = "http://www.youtube.com/user/Apple?feature=xxxx";
	//var youTubeURL = "http://www.youtube.com/user/xxxxx";
	var youTubeURL = "http://www.youtube.com/user/hakerx1";
	
	//optional---------------------------------------
	var yuneroWidgetHeight = 400; 
	var yuneroWidgetWidth = 310; 
	var yuneroVideoHeight = 200;
	
	function goClicked() {
		$('#yunero').empty().append(' loading ...');
		youTubeURL=$('#youTubeUrl').val();
		
		loadYunero();
	}