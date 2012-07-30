<?php

include 'currency_converter.php';


$dolar_a_euro_valor = currency_convert(1, "USD", "EUR");
$euro_a_dolar_valor = currency_convert(1, "EUR", "USD");

/*
TABLA cotizaciones

FIELD          TYPE            COLLATION          NULL    KEY     DEFAULT  Extra           PRIVILEGES                       COMMENT
-------------  --------------  -----------------  ------  ------  -------  --------------  -------------------------------  -------
id_cotizacion  INT(11)         (NULL)             NO      PRI     (NULL)   AUTO_INCREMENT  SELECT,INSERT,UPDATE,REFERENCES         
origen         VARCHAR(255)    latin1_swedish_ci  YES             (NULL)                   SELECT,INSERT,UPDATE,REFERENCES         
destino        VARBINARY(255)  (NULL)             YES             (NULL)                   SELECT,INSERT,UPDATE,REFERENCES         
valor          DOUBLE          (NULL)             YES             (NULL)                   SELECT,INSERT,UPDATE,REFERENCES         
*/

$s1 = "UPDATE cotizaciones SET valor = '".$dolar_a_euro_valor."' WHERE origen = 'USD' and destino = 'EUR';";
$s2 = "UPDATE cotizaciones SET valor = '".$euro_a_dolar_valor."' WHERE origen = 'EUR' and destino = 'USD';";

echo $s1;
echo "<br />";
echo $s2;