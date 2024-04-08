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
  <h1 style="color:#144a0b; text-align: center; font-size: 50px; font-weight: bolder; font-family: helvetica; text-shadow: 6px 6px 6px #dcf4da;">Members Payment Records</h1><br>

    <div class="container my-4">
        <header class="d-flex justify-content-between my-4">
            <div>
                <a href="monthlypaid.php" class="btn btn-outline-success my-2 my-sm-0">Paid Payments</a>
            </div>

            <div>
                <a href="allpay.php" class="btn btn-outline-secondary my-2 my-sm-0">Uniform payments</a>
            </div>

            <div>
                <a href="monthlynotpaid.php" class="btn btn-outline-danger my-2 my-sm-0">View Pending payments</a>
            </div>
        </header>

        <form method="GET" action="paysearch.php" class="search-form">
            <input type="text" name="search" placeholder="Enter Date" class="search-input">
            <button type="submit" class="search-button">Search</button>
        </form>
        <br>


        <?php
        /*session_start();*/
        if (isset($_SESSION["create"])) {
        ?>
        <div class="alert alert-success">
            <?php 
            echo $_SESSION["create"];
            ?>
        </div>
        <?php
        unset($_SESSION["create"]);
        }
        ?>
         <?php
        if (isset($_SESSION["update"])) {
        ?>
        <div class="alert alert-success">
            <?php 
            echo $_SESSION["update"];
            ?>
        </div>
        <?php
        unset($_SESSION["update"]);
        }
        ?>
        <?php
        if (isset($_SESSION["delete"])) {
        ?>
        <div class="alert alert-success">
            <?php 
            echo $_SESSION["delete"];
            ?>
        </div>
        <?php
        unset($_SESSION["delete"]);
        }
        ?>
        <div class="display_table">
        <table class="table">
        <thead>
            <tr>
                <th>DATE</th>
                <th>#</th>
                <th>EmpNo</th>
                <th>First_name</th>
                <th>Surname</th>
                <th>Edited By</th>
                <th>Received USD</th>
                
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        
        <?php
            include('connect.php');

            // Define the number of records to display per page
            $recordsPerPage = 20;

            // Get the current page number from the URL
            if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                $currentPage = $_GET['page'];
            } else {
                $currentPage = 1;
            }

            // Calculate the offset for the database query
            $offset = ($currentPage - 1) * $recordsPerPage;

            // Prepare the SQL query to retrieve the records for the current page with pagination
            $sqlSelect = "SELECT * FROM payments LIMIT $offset, $recordsPerPage";
            $result = mysqli_query($conn, $sqlSelect);

            // Check if the query executed successfully
            if ($result) {
                // Check if any records found
                if (mysqli_num_rows($result) > 0) {
                    // Display the records
                    while ($data = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td><?php echo $data['paymentDate']; ?></td>
                            <td><?php echo $data['id']; ?></td>
                            <td><?php echo $data['EmpNo']; ?></td>
                            <td><?php echo $data['First_name']; ?></td>
                            <td><?php echo $data['Surname']; ?></td>
                            
                            <td><?php echo $data['RTGs']; ?></td>
                            <td><?php echo $data['Amount']; ?></td>
                            <td>
                                <a href="view.php?id=<?php echo $data['id']; ?>" class="btn btn-outline-success"><i class="fas fa-eye"></i></a>

                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "No records found.";
                }

                // Calculate the total number of records
                $totalRecordsQuery = "SELECT COUNT(*) as total FROM payments";
                $totalResult = mysqli_query($conn, $totalRecordsQuery);
                $totalRecords = mysqli_fetch_assoc($totalResult)['total'];

                // Calculate the total number of pages
                $totalPages = ceil($totalRecords / $recordsPerPage);

                // Display pagination buttons
                echo "<div class='pagination'>";

                // Previous button
                if ($currentPage > 1) {
                    echo "<a href='paytable.php?page=" . ($currentPage - 1) . "' class='btn btn-outline-success'>Previous page</a>";
                }

                // Next button
                if ($currentPage < $totalPages) {
                    echo "<a href='paytable.php?page=" . ($currentPage + 1) . "' class='btn btn-outline-success'>Next page</a>";
                }

                echo "</div>";

            } else {
                echo "Error executing the query: " . mysqli_error($conn);
            }

            // Close the database connection
            mysqli_close($conn);
            ?>
        </tbody>
        </table>
    </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>