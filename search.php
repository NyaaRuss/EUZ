<?php
session_start();

// Check if the user is logged in, if not, redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
          crossorigin="anonymous">
    <link href="css/stylesheet.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
          integrity="sha512-...your-unique-integrity-hash...=" crossorigin="anonymous"/>

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

</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark fixed-top " style="background-color: #0e3807;">
    <img src="img/sv.png" height="30px" width="30px"/>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
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
    </div>
</nav>

<div class="jumbotron">
    <h1 style="color:#144a0b; text-align: center; font-size: 50px; font-weight: bolder; font-family: helvetica; text-shadow: 6px 6px 6px #dcf4da;">Search Results</h1><br>

    <div class="container my-4">
        <header class="d-flex justify-content-between my-4">
            <div>
                <a href="create.php" class="btn btn-outline-success my-2 my-sm-0">Add New Member</a>
            </div>
            <div>
                <a href="paytable.php" class="btn btn-outline-secondary my-2 my-sm-0">Member Payments</a>
            </div>
        </header>

        <form method="GET" action="crow.php" class="search-form">
            <input type="text" name="search" placeholder="Enter EmpNo" class="search-input">
            <button type="submit" class="search-button">Search</button>
        </form>
        <br>

        <div class="display_table">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>EmpNo</th>
                    <th>First_name</th>
                    <th>Surname</th>
                    <th>Paid</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                <?php
// Database connection code
include("connect.php");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_GET['search'])){
    $search = $_GET['search'];

    // Get the current month and year
    $currentMonth = date('m');
    $currentYear = date('Y');

    // SQL query to fetch the most recent payment for each member and include members who didn't pay
    $sql = "SELECT members.id, members.EmpNo, members.Surname, members.First_name, payments.paymentDate
            FROM members
            LEFT JOIN payments ON members.id = payments.id 
                AND MONTH(payments.paymentDate) = $currentMonth 
                AND YEAR(payments.paymentDate) = $currentYear
            WHERE members.EmpNo LIKE '%$search%'
            AND (payments.paymentDate IS NULL 
                OR payments.paymentDate = (
                    SELECT MAX(paymentDate) 
                    FROM payments 
                    WHERE id = members.id 
                    AND MONTH(paymentDate) = $currentMonth 
                    AND YEAR(paymentDate) = $currentYear
                ))
            ORDER BY members.id ASC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['EmpNo']; ?></td>
                <td><?php echo $row['First_name']; ?></td>
                <td><?php echo $row['Surname']; ?></td>
                <?php if (!empty($row["paymentDate"])): ?>
                    <td><?php echo $row['paymentDate']; ?></td>
                <?php else: ?>
                    <td><p>Pending</p></td>
                <?php endif; ?>
                <td>
                    <a href="view.php?id=<?php echo $row['id']; ?>"
                       class="btn btn-outline-success my-2 my-sm-0"><i class="fas fa-eye"></i></a>
                    <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning"><i
                                class="fas fa-edit" style="font-weight: normal;"></i></a>
                    <a href="confirm.php?id=<?php echo $row['id']; ?>" class="btn btn"><img
                                src="img/del.png" height="20px" width="20px"/></a>
                </td>
            </tr>
            <?php
        }
    } else {
        echo "<tr><td colspan='6'>No members found.</td></tr>";
    }
}

// Close the database connection
$conn->close();
?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>

</body>
</html>
