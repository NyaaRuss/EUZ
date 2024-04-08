<?php
require 'connect.php';
if(isset($_POST["submit"])){
    $username = $_POST["username"];
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $role=$_POST["role"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $duplicate = mysqli_query($conn, "SELECT * FROM registration WHERE username='$username' OR email='$email'");
    if(mysqli_num_rows($duplicate) > 0){
        echo "<script> alert('Username or Email has been Taken'); </script>";
    }
    else {
        if($password == $confirm_password){
            $query = "INSERT INTO registration (fullname, username, password, email , role) VALUES ('$fullname','$username','$password', '$email' , '$role')";
            mysqli_query($conn, $query);
            echo "<script>
                // Display the alert message
                window.alert('Registration Successful. Now you can login.');
                // Redirect to login.php after a short delay
                setTimeout(function() {
                    window.location.href = 'login.php';
                }, 2000); // 2000 milliseconds delay (2 seconds)
            </script>"; // Redirect to login.php
            exit(); // Ensure no further code execution after redirect
        }
        else{
            echo "<script>alert('Password does not match');</script>";
        }
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Design by foolishdeveloper.com -->
    <title>EUZ Sign Up</title>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!--Stylesheet-->
    <style media="screen">
      *,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body {
    background-color: #0e3807;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    margin: 0;
    padding: 0;
    height: 100vh;
}
.background{
    width: 430px;
    height: 520px;
    position: absolute;
    transform: translate(-50%,-50%);
    left: 50%;
    top: 50%;
}
.background .shape{
    height: 200px;
    width: 200px;
    position: absolute;
    border-radius: 50%;
}
.shape:first-child{
    background: linear-gradient(
        #1845ad,
        #23a2f6
    );
    left: -80px;
    top: -80px;
}
.shape:last-child{
    background: linear-gradient(
        to right,
        #108b1b,
        #f09819
    );
    right: -30px;
    bottom: -80px;
}
form{
    height: 670px;
    width: 480px;
    background-color: rgba(255,255,255,0.13);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 10px 35px;
}
form *{
    font-family: 'Poppins',sans-serif;
    color: #ffffff;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}
form h3{
    font-size: 32px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
}

label{
    display: block;
    margin-top: 30px;
    font-size: 16px;
    font-weight: 500;
}
input{
    display: block;
    height: 50px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 10px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
}
::placeholder{
    color: #e5e5e5;
}
button{
    margin-top: 50px;
    width: 100%;
    background-color: #ffffff;
    color: #080710;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
}
.social{
  margin-top: 30px;
  display: flex;
}
.social div{
  background: red;
  width: 150px;
  border-radius: 3px;
  padding: 5px 10px 10px 5px;
  background-color: rgba(255,255,255,0.27);
  color: #eaf0fb;
  text-align: center;
}
.social div:hover{
  background-color: rgba(255,255,255,0.47);
}
.social .fb{
  margin-left: 25px;
}
.social i{
  margin-right: 4px;
}

.form-group {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    margin-bottom: 10px;
}

.form-group label,
.form-group input {
    width: 48%;
}
.error-message {
   color: red;
    margin-top: 5px;
}

    </style>
</head>
<body>
    <div class="background">
        
    </div>
    
    
        <form id="signup-form" class="" action="" method="post" onsubmit="return validatePasswords()" autocomplete="off">
        <div style="text-align: center;">
            <img src="img/sv.png" height="40px" width="40px" />
        </div>
        <h3>EUZ SIGN UP PORTAL</h3>
        <div id="password-error" class="error-message"></div>
        <div class="form-group">
            <label for="username">User name</label>
            <input type="text" placeholder="Enter username" id="username" name="username" required value="">
        </div>

        <div class="form-group">
            <label for="fullname">Full name</label>
            <input type="text" placeholder="Enter fullname" id="fullname" name="fullname" required value="">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" placeholder="Enter email" id="email" name="email" required value="">
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <input type="text" placeholder="Enter role" id="role" name="role" required value="">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" placeholder="Enter Password" id="password" name="password" required value="">
        </div>

        <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" placeholder="Re-enter Password" id="confirm_password" name="confirm_password" required value="">
        </div>

        <button type="submit" name="submit">Sign up</button>

        <a href="login.php">Already have an account</a>

    </form>

    <script>
        function validatePasswords() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirm_password").value;
        var role = document.getElementById("role").value;

        if (password !== confirmPassword) {
            alert("Passwords do not match. Please re-enter.");
            return false; // Prevent form submission
        }

        if (role !== "euz admin") {
            alert("Role does not match. Please re-enter.");
            return false; // Prevent form submission
        }

        // If both conditions pass, allow form submission
        return true;
    }

    </script>


    </body>
</html>
