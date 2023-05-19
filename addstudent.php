<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</head>
<div class="container">
    
<div class="row">
    <div class="col-md-5 bg-pirmary">
        

<h2 class="text h3 tooltip-top" style="padding-top: 10vh;">Add Student</h2> <a href="http://localhost/apiwork/consumer/consumer.php">View Students</a>
<form class="table" action="/apiwork/API/studentapi.php/addstudent" method="POST">
    <label for="firstname">Fist Name:</label>
    <input type="text" class="form-control"  id="name" name="fname" required>
    <br>
    <label for="lastname">Fist Name:</label>
    <input type="text" class="form-control" id="name" name="lname" required>
    <br>
    <label for="email">Email:</label>
    <input type="email" class="form-control" id="email" name="email" required>
    <br>
    <input type="submit" class="btn btn-block btn-danger btn-outline-dark" value="Add Student">
</form>
    </div>
    
</div>
</div>

<?php 

// API endpoint URL
$apiUrl = 'http://localhost/apiwork/API/studentapi.php/addstudent';

// Data to send in the request body
$data = array(
    'firstname' => '',
    'lastname' => '',
    'email' => 'johndoe@example.com'
);

// Convert the data to URL-encoded format
$postData = http_build_query($data);

// Initialize cURL session
$ch = curl_init();

// Set the cURL options
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

// Execute the cURL request
$response = curl_exec($ch);

// Check for errors
if ($response === false) {
    echo 'cURL error: ' . curl_error($ch);
} else {
    // Process the API response
    echo $response;
}

// Close the cURL session
curl_close($ch);


 ?>