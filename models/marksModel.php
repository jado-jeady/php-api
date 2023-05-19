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
            $query = "INSERT INTO ".$table."(";
            $i =0;
            $ph ="";
            $values =[];
            foreach($data as $field => $value){
                $query .= $i==0? $field:",".$field;
                $ph .= $i==0? "?": ",?";
                array_push($values, $value);
                $i++;
            }
            $query .= ")values(".$ph.")";
            $stm = $this->db->prepare($query);
            $stm->execute($values);
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
    function delete($table, $m_id) {
        try {
            $stm = $this->db->prepare("DELETE FROM $table WHERE m_id = :m_id");
            $stm->bindParam(':m_id', $m_id);
            $stm->execute();
            $count = $stm->rowCount();
            $response;
            if($count > 0) {
                $response = array(
                    'status' => 'success',
                    'message' => 'Marks deleted successfully'
                );
                return $response;
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'No Marks found to delete'
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

    function update($table, $m_id, $data){
        try {
            $query = "UPDATE ".$table." SET ";
            $i = 0;
            $values = array();
            foreach($data as $field => $value){
                if($i > 0){
                    $query .= ",";
                }
                $query .= $field."=?";
                array_push($values, $value);
                $i++;
            }
            $query .= " WHERE m_id=?";
            array_push($values, $m_id);
            $stm = $this->db->prepare($query);
            $stm->execute($values);
            $count = $stm->rowCount();
    
            if($count > 0) {
                $response = array(
                    'status' => 'success',
                    'message' => 'Marks updated successfully'
                );
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'No Marks found to update'
                );
            }
            return $response;
        } catch (Exception $th) {
            return array(
                'status' => 'error',
                'message' => $th->getMessage()
            );
        }
    }
}

?>