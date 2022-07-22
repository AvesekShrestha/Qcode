<?php
session_start();
$loggedin = false;
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    $loggedin = true;
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QCode - Discuss your problem here.</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Titan+One&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/5746d65231.js" crossorigin="anonymous"></script>

</head>

<body>

    <div class="container-fluid">

        <nav class="navbar navbar-expand-lg bg-light">
            <a class="navbar-brand fs-3" href="index.php" style="font-family: Titan One, cursive;">QCode</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item ms-5 ms-4">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item ms-5 ms-4">
                        <a class="nav-link" href="about.php">About</a>
                    </li>

                    <li class="nav-item ms-5 ms-4">
                        <a class="nav-link" href="blogs.php">Blogs</a>
                    </li>

                    <li class="nav-item ms-5 ms-4">
                        <a class="nav-link" href="contact.php">Contact Us</a>
                    </li>

                </ul>

                <?php
                if(!$loggedin){

                    echo '
                    <form class="d-flex" role="search" action="search.php" method="get">
                    <input class="form-control me-2" type="search" placeholder="Search" name="search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit" >Search</button>
                    </form>
                    <a href="signup.php"> <button class="btn btn-primary me-4 w-10 ms-4" type="submit">SignUp</button></a>
                    <a href="login.php"><button class="btn btn-primary me-4" type="submit">Login</button></a>';
                }
                else{
                    echo '
                    <form class="d-flex" role="search" action="search.php" method="get">
                    <input class="form-control me-2" type="search" placeholder="Search" name="search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit" >Search</button>
                    </form>
                    <a href="logout.php"><button class="btn btn-primary ms-4 me-4" type="submit">Logout</button></a>';
                }
                ?>


            </div>
        </nav>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>