<?php

require_once '../include/DBConnect.php';

/**
 * Class Notes
 */
class Notes
{
    private $db_connect;

    function __construct()
    {
        $db = new DBConnect();
        $this->db_connect = $db->connect();
    }

    public function insert($data)
    {
        $notes = $data->notes;
        $title = $notes->title;
        $description = $notes->name;
        $create_date = $notes->create_date;
        $last_modif = $notes->last_modif;
        $username = $notes->username;
        $useremail = $notes->useremail;

        try {
            $this->db_connect->beginTransaction();

            $sql = "INSERT INTO notes (title, description, create_date, last_modif, username, useremail) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->db_connect->prepare($sql);
            $stmt->execute(array(
                    $title,
                    $description,
                    $create_date,
                    $last_modif,
                    $username,
                    $useremail
                )
            );

            $this->db_connect->commit();
        } catch (Exception $e) {
            echo $e->getMessage();
            //Rollback the transaction.
            $this->db_connect->rollBack();
        }

    }


}


