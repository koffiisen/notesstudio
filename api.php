<?php
/**
 * Created by IntelliJ IDEA.
 * User: Koffi
 * Date: 09/02/2019
 * Time: 19:55
 */

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Content-Type: application/json');
require_once 'model/Notes.php';


$response = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"));

    if (isset($data->operation)) {

        $operation = $data->operation;

        if (!empty($operation)) {

            if ($operation == 'addNote') {

                if (isset($data->notes) && isset($data->notes->title)
                    && isset($data->notes->create_date) && isset($data->notes->last_modif)
                    && isset($data->notes->useremail)) {

                    $note = new Notes();
                    $note->insert($data);

                    $response["msg"] = "successful insert note on online database";
                    echo json_encode($response);

                }

            }

        }
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $note = new Notes();
    $note->getAll();

}

