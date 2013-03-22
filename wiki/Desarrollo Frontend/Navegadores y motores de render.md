# Desarrollo frontend - Navegadores y motores de render

## Fuentes

* [Mejorando.la](http://www.mejorando.la)

## Navegadores importantes y sus empresas madre y motores de render

1. Chrome (Google) (Webkit + V8)
2. Firefox (Mozilla/Netscape) (Gecko + Spidermonkey)
3. Internet explorer (Microsoft) (Trident 5)
4. Safari (Apple) (Webkit + Nitro)
5. Opera (Opera) (Webkit + V8)

## Motores de renderizado

### Historia

__Mosaic:__

El mas viejo de todos y el primero que empezo a agregar cosas graficas a los documentos de internet.

__Gecko:__

Netscape Navigator incorporaba Gecko.  
Luego Netscape regaló el codigo a Mozilla que crea Firefox.  
Firefox venia instalado por defecto en los sistemas Linux y algunos desarrolladores no contestos con su funcionamiento deciden hacer su propio motor.  
Lo llamaron Khtml porque es del grupo KDE de Linux.

__Trident:__

Es el motor de renderizado de Microsoft. Comienza a desarrollarse como un intento de competir contra Netscape.  
IE 6 7 8 utilizan Trident 4.0. Este motor fue el que mas problemas trajo porque estuvo mucho tiempo en funcionamiento.  
Por eso IE fue malo porque parchearon los motores de renderizado durante casi 10 años.  
Triden 5.0 es el motor de IE9: Cambio completamente el motor de render agregando html5 y todas las nuevas funcionalidades de la web.  

__Webkit:__

Es el motor de render del explorador de Apple Safari.  
Empieza a desarrollarse en 1998 en base a un motor khtml creado por la gente de KDE de Linux para su navegador Conqueror.  
Era el primer motor de render del siglo XXI.  
Apple lo crea para poder sacarse de encima a Internet Explorer en sus productos.  

__Google entra a la batalla de los navegadores:__  
Crea el parche mas grande de la historia para Webkit y crea Chrome.  
Chrome es mas rápido porque no solo mejoró el motor de renderizado sino tabien el motor de Javascript.  


__Presto:__

Es el motor de render de Opera pero ahora decidieron usar webkit y V8
Tenian su propio motor de Javascript también pero es muy lento.


### Interpretadores de javascript (Un tema aparte):

Javascript fue impulsado gracias a que Microsoft creó ajax con el objeto xmlhttprequest.
Empezaron a surgir muchas aplicaciones con Js y surgió la necesidad de mejorar su velocidad.

Los motores interpretadores de Javascript de última generación nacieron gracias a que Macromedia liberó a la comunidad una parte de su código de interpretación de action script.

De esto nacieron:
Nitro es el motor de js de alta velocidad de Safari.
Firefox utiliza __Spidermonkey__ como motor de javascript.  
Chrome utiliza __V8__ y permite node.js  

