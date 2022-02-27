<?php
require 'connection.php';
$username = $password = "";

$errors = [
    'username' =>'',
    'password' =>'',
    'loginError' =>''
];

if(isset($_POST['submit'])){
    if(empty($_POST['username'])){
        $errors['username'] = "A username is required";
    }else{
        $username = $_POST['username'];
    }
    if(empty($_POST['password'])){
        $errors['password'] = "A password is required";
    }else{
        $password = $_POST['password'];
    }

    if(!empty($username) && !empty($password)){

        $checksql = "SELECT * FROM users WHERE username = '$username'";
        $checkResult = mysqli_query($conn, $checksql);
        $user = mysqli_fetch_assoc($checkResult);

        if (mysqli_num_rows($checkResult) > 0) {
            if(password_verify($password, $user['password'])){
                $role = $user['role'];
                $contact = $user['contact'];
                require 'authSession.php';
                if($_SESSION['role'] == 'Tenant'){
                    header('location: properties.php');
                }else{
                    header('location: my-properties.php');
                }
            }else{
                $errors['loginError'] = 'Wrong password';
            }
        }else{
            $errors['loginError'] = 'User does not exist';
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Cantarell:ital@1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="SignIn.css"/>
    <title>Booking_System</title>
</head>
<body>
    <div class="login-content">
        <div class="form">
            <div class="create-acc-head">Sign in</div>
            <form action="SignIn.php" class="sign-up" method="POST">
                <p class="login-error"><?php echo $errors['loginError']; ?></p>
                <label for="username">Username</label>
                <input type="username" style="border-color:blue;" id="username" name="username" value="<?php echo htmlspecialchars($username)?>">
                <p class="errors"><?php echo $errors['username']; ?></p>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($password)?>">
                <p class="errors"><?php echo $errors['password']; ?></p>
<div style="font-size:12px;"class="Forgot_password"><a href="Forgot_password.php">Forgot password?</div>
                <input type="submit" id="submit-btn" name="submit" value="Log in">
            </form>
            <div  class="terms"><span style="color:black;">Don't have an account? Sign up </span><a href="signup.php">HERE</a></div>
        </div>
    </div>
</body>
</html>
