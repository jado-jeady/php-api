<?php

require_once('../models/marksModel.php');
switch ($_SERVER['REQUEST_METHOD']) {
    case "POST":
        if ($_SERVER['REQUEST_URI']==="/apiwork/api/marksapi.php/addMarks") {

        $data = file_get_contents('php://input');
        $obj = json_decode($data);
        
     
        $userData = [
            "cat" =>$obj->cat,
            "exam" =>$obj->exam,
            "total" =>$obj->total,
            "s_id" =>$obj->s_id];
        $db = new dbconnection();
        $result = $db->save("marks", $userData);
        if(is_int($result)){
            $response = ["message"=>"marks added successfully", "status" =>202, "Added Marks Id :".$result];
            echo (json_encode($response));
        }
        else{
            echo json_encode("error While Adding Marks");
        }
        
            
        }

        break;

    case "GET":
        $db = new dbconnection();
        echo json_encode($db->getAll("marks"));
        break;
        
    case "DELETE":
        $db = new dbconnection();
        $db->delete("marks", $m_id);
        echo json_encode($db->delete("marks",$_GET["m_id"]));
        break;

    case "PUT":
        if(isset($_GET['m_id'])) {
            $data = file_get_contents('php://input');
            $obj = json_decode($data);
            $userData = [
                "cat" =>$obj->cat,
                "exam" =>$obj->exam,
                "total" =>$obj->total,
                "s_id" =>$obj->s_id,
            ];
            $db = new dbconnection();
            $m_id = $_GET['m_id'];
            $db->update("marks", $m_id, $userData);
            $response = array(
                'status' => 'yes',
                'message' => 'Marks updated successfully'
            );
            echo json_encode($response);
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Missing M_id parameter'
            );
            echo json_encode($response);
        }
        break;
        
    case "PATCH":
        echo "PACH for editing working";
        break;

    default:
        echo "Nothing done";
        break;
}


?>
