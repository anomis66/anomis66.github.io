function include(file) { 

	var script  = document.createElement('script'); 
	script.src  = file; 
	script.type = 'text/javascript'; 
	script.defer = true; 

	document.getElementsByTagName('head').item(0).appendChild(script); 

} 

/* Include Many js files */
include('https://www.simonarthur.co.uk/includes/scripts/jquery-3.5.1.min.js'); 
include('https://www.simonarthur.co.uk/includes/scripts/jquery.fancybox.min.js');
include('https://www.simonarthur.co.uk/includes/scripts/core.js');


