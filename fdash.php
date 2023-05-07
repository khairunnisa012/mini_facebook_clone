<?php
session_start();

if ($_SESSION["email"]) {
    $name = $_SESSION["name_"];
    ?>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="./images/logo.png" type="image/x-icon">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
            integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="style.css">
        <title>FaceBook</title>
    </head>

    <body>
        <nav>
            <div class="nav-left">
                <img src="logo.png" alt="Logo">
                <input type="text" placeholder="Search FACEBOOK...">
            </div>

            <div class="nav-middle">
                <a href="#" class="active">
                    <i class="fa fa-home"></i>
                </a>

                <a href="#">
                    <i class="fa fa-user-friends"></i>
                </a>

                <a href="#">
                    <i class="fa fa-play-circle"></i>
                </a>

                <a href="#">
                    <i class="fa fa-users"></i>
                </a>
            </div>

            <div class="nav-right"><p> &nbsp &nbsp</p>
            <a href="flogout.php">
                <br><br><p>LOGOUT</p> 
                <i class="fa fa-sign-out"></i>
                </a>
            </div>
        </nav>


        <div class="container">
            <div class="left-panel">
                <ul>
                    <li>

                        <p>Welcome
                            <?php echo $_SESSION["name_"]; ?>
                        </p>
                    </li>
                    <li>
                        <i class="fa fa-user-friends"></i>
                        <p>Friends</p>
                    </li>
                    <li>
                        <i class="fab fa-facebook-messenger"></i>
                        <p>Inbox</p>
                    </li>
                    <li>
                        <i class="fas fa-calendar-week"></i>
                        <p>Events</p>
                    </li>
                    <li>
                        <i class="fas fa-briefcase"></i>
                        <p>Jobs</p>
                    </li>
                    <li>
                        <i class="fa fa-star"></i>
                        <p>Favourites</p>
                    </li>
                </ul>

                <div class="footer-links">
                    <a href="#">Privacy</a>
                    <a href="#">Terms</a>
                    <a href="#">Advance</a>
                    <a href="#">More</a>
                </div>
            </div>

            <div class="middle-panel">
                <div class="post create">
                    <div class="post-top">

                        <input type="text" placeholder="What's on your mind ,<?php echo $_SESSION["name_"]; ?> ?" />
                    </div>

                    <div class="post-bottom">
                        <div class="action">
                            <i class="fa fa-video"></i>
                            <span>Live video</span>
                        </div>
                        <div class="action">
                            <a style="text-decoration:none; color:#d74" href="uploads.html">
                                <i class="fa fa-image"></i>
                                <span>Photo/Video</span></a>
                        </div>
                        <div class="action">
                            <i class="fa fa-smile"></i>
                            <span>Feeling/Activity</span>
                        </div>
                    </div>
                </div>
                <?php
                 $host = 'localhost';
                 $username = 'root';
                 $password = '';
                 $dbname = 'fb';
                 $name=$_SESSION['name_'];
                $conn = mysqli_connect("localhost", "root", "", "fb");
                $sql = "Select * from uploads order by likes desc";
                $conn = mysqli_connect($host, $username, $password, $dbname);
                $result = $conn->query($sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($rows = $result->fetch_assoc()) {
                        $x= $rows["path"];
                        $y="";
                        $a=mysqli_query($conn,"select * from liking where name='$name' and url='$x'");
                        $_SESSION["addr"]=$x;
                        if(mysqli_num_rows($a) > 0){$y='like.png';}
                        else{$y='nolike.png';}
                        ?>
                        <div class="post">
                            <div class="post-top">
                                <div class="post-info">
                                    <p class="name">
                                        <?php echo $rows['id']; ?>
                                    </p>
                                    <span class="time">
                                        <?php echo time() - $rows['po_time'] . "secs"; ?>
                                    </span>
                                </div>
                                <i class="fas fa-ellipsis-h"></i>
                            </div>

                            <div class="post-content">
                                <img src="<?php echo $rows["path"]; ?>" />
                            </div>

                            <div class="post-bottom">
                                <div class="action">
                                <?php echo "<br><form action='likes.php' method='post'><input type='image'class='img' src='$y' name='submit'><label for='like' class='likes'>{$rows['likes']}</label><input type='text1' id='url' name='url' value='$x'></form><br>"; ?>
                                </div>
                                <div class="action">
                                    <i class="far fa-comment"></i>
                                    <span>Comment</span>
                                    <?php echo "<br><form action='comments.php' method='post'><input type='submit' class='cm' name='submit' placeholder='Comment Here...' ><input type='text1' id='url' name='url' value='$x'></form>"; ?>
                                </div>
                                <div class="action">
                                    <i class="fa fa-share"></i>
                                    <span>Share</span>
                                </div>
                            </div>
                    </div>

                    <?php
                    }

                } else {
                    echo "No records found.";
                } ?>
</body>


           
            <?php
} else {
    echo "<h1>Please Login first. </h1>";
}

?>

        <style>
            input[type="text1"] {
                visibility: hidden;
            }

            .cm {
                position: relative;
                width: 50px;
                height: 20px;
            }

            .img {
                height: 40px;
                width: 40px;
            }

            .likes {
                color: black;
                font: 15px;
            }
        </style>