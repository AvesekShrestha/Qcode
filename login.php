<?php include 'partials/header.php';?>

<?php

include "partials/dbconnect.php";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $userEmail = $_POST['userEmail'];
    $userPassword = $_POST['userPassword'];
    
    $existSql = "SELECT * FROM `qlogin` WHERE email = '$userEmail'";
    $existResult = mysqli_query($connect, $existSql);
    $existRow = mysqli_num_rows($existResult);
    
    if($existRow == 1){
        while($num = mysqli_fetch_assoc($existResult)){
            if(password_verify($userPassword , $num['password'])){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong me-1>Note!   </strong> Login Successfull.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                //   session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['userEmail'] = $userEmail;
                $_SESSION['user_id'] = $num['user_id'];
                header("location:index.php?loggin=true");
                
            }
            else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong me-1>Note!   </strong>  Invalid Credentials.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                
            }
        }
    }
    else{
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong me-1>Note!   </strong>   Invalid Credentials.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';  
    }
    
}




?>
<h2 class="text-center mt-5">QCode - Login</h2>

<div class="container-fluid d-flex flex-column justify-content-center align-items-center " style="height:70vh">
    <form class=" g-3" action= "login.php" method="post" >

        <div class="col ">
            <label for="validationDefaultUsername" class="form-label fs-4 fw-bold">Email address</label>
            <div class="input-group">
                <span class="input-group-text" id="inputGroupPrepend2">@</span>
                <input type="email" class="form-control" id="validationDefaultUsername"
                    aria-describedby="inputGroupPrepend2" style="width:40vw" ; name="userEmail" required>
            </div>
        </div>


        <div class="col mt-5 ">
            <label for="validationDefault01" class="form-label fs-4 fw-bold">Password</label>
            <input type="password" class="form-control" id="validationDefault01" name="userPassword" required>
        </div>

        <div class="col-12 mt-5">
            <button class="btn btn-primary" type="submit">Login</button>
        </div>
    </form>
</div>
<?php include "partials/footer.php"; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
</script>
</body>

</html>