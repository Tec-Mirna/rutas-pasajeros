<?php

class Pasajeros {
    public $id;
    public $nombre;
    public $apellido;
    public $gmail;
    public $id_ruta;
    public $num_reservaciones;
    public $fecha;
    public $desde;
    public $hasta;
    public $total;

    public function __construct($id, $nombre, $apellido, $gmail, $id_ruta, $num_reservaciones, $fecha, $desde, $hasta, $total){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->gmail = $gmail;
        $this->id_ruta = $id_ruta;
        $this->num_reservaciones = $num_reservaciones;
        $this->fecha = $fecha;
        $this->desde = $desde;
        $this->hasta = $hasta;
        $this->total = $total;
    }
    public function crearReservacion(){
        $enpoint = 'https://sheetdb.io/api/v1/y28835wu65rfz?sheet=BD-Pasajeros';

        $data = array(
            'id' => $this->id,
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'gmail'=> $this->gmail,
            'id_ruta'=> $this->id_ruta,
            'num_reservaciones'=> $this->num_reservaciones,
            'fecha'=>$this->fecha,
            'desde'=>$this->desde,
            'hasta'=>$this->hasta,
            'total'=>$this->total,
            
        );
        $ch = curl_init($enpoint);
        curl_setopt($ch, CURLOPT_URL, $enpoint);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data) );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: aplication/json'));

        $response= curl_exec($ch);
        curl_close($ch);
        echo $response;
    }


    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <form>
    <h3>Realizar reserva</h3>

    <label>Id:</label>
    <input type="number" name="id" placeholder="Id" required>

    <label >Nombre:</label>
    <input type="text" name="name" placeholder="Ingresa tu nombre" required>

    <label >Apellido:</label>
    <input type="text" name="lastname" placeholder="Ingresa tu apellido" required>

    <label>Gmail</label>
    <input type="text" name="gmail" placeholder="Ingresa tu correo" required>

    <label>Ruta</label>
    <select name="" id=""></select>

    <label>Número de reservas</label>
    <input type="number" name="num_reserva" placeholder="Ingresa el número de reservas">

    <label>Fecha</label>
    <input type="date" name="date">
   </form>
</body>
</html>