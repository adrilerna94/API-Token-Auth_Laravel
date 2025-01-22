# API Token Auth

## Ejercicio 01 - Parte 1
Crea una aplicación con un endpoint que haga un registro de un usuario (que cree un usuario) con los parámetros `name`, `email` y `password`. El password tiene que estar encriptado con el método `Hash::make`.

Después, crea otro endpoint que simule un login y que devuelva el token de autenticación de usuarios.

Para hacerlo, asegúrate de que tienes la tabla `users`, con al menos un usuario, y valida que el `email` y `password` de entrada son correctos. (Revisa el método `attempt` en la documentación).

---

## Ejercicio 01 - Parte 2
Crea otro endpoint que valide si hay un token en la cabecera de la petición. Si lo hay, que devuelva el texto `OK`, si no, que devuelva el texto `403 Forbidden`.

---

## Ejercicio 02 - Parte 1
Implementa la autenticación (`register` y `login`) en la aplicación anterior (**Band-Concert**). Aplica una validación para que sea obligatorio estar logueado para poder realizar cualquier acción en los controladores `Band` y `Concert`.

---

## Ejercicio 02 - Parte 2
Cambia la expiración del token para que caduque en 2 horas.
