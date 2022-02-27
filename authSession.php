<?php
    session_start();
    $_SESSION['auth'] = 'true';
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $role;
    $_SESSION['contact'] = "254".$contact;
    
?>