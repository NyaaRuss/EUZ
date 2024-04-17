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
      /*background-image: url("img/logo.jpg");*/
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      margin: 0;
      padding: 0;
      height: 100vh;
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
 
  <div class="jumbotron">
  <h1 style="color:#144a0b; text-align: center; font-size: 50px; font-weight: bolder; font-family: helvetica; text-shadow: 6px 6px 6px #dcf4da;">Edit Member Records</h1>
    <header class="d-flex justify-content-between my-4">
            <div>
            <a href="index.php" class="btn btn-outline-success">Back</a>
            </div>
        </header>
<div style="display: flex; justify-content: center;">
    <div style="display: flex; flex-direction: column; justify-content: space-between;">
        <ul class="list-group list-group-flush">

        <div class="card border-success mb-3" style="max-width: 30rem; margin-top: 50px;">
        <div class="card-header bg-success text-white">Edit Member</div>
        <div class="card-body">

        <form action="process.php" method="post">
            <?php 
            
            if (isset($_GET['id'])) {
                include("connect.php");
                $id = $_GET['id'];
                $sql = "SELECT * FROM members WHERE id=?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "i", $id); // Assuming id is an integer
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $row = mysqli_fetch_array($result);

                ?>

            <div class="input-group mb-3">
                <span class="input-group-text">SURNAME</span>
                <input type="text" class="form-control" name="Surname"  placeholder="Member Surname:" value="<?php echo $row["Surname"]; ?>">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">FIRST NAME</span>
                <input type="text" class="form-control" name="First_name"  placeholder="Member First_name:" value="<?php echo $row["First_name"]; ?>">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">EMP NO</span>
                <input type="text" class="form-control" name="EmpNo" placeholder="Username" placeholder="Member EmpNo:" value="<?php echo $row["EmpNo"]; ?>">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">NatRegNo</span>
                <input type="text" class="form-control" name="NatRegNo" placeholder="Username" placeholder="Member NatRegNo:" value="<?php echo $row["NatRegNo"]; ?>">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">PROVINCE</span>
                <input type="text" class="form-control" name="Province" placeholder="Member Province:" value="<?php echo $row["Province"]; ?>">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">DEPARTMENT</span>
                <input type="text" class="form-control" name="Department"  placeholder="Member Department:" value="<?php echo $row["Department"]; ?>">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">DOB</span>
                <input type="text" class="form-control" name="DOB" placeholder="Member DOB:" value="<?php echo $row["DOB"]; ?>">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">APP DATE</span>
                <input type="text" class="form-control" name="AppDate"  placeholder="Member AppDate:" value="<?php echo $row["AppDate"]; ?>">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">STATION DESCRIPTION</span>
                <input type="text" class="form-control" name="StationDescription"  placeholder="Member StationDescription:" value="<?php echo $row["StationDescription"]; ?>">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">DISTRICT</span>
                <input type="text" class="form-control" name="Descriptions"  placeholder="Member Descriptions:" value="<?php echo $row["Descriptions"]; ?>">
            </div>
            
            <div class="input-group mb-3">
                <span class="input-group-text">STAT CODE</span>
                <input type="text" class="form-control" name="Statcode"  placeholder="Member Statcode:" value="<?php echo $row["Statcode"]; ?>">
            </div>
            
            <input type="hidden" value="<?php echo $id; ?>" name="id">
            <div class="form-element my-4">
                <input type="submit" name="edit" value="Edit Member" class="btn btn-success">
            </div>
                <?php
            }else{
                echo "<h3>Member Does Not Exist</h3>";
            }
            ?>
           
        </form>  
        </ul>  
    </div>
    
    </div>
</div>
</body>
</html>