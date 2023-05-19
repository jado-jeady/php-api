<?php

require_once('dbconfig.php');
class dbconnection {
    protected $db;
    public function __construct(){
        $this->db = new PDO(DB_DRIVER.":host=".DB_HOST.";dbname=".DB_NAME,
        DB_USER,DB_PWD,[PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    function save($table, $data){
        try {
            $query = "INSERT INTO ".$table."(firstname,lastname,email) values(?,?,?)";
            $stm = $this->db->prepare($query);
            $stm->execute($data);
            return intval($this->db->lastInsertId());


        } catch (Exception $th) {
            return $th->getMessage();
        }
       
    }

    function getAll($table){
        try{
            $stm = $this->db->prepare("SELECT * FROM ".$table);
            $stm->execute();
            $stm->setFetchMode(PDO::FETCH_ASSOC);
            return $stm->fetchAll();
        }
        catch(Exception $ex){
            return $ex->getMessage();
        }
    }
    function delete($table, $id) {
        try {
            $stm = $this->db->prepare("DELETE FROM $table WHERE s_id = :id");
            $stm->bindParam(':id', $id);
            $stm->execute();
            $count = $stm->rowCount();
            $response;
            if($count > 0) {
                $response = array(
                    'status' => 'success',
                    'message' => 'Data deleted successfully'
                );
                return $response;
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'No data found to delete'
                );
                return $response;
            }
        } catch (PDOException $ex) {
            $response = array(
                'status' => 'error',
                'message' => $ex->getMessage()
            );
            return $response;
        }
    }
    
}



?>