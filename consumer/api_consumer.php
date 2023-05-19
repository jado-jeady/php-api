<?php
// API URLs
$marksApiUrl = 'http://localhost/apiwork/API/studentapi.php';
$studentsApiUrl = 'http://localhost/api_test/index.php';

// Initialize cURL session for marks API
$marksCh = curl_init($marksApiUrl);
curl_setopt($marksCh, CURLOPT_RETURNTRANSFER, true);
$marksData = curl_exec($marksCh);
if ($marksData === false) {
    die('Failed to fetch marks API data: ' . curl_error($marksCh));
}
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
    echo "Student Names: $firstName $lastName\n";
    echo "Email: $email\n";

    // Output marks information
    if ($studentMarks) {
        foreach ($studentMarks as $mark) {
            $category = $mark['cat'];
            $exam = $mark['exam'];
            $total = $mark['total'];
            echo "Cat: $category, Exam: $exam, Total: $total\n";
        }
    } else {
        echo "No marks found for this student.\n";
    }

    echo "\n";
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
}
?>
