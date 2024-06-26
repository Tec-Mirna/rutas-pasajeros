<?php
 include_once './rutas.php';


class Pasajeros {
    public $id;
    public $nombre;
    public $apellido;
    public $gmail;
     public $ruta; 
     public $costoPasaje;
    public $num_reservaciones;
    public $fecha;
    public $desde;
    public $hasta;
    public $total;

    public function __construct($id, $nombre, $apellido, $gmail,  $ruta, $costoPasaje, $num_reservaciones, $fecha, $desde, $hasta, $total){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->gmail = $gmail;
       $this->ruta = $ruta; 
       $this->costoPasaje = $costoPasaje;
        $this->num_reservaciones = $num_reservaciones;
        $this->fecha = $fecha;
        $this->desde = $desde;
        $this->hasta = $hasta;
        $this->total = $total;
    }
    public function crearReservacion(){
        //URL más '?' seguido de la palabra 'sheet=' y el nombre de la hoja
        $enpoint = 'https://sheetdb.io/api/v1/m1ndozccoo56f?sheet=BD-Pasajeros';

        $data = array(
            'id' => $this->id,
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'gmail'=> $this->gmail,
            'ruta'=> $this->ruta,
            'costoPasaje'=> $this->costoPasaje,
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


    
    //GET
    public function get_pasajeros(){
        $response = file_get_contents('https://sheetdb.io/api/v1/m1ndozccoo56f?sheet=BD-Pasajeros');
        return $response;
    }
    
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    //['aquí] debe estar escrito tal cual en el atributo name de los inputs del form
    $id = $_POST['id'];
    $nombre = $_POST['name'];
    $apellido =$_POST['lastname'];
    $gmail = $_POST['gmail'];
    $ruta = $_POST['ruta'];
    $costoPasaje = $_POST['costoPasaje'];
    $num_reservaciones = $_POST['num_reserva'];
    $fecha = $_POST['date'];
    $desde = $_POST['desde'];
    $hasta = $_POST['hasta'];
    $total = $_POST['total'];

    // Crear una instancia de la clase Rutas con los datos del formulario
    $pasajero = new Pasajeros($id, $nombre, $apellido, $gmail, $ruta, $costoPasaje, $num_reservaciones, $fecha, $desde, $hasta, $total);
    
    $pasajero->crearReservacion();

} include_once './email.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <style>
        .formulario{
         margin: 50px;
	     box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
	     padding: 25px;
	     border-radius: 20px;
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
    .center {
       text-align: center;
    }

    </style>
</head>
<body>
   <form method="post"
   action=" <?php echo $_SERVER['PHP_SELF']; ?>"
   class="formulario"
   >
    <h3 style="text-align:center">Realizar una reserva</h3>

    <label>Id:</label>
    <input type="number" name="id" placeholder="Id" required>

    <label >Nombre:</label>
    <input type="text" name="name" placeholder="Ingresa tu nombre" required>

    <label >Apellido:</label>
    <input type="text" name="lastname" placeholder="Ingresa tu apellido" required>

    <label>Gmail:</label>
    <input type="text" name="gmail" placeholder="Ingresa tu correo" required>

    <label>Ruta</label>
    <select name="ruta" id="ruta" onchange="actualizarCostoPasaje()">
    <?php
    include_once './rutas.php';
    $rutas = new Rutas(null, null, null, null, null);
    $response = $rutas->get_rutas();
    $data = json_decode($response, true);
    foreach($data as $row){
        $costo_pasaje = str_replace('$', '', $row['costoPasaje']); // Elimina el $
        echo "<option value='".$row['ruta']."' data-costo='".$costo_pasaje."'>".$row['ruta']."</option>";
    }
    
    ?>
</select><br>

     <label>Costo del pasaje</label>
     <input placeholder="Seleccione una ruta" name="costoPasaje" type="text" id="costoPasaje" readonly >
    
    <label>Desde</label>
<select name="desde">
    <?php
        include_once './rutas.php'; //  el nombre del archivo a incluir

        $rutas = new Rutas(null, null, null, null, null);
        $response = $rutas->get_rutas();

        $data = json_decode($response, true);
        foreach($data as $row){
            echo "<option value='".$row['desde']."'>".$row['desde']."</option>";
        }
    ?>
</select>
<label>Hasta:</label>
<select name="hasta">
    <?php
        include_once './rutas.php'; // el nombre del archivo a incluir

        $rutas = new Rutas(null, null, null, null, null);
        $response = $rutas->get_rutas();

        $data = json_decode($response, true);
        foreach($data as $row){
            echo "<option value='".$row['hasta']."'>".$row['hasta']."</option>";
        }
    ?>
</select>
    <label>Número de reservas:</label>
    <input type="number" name="num_reserva" id="numReserva" placeholder="Número de reservaciones" onchange="actualizarTotal()">


    <label>Fecha:</label>
    <input type="date" name="date">

    <label>Total:</label>
    <input type="text" name="total"  id="total"  placeholder="Añada cantidad reservas" readonly>
    <input type="hidden" name="totalHidden" id="totalHidden" value="">
    
    <input type="submit" value="Aceptar" class="btn btn-success">

   
   </form>
   
   
<!-- Tabla para mostrar las reservaciones realizadas -->
   <div class="tabla">
    <h2 class="text-center">Lista de reservaciones</h2>

    <table class="table container">
        <tr>
            <th>Id</th>
            <th>Fecha</th>
            <th>Ruta</th>
            <th>Costo</th>
            <th>Desde</th>
            <th>Hasta</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Gmail</th>
            <th>N° reservas</th>
            <th>Total</th>
        </tr>

        <?php
           include_once './pasajero.php';

           $pasajeros = new Pasajeros(null, null, null, null, null, null, null, null, null, null, null);
           $response = $pasajeros->get_pasajeros();

           $data = json_decode($response, true);
           foreach($data as $row){
            echo "<tr>";
            /* ['nombre_col']  DEBE ESTAR TAL CUAL EN LA HOJA DE CALCULO */
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['fecha']."</td>";
            echo "<td>".$row['ruta']."</td>";
            echo "<td>".$row['costoPasaje']."</td>";
            echo "<td>".$row['desde']."</td>";
            echo "<td>".$row['hasta']."</td>";
            echo "<td>".$row['nombre']."</td>";
            echo "<td>".$row["apellido"]."</td>";
            echo "<td>".$row['gmail']."</td>";
            echo "<td class='center'>".$row['num_reservaciones']."</td>";
            echo "<td>".$row['total']."</td>";
           }
        ?>
    </table>
   </div>



   <!--JavaScript para mostrarel costo del pasaje según la ruta seleccionada-->
  <script>
    function actualizarCostoPasaje() {
        var select = document.getElementById('ruta');
        var selectedOption = select.options[select.selectedIndex];
        var costoPasaje = selectedOption.getAttribute('data-costo');// Obtener el costo del pasaje
        document.getElementById('costoPasaje').value = costoPasaje;
        actualizarTotal();
    }
 
    /*     multiplicar el costo del pasaje por el número de reservas */
    function actualizarTotal() {
        var costoPasaje = parseFloat(document.getElementById('costoPasaje').value);
        var numReserva = parseInt(document.getElementById('numReserva').value);
        var total = costoPasaje * numReserva;
        document.getElementById('total').value = total.toFixed(2); // toFixed(2) = se muestre el punto y dos ceros seguido de un número entero
        
    }
 


   </script>
</body>
</html>