<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="text/javascript" src="../jquery/jquery-1.7.1.min.js"></script>

<link rel="stylesheet" href="js/fancyBox/jquery.fancybox.css?v=2.0.5" type="text/css" media="screen" />
<script type="text/javascript" src="js/fancyBox/jquery.fancybox.pack.js?v=2.0.5"></script>

<script>

$(document).ready(function() {
	$("#confirmPopup").fancybox({
		maxWidth	: 800,
		maxHeight	: 600,
		fitToView	: false,
		width		: '70%',
		height		: '70%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
	});
	
	
	$('#confirmationPopupContent #cancelButton').live("click", function(){                                         
    	$.fancybox.close();
    });
	
});

</script>
<title>Jquery FancyBox Testing</title>
</head>

<body>

<h1>Jquery Fancy Box Test</h1>


<a id="confirmPopup" href="#confirmationPopupContent">Confirmacion</a>

<div id="confirmationPopupContent" style="display:none;">

    <div>Importante:</div>
    <div>Faltan habitaciones</div>
    <div><a id="acceptButton" href="#">Continuar</a>&nbsp;<a id="cancelButton" href="#">Cancelar</a></div>

</div>

</body>
</html>