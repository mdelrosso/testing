<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Prueba Smarty</title>
</head>

<body>
<?
echo "Prueba Smarty";
require('Smarty/libs/Smarty.class.php');
$smarty = new Smarty;

$smarty->template_dir 	= 'Smarty/templates/';
$smarty->compile_dir 	= 'Smarty/templates_c/';
$smarty->config_dir 	= 'Smarty/configs/';
$smarty->cache_dir 		= 'Smarty/cache/';


$smarty->assign('name','Mariano');
$choices[0] = 'Mariano';
$choices[1] = 'Jose';
$smarty->assign('choices',$choices);
$smarty->display('index.tpl');
//comentario
?>

</body>
</html>
