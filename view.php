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
        
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        margin: 0;
        padding: 0;
        height: 100vh;
        }

        .member-details {
            background-color: #dcf4da;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
            color: #144a0b;
        }

        .member-details h5 {
            color: black;
            margin-bottom: 5px;
        }

        .member-details p {
            margin-top: 0;
        }

        .member-details div {
            margin-bottom: 15px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 15px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .form-group {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            margin-bottom: 10px;
            text-align : center;
            
        }

        .form-group label,
        .form-group input {
            width: 48%;
        }

        
    
    </style>
    <!--{% include 'script.html' %}-->
    <!-- Custom styles for this template -->

    
    
  </head>
  <body >
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
            <a class="nav-link" href="#">PAST MEMBERS</a>
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
 
  <div class="jumbotron" style="background-color: #b1e6b6;">
  
  <h1 style="color:#144a0b; text-align: center; font-size: 50px; font-weight: bolder; font-family: helvetica; text-shadow: 6px 6px 6px #dcf4da;">Member Record</h1>
    <div class="container my-4">
        <header class="d-flex justify-content-between my-4">
            <h2 style="color:green;"></h2>
            <div>
            <a href="index.php" class="btn btn-outline-primary">Back</a>
            </div>
        </header>
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
        
        <div class="member-details p-5 my-4">
        <?php
            include("connect.php");
            $id = $_GET['id'];
            if ($id) {
                $sql = "SELECT *, YEAR(DOB) AS year FROM members WHERE id = $id";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
                    $dobYear = date('Y', strtotime($row['DOB']));

                    // Calculate the future year
                    $futureYear = $dobYear + 65;

                    // Get the current year
                    $currentYear = date('Y');

                    // Calculate the remaining years
                    $yearsLeft = $futureYear - $currentYear;

                    
                 ?>
                 
                <div class="form-group">
                   <div>
                        <h5>EMPNO</h5>
                        <p><?php echo $row["EmpNo"]; ?></p>
                    </div>
                    <div>
                        <h5>SURNAME</h5>
                        <p><?php echo $row["Surname"]; ?></p>
                    </div>
                    <div>
                        <h5>FIRST NAME</h5>
                        <p><?php echo $row["First_name"]; ?></p>
                    </div>
                </div>
                <div class="form-group">
                    
                    <div>
                        <h5>PROVINCE</h5>
                        <p><?php echo $row["Province"]; ?></p>
                    </div>
                    <div>
                        <h5>DISTRICT</h5>
                        <p><?php echo $row["Descriptions"]; ?></p>
                    </div>
                </div>
                <div class="form-group">
                    <div>
                        <h5>YEARS LEFT(65)</h5>
                        <p><?php echo $yearsLeft ?></p>
                    </div>
                    
                    <div>
                        <h5>DOB</h5>
                        <p><?php echo $row["DOB"]; ?></p>
                    </div>
                </div>
                <div class="form-group">
                    <div>
                        <h5>APP DATE</h5>
                        <p><?php echo $row["AppDate"]; ?></p>
                    </div>
                    <div>
                        <h5>STATION DESCRIPTION</h5>
                        <p><?php echo $row["StationDescription"]; ?></p>
                    </div>
                </div>
                
                <div class="form-group">
                    <div>
                        <h5>DEPARTMENT</h5>
                        <p><?php echo $row["Department"]; ?></p>
                    </div>
                    <div>
                        <h5>STAT CODE</h5>
                        <p><?php echo $row["Statcode"]; ?></p>
                    </div>
                </div>
                <div class="form-group">
                    <div>
                        <h5>NATIONAL REG #</h5>
                        <p><?php echo $row["NatRegNo"]; ?></p>
                    </div>
                    <div>
                        <h5>USD TOTAL</h5>
                        <p><?php echo $row["Amount"]; ?></p>
                    </div>

                </div>
                <div class="form-group">
                    <div>
                        <a href="edit.php?id=<?php echo $row["id"]; ?>" class="btn btn-outline-success my-2 my-sm-0">Edit Member record</a>
                    </div>
                    <div>
                        <a href="viewpayment.php?id=<?php echo $row["id"]; ?>" class="btn btn-outline-success my-2 my-sm-0">View payments</a>
                    </div>
                    <div>
                        <a href="payments.php?id=<?php echo $row["id"]; ?>" class="btn btn-outline-success my-2 my-sm-0">Add payment</a>
                    </div>
                    <div>
                        <a href="confirm.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-danger">Delete Member</a>
                    </div>
                </div>
                 <?php
                }
            }
            else{
                echo "<h5>No members found</h5>";
            }
            ?>
            
        </div>

        

        
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>