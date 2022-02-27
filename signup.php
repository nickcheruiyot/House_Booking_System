<?php
    require 'connection.php';

    $username = $contact = $role = $email = $password = "";

    $errors = [
         'username' => '',
         'contact' => '',
         'role' => '',
         'email' => '',
         'password' => ''
    ];
    $regError = "";

    if(isset($_POST['submit'])){
         if(empty($_POST['username'])){
             $errors['username'] = "A username is required";
         }else{
             $username = $_POST['username'];
         }
         if(empty($_POST['contact'])){
             $errors['contact'] = "A contact is required";
         }else{
             $contact = $_POST['contact'];
         }
         if(empty($_POST['role'])){
             $errors['role'] = "A role is required";
         }else{
             $role = $_POST['role'];
         }
         if(empty($_POST['email'])){
             $errors['email'] = "An email is required";
         }else{
             $email = $_POST['email'];
         }
         if(empty($_POST['password'])){
             $errors['password'] = "A password is required";
         }else{
             $password = $_POST['password'];
         }


        if(!empty($username) && !empty($contact) && !empty($role) && !empty($email) && !empty($password)){
            /* Secure password hash. */
            $hashPssd = password_hash($password, PASSWORD_DEFAULT);

            $checksql = "SELECT * FROM users WHERE username = '$username'";
            $checkResult = mysqli_query($conn, $checksql);

            if (!(mysqli_num_rows($checkResult) > 0)) {
                $sqlInsert = "INSERT INTO users (username, contact, role, email, password)
                VALUES ('$username', '$contact', '$role', '$email', '$hashPssd')";

                if (mysqli_query($conn, $sqlInsert)) {
                echo "New record created successfully";
                require 'authSession.php';
                if($_SESSION['role'] == 'Tenant'){
                    header('properties.php');
                }else{
                    header('location: my-properties.php');
                }
                } else {
                echo "Error: " . $sqlInsert . "<br>" . mysqli_error($conn);
                }
            } else {
                echo 'A user with that username already exists';
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
    <link rel="stylesheet" href="signupA.css"/>
    <title>Booking_System</title>
</head>
<body>
    <div class="signup-content">
        <div class="form">
            <div class="create-acc-head">Create account</div>
            <form action="signup.php" class="sign-up" method="POST">
                <p class="regError"><?php echo $regError; ?></p>
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username)?>">
                <p class="errors"><?php echo $errors['username']; ?></p>

                <label for="contact">Contact</label>
                <input type="text" id="contact" name="contact" value="<?php echo htmlspecialchars($contact)?>">
                <p class="errors"><?php echo $errors['contact']; ?></p>

                <label for="role">Role</label>
                <select id="role" name="role">
                    <option value="Tenant">Tenant </option>
                    <option value="Plot Owner">Plot Owner</option>
                </select>
                <p class="errors"><?php echo $errors['role']; ?></p>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email)?>">
                <p class="errors"><?php echo $errors['email']; ?></p>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($password)?>">
                <p class="errors"><?php echo $errors['password']; ?></p>

                <input type="submit" id="submit-btn" name="submit" value="Create account">
            </form>
            <div class="terms">Already have an account? Login <a href="SignIn.php">HERE.</a></div>
        </div>
    </div>
</body>
</html>
