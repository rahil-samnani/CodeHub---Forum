<?php 
    session_start();
    echo "Logging you out...";
    session_destroy();

    header("Location: /forum/index.php");
    exit();

?>