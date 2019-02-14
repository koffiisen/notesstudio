<?php


/**
 * Class Notes
 */
class Notes
{
    private $db_connect;

    function __construct()
    {
        require_once 'DBConnect.php';

        $db = new DBConnect();
        $this->db_connect = $db->connect();
    }

    public function insert($data)
    {
        $notes = $data;
        $title = $notes->title;
        $description = $notes->description;
        $create_date = $notes->create_date;
        $last_modif = $notes->last_modif;
        $username = $notes->username;
        $useremail = $notes->useremail;


        try {

            $sql = "INSERT INTO notes (title, description, create_date, last_modif, username, useremail) VALUES (?,?,?,?,?,?)";
            $stmt = $this->db_connect->prepare($sql);
            $stmt->execute([$title, $description, $create_date, $last_modif, $username, $useremail]);

            //echo $useremail;

            echo "successful insert note on online database";

        } catch (Exception $e) {
            echo $e->getMessage();
            //Rollback the transaction.
            $this->db_connect->rollBack();
        }

    }

    public function getAll()
    {
        $sql = "SELECT * FROM notes";
        $stmt = $this->db_connect->prepare($sql);
        $stmt->execute();

        /*$result = $stmt->fetchAll();
        print_r($result);*/

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        echo $json;


    }

    /**
     * @return PDO
     */
    public function getDbConnect()
    {
        return $this->db_connect;
    }


}


