<?php 

    include "_dbconnect.php";

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $username = $_POST['LoginUsername'];
        $password = $_POST['LoginPassword'];

        $error = "";

        // check if the username and password is correct
        $sql = "SELECT * FROM `users` WHERE username = '$username'";
        $result = mysqli_query($conn,$sql);
        $num_row = mysqli_num_rows($result);
        if($num_row == 1){
            $row = mysqli_fetch_assoc($result);

            $fetch_password = $row['password'];
            $hash_password = hash('sha256',$password);

            if($fetch_password == $hash_password){
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                header("Location: /forum/index.php?loggedin=true");
            }
            else{
                $error = " Incorrect password.";
                header("Location: /forum/index.php?errors=$error");
            }
        }
        else{
            $error = " Username does not exists.";
            header("Location: /forum/index.php?errors=$error");
        }

    }
?>