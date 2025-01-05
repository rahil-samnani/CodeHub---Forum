<?php
include "Partials/_dbconnect.php";

$id = $_GET['catid'];
$sql = "SELECT * FROM `categories` WHERE category_id=$id";
$result =  mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$catname = $row['category_name'];
$catdesc = $row['category_desc'];

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CodeHub - <?php echo $catname ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="/img/favicon.jpeg">
</head>

<body class="bg-black text-white">
    <?php include "Partials/_header.php";

    $error = "";
    $show_alert = false;

    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true) {
        $thread_title = $_POST['title'];
        $thread_desc = $_POST['desc'];
        $user_id = $_SESSION['username'];
        $thread_category_id = $id;

        $thread_title = str_replace(">","&gt;",$thread_title);
        $thread_title = str_replace("<","&lt;",$thread_title);
        $thread_title = str_replace("'","\'",$thread_title);
        $thread_title = str_replace(" \" ","\"",$thread_title);

        $thread_desc = str_replace(">","&gt;",$thread_desc);
        $thread_desc = str_replace("<","&lt;",$thread_desc);
        $thread_desc = str_replace("'","\'",$thread_desc);
        $thread_desc = str_replace(" \" ","\"",$thread_desc);

        if ($thread_title != "" && $thread_desc != "") {
            $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$thread_title', '$thread_desc', '$thread_category_id', '$user_id', current_timestamp())";
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


    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="check-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </symbol>
        <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </symbol>
    </svg>

    <?php
    if ($show_alert) {
        echo '<div class="alert alert-dark alert-dismissible fade show" role="alert">
                    <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Success:" style="height:18px; width:20px;">
                        <use xlink:href="#check-circle-fill" />
                    </svg>
                    <strong>Success!</strong> wait while our community responds to your thread.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    }
    if ($error != "") {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Warning:"  style="height:18px; width:20px;">
                        <use xlink:href="#exclamation-triangle-fill"/>
                    </svg>
                    <strong>oh oh!</strong>' . $error . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    }
    ?>

    <div class="container my-4 bg-black text-white">
        <div class="jumbotron my-5">
            <h1 class="display-4">Welcome to <?php echo $catname; ?> Forum</h1>
            <p class="lead"><?php echo $catdesc; ?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum for sharing Knowledge with each other, Don not use any language\images\symbols that might hurt the feeling of others.</p>
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div>

    <div class="container" style="min-height:45vh;">
        <h2 class="py-3">Browse Questions</h2>
        <?php
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
        $result =  mysqli_query($conn, $sql);
        $noresult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noresult = false;
            $user_id = $row['thread_user_id'];
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $id = $row['thread_id'];
            $time = $row['timestamp'];
            echo '<div class="media my-5 d-flex">
                    <a href="thread.php?threadid=' . $id . '"><img class="mx-3 align-self-center" src="img/Profile-Avatar-PNG.png" alt="Generic placeholder image" style="height:60px; width:60px;"></a>
                    <div class="media-body">
                    <h5 class="mt-0"><a href="thread.php?threadid=' . $id . '" class="text-decoration-none text-secondary">' . $title . '</a></h5>
                    ' . $user_id . ' @ ' . $time . '
                    </div>
                    </div>';
        }
        if ($noresult) {
            echo '<div class="jumbotron my-5 jumbotron-fluid">
                    <div class="container">
                        <h4 class="display-6 fs-3 text-center">No Questions Yet!</h4>
                        <p class="lead text-center">Be the first one to ask a question.</p>
                    </div>
                    </div>';
        }
        ?>
    </div>

    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        echo '<div class="container my-4 px-4 py-4" style="background-color:#111111; border-radius:20px; border:3px solid green; width:90%;">
            <h2 class="mb-3 text-center" style="margin-left:30px">Ask a Question</h2>
            <br>
            <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
                <div class="row my-3">
                    <label for="title" class="col-sm-3 col-form-label text-start fs-5" style="margin-left:60px">Thread Title : </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="title" name="title">
                    </div>
                </div>
                <div class="row my-3">
                    <label for="desc" class="col-sm-3 col-form-label text-start fs-5" style="margin-left:60px">Ellaborate your query : </label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                    </div>
                </div>
                <div class="d-grid gap-2 col-2 mx-auto " style="margin-top:30px;">
                    <button type="submit" class="btn btn-success btn-lg">Submit</button>
                </div>


            </form>
        </div>';
    } else {
        echo '<div class="container my-4 px-4 py-4" style="background-color:#111111; border-radius:20px; border:3px solid green; width:90%;">
            <h2 class="mb-3 text-center" style="margin-left:30px">Login to post a thread.</h2>
            </div>';
    }

    ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <?php include "Partials/_footer.php" ?>
</body>

</html>