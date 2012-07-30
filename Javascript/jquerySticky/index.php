<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Prueba de sticky</title>
<script type="text/javascript" src="jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="waypoints.js"></script>
<style>

.normal {
	position: relative;
}

.sticky {
	position: fixed;
	width: 100%;
	top: 0px;
	left: 0px;
}

</style>
</head>

<body>

<div id="header" style="height:350px;  background-color:#0F0;">header</div>
<div id="content" class="normal" style="height:150px; background-color:#F00;">content</div>
<div id="footer" style="height:950px;  background-color:#00F;">footer</div>

<script>


$('#content').waypoint(function(event, direction) {
   
	$(this).toggleClass('sticky', direction === "down");

   
});


</script>

</body>
</html>