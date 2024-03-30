<?php

class Rutas {
    public $id;
    public $ruta;
    public $desde;
    public $hasta;
    public $costoPasaje;

    public function __construct($id, $ruta, $desde, $hasta, $costoPasaje){
      
        $this->id = $id; 
        $this->ruta = $ruta; 
        $this->desde = $desde; 
        $this->hasta = $hasta; 
        $this->costoPasaje = $costoPasaje; 

    }
    public function createRuta(){
        $enpoint = 'https://sheetdb.io/api/v1/m1ndozccoo56f';

        $data = array(
            'id' => $this->id,
            'ruta' => $this->ruta,
            'desde' => $this->desde,
            'hasta' => $this->hasta,
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
        $response = file_get_contents('https://sheetdb.io/api/v1/m1ndozccoo56f?sheet=BD-Rutas');
       return $response;
        
    }
  
}
// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger los datos del formulario
    $id = $_POST['id'];
    $ruta = $_POST['ruta'];
    $desde = $_POST['desde'];
    $hasta = $_POST['hasta'];
    $costoPasaje = $_POST['costoPasaje'];
    
    // Crear una instancia de la clase Rutas con los datos del formulario
    $rutaObj = new Rutas($id, $ruta, $desde, $hasta, $costoPasaje);
    
    // Llamar al método createRuta() para enviar los datos a la API
    $rutaObj->createRuta();
}

?>