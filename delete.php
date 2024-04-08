<?php
session_start();

// Check if the user is logged in, if not, redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<?php
session_start();

if (isset($_GET['id'])) {
    include("connect.php");

    $id = $_GET['id'];

    // Retrieve the record from the main list based on the ID
    $sqlSelect = "SELECT * FROM members WHERE id='$id'";
    $result = mysqli_query($conn, $sqlSelect);
    $deletedMember = mysqli_fetch_assoc($result);

    // Insert the deleted member into the past list table
    $sqlInsert = "INSERT INTO past_members (id, Surname, First_name, EmpNo, NatRegNo, DOB, AppDate, StationDescription, Descriptions, Province, Department, Statcode, Amount) 
                  VALUES ('".$deletedMember['id']."', '".$deletedMember['Surname']."', '".$deletedMember['First_name']."', '".$deletedMember['EmpNo']."', '".$deletedMember['NatRegNo']."', '".$deletedMember['DOB']."', '".$deletedMember['AppDate']."', '".$deletedMember['StationDescription']."', '".$deletedMember['Descriptions']."', '".$deletedMember['Province']."', '".$deletedMember['Department']."', '".$deletedMember['Statcode']."', '".$deletedMember['Amount']."')";
    
    if(mysqli_query($conn, $sqlInsert)) {
        // Delete the record from the main list
        $sqlDelete = "DELETE FROM members WHERE id='$id'";
        if(mysqli_query($conn, $sqlDelete)) {
            $_SESSION["delete"] = "Member moved to past list successfully!";
            header("Location:index.php");
            exit();
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    } else {
        echo "Error inserting into past members table: " . mysqli_error($conn);
    }
} else {
    echo "Member does not exist";
}
?>
