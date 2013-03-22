# Encriptación de datos usando algoritmos de encriptación

## Extensión php_mcrypt para PHP

En PHP se utiliza una extensión llamada php_mcrypt que se instala como una extensión de PHP y se habilita desde el php.ini  
En realidad es una interfaz para la biblioteca mcrypt, que soporta una gran variedad de algoritmos de bloques tales como DES, TRipleDES, Blowfish (por defecto), 3-WAY, SAFER-SK64, SAFER-SK128,TWOFISH, TEA, RC2 y GOST en modo de cifrado CBC, OFB, CFB y ECB.   
Además, soporta RC6 e IDEA que son considerados "no libres". CFB/OFB son de 8 bits por defecto.  


Clave simétrica: La criptografía simétrica (en inglés symmetric key cryptography), también llamada criptografía de clave secreta (en inglés secret key cryptography) o criptografía de una clave1 (en inglés single-key cryptography), es un método criptográfico en el cual se usa una misma clave para cifrar y descifrar mensajes  

Cifrado por bloques: http://es.wikipedia.org/wiki/Cifrado_por_bloques  

### Cifradores soportados por mcrypt

Aqui hay una lista de los cifradores que actualmente son soportados por la extensión mcrypt.  
Para una lista completa de los cifradores soportados, vea los defines al final de mcrypt.h.  
La regla general con la API de mcrypt-2.2.x es que se puede acceder al cifrador desde PHP con MCRYPT_ciphername.  
Con la API de libmcrypt-2.4.x y libmcrypt-2.5.x estas constantes también trabajan, pero es posible especificar el nombre del cifrador como una string al invocar a mcrypt_module_open().  

    MCRYPT_3DES
    MCRYPT_ARCFOUR_IV (solo libmcrypt > 2.4.x)
    MCRYPT_ARCFOUR (solo libmcrypt > 2.4.x)
    MCRYPT_BLOWFISH
    MCRYPT_CAST_128
    MCRYPT_CAST_256
    MCRYPT_CRYPT
    MCRYPT_DES
    MCRYPT_DES_COMPAT (solo libmcrypt 2.2.x)
    MCRYPT_ENIGMA (solo libmcrypt > 2.4.x, alias de MCRYPT_CRYPT)
    MCRYPT_GOST
    MCRYPT_IDEA (no libre)
    MCRYPT_LOKI97 (solo libmcrypt > 2.4.x)
    MCRYPT_MARS (solo libmcrypt > 2.4.x, no libre)
    MCRYPT_PANAMA (libmcrypt > 2.4.x only)
    MCRYPT_RIJNDAEL_128 (solo libmcrypt > 2.4.x)
    MCRYPT_RIJNDAEL_192 (solo libmcrypt > 2.4.x)
    MCRYPT_RIJNDAEL_256 (solo libmcrypt > 2.4.x)
    MCRYPT_RC2
    MCRYPT_RC4 (solo libmcrypt 2.2.x)
    MCRYPT_RC6 (solo libmcrypt > 2.4.x)
    MCRYPT_RC6_128 (solo libmcrypt 2.2.x)
    MCRYPT_RC6_192 (solo libmcrypt 2.2.x)
    MCRYPT_RC6_256 (solo libmcrypt 2.2.x)
    MCRYPT_SAFER64
    MCRYPT_SAFER128
    MCRYPT_SAFERPLUS (solo libmcrypt > 2.4.x)
    MCRYPT_SERPENT (solo libmcrypt > 2.4.x)
    MCRYPT_SERPENT_128 (solo libmcrypt 2.2.x)
    MCRYPT_SERPENT_192 (solo libmcrypt 2.2.x)
    MCRYPT_SERPENT_256 (solo libmcrypt 2.2.x)
    MCRYPT_SKIPJACK (solo libmcrypt > 2.4.x)
    MCRYPT_TEAN (solo libmcrypt 2.2.x)
    MCRYPT_THREEWAY
    MCRYPT_TRIPLEDES (solo libmcrypt > 2.4.x)
    MCRYPT_TWOFISH (para versiones de mcrypt inferiores a la 2.x, o mcrypt > 2.4.x )
    MCRYPT_TWOFISH128 (TWOFISHxxx están disponibles en las más recientes versiones 2.x, pero no en las versiones 2.4.x)
    MCRYPT_TWOFISH192
    MCRYPT_TWOFISH256
    MCRYPT_WAKE (solo libmcrypt > 2.4.x)
    MCRYPT_XTEA (solo libmcrypt > 2.4.x)

