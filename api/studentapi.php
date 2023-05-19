<?php require_once('../models/studentModel.php');
//switching on request method received 

switch ($_SERVER['REQUEST_METHOD']) {
    case "POST":    //handle Post method
        if ($_SERVER['REQUEST_URI'] === "/apiwork/API/studentapi.php/addstudent") {
            $data = file_get_contents('php://input');
            $obj = json_decode($data);
            
            $userData = [
                $obj->firstname,
                $obj->lastname,
                $obj->email];
            $db = new dbconnection();
            $result = $db->saveFormData("students", $userData);
            
            if (is_int($result)) {
             echo json_encode("Added Student:");
                 print_r($userData);
                 echo "";
                exit();
            }

            $response = [
                "message" => "Failed to save: " . $result,
                "status" => 202
            ];
            //sending back the response
            echo json_encode($response);
        } else {
            echo "Unknown API Request Method ";
        }
        break;

    case "GET": //handling Get Method request
        if ($_SERVER['REQUEST_URI'] === "/apiwork/api/studentapi.php/allstudent") {
            /*
            //Authenitcate token
            if (!isset($_SERVER['HTTP_AUTHORIZATION'])) {
            http_response_code(401);
            exit();
            }
            $jwt = $_SERVER['HTTP_AUTHORIZATION'];
            $decodedToken = JWTHelper::validateToken($jwt);
            if (!$decodedToken) {
            http_response_code(401);
            exit();
            }
            */
            //get userdata

            $db = new dbconnection();
            $students = $db->getAll("students");
            echo json_encode($students);
        }
        elseif (strpos($_SERVER['REQUEST_URI'],"/apiwork/API/studentapi.php/student/") !== false)
        {
          $studentId = ltrim($_SERVER['REQUEST_URI'], '/apiwork/API/studentapi.php/student/');
            $db = new dbconnection();
            $student=$db->getOneStudent("students",$studentId);
            // sending back the response
            $response = ["message" => "Student $studentId rerived successfully."];
            echo json_encode($student);
        }else{
            echo "Unknown API Request Method ";
        }
        break;

    case "DELETE":  //Handle the Delete method
        if (strpos($_SERVER['REQUEST_URI'], "/apiwork/API/studentapi.php/delete/") !== false) {
            $studentId = ltrim($_SERVER['REQUEST_URI'], '/apiwork/API/studentapi.php/delete/');

            $db = new dbconnection();
            $db->delete("students", $studentId);
            $response = [
                "message" => "Student $studentId deleted successfully."
            ];
            echo json_encode($response);
        } else {
            echo "Unknown API";
        }
        break;

    case "PUT":
        if (isset($_SERVER['REQUEST_URI'])) {
            $studentId = ltrim($_SERVER['REQUEST_URI'], '/apiwork/API/studentapi.php/update/');
            
            $data = file_get_contents('php://input');
            $obj = json_decode($data);
            
            $userData = [
                "firstname" => $obj->firstname,
                "lastname" => $obj->lastname,
                "email" => $obj->email
            ];
            
            $db = new dbconnection();
            $db->update("students", $studentId, $userData);
            
            $response = [
                "status" => "202",
                "message" => "Student updated successfully"
            ];
            echo json_encode($response);
        } else {
            $response = [
                "status" => "101",
                "message" => "Missing Student ID parameter"
            ];
            echo json_encode($response);
        }
        break;

    default:
        echo "Nothing done";
        break;
}
 ?>


<?php   



// if ($_SERVER['REQUEST_URI']==="/apiwork/API/studentapi.php/addstudent") {
        

//         $data = file_get_contents('php://input');
//         $obj = json_decode($data);
//         var_dump($obj);
     
//         $userData = [
//             "firstname" =>$obj->firstname,
//             "lastname" =>$obj->lastname,
//             "email" =>$obj->email];
//         $db = new dbconnection();
//         $result = $db->save("students", $userData);

//         $response = ["message"=>"Failed to dave".$result, "status"=>'0'];
//         if(is_int($result)){
//             $response = ["message"=>"student added successfully", "status" =>202, "s_id"=>$result];
//         }
//         echo (json_encode($response));
//     }




 ?>