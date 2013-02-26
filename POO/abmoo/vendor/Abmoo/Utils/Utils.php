<?php


namespace Abmoo\Utils;

class Utils {
	
    static function printPre($v)
    {
        echo '<pre style="background-color:#FFFF00; border: 1px solid #000000;">' . htmlspecialchars(print_r($v, true)) . '</pre>';
    }

    static function dump($array=array(), $titulo='', $color='FFFF00', $location='')
    {
        // Defaults
        if (!isset($color)) $color = 'FFFF00';

        echo "<div style=\"font-size:12px; font-weight:normal; margin:10px; padding:10px; border:1px solid black; background:#".$color."; color:black;  \">";
        if ($titulo) {
            echo "<h3>{$titulo}</h3>";
        }
        if ($location) {
            echo "<h5>{$location}</h5>";
        }
        echo "<pre>";
            print_r($array);
        echo "</pre>";
        echo "</div>";
    }
    
    static function isoSqlDate($date=""){
        
        $aDate = explode("-", $date);
        
        if(count($aDate) != 3)
            return null;
        
        $isoSqlDate = sprintf("%04d-%02d-%02d", $aDate[0], $aDate[1], $aDate[2]);        
        
        //tdump($isoSqlDate);
        
        return $isoSqlDate;
    }

   /**
     * Sempty is the shortening of "String Empty"
     * 
     * Same as empty() except for:
     * if $x = false 
     * or $x = 0
     * or $x = "0" 
     * or $x = '0'
     * then sempty($x); returns false
     * 
     * @param $variable
     * Some variable
     * @return true or false
        // Unit Testing (Armar testeo unitario)
        $br = '<br/>';
        class simpleObject
        {}
        $test_array = array(
            'solo comillas ""' => "" 
            , 'null' => null 
            , 'array sin elementos' => array() 
            , 'booleano false' => false 
            , 'booleano true' => true 
            , 'entero 0' => 0 
            , 'string "0"' => "0" 
            , 'string "false"' => "false" 
            , 'Objeto' => new simpleObject()
            , 'float 0.0' => 0.0 
        );
        foreach ($test_array as $k => $v) {
            if (sempty($v)) {
                echo $k . ' es vacio ' . $br;
            } else {
                echo $k . ' no es vacio ' . $br;
            }
        }
    */
    static function sempty($variable)
    {
        $result = empty($variable);
        if ($result) {
            /* 
             * If its empty and its boolean then, it value must be false.
             * For sempty, false its not an empty value 
             */
            if (is_bool($variable) === true) {
                $result = false;
            } elseif (is_string($variable) === true) {
                if ($variable === '0') {
                    $result = false;
                }
            } elseif (is_int($variable) === true || is_float($variable) === true) {
                $result = false;
            }
        }
        return $result;
    }
    
    /*
     * arrayValueRemove removes the array position by a value
     *
     * @param array() $array
     * @param string $value
     *
     * @return array()
    */
    static function arrayValueRemove($array, $value)
    {
            $array = array_flip($array);
            unset($array[$value]);
            $array = array_flip($array);
            return array_values($array);
    }

    /*
     * arrayValueRemove removes the array position by a key
     *
     * @param array() $array
     * @param string $key  
     * @param boolean $reIndex = false 
     *
     * @return array()
     */
    static function arrayKeyRemove($array, $key, $reIndex = false)
    {
            unset($array[$key]);
            if ($reIndex)
                    array_values($array);
            return $array;
    }

    /**
     * arrayToQueryString
     *
     * Transforms an array into a GET querystring
     * Ex:
     *     array('adultos'=>2,'ninios'=>1)
     *
     */
    static function arrayToQueryString($params, $options = array())
    {
        $isFirst = true;
        $string = '';
        $defaultOptions = array(
            'checkFirst' => true
        );

        $options = array_merge($options, $defaultOptions);

        foreach($params as $key => $value) {
            if ($isFirst && $options['checkFirst']) {
                $string .= '?';
                $isFirst = false;
            } else {
                $string .= '&';
            }
            $string .= $key.'='.$value;
        }
        return $string;
     }

   /**
    * TODO.TPVB ¿Qué hace esta función? Explicarlo aqui
    */
    static function normalizeIndexArray($a)
    {
         $b = array();         
         foreach($a as $k => $v){             
             $b[lcfirst($k)] = $v;                      
             if(is_array($v) or is_object($v)){                
                $b[lcfirst($k)] = tpvbUtils::normalizeIndexArray($v);
             }
         }         
         return $b;
     }    

     static function standard_array_compare($op1, $op2)
    {

        if (count($op1) < count($op2)) {
            return -1; // $op1 < $op2
        } elseif (count($op1) > count($op2)) {
            return 1; // $op1 > $op2
        }
        foreach ($op1 as $key => $val) {
            if (!array_key_exists($key, $op2)) {
                return null; // uncomparable
            } elseif ($val < $op2[$key]) {
                return -1;
            } elseif ($val > $op2[$key]) {
                return 1;
            }
        }
        return 0; // $op1 == $op2
     }
     
     
     
     /**
    * Toma los ultimos 4 digitos de la tarjeta y le agrega unos
    * aleatorios para simular que es una tarjeta real
    */
   public static function fake_numero_tarjeta($numeroTarjeta) {

       $iLen = strlen($numeroTarjeta);

       $s = substr($numeroTarjeta, 0, $iLen-4);

       for ($i = $iLen-4; $i < $iLen; $i++) {
           $s .=rand(0,9);
       }

       return $s;
   }

    // Extrae los ultimos 4 digitos del numero de tarjeta
   public static function extract_last_digits_numero_tarjeta($numeroTarjeta) {

        $iLen = strlen($numeroTarjeta);

        return substr($numeroTarjeta, $iLen-4, $iLen);
   }

}
