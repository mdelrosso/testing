# Linux - Aspectos básicos

## Prompt

    usuario@nombre-sistem: <carpeta actual> <simbolo permisos>
    
Si el usuario es root el simbolo de permisos sera # sino $  
Si la carpeta actual muestra un tilde (~) es porque se esta parado sobre el home del usuario logueado.

## Comandos (estructura general)

    Comando [Opciones] [argumentos] [opciones]

Las opciones pueden ubicarse delante o detras o ambas.
Si se especifican muchas opciones se pueden agrupar sin poner -. 

### Ejemplo: Con contador de palabras

    wc -lw /etc/httpd/access.log -c
    
-l: lineas  
-w: palabras  
-c: caracteres  


## Comandos básicos y mas utilizados



## Directorios

### Los mas usados

/home Es un directorio donde tenemos los directorios personales de los usuarios. 
	/home/(usuario) Es nuestro directorio personal. Aquí es donde guardaremos nuestros documentos, música, películas, fotos y los archivos de configuración personalizados de los programas que usamos.También podemos referirnos a este directorio por su abreviatura '~'
	~/Desktop Aquí tenemos nuestro escritorio. 

/usr Este directorio contiene los archivos de los programas no esenciales. Es el directorio más grande del sistema. 
	/usr/X11R6  Aquí tenemos los programas de X-Window, el servidor gráfico.
	/usr/bin  Aquí tenemos programas de uso general para los usuarios.
	/usr/doc  Aquí tenemos documentación de los programas.
	/usr/etc  Aquí tenemos archivos de configuración de uso global.
	/usr/include  Aquí tenemos las cabeceras de C y C++. Son archivos con extensión .h. Los programadores comprenderán su significado.
	/usr/lib  Aquí tenemos las bibliotecas de nuestros programas.
	/usr/man  En este directorio encontramos los manuales (man).
	/usr/sbin  Este directorio contiene los ejecutables de los demonios correspondientes a los programas de usuario.
	/usr/src  Aquí se almacenan los códigos fuentes de nuestros programas. 

/var  Este directorio contiene información variable, como registros, datos de los servidores, etc.

/etc Aquí encontramos los archivos de configuración generales del sistema y los programas.

### Los del sistema

/bin Aquí tenemos los programas básicos que pueden lanzar todos los usuarios del sistema.
/sbin Aquí se encuentran los ejecutables de los demonios (servicios) instalados en el sistema. 
/boot Aquí tenemos los archivos de configuración del arranque del sistema (como por ejemplo GRUB) el Kernel y un disco RAM para el arranque (initrd). 
/lib Contiene las bibliotecas necesarias para que se ejecuten los programas que tenemos en /bin y /sbin. Si usas un sistema de 64bits tendrás un enlace lib64 que apunte a /lib. 
/sys Contiene información sobre el sistema y el kernel. Es un sistema de archivos virtual, en realidad en el disco duro ese directorio está vacío. 
/tmp Este directorio contiene información temporal de los programas. No se conserva su contenido, suele borrarse al arrancar el sistema. 
/root Es el directorio personal del usuario root.

### Los demas

/media Aquí encontramos todas las unidades físicas que tenemos montadas. Discos duros, unidades de dvd, pendrive, ... 
/mnt Este ha sido el lugar tradicional para montar unidades, ha perdido gran parte de su función en favor de /media pero sigue siendo útil para el montaje puntual de algunas cosas.

