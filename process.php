<?php
include('connect.php');
if (isset($_POST["create"])) {
    $Surname = mysqli_real_escape_string($conn, $_POST["Surname"]);
    $EmpNo = mysqli_real_escape_string($conn, $_POST["EmpNo"]);
    $NatRegNo = mysqli_real_escape_string($conn, $_POST["NatRegNo"]);
    $Province = mysqli_real_escape_string($conn, $_POST["Province"]);
    $First_name = mysqli_real_escape_string($conn, $_POST["First_name"]);
    $DOB = mysqli_real_escape_string($conn, $_POST["DOB"]);
    $AppDate = mysqli_real_escape_string($conn, $_POST["AppDate"]);
    $StationDescription = mysqli_real_escape_string($conn, $_POST["StationDescription"]);
    $Descriptions = mysqli_real_escape_string($conn, $_POST["Descriptions"]);
    $Department = mysqli_real_escape_string($conn, $_POST["Department"]);
    $Statcode = mysqli_real_escape_string($conn, $_POST["Statcode"]);
    $Amount = mysqli_real_escape_string($conn, $_POST["Amount"]);
    $sqlInsert = "INSERT INTO members(Surname , NatRegNo , EmpNo , First_name ,  Province, DOB , AppDate , StationDescription , Descriptions , Department , Statcode , Amount) VALUES ('$Surname','$NatRegNo','$EmpNo', '$Province' , '$First_name' , '$DOB' ,'$AppDate' , '$StationDescription' , '$Description' , '$Department' , '$Statcode' , '$Amount' )";
    if(mysqli_query($conn,$sqlInsert)){
        session_start();
        $_SESSION["create"] = "member Added Successfully!";
        header("Location:index.php");
    }else{
        die("Something went wrong");
    }
}
if (isset($_POST["edit"])) {
    $Surname = mysqli_real_escape_string($conn, $_POST["Surname"]);
    $EmpNo = mysqli_real_escape_string($conn, $_POST["EmpNo"]);
    $NatRegNo = mysqli_real_escape_string($conn, $_POST["NatRegNo"]);
    $Province = mysqli_real_escape_string($conn, $_POST["Province"]);
    $First_name = mysqli_real_escape_string($conn, $_POST["First_name"]);
    $DOB = mysqli_real_escape_string($conn, $_POST["DOB"]);
    $AppDate = mysqli_real_escape_string($conn, $_POST["AppDate"]);
    $StationDescription = mysqli_real_escape_string($conn, $_POST["StationDescription"]);
    $Descriptions = mysqli_real_escape_string($conn, $_POST["Descriptions"]);
    $Department = mysqli_real_escape_string($conn, $_POST["Department"]);
    $Statcode = mysqli_real_escape_string($conn, $_POST["Statcode"]);
    $Amount = mysqli_real_escape_string($conn, $_POST["Amount"]);
    $id = mysqli_real_escape_string($conn, $_POST["id"]);  
    $sqlUpdate = "UPDATE members SET Surname = '$Surname', EmpNo = '$EmpNo', NatRegNo = '$NatRegNo', Province = '$Province' , First_name = '$First_name' , DOB = '$DOB' , AppDate = '$AppDate' , StationDescription = '$StationDescription' , Descriptions = '$Descriptions' , Department = '$Department'  , Statcode = '$Statcode'  , Amount = '$Amount'  WHERE id='$id'";
    if(mysqli_query($conn,$sqlUpdate)){
        session_start();
        $_SESSION["update"] = "member Updated Successfully!";
        header("Location:index.php");
    }else{
        die("Something went wrong");
    }
}





if (isset($_POST["edit"])) {
    // Retrieve form data
    $id = $_POST['id'];
    $empNo = $_POST['EmpNo'];
    $firstName = $_POST['First_name'];
    $surname = $_POST['Surname'];
    $RTGs = $_POST['RTGs'];
    $amount = $_POST['Amount'];
    $receivedRtgs = $_POST['Received_Rtgs'];
    $receivedUSD = $_POST['Received_USD'];

    // Insert data into database
    $query = "INSERT INTO payments (id, EmpNo, First_name, Surname, RTGs, Amount, Received_Rtgs, Received_USD)
              VALUES ('$id', '$empNo', '$firstName', '$surname', '$RTGs', '$amount', '$receivedRtgs', '$receivedUSD')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Payment added successfully');</script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

// Close connection
mysqli_close($conn);
?>
