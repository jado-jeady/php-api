<?php

require_once('dbconnection.php');
switch ($_SERVER['REQUEST_METHOD']) {
    case "POST":

    
        $data = file_get_contents('php://input');
        $obj = json_decode($data);
        var_dump($obj);

        $userData = [
            "name" =>$obj->name,
            "phone" =>$obj->phone,
            "email" =>$obj->email,
            "password" =>md5($obj->password)];
        $db = new dbconnection();
        $result = $db->save("users", $userData);
        $response = ["message"=>"Failed to dave".$result, "status"=>0];
        if(is_int($result)){
            $response = ["message"=>"User added", "status" =>1, "id"=>$result];
        }
        echo (json_encode($response));
        break;

    case "GET":
        $db = new dbconnection();
        echo json_encode($db->getAll("users"));
        break;
    case "DELETE":
            $db = new dbconnection();
            $db->delete("users", $id);
            echo json_encode($db->delete("users",$_GET["id"]));
        break;
    case "PUT":
        echo "PUT for editing working";
        break;

    case "PATCH":
            echo "PACH for editing working";
            break;

    default:
        echo "Nothing done";
        break;
}


?>