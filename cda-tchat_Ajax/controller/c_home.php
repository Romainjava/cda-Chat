<?php
include 'model/M_message.php';

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING);
$message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
$data = new M_message();

switch ($action) {

    case 'read':
        $arr_message = [];
        $arr_message['data'] = $data->readAllMessage();
        $arr_message['time'] = $data->readLastTime();
        echo json_encode($arr_message);
        die();
        break;

    case 'ajax':
        $result = $data->createMessage($pseudo, $message);
        echo json_encode($result);
        die();
        break;

    default:
        $arr_message = $data->readAllMessage();
        $loc = "home";
        break;
}
