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

$duration = isset($_GET['duration']) ? $_GET['duration'] : 12; //par défaut 12h

$oPlace = new Position();

$result = $oPlace->getLastPosition($duration);

switch($result) {
    case -1 :
        response(500,"database_error", NULL);
        break;
    case 0 :
        response(200,"last_positions_result", $oPlace->export());
        break;
    case 1 :
        response(403, "no_recent_positions", NULL);
        break;
}

?>
