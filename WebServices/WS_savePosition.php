<?php
header("Content-Type:application/json;charset=utf-8", false);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, Content-Type, Autorization, X-Auth-Token');
header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, HEAD, OPTIONS');

require_once dirname(__FILE__) . '/../Classes/place_management.php';
use Classes\Position;

function response($status, $status_message, $data)
{
    header("HTTP/1.1 ".$status);
    //header("Content-Type:application/json;charset=utf-8", false);
    $response['status']=$status;
    $response['status_message']=$status_message;
    $response['data']=$data;
    $json_response = json_encode($response, JSON_UNESCAPED_UNICODE);
    echo $json_response;
}

$latitude = isset($_GET['latitude']) ? $_GET['latitude'] : "";
$longitude = isset($_GET['longitude']) ? $_GET['longitude'] : "";
$water = isset($_GET['water']) ? $_GET['water'] : "";

$oPlace = new Position();

if (! empty($latitude) && ! empty($longitude) && isset ($water))
{
    $result =  $oPlace->createPosition($latitude, $longitude, $water);
    switch ($result) {
        case 0:
            response(200, "creation_ok", NULL);
            break;
        case -1:
            response(500, "ws_error", NULL);
            break;
    }
    
} else {
    $msg='error';
    $sep='|';
    if (empty($position)) {
        $msg = $msg . $sep . 'empty_position';
    }
    if (empty($water)) {
        $msg = $msg . $sep . 'empty_water';
    }
    response(400,$msg, NULL);
}


?>