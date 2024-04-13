# Título: Rutas y reservaciones

## Overview: Problema a resolver
Descripción
El presente sistema permite registrar rutas de transporte público, detallando el nombre de la ruta, el destino, punto de partida y el costo del pasaje(Éste es un valor fijo por cada ruta).

Otra funcionalidad es hacer reservaciones, en donde se solicitan los siguientes datos al cliente: 
* Nombre
* Apellido
* Dirección de correo electrónico
* Ruta a reservar (Es un selector, lo que significa que solo aparecen las rutas que se hayan regstrado antes)
* Costo de pasaje (Valor automático dependiendo la ruta seleccionada)
* Cantidad de asientos a reservar
* Fecha en la que va a viajar
* Punto de partida
* Destino
* Total a pagar (Este valor se genera automáticamente  a partir de la multiplicación del costo de pasaje de la ruta que reserva por el número de asientos seleccionados)

 Cuando ya hemos hecho clic en el boton para aceptar (confirmar la reservación) se envía un email automático a la dirección registrada, indicando el total a pagar por la reservación hecha.
## Limitaciones
* No se puede realizar el pago desde la app
* No se puede restringir reservaciones
  
