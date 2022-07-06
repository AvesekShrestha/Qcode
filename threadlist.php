<?php
include "partials/header.php";
include "partials/dbconnect.php";

$id = $_GET['id'];
$sql = "SELECT * FROM `categories` WHERE categorie_id = $id";
$result = mysqli_query($connect , $sql);
while($data = mysqli_fetch_assoc($result)){
    $catName = $data['categorie_name'];
    $catDisc = $data['categorie_disc'];
}

?>



<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
$problemTitle = $_POST['problemTitle'];
// $problemTitle = str_replace("<" ,"&lt", $problemTitle);
// $problemTitle = str_replace(">" ,"&gt" , $problemTitle);
$problemDesc = $_POST['titleDesc'];
// $problemDesc = str_replace("<", "&lt", $problemDesc);
// $problemDesc = str_replace(">", "&gt", $problemDesc);
$userId = $_POST['sn'];

$sql = "INSERT INTO `thread_record` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`) VALUES ('$problemTitle', '$problemDesc', '$id', '$userId')";
$result = mysqli_query($connect, $sql);
if($result){
echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
<strong me-1>Note!   </strong> Your thread has been submitted. Please wait for commity to respond.
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
else{
echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong me-1>Note!   </strong> Your thread has been not submitted due to some technical problems.
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>'; 
}
}
?>

<div class="container-fluid d-flex justify-content-center align-items-center mt-5">
    <div class="jumbotron bg-light " style="width:60vw" ;>
        <h1 class="display-4 me-4 ms-4 fs-3 fw-bold">Welcome to <?php echo $catName;?> forums</h1>
        <p class="lead me-4 ms-4"><?php echo $catDisc; ?></p>
        <hr class="my-4  me-4 ms-4">
        <p class=" me-4 ms-4">This is peer to peer forum. You have every right to disagree with your fellow community
            members and explain
            your perspective. However, you are not free to attack, degrade, insult, or otherwise belittle them or the
            quality of this community. It does not matter what title or power you hold in these forums, you are expected
            to obey this rule.</p>
    </div>
</div>

<h2 class="text-center mt-5 mb-3">Browse Question</h2>
<hr>

<?php
$sql2 = "SELECT * FROM `thread_record` WHERE thread_cat_id =$id";
$result = mysqli_query($connect , $sql2);
$noResult = true;
while($data = mysqli_fetch_assoc($result)){
    $threadTitle = $data['thread_title'];
    $threadDesc = $data['thread_desc'];
    $threadId = $data['thread_id'];
    $threadTime = $data['timestamp'];
    $thread_user_id = $data['thread_user_id'];

    $noResult = false;

    $sql3 = "SELECT user_name FROM `qlogin` WHERE user_id = $thread_user_id";
    $result2 = mysqli_query($connect , $sql3);
    $userName = mysqli_fetch_assoc($result2);



    echo '
    <div class="media  d-flex mt-5 col bg-light" style="min-width:90vw";>
    <img src="image/profile.png" height="60px" ; class="mr-3 rounded-circle d-inline ms-4" alt="Profile">
    <div class="media-body ms-5 col">
    <h5 class="mt-0 " > <a class="text-decoration-none text-dark" href="thread.php?threadId='.$threadId.'" >'.$threadTitle.'</a></h5>
    <p class="mb-0  fs-6">'. $threadDesc .'</p>
    <div class="container d-flex flex-row justify-content-between">
    <p class="mt-1 fs-6 fw-light mb-0 position-relative"> Posted by '. $userName['user_name'].'</p>
    <span class="mt-1 fs-6 fw-light ms-0 position-relative start-40" > '.$threadTime .'</span>
    </div>
    </div>
    </div>';
    
}
?>
<h2 class="text-center mt-5 mb-3">Start a Discussion</h2>

<?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    
    echo '<div class="container-fluid d-flex flex-column" style="min-height:300px" ;>
    <div class="container mb-5 d-flex flex-column justify-content-center align-items-center">
        <form class=" g-3" action="'.$_SERVER["REQUEST_URI"].'" method="post">
    
    
            <div class="col mt-5 ">
                <label for="validationDefault01" class="form-label fs-4 fw-bold">Problem Title</label>
                <input type="text" class="form-control mb-5" id="validationDefault01" name="problemTitle" required>
            </div>
    
            <div class="col mb-5">
                <label for="exampleFormControlTextarea1" class="form-label fs-4 fw-bold">Ellaborate your concern</label>
                <textarea class="form-control fs-5" id="exampleFormControlTextarea1" rows="3"
                    style="width:50vw; height:150px" name="titleDesc" required></textarea>
            </div>
            <input type="hidden" name="sn" value="'.$_SESSION["user_id"].'">
            <div class="col-12 mt-5">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
    
        </form>
    </div>
    </div>';
}
else{
    echo '<div class="container text-center">
    <p class="fs-5 mt-4 mb-0 fw-bold font-italic">Please login first to post your thread.</p>
</div>';
    echo '<div class="container-fluid d-flex flex-column" style="min-height:300px" ;>
    <div class="container mb-5 d-flex flex-column justify-content-center align-items-center">
        <form class=" g-3" action="'.$_SERVER["REQUEST_URI"].'" method="post">
    
    
            <div class="col mt-5 ">
                <label for="validationDefault01" class="form-label fs-4 fw-bold">Problem Title</label>
                <input type="text" class="form-control mb-5" id="validationDefault01" name="problemTitle" required>
            </div>
    
            <div class="col mb-5">
                <label for="exampleFormControlTextarea1" class="form-label fs-4 fw-bold">Ellaborate your concern</label>
                <textarea class="form-control fs-5" id="exampleFormControlTextarea1" rows="3"
                    style="width:50vw; height:150px" name="titleDesc" required></textarea>
            </div>
    
            <div class="col-12 mt-5">
            <button type="submit" class="btn btn-primary" disabled>Submit</button>

            </div>
    
        </form>
    </div>
    </div>';

}
?>


<?php
if($noResult){
    echo '<div class="jumbotron jumbotron-fluid bg-light col-12  d-flex justify-content-center align-items-center flex-column" style="min-height:150px;">
    <div class="container d-flex justify-content-center align-items-center flex-column mt-5">
    <h1 class="display-4 fs-5 fw-bold">No Threads Found.</h1>
    <p class="lead">Be the first person to ask the question.</p>
    </div>
    </div>';
}
?>
</div>
<?php
include "partials/footer.php";
?>