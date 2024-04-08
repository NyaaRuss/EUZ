<?php
session_start();

// Check if the user is logged in, if not, redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>



<?php
// Database connection code
include("connect.php");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch member details from the members table based on the id parameter in the URL
$id = $_GET['id'] ?? null; // Get the id parameter from the URL
if ($id !== null) {
    $id = intval($id); // Convert id to integer to prevent SQL injection
    $member_query = "SELECT id, EmpNo, First_name, Surname FROM members WHERE id = $id";
    $result = $conn->query($member_query);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $id = $row["id"];
        $EmpNo = $row["EmpNo"];
        $First_name = $row["First_name"];
        $Surname = $row["Surname"];
    } else {
        echo "Member not found.";
        exit; // Stop execution if member not found
    }
} else {
    echo "Member ID not provided.";
    exit; // Stop execution if member ID not provided in the URL
}

// Add payment record to the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $RTGs = $_POST["RTGs"];
    $paymentDate = $_POST["paymentDate"];
    $Amount = $_POST["Amount"];

    $sql = "INSERT INTO payments (id, EmpNo, First_name, Surname, RTGs, paymentDate, Amount)
            VALUES ('$id' ,'$EmpNo', '$First_name', '$Surname', '$RTGs', '$paymentDate', '$Amount')";

    if ($conn->query($sql) === TRUE) {
        // Update the amount in the members table
        $updateSql = "UPDATE members SET Amount = Amount + $Amount WHERE id = $id";
        if ($conn->query($updateSql) === TRUE) {
            echo "<script>alert('Payment record added successfully.');</script>";
            // Redirect after alerting the message
            echo "<script>window.location.href = 'viewpayment.php?id=$id';</script>";
            exit();
        } else {
            echo "Error updating amount in members table: " . $conn->error;
            exit();
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>EUZ</title>

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
  <h1 style="color:#144a0b; text-align: center; font-size: 50px; font-weight: bolder; font-family: helvetica; text-shadow: 6px 6px 6px #dcf4da;">Add Payment</h1><br>

    <div class="container my-4">
        <header class="d-flex justify-content-between my-4">
            <div>
                <a href="paytable.php" class="btn btn-outline-success">Back</a>
            </div>
        </header><br><br>

    <div style="display: flex; justify-content: center;">
    <div style="display: flex; flex-direction: column; justify-content: space-between;">
        <ul class="list-group list-group-flush">
            <div class="card border-success mb-3" style="max-width: 30rem; margin-top: 50px;">
            <div class="card-header bg-success text-white">Add Payment</div>
            <div class="card-body">

            <form method="POST" action="<?php echo $_SERVER["PHP_SELF"] . '?id=' . $id; ?>">
                <div class="input-group mb-3" >
                    <span class="input-group-text" id="basic-addon1">Employee Number : </span>
                    <span class="input-group-text" id="basic-addon1"><?php echo $EmpNo; ?></span>
                </div>

                <div class="input-group mb-3" >
                    <span class="input-group-text" id="basic-addon1">First Name : </span>
                    <span class="input-group-text" id="basic-addon1"><?php echo $First_name; ?></span>
                </div>

                <div class="input-group mb-3" >
                    <span class="input-group-text" id="basic-addon1">Surname : </span>
                    <span class="input-group-text" id="basic-addon1"><?php echo $Surname; ?></span>
                </div>

                

                <div class="input-group mb-3" >
                    <span class="input-group-text" id="basic-addon1">paymentDate</span>
                    <input type="date" class="form-control" name="paymentDate"  placeholder="Enter paymentDate Amount"  aria-label="paymentDate" aria-describedby="basic-addon1" required>
                </div>

                <div class="input-group mb-3" >
                    <span class="input-group-text" id="basic-addon1">USD</span>
                    <input type="number" step="1" class="form-control" name="Amount"  placeholder="Enter USD Amount"  aria-label="USD" aria-describedby="basic-addon1" value="<?php echo isset($_POST['Amount']) ? $_POST['Amount'] : 0; ?>" required >
                </div>   

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Edited By</span>
                    <input type="text"  class="form-control" name="RTGs" placeholder="Enter Your name" aria-label="RTGs" aria-describedby="basic-addon1" value="" required>
                </div>

                <div class="input-group mb-3" >
                    <input type="submit" step="1" value="Add Payment" class="form-control btn btn-outline-success" aria-describedby="basic-addon1" >
                </div>   
            </form>
        </ul>
    </div>
</div>
</div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>
