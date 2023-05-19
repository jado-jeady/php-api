<!DOCTYPE html>
<html>
<head>
    <title>Student Ms</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    
    <div class="container">
        <h2>Student Information And Marks </h2> <a class="h5 text-center" href="http://localhost/apiwork/addstudent.php">Add Student </a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Student Names</th>
                    <th>Email</th>
                    <th>Cat</th>
                    <th>Exam</th>
                    <th>Total</th>
               
                </tr>
            </thead>
            <tbody>
                <?php







// Set the cURL options
                $curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'http://localhost/apiwork/api/studentapi.php/allstudent');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// Execute the request and get the response
$response = curl_exec($curl);

// Close cURL resource
curl_close($curl);

// Process the response
if ($response !== false) {
    // Handle the response data
   $data=json_decode($response,true);
   
  
    foreach ($data as $key) {
       ?>
       
       <tr>
           <td><?php echo $key['firstname']; ?></td>
           <td><?php echo $key['lastname']; ?></td>
           <td><?php echo $key['email']; ?></td>
           <td><?php echo $key['s_id']; ?></td>

           <!-- <td> <a href="consumeredit.php?pidedit=<?php //echo$key['s_id'];?>">Edit</a></td> -->

           <td> <a href="../models/studentdelete.php?sid=<?php echo$key['s_id'];?>">delete</a></td>
           <td> <a href="#consumeredit.php?pidedit=<?php echo$key['s_id'];?>">Edit</a></td>
       </tr>

       <?php
    }

    ?>
</table>
<?php 
}

else {
    // Handle the request failure
    echo "Failed fech the data from api";
}
?>




<?php 

                /*
                // API URLs
                $marksApiUrl = 'http://localhost/apiwork/index.php';
                $studentsApiUrl = 'http://localhost/api_test/index.php';

                // Initialize cURL session for marks API
                $marksCh = curl_init($marksApiUrl);
                curl_setopt($marksCh, CURLOPT_RETURNTRANSFER, true);
                $marksData = curl_exec($marksCh);

                curl_close($marksCh);
                $marks = json_decode($marksData, true);

                // Initialize cURL session for students API
                $studentsCh = curl_init($studentsApiUrl);
                curl_setopt($studentsCh, CURLOPT_RETURNTRANSFER, true);
                $studentsData = curl_exec($studentsCh);
                if ($studentsData === false) {
                    die('Failed to fetch students API data: ' . curl_error($studentsCh));
                }
                curl_close($studentsCh);
                $students = json_decode($studentsData, true);

                // Display student and marks information
                foreach ($students as $student) {
                    $studentId = $student['s_id'];
                    $firstName = $student['firstname'];
                    $lastName = $student['lastname'];
                    $email = $student['email'];

                    // Find the marks for the current student
                    $studentMarks = findMarksByStudentId($marks, $studentId);

                    // Output student information
                    echo "<tr>";
                    echo "<td>$firstName $lastName</td>";
                    echo "<td>$email</td>";

                    // Output marks information
                    if ($studentMarks) {
                        foreach ($studentMarks as $mark) {
                            $category = $mark['cat'];
                            $exam = $mark['exam'];
                            $total = $mark['total'];
                            echo "<td>$category</td>";
                            echo "<td>$exam</td>";
                            echo "<td>$total</td>";
                        }
                    } else {
                        echo "<td colspan='5'>No marks found for this student.</td>";
                        echo "</tr>";
                    }
                }

                // Helper function to find marks by student ID
                function findMarksByStudentId($marks, $studentId) {
                    $studentMarks = array();
                    foreach ($marks as $mark) {
                        if ($mark['s_id'] === $studentId) {
                            $studentMarks[] = $mark;
                        }
                    }
                    return $studentMarks;

                }*/
                
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
