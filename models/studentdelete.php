<?php 

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['sid'])) {
    // Get the student ID from the query parameter
    $studentId = $_GET['sid'];

    // Send the DELETE request to the API
    $apiUrl = 'http://localhost/apiwork/API/studentapi.php/delete/'.$studentId;
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    
   header('Location:http://localhost/apiwork/consumer/consumer.php');
}


 ?>