Se debe (en modo CFB y OFB) o se puede (en modo CBC) suministrar un vector de inicialización (IV) a la función de cifrado correspondiente.  
El IV debe ser único y debe ser el mismo cuando cifra/descifra. Con información que es almacenada encriptada, se puede tomar la salida de una función del índice con el que la información es almacenada (por ej., la clave MD5 de un nombre de archivo).  
Alternativamente, se puede transmitir el IV junto con los datos encriptados (ver el capítulo 9.3 de Applied Cryptography by Schneier (ISBN 0-471-11709-9) para una discusión sobre este tema). 

### Modos de cifrado
	
Los algoritmos de cifrado de bloque como DES o AES separan el mensaje en pedazos de tamaño fijo, por ejemplo de 64 o 128 bits.  
La forma en que se gestionan estos pedazos o bloques de mensaje, se denomina "modo de cifrado".  
Existen muchos modos de cifrado diferentes, a continuación hablaremos de los más importantes.  

Fuente: [Blog de seguridad](http://dlerch.blogspot.com.ar/2007/07/modos-de-cifrado-ecb-cbc-ctr-ofb-y-cfb.html)

Mcrypt puede operar en cuatro modos de cifrado de bloques (CBC, OFB, CFB, y ECB). Si está enlazado con libmcrypt-2.4.x o superiores las funciones también pueden operar en el modo de cifrado por bloques nOFB y en modo STREAM.  
Abajo se listan modo de cifrado soportados junto con las constantes que están definidas para el modo de cifrado.  
Para una referencia más completa y discusión, véase Applied Cryptography by Schneier (ISBN 0-471-11709-9).  

    MCRYPT_MODE_ECB (electronic codebook) es útil para datos aleatorios, tal como para encriptar otras claves. Dado que los datos son cortos y aleatorios, las desventajas de ECB tienen un efecto negativo favorable.  
    MCRYPT_MODE_CBC (cipher block chaining) es especialmente útil para cifrar archivos donde la seguridad se incrementa significativamente sobre la de ECB.  
    MCRYPT_MODE_CFB (cipher feedback) es el mejor modo de cifrado para secuencias de bytes donde cada byte debe ser encriptado.  
    MCRYPT_MODE_OFB (output feedback, en 8 bits) es comparable a CFB, pero puede ser utilizado en aplicaciones donde la propagación de errores no puede ser tolerada. No es segura (debido a que opera en modo 8 bits) por lo que no es recomendado su uso.  
    MCRYPT_MODE_NOFB (output feedback, in nbit) is comparable to OFB, but more secure because it operates on the block size of the algorithm.  
    MCRYPT_MODE_STREAM es un modo extra para incluir algunos algoritmos de flujo tales como "WAKE" o "RC4".  
	
[Funciones de Mcrypt](http://www.php.net/manual/es/ref.mcrypt.php)  
[Tutorial MCrypt interesante con fuente](http://www.itnewb.com/tutorial/PHP-Encryption-Decryption-Using-the-MCrypt-Library-libmcrypt)

## Preguntas frecuentes
    
### ¿Que cifrador utilizar?

AES Rijndael-256

[http://www.sitepoint.com/forums/showthread.php?637486-Your-favorite-mcrypt-cipher-to-use-in-PHP](http://www.sitepoint.com/forums/showthread.php?637486-Your-favorite-mcrypt-cipher-to-use-in-PHP)  
[http://stackoverflow.com/questions/5204039/what-is-if-any-prefered-mcrypt-cipher-for-encrypting-decrypting-php-objects-or](http://stackoverflow.com/questions/5204039/what-is-if-any-prefered-mcrypt-cipher-for-encrypting-decrypting-php-objects-or)  

### ¿Que modo de encriptación utilizar?

[http://stackoverflow.com/questions/5108408/php-mcrypt-which-mode](http://stackoverflow.com/questions/5108408/php-mcrypt-which-mode)  
[http://stackoverflow.com/questions/1220751/how-to-choose-an-aes-encryption-mode-cbc-ecb-ctr-ocb-cfb](http://stackoverflow.com/questions/1220751/how-to-choose-an-aes-encryption-mode-cbc-ecb-ctr-ocb-cfb)  
	
### ¿Porque usan base64 encode/decode al resultado cifrado?

Porque sino manda caracteres extremadamente raros que no tienen representacion.

"...El problema con el texto encriptado es que tiene muchos caracteres raros, inclusive podría ser que tenga caracteres que, al no tener una representación visual, no se estén mostrando. 
También podría ser que tenga espacios en blanco al inicio o al final. Debido a todas estas razones, no es posible almacenar este valor de forma correcta en una base de datos o inclusive pasarlo por un web service sin que exista la posibilidad de que se pierda un pedazo de esta cadena.
Es por esta razón que recomiendo convertir la cadena encriptada en base 64 para que solo esté compuesta por caracteres con representación visual. 
Para convertir a base 64 usaremos base64_encode y base64_decode..."