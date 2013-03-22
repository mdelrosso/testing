# Notas sobre Api-Rest

## Fuentes

*[FOSRestBundle](https://github.com/FriendsOfSymfony/FOSRestBundle/blob/master/Resources/doc/2-the-view-layer.md)

Peticiones HTTP:
id para el ejemplo = 11

GET     Select  /users/  ó /users/11
POST    Insert  /users/
PUT     Update  /users/11
DELETE  Delete  /users/11

Codigo de respuesta HTTP: Usar los códigos de respuesta de estados http para comunicar lo que sucedio en la respuesta. Generalmente solo usamos el 200, 404 y 500 pero para REST conviene usar todos.

Content-Type: El accept para negociar el formato de respuesta

Accept: El content-type para indicar el formato de respuesta

Etag: Para controlar si se ha modificado el recurso. Se hace mediante el hash.

If-None-Match: Se encarga de indicar que la petición sea efectiva solo si se etag del recurso sea distinto 
If-Match: Es lo contrario

Last-Modified/If-Modified-Single: Sirve para saber si un recurso se ha modificado a partir de una fecha.







