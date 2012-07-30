<? ob_start(); require('firePHP/FirePHP.class.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Test firephp</title>
</head>

<body>

<?
$firephp = FirePHP::getInstance(true);
$var = array('i'=>10, 'j'=>20);
$firephp->log($var, 'Iterators');
?>

<? echo 'Holaaa mundo!!';?>

</body>
</html>
