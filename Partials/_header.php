<nav class="navbar navbar-expand-lg bg-black ">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="img/codehub_logo.png" alt="logo" style="width: 170px; height:47px; border: 2px solid black; border-radius: 10px">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item mx-2">
                    <a class="nav-link active  text-light " aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link text-light" href="#">About</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link text-light" href="#">Contact us</a>
                </li>
                <?php
                session_start();
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                    echo '<li class="nav-item mx-2">
                            <a class="nav-link text-light" href="/forum/profile.php">Profile</a>
                            </li>';
                }
                ?>
            </ul>
            <form class="d-flex" role="search" action="/forum/search.php?query=query">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
                <button class="btn btn-success" type="submit">Search</button>
            </form>
            <?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                echo ' <button type="button" class="btn btn-outline-danger mx-2">
                            <a class="text-danger text-decoration-none" href="Partials/_logout.php">Logout</a>
                        </button>';
            } else {
                echo '<form action="" class="d-flex">
                        <button type="button" class="btn btn-outline-success mx-2"  data-bs-toggle="modal" data-bs-target="#loginmodal">
                            Login
                        </button>
                        <button type="button" class="btn btn-outline-success " data-bs-toggle="modal" data-bs-target="#signupmodal">
                            Sign up
                        </button>
                        </form>';
            }
            ?>

        </div>
    </div>
</nav>
<?php include "Partials/_login.php"; ?>
<?php include "Partials/_signup.php"; ?>
<?php
if (isset($_GET['signup']) && $_GET['signup'] == "true") {
    echo '<div class="my-0 alert alert-dark alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> You have Signed up Successfuly, you can now login.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
}
if (isset($_GET['errors'])  && $_GET['errors'] != "") {
    echo '<div class="my-0 alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>oh oh!</strong>' . $_GET['errors'] . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
}

?>