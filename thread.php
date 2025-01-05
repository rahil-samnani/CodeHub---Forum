<?php include "Partials/_dbconnect.php";
$id = $_GET['threadid'];
$sql = "SELECT * FROM `threads` WHERE thread_id=$id";
$result =  mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$title = $row['thread_title'];
$desc = $row['thread_desc'];
$user = $row['thread_user_id'];
$time = $row['timestamp'];

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CodeHub - <?php echo substr($title,0,20);?>...</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="/img/favicon.jpeg">
    <style>
        *{
            overflow-x:hidden;
        }
        h3,h1{
            overflow:hidden;
        }
    </style>
</head>

<body class="bg-black text-white" >
    <?php include "Partials/_header.php";
    $error = "";
    $show_alert = false;

    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true) {
        $comment_desc = $_POST['desc'];
        $comment_user_id = $_SESSION['username'];
        $thread_id = $id;

        $comment_desc = str_replace(">","&gt;",$comment_desc);
        $comment_desc = str_replace("<","&lt;",$comment_desc);
        $comment_desc = str_replace("'","\'",$comment_desc);
        $comment_desc = str_replace(" \" ","\"",$comment_desc);

        if ($comment_desc != "") {
            $sql = "INSERT INTO `thread_comments` (`comment_desc`, `thread_id`, `user_id`, `comment_time`) VALUES ('$comment_desc', '$id', '$comment_user_id', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $show_alert = true;
            } else {
                $error = " Failed to post your thread, try again!";
            }
        } else {
            $error = " One of the feild is left empty, try again.";
        }
    }
    ?>

    <div class="container my-4 bg-black text-white" style="min-height:45vh">
        <div class="jumbotron my-5">
            <div class="d-flex align-items-center" style="flex-wrap: wrap;">
                <img class="mx-3 align-self-center" src="img/Profile-Avatar-PNG.png" alt="Generic placeholder image" style="height:100px; min-width:100px;">
                <h3 class="display-7 fw-bold align-self-center mx-2 my-3 fs-2" style="min-width: 350px; overflow-y:hidden;"><?php echo $title; ?></h3>
            </div>
            <p class="lead my-2 px-4 py-3"><?php echo $desc; ?></p>
            <?php echo'<p class="lead my-2 px-4 py-3 fw-lighter fs-6">posted by : <b><a href="profile.php?username='.$user.'" class="text-decoration-none text-secondary">'.$user.'</a></b>'; ?>
                <br>
                posted on : <b> <?php echo $time; ?> </b>
            </p>
        </div>
    </div>

    <div class="container my-4 " style="min-height:23vh">
        <h1>Discussions</h1>

        <?php
        $sql = "SELECT * FROM `thread_comments` WHERE thread_id=$id";
        $result =  mysqli_query($conn, $sql);
        $noresult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noresult = false;
            $time = $row['comment_time'];
            $desc = $row['comment_desc'];
            $id = $row['comment_id'];
            $user_id = $row['user_id'];

            echo '<div class="media mt-5 d-flex border border-secondary p-2 align-items-center" style="border-radius:0 20px 0 0;">
                    <a href="#" style="width:100px;">
                        <img class="mx-3 align-self-center" src="img/Profile-Avatar-PNG.png" alt="Generic placeholder image" style="height:60px; width:60px;">
                    </a>
                    <div class="media-body mx-4" style="min-width:200px;>
                    <h5 class="mt-0"><a href="profile.php?username='.$user_id.'" class="text-decoration-none text-secondary">'.$user_id.'</a></h5>
                    <p class="lead px-3 fw-lighter fs-6 row">
                        @ : '. $time .'
                    </p>
                    </div>
                    </div>
                    <p class="lead mb-4 px-5 py-2 border border-secondary"  style="border-radius: 0 0 0 20px ;">' . $desc . '</p>
                    ';
        }
        if ($noresult) {
            echo '<div class="jumbotron my-5 jumbotron-fluid">
                    <div class="container">
                        <h4 class="display-6 fs-3 text-center" style="overflow:hidden">No Comments Yet!</h4>
                        <p class="lead text-center">Be the first one to reply to this thread.</p>
                    </div>
                    </div>';
        }
        ?>
    </div>

    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        echo '    <div class="container my-5 px-4 py-4" style="background-color:#111111; border-radius:20px; border:3px solid green; width:90%;">
        <h2 class="mb-3 text-center" style="margin-left:30px; overflow-y:hidden;">Post a reply</h2>
        <br>
        <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
            <div class="row my-3">
                <label for="desc" class="col-sm-3 col-form-label text-start fs-5" style="margin-left:60px;">write your reply here : </label>
                <div class="col-sm-8">
                    <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                </div>
            </div>
            <div class="d-grid gap-2 col-2 mx-auto " style="margin-top:30px; min-width:95px;">
                <button type="submit" class="btn btn-success btn-lg">Submit</button>
            </div>
        </form>
    </div>';
    }
    else {
        echo '<div class="container my-5 px-4 py-4 " style="background-color:#111111; border-radius:20px; border:3px solid green; width:90%;">
            <h2 class="mb-3 text-center" style="margin-left:30px; overflow-y:hidden;">Login to start the discussion.</h2>
            </div>';
    }

    ?>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <?php include "Partials/_footer.php" ?>
</body>

</html>