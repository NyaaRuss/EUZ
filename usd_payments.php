<?php
session_start();

// Check if the user is logged in, if not, redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>


<?php
function insertIntoMembersTable($conn, $data)
{
    // Check if EmpNo exists and is not empty
    if (!empty($data[2])) {
        // Prepare the SQL statement for checking EmpNo existence
        $stmtCheckEmpNo = $conn->prepare("SELECT COUNT(*) FROM members WHERE EmpNo = ?");
        $stmtCheckEmpNo->bind_param("s", $data[2]);
        $stmtCheckEmpNo->execute();
        $stmtCheckEmpNo->bind_result($empCount);
        $stmtCheckEmpNo->fetch();
        $stmtCheckEmpNo->close();

        if ($empCount == 0) {
            // Prepare the SQL statement for members table
            $stmtMembers = $conn->prepare("INSERT INTO members (Surname, First_name, EmpNo, NatRegNo, DOB, AppDate, StationDescription, Descriptions, Province, Department, Statcode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            
            // Bind the CSV values to the prepared statement for members table
            $stmtMembers->bind_param("sssssssssss", $data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8], $data[9], $data[10]);
            
            // Execute the statement for members table
            $stmtMembers->execute();
            
            $stmtMembers->close();
        }
    }
}

// Check if the form is submitted
if (isset($_POST["submit"])) {
    // Check if a file is uploaded
    if ($_FILES["csv_file"]["error"] == UPLOAD_ERR_OK && $_FILES["csv_file"]["tmp_name"] != "") {
        // Get the file extension
        $extension = pathinfo($_FILES["csv_file"]["name"], PATHINFO_EXTENSION);

        // Check if the file is a CSV
        if (strtolower($extension) == "csv") {
            // Database connection details
            include('connect.php');

            // Create a database connection
            $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

            // Check the connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Check if the file has already been uploaded
            $stmt = $conn->prepare("SELECT COUNT(*) FROM usd_payments WHERE file_name = ?");
            $stmt->bind_param("s", $_FILES["csv_file"]["name"]);
            $stmt->execute();
            $stmt->bind_result($fileCount);
            $stmt->fetch();
            $stmt->close();

            if ($fileCount > 0) {
                echo '<script>alert("This file has already been uploaded.");</script>';
            } else {
                // Prepare the SQL statement for rtgs_payments table
                $stmtPayments = $conn->prepare("INSERT INTO usd_payments (Surname, First_name, EmpNo, NatRegNo, DOB, AppDate, StationDescription, Descriptions, Province, Department, Statcode, Amount, paymentDate, file_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                // Open the CSV file for reading
                if (($handle = fopen($_FILES["csv_file"]["tmp_name"], "r")) !== FALSE) {

                    // Skip the header row
                    fgetcsv($handle, 1000, ",");
                    
                    // Read each row of the CSV file
                    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                        // Get the payment date from the form
                        $paymentDate = $_POST['payment_date'];

                        // Bind the CSV values, payment date, and additional values to the prepared statement for rtgs_payments table
                        $stmtPayments->bind_param("ssssssssssssss", $data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8], $data[9], $data[10], $data[11], $paymentDate, $_FILES["csv_file"]["name"]);

                        // Execute the statement for rtgs_payments table
                        $stmtPayments->execute();

                        // Insert into members table if EmpNo does not exist
                        insertIntoMembersTable($conn, $data);
                    }

                    // Close the CSV file
                    fclose($handle);
                }

                // Close the statements and database connection
                $stmtPayments->close();
                $conn->close();
                
                echo '<script>alert("CSV file uploaded successfully.");</script>';
            }
        } else {
            echo '<script>alert("Only CSV files are allowed.");</script>';
        }
    } else {
        echo '<script>alert("Please choose a file to upload.");</script>';
    }
}
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>EUZ USD payments</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/navbar-fixed/">

    <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link href="css/stylesheet.css" rel="stylesheet">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-...your-unique-integrity-hash...=" crossorigin="anonymous" />
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      body {
      /*background-image: url("img/logo.jpg");*/
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      margin: 0;
      padding: 0;
      height: 100vh;
      }

      .search-form {
            display: flex;
            align-items: center;
            max-width: 300px;
            margin-bottom: 10px;
        }

        .search-input {
            flex: 1;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .search-button {
            margin-left: 5px;
            padding: 8px 12px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
    <!--{% include 'script.html' %}-->
    <!-- Custom styles for this template -->

    
    
  </head>
  <body>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top " style="background-color: #0e3807;">
        <img src="img/sv.png" height="30px" width="30px" />
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item">
        <a class="nav-link" href="home.php">HOME</a>
        </li>
        
        <li class="nav-item">
        <a class="nav-link " href="index.php" tabindex="-1" aria-disabled="true">MEMBERSHIP</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="create.php">NEW MEMBER</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pastmembers.php">PAST MEMBERS</a>
        </li>
        
        
        <li class="nav-item">
        <a class="nav-link" href="logout.php">LOG OUT</a>
        </li>
    </ul>
    <!--<form class="form-inline mt-2 mt-md-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>-->
    </div>
    </nav>

    
    
  <div class="jumbotron">
  <h1 style="color:#144a0b; text-align: center; font-size: 50px; font-weight: bolder; font-family: helvetica; text-shadow: 6px 6px 6px #dcf4da;">MONTHLY USD PAYMENTS</h1><br>

    <div class="container my-4">
        <header class="d-flex justify-content-between my-4">
            <div>
                <a href="home.php" class="btn btn-outline-success">Back</a>
            </div>

            <div>
                <a href="paytable.php" class="btn btn-outline-secondary my-2 my-sm-0">View USD Payments</a>
            </div>
        </header><br><br>

    <div style="display: flex; justify-content: center;">
    <div style="display: flex; flex-direction: column; justify-content: space-between;">
        <ul class="list-group list-group-flush">
            <div class="card border-success mb-3" style="max-width: 30rem; margin-top: 50px;">
            <div class="card-header bg-success text-white">USD Payment</div>
                <div class="card-body">


                <form method="post" enctype="multipart/form-data">
                    <input type="file" name="csv_file" accept=".csv"><br>
                    <label for="payment_date">Payment Date:</label>
                    <input type="date" name="payment_date" id="payment_date" required ><br>
                    <input type="submit" name="submit" value="Upload">
                </form>


            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>