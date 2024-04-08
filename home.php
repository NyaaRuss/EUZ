<?php
session_start();

// Check if the user is logged in, if not, redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
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
    <title>EUZ</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/navbar-fixed/">

    <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link href="css/stylesheet.css" rel="stylesheet">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-...your-unique-integrity-hash...=" crossorigin="anonymous" />

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

        .card-container {
            display: flex;
            justify-content: center;
        }

        .card {
            padding: 20px;
            background-color: #dcf4da;
            border-radius: 5px;
            text-align: center;
            width: 100%;
            margin: 20px;
            color: #144a0b;
            display: flex;
            flex-direction: column;
            justify-content:space-between;
        }

        .card-title {
            font-size:40px;
        }

        .text {
            font-size: 25px;
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
  
    
    <div class="container my-4">
        <header>
        <h1 style="color:#144a0b; text-align: center; font-size: 50px; font-weight: bolder; font-family: helvetica; text-shadow: 6px 6px 6px #dcf4da;">DASHBOARD</h1><br>
        </header>
</head>
<body>
    
    
    
    <div class="card-container">
    <?php
    // Database connection
    include('connect.php');

    // Get total number of members
    $sql = "SELECT COUNT(id) AS totalMembers FROM members";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $totalMembers = $row['totalMembers'];

    // Close database connection
    
    ?>

    <div class="card">
        <div class="card-title">Total Members</div>
        <p class="text"><?php echo $totalMembers; ?></p>
        <div>
            <a href="index.php" class="btn btn-outline-success my-2 my-sm-0">View Members</a>
        </div>
    </div>
    <?php
    // Database connection
    

    // Get total number of members
    $sql = "SELECT COUNT(id) AS totalMembers FROM past_members";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $totalMembers = $row['totalMembers'];

    
    ?>

    <div class="card">
        <div class="card-title">Past Members</div>
        <p class="text"><?php echo $totalMembers; ?></p>
        <div>
            <a href="pastmembers.php" class="btn btn-outline-success my-2 my-sm-0">View Members</a>
        </div>
    </div>

    <?php
        // Database connection code
        

        // Get the current month and year
        $currentMonth = date('m');
        $currentYear = date('Y');

        // SQL query to fetch payments made in the current month
        $sql = "SELECT payments.id, payments.Amount, payments.paymentDate, members.Surname, members.First_name, members.EmpNo
                FROM payments
                INNER JOIN members ON payments.id = members.id
                WHERE MONTH(payments.paymentDate) = $currentMonth AND YEAR(payments.paymentDate) = $currentYear";

        // Execute the query
        $result = mysqli_query($conn, $sql);

        // Calculate the total amount
        $totalAmount = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $totalAmount += $row['Amount'];
        }

        // Close the database connection
        

        // Return the total amount
        
        ?>

    <div class="card">
        <div class="card-title">Current Month Payments</div>
        <p class="text"><?php echo $totalAmount; ?></p>
        <div>
            <a href="monthlypaid.php" class="btn btn-outline-success my-2 my-sm-0">View Payments</a>
        </div>
    </div>
    </div>

    <div class="card-container">

    <?php

        
        $sqlSelect = "SELECT * FROM payments";
        $result = mysqli_query($conn, $sqlSelect);

        // Calculate the total amount
        $totalAmount = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $totalAmount += $row['Amount'];
        }

        // Close the database connection
        

        // Return the total amount
        
        ?>
        <div class="card">
            <div class="card-title">All Payments amount</div>
            <p class="text"><?php echo $totalAmount; ?></p>
            <div>
                <a href="paytable.php" class="btn btn-outline-secondary my-2 my-sm-0">View Payments</a>
            </div>
        </div>

        <?php
            // Prepare the SQL query to retrieve members who haven't paid
            $sql = "SELECT COUNT(*) AS memberCount
            FROM members
            LEFT JOIN payments ON members.id = payments.id AND MONTH(payments.paymentDate) = $currentMonth AND YEAR(payments.paymentDate) = $currentYear
            WHERE payments.id IS NULL";

            // Execute the query
            $result = mysqli_query($conn, $sql);

            // Fetch the result
            $row = mysqli_fetch_assoc($result);
            $memberCount = $row['memberCount'];

            // Close the database connection
            mysqli_close($conn);

            
            ?>

        <div class="card">
        <div class="card-title">Members Owing</div>
            <p class="text"><?php echo $memberCount; ?></p>
            <div>
                <a href="monthlynotpaid.php" class="btn btn-outline-secondary my-2 my-sm-0">View Pending</a>
            </div>
        </div>


        <div class="card">
        <div class="card-title">Uniform payment</div>

            <div>
                <a href="allpay.php" class="btn btn-outline-secondary my-2 my-sm-0">Add</a>
            </div>
        </div>

    </div>
    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    
</body>
</html>