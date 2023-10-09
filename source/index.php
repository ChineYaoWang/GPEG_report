<?php
require_once "config.php";


session_start();


    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {

        // collect value of input field
        // $user_id = $_POST['user_id'];
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];

        // Check if email and username exist
        $check = [];
        if(!LoginCheck($conn, $user_table,$user_name, $password)){
            $check["response"] = "Email or password is incorrect";
        }
        
        // if no error
        if(!count($check)):
            $_SESSION['user_name'] = $user_name;
            $_SESSION['type_id'] = Get_type($conn,$user_table,$user_name);
            $_SESSION['last_time_login'] = time();
            header("Location:home.php");
        endif;

        // Show error
        //echo '<script>alert("Welcome to Geeks for Geeks")</script>';
        $message = json_encode($check);
        echo "<script type='text/javascript'>alert('$message'); window.location.href='login.php';</script>";
        exit();
        //echo json_encode($check);
    }
    else{
        header("Location: login.php");
        exit();
    }

    $conn->close();

?>