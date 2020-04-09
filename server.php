<?php

$user = array_key_exists('PHP_AUTH_USER',$_SERVER) ? $_SERVER['PHP_AUTH_USER']:'';
$pw = array_key_exists('PHP_AUTH_PW',$_SERVER) ? $_SERVER['PHP_AUTH_PW']:'';

if($user !== 'saul' || $pw !=='12345'){
    die;
}

// Definimos los recurso disponibles
$allowedResourceTypes = [
    'books',
    'authors',
    'genres',
];


//Validamos que el recurso este disponible
$resourceType = $_GET['resource_type'];

if(!in_array($resourceType,$allowedResourceTypes))
{
    die;
}


//Defino los recurso
$books = [
    1 => [
        'titulo' => 'Lo que el viento se llevo',
        'id_autor' => 2,
        'id_genero' => 2,
    ],
    2 => [
        'titulo' => 'La iliada',
        'id_autor' => 2,
        'id_genero' => 2,
    ],
    3 => [
        'titulo' => 'La Odisea',
        'id_autor' => 2,
        'id_genero' => 2,
    ],
];

header('Content-Type: application/json');

//Levantamos el id del recurso buscado
$resourceId = array_key_exists('resource_id',$_GET) ? $_GET['resource_id'] : '';

//Generamos la respuesta asumiendo que el pedido es correcto
switch( strtoupper($_SERVER['REQUEST_METHOD']))
{
    case 'GET':
        if(empty($resourceId)){

            echo json_encode($books);

        }else{

            if(array_key_exists($resourceId,$books)){
                echo json_encode($books[$resourceId]);
            }
        }
    break;
    case 'POST':

        $json = file_get_contents('php://input');

        $books[] = json_decode($json,true);

        //echo array_keys( $books ) [count($books) -1 ];

        echo json_encode($books);

        break;
    case 'PUT':
        //validamos que el recurso buscado exista
        if(!empty($resourceId) && array_key_exists($resourceId,$books)){
            //Tomamos la entrada cruda
            $json = file_get_contents('php://input');
            //Transformamos el JSON recibido y usando el ID modificamos su contenido
            $books[$resourceId] = json_decode($json,true);
            //Retornamos la coleccion modificada en formado json
            echo json_encode($books);
        }   
        break;
    case 'DELETE':
    //Validamos que el recurso que queremos eliminar, exista
    if(!empty($resourceId) && array_key_exists($resourceId,$books)){
        //Eliminamos el recurso
        unset($books[$resourceId]);
        //Retornamos la coleccion completa para verificar que se halla eliminado el registro
        echo json_encode($books);
    }  
    break;
}

?>