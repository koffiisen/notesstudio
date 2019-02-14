<?php
/**
 * Created by IntelliJ IDEA.
 * User: Koffi
 * Date: 09/02/2019
 * Time: 19:55
 */

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require_once 'include/Notes.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode($_POST["notes"]);

    //print_r($data);
    //echo $data->useremail;
    //echo $data["last_modif"];


    if (isset($data->operation)) {

        $operation = $data->operation;

        if (!empty($operation)) {

            if ($operation == 'addNote') {

                if (isset($data->title)
                    && isset($data->create_date) && isset($data->last_modif)
                    && isset($data->useremail)) {

                    $note = new Notes();
                    $note->insert($data);

                }

            }

        }
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $note = new Notes();
    $note->getAll();

}

