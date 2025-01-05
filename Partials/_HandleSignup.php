<?php 

    include "_dbconnect.php";

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $username = $_POST['SignupUsername'];
        $email = $_POST['SignupEmail'];
        $password = $_POST['SignupPassword'];
        $cpassword = $_POST['SignupcPassword'];

        $error = "";

        // check if the username is taken
        $sql = "SELECT * FROM `users` WHERE username = '$username'";
        $result = mysqli_query($conn,$sql);
        $num_row = mysqli_num_rows($result);
        if($num_row > 0){
            $error = "Username already exists!";
        }
        else{
            if($password == $cpassword && filter_var($email, FILTER_VALIDATE_EMAIL)){
                $hash = hash('sha256',$password);
                $sql = "INSERT INTO `users` (`username`, `email`, `password`, `timestamp`) VALUES ('$username', '$email', '$hash', current_timestamp())";
                $result = mysqli_query($conn,$sql);
                if($result){
                    $Signup = "true";
                    header("Location: /forum/index.php?signup=$Signup");
                    exit();
                }
            }
            else{
                $error = "Invalid email or passwords do not match";
            }
        }
        header("Location: /forum/index.php?signup=false&errors=$error");
    }

?>