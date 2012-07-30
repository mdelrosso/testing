<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Prueba de scope</title>
</head>

<body>

<?
class Foo {
  
  public static function interno() {
  	echo 'Holaaa';
  }
  
  public static function static_fun()
  {
  	self::interno();
    return "This is a class method!\n";
  }
 
  public function not_static_fun()
  {
  	self::interno();
    return "This is an instance method!\n";
  }
}

echo '<pre>';
echo "From Foo:\n";
echo Foo::static_fun();
echo Foo::not_static_fun();
echo "\n";

echo "From \$foo = new Foo():\n";
$foo = new Foo();
echo $foo->static_fun();
echo $foo->not_static_fun();
echo '</pre>';

/*
You'll see the following output:

From Foo:
This is a class method!
This is an instance method!

From $foo = new Foo():
This is a class method!
This is an instance method!
*/
?>

</body>
</html>
