<?php
require 'connect.php'; // Include your database connection file

if (isset($_POST["submit"])) {
    // Retrieve the email and new password from the form
    $email = $_POST["email"];
    $new_password = $_POST["new_password"];

    // Update the password in the database for the given email
    $update_query = "UPDATE registration SET password = '$new_password' WHERE email = '$email'";
    $result = mysqli_query($conn, $update_query);

    if ($result) {
        echo "<script>
                    // Display the alert message
                    window.alert('Password reset was successful. Now you can login.');
                    // Redirect to login.php after a short delay
                    setTimeout(function() {
                        window.location.href = 'login.php';
                    }, 2000); // 2000 milliseconds delay (2 seconds)
                </script>";
    } else {
        echo "Error resetting password: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Design by foolishdeveloper.com -->
    <title>Login Page</title>
 
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
    background-color:#0e3807;
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
    height: 800px;
    width: 440px;
    background-color: rgba(255,255,255,0.13);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 50px 35px;
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
    border-radius: 3px;
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

    </style>
</head>
<body>
    <div class="background">
        
    </div>


    <form action="" method="post" onsubmit="return validatePasswords()">
        <div style="text-align: center;">
            <img src="img/sv.png" height="50px" width="50px" />
        </div>
        <h1>Password Reset</h1>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Enter your existing email" required>
        </div>
        <div class="form-group">
            <label for="role">Role</label>
            <input type="text" placeholder="Enter role" id="role" name="role" required value="">
        </div>

        <div class="form-group">
            <label for="new_password">New Password</label>
            <input type="password" id="new_password" name="new_password" placeholder="Enter new password" required>
        </div>

        <div class="form-group">
            <label for="confirm_new_password">Confirm New Password</label>
            <input type="password" id="confirm_new_password" name="confirm_new_password" placeholder="Enter Confirm new password" required>
        </div>

        <button type="submit" name="submit">Reset Password</button><br><br>

        <a href="login.php">Back to login</a>
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