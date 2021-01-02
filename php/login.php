<?php
    include_once "connect.php";

    if(isset($_POST['submit'])){
        $username = "admin";
        $password = htmlentities(mysqli_real_escape_string($conn, $_POST['password']));
        
        $sql = "SELECT * FROM users WHERE name = ? AND password = ? ;";

        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "failed";
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "ss", $username, $password);
            
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            
            while($row = mysqli_fetch_assoc($result)){
                session_start();
                $_SESSION['name'] = "admin_privelages";
                header( 'Location: ../dashboard.php' );
                die();
            }
        }
    }
    else{
        header('Location: ../login_form.php');
        die();
        exit();
    }

?>