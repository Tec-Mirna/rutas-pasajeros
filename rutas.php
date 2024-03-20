<?php

class Rutas {
    public $id;
    public $ruta;
    public $puntoPartida;
    public $destino;
    public $costoPasaje;

    public function __construct($id, $ruta, $puntoPartida, $destino, $costoPasaje){
      
        $this->id = $id; 
        $this->ruta = $ruta; 
        $this->puntoPartida = $puntoPartida; 
        $this->destino = $destino; 
        $this->costoPasaje = $costoPasaje; 

    }
    public function createRuta(){
        $enpoint = 'https://sheetdb.io/api/v1/y28835wu65rfz';

        $data = array(
            'id' => $this->id,
            'ruta' => $this->ruta,
            'puntoPartida' => $this->puntoPartida,
            'destino' => $this->destino,
            'costoPasaje' => $this->costoPasaje,

        );
        $ch = curl_init($enpoint);
        curl_setopt($ch, CURLOPT_URL,$enpoint);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data) );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: aplication/json'));

        $response = curl_exec($ch);
        curl_close($ch);
        echo $response;
    }

    //Get (obtener todas )
    public function get_rutas(){
        $response = file_get_contents('https://sheetdb.io/api/v1/y28835wu65rfz');
       return $response;
        
    }
}
// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger los datos del formulario
    $id = $_POST['id'];
    $ruta = $_POST['ruta'];
    $puntoPartida = $_POST['puntoPartida'];
    $destino = $_POST['destino'];
    $costoPasaje = $_POST['costoPasaje'];
    
    // Crear una instancia de la clase Rutas con los datos del formulario
    $rutaObj = new Rutas($id, $ruta, $puntoPartida, $destino, $costoPasaje);
    
    // Llamar al método createRuta() para enviar los datos a la API
    $rutaObj->createRuta();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rutas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
     
 .formulario{
    margin: 50px;
	box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
	padding: 25px;
	border-radius: 20px;
	width: 475px;
	background-color: #f4f6f6;
}
.formulario label {

  padding-top: 20px;
  margin-bottom: 20px;
}
.tabla{
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
	padding: 25px;
	border-radius: 14px;
    margin: 50px;
   
}
</style> 
</head>
<body>
<form class="formulario" method="post" action=" <?php echo $_SERVER['PHP_SELF']; ?>"> <!-- Mandar data = POST -->
<h3 style="text-align:center">Ingresa una nueva ruta</h3><br>

     <label>Id:</label>
     <input style="width: 4em; margin-right: 20px;" type="number" name="id" placeholder="Id" required>
     <label >Ruta:</label>
    <input type="text"  name="ruta" placeholder="Ingresa la ruta" required><br>
    <label >Punto de partida:</label>
    <input  style="margin-right: 75px;" type="text" name="puntoPartida" placeholder="Punto de partida" required><br>
    <label >Destino:</label>
    <input type="text" name="destino" placeholder="Ingresa el destino" required><br>
    <label >Costo del pasaje:</label>
    <input type="text" name="costoPasaje" placeholder="Ingresa el precio " required><br><br>
   
    <input class="btn btn-success" type="submit" value="Agregar">
</form>

<div class="tabla">
<h2 class="text-center">Detalle de las rutas</h2>


<table class="table container">
        <tr>
            <!-- Encabezados de la tabla -->
            <th>Id</th>
            <th>Ruta</th>
            <th>Punto de Partida</th>
            <th>Destino</th>
            <th>Pasaje</th>
        </tr>

        <?php
    
    include_once './rutas.php';

        $routes = new Rutas(null, null, null, null, null);
        $response = $routes->get_rutas();

           $data = json_decode($response, true);
           foreach($data as $row){
            echo "<tr>";
            echo "<td>".$row['id'] ."</td>";
            echo "<td>".$row['ruta'] ."</td>";
            echo "<td>".$row['puntoPartida'] ."</td>";
            echo "<td>".$row['destino'] ."</td>";
            echo "<td>".$row['costoPasaje'] ."</td>";
            echo "</tr>";
           }
        ?>
    </table>
    </div>
     <!-- Agregar el botón para dirigir a otra vista -->
     <div style="text-align:center; margin-top:20px;">
        <a href="pasajero.php" class="btn btn-info">Hacer una reservar</a>
    </div>

</body>
</html>