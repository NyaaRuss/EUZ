<?php
require 'connect.php';

// Insert EmpNo and Amount records into the payments table, allowing duplicates
$insertQuery = "INSERT INTO payments (id, EmpNo, Surname, First_name, Amount) 
                SELECT m.id, m.EmpNo, m.Surname, m.First_name, m.Amount 
                FROM members m";
$insertResult = mysqli_query($conn, $insertQuery);

if ($insertResult) {
    echo "Records inserted successfully.";
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
