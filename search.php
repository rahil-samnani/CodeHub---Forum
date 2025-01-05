<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CodeHub - search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="/img/favicon.jpeg">
</head>

<body class="bg-black text-white">
    <?php include "Partials/_header.php"; ?>
    <?php include "Partials/_dbconnect.php"; 
    $query = $_GET['query'];

    $query = str_replace(">","&gt;",$query);
    $query = str_replace("<","&lt;",$query);
    $query = str_replace("'","\'",$query);
    $query = str_replace(" \" ","\"",$query);
    ?>


    <div class="list-group container" style="min-height:80vh;">
        <h2 class="fw-light my-4">Showing results for "<em><?php echo $query; ?></em>"</h2>

        <?php

            $sql = "SELECT * FROM threads WHERE MATCH(thread_title, thread_desc) AGAINST ('$query' IN BOOLEAN MODE)";
            $result = mysqli_query($conn,$sql);
            $num_row = mysqli_num_rows($result);
            if($num_row > 0){
                while($row = mysqli_fetch_assoc($result)){
                    echo'<a href="thread.php?threadid='.$row['thread_id'].'" class="list-group-item list-group-item-action py-3 px-4  bg-black text-white">
                            <div class="d-flex w-100 justify-content-between">
                                <h4 class="mb-1 text-secondary">'.$row['thread_title'].'</h4>
                                <small>Posted by: '.$row['thread_user_id'].' @ '.$row['timestamp'].'</small>
                            </div>
                             <p class="mb-1">'.$row['thread_desc'].'</p>
                        </a>';
                }
            }
            else{
                echo '<div class="jumbotron my-5 jumbotron-fluid">
                <div class="container">
                    <h3 class="display-4 fs-2 text-center">No results found!</h3>
                    <p class="lead text-center">Try a different keyword.</p>
                </div>
                </div>';
            }
        ?>
    </div>


    <?php include "Partials/_footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>