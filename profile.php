<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CodeHub - Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="/img/favicon.jpeg">
    <style>
        /* General Styling */

        .profile-page {
            width: 600px;
            padding: 20px;
            text-align: center;
            border: 1px solid #333333;
            border-radius: 10px;
        }

        /* Profile Header */
        .profile-header .profile-picture img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 2px solid #FFFFFF;
            margin-bottom: 10px;
        }

        .profile-header .username {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .profile-header .bio {
            font-size: 14px;
            color: #BBBBBB;
            margin-bottom: 20px;
        }

        /* User Info Section */
        .profile-info {
            margin-bottom: 20px;
        }

        .info-item {
            margin: 10px 0;
        }

        .label {
            font-weight: bold;
            color: #CCCCCC;
        }

        .value {
            color: #FFFFFF;
        }

        /* Statistics Section */
        .stats {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-top: 1px solid #333333;
            border-bottom: 1px solid #333333;
            margin-bottom: 20px;
        }

        .stat-item {
            text-align: center;
        }

        .stat-value {
            font-size: 18px;
            font-weight: bold;
        }

        .stat-label {
            font-size: 12px;
            color: #CCCCCC;
        }

        /* Footer with Buttons */
        footer {
            margin-top: 20px;
        }

        button {
            background-color: #666666;
            color: #FFFFFF;
            border: none;
            padding: 8px 16px;
            margin: 5px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        button:hover {
            background-color: #FFFFFF;
            color: #000000;
        }
    </style>
</head>

<body class="bg-black text-white">
    <?php include "Partials/_header.php"; ?>
    <?php include "Partials/_dbconnect.php";

    $username = $_GET['username'];
    $sql = "SELECT * FROM `users` WHERE username='$username'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);

    $sql = "SELECT * FROM `threads` WHERE thread_user_id='$username'";
    $result = mysqli_query($conn,$sql);
    $thread_no = mysqli_num_rows($result);

    $sql = "SELECT * FROM `thread_comments` WHERE user_id='$username'";
    $result = mysqli_query($conn,$sql);
    $comment_no = mysqli_num_rows($result);
    ?>

    <div class="container d-flex" style="min-height:80vh;">
        <div class="profile-page m-auto">
            <!-- Profile Header Section -->
            <div class="profile-header">
                <div class="profile-picture">
                    <img src="img/Profile-Avatar-PNG.png" alt="Profile Picture">
                </div>
                <div class="username"><?php echo $row['username']; ?></div>
                <div class="bio">Coding enthusiast and problem solver.</div>
            </div>

            <!-- User Info Section -->
            <div class="profile-info">
                <div class="info-item">
                    <span class="label">Email:</span>
                    <span class="value"><?php echo $row['email']; ?></span>
                </div>
                <div class="info-item">
                    <span class="label">Join Date:</span>
                    <span class="value"><?php echo $row['timestamp']; ?></span>
                </div>
            </div>

            <!-- Statistics Section -->
            <div class="stats">
                <div class="stat-item">
                    <span class="stat-value"><?php echo $thread_no; ?></span>
                    <span class="stat-label">Threads Posted</span>
                </div>
                <div class="stat-item">
                    <span class="stat-value"><?php echo $comment_no; ?></span>
                    <span class="stat-label">Comments Posted</span>
                </div>
                <div class="stat-item">
                    <span class="stat-value"><?php echo ($comment_no + $thread_no ) * 10; ?></span>
                    <span class="stat-label">Reputation Points</span>
                </div>
            </div>

            <!-- Footer with Buttons -->
            <footer>
                <button type="button" class="btn btn-outline-success mx-2">
                    <a class="text-light text-decoration-none">Edit Profile</a>
                </button>
                <button type="button" class="btn btn-outline-danger mx-2">
                    <a class="text-light text-decoration-none" href="Partials/_logout.php">Logout</a>
                </button>
            </footer>
        </div>
    </div>

    <?php include "Partials/_footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>