<?php
include "partials/header.php";
include "partials/dbconnect.php";
?>


<?php
    $id = $_GET['threadId'];
if($_SERVER['REQUEST_METHOD'] == "POST"){
    // $comment = str_replace("<", $comment, "&lt;");
    // $comment = str_replace(">", $comment, "&gt;");
    $comment = $_POST['comment'];

    $userId = $_POST['sn'];
    $sql = "INSERT INTO `coments` ( `coment_content`, `thread_id`, `coment_by`) VALUES ('$comment', '$id', '$userId')";
    $result = mysqli_query($connect ,$sql);
    if($result){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong me-1>Note!   </strong> Your comment has been submitted.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
        else{
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong me-1>Note!   </strong> Your comment has been not submitted due to some technical problems.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>'; 
        }
}

?>

<?php
// $id = $_GET['threadId'];
// $sql = "SELECT * FROM `coments` WHERE thread_id = $id";
// $result = mysqli_query($connect , $sql);
// while($data = mysqli_fetch_assoc($result)){
//     $thread_user_id = $data['coment_by'];
//     $sql2 = "SELECT user_name FROM `qlogin` WHERE user_id = $thread_user_id";
//     $result2 = mysqli_query($connect , $sql2);
//     $userName = mysqli_fetch_assoc($result2);
// }

    $user_id = $_SESSION['user_id'];
    $sql2 = "SELECT user_name FROM `qlogin` WHERE user_id = $user_id";
    $result2 = mysqli_query($connect , $sql2);
    while($data = mysqli_fetch_assoc($result2)){
        $userName = $data['user_name'];
    }

$id = $_GET['threadId'];
$sql = "SELECT * FROM `thread_record` WHERE thread_id = $id";
$result = mysqli_query($connect , $sql);
$noResult = true;
while($data = mysqli_fetch_assoc($result)){
    $threadTitle = $data['thread_title'];
    $threadDesc = $data['thread_desc'];

    $noResult = false;
    echo '<div class="container-fluid d-flex justify-content-center align-items-center mt-5">
    <div class="jumbotron bg-light " style="width:60vw";>
        <h1 class="display-4 me-4 ms-4 fs-3 fw-bold">'. $threadTitle.' forums</h1>
        <p class="lead me-4 ms-4">'. $threadDesc.'</p>
        <hr class="my-4  me-4 ms-4">
        <p class=" me-4 ms-4">This is peer to peer forum. You have every right to disagree with your fellow community members and explain
            your perspective. However, you are not free to attack, degrade, insult, or otherwise belittle them or the
            quality of this community. It does not matter what title or power you hold in these forums, you are expected
            to obey this rule.</p>
            <p class="fw-bold ms-4">Posted by : '. $userName .'  </p>
    </div>
</div>';
}
?>


<h2 class="text-center mt-5 mb-3">Post your comments</h2>

<?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){

    echo '<div class="container mb-5 d-flex flex-column justify-content-center align-items-center">
    <form class=" g-3" action="'. $_SERVER["REQUEST_URI"].'" method="post">
    
        <div class="col mb-5">
            <label for="exampleFormControlTextarea1" class="form-label fs-4 fw-bold">Ellaborate your concern</label>
            <textarea class="form-control fs-5" id="exampleFormControlTextarea1" rows="3"
            style="width:50vw; height:150px" name="comment" required></textarea>
        </div>
        
        <div class="col-12 mt-5">
        <button class="btn btn-primary" type="submit">Post Comment</button>
        <input type="hidden" name="sn" value="'.$_SESSION["user_id"].'">

        </div>
    </form>
</div>';
}      
else{
    echo '<div class="container text-center mt-5 mb-5">
    <p class="fs-5 mt-4 mb-0 fw-bold font-italic">Please login first to post your thread.</p>
</div>';
    echo '<div class="container mb-5 d-flex flex-column justify-content-center align-items-center">
    <form class=" g-3" action="'. $_SERVER['REQUEST_URI'].'" method="post">
        
        <div class="col mb-5">
            <label for="exampleFormControlTextarea1" class="form-label fs-4 fw-bold">Ellaborate your concern</label>
            <textarea class="form-control fs-5" id="exampleFormControlTextarea1" rows="3"
            style="width:50vw; height:150px" name="comment" required></textarea>
        </div>
        <input type="hidden" name="sn" value="'.$_SESSION["user_id"].'">
        
        <div class="col-12 mt-5">
        <button type="submit" class="btn btn-primary" disabled>Post Comment</button>

        </div>
    </form>
</div>';
}
?>



<h2 class="text-center mt-5 mb-3">Discussion</h2>



<div class="container-fluid">
<?php
$id = $_GET['threadId'];
$sql = "SELECT * FROM `coments` WHERE thread_id = $id";
$result = mysqli_query($connect , $sql);
$noResult = true;
while($data = mysqli_fetch_assoc($result)){
    $comment = $data['coment_content'];
    $commentBy = $data['coment_by'];
    $commentTime = $data['coment_time'];
    $noResult = false;

    $thread_user_id = $data['coment_by'];
    $sql2 = "SELECT user_name FROM `qlogin` WHERE user_id = $thread_user_id";
    $result2 = mysqli_query($connect , $sql2);
    $userName = mysqli_fetch_assoc($result2);

    echo '
    <div class="media  d-flex mt-5 col-12 bg-light">
    <img src="image/profile.png" height="60px" ; class="mr-3 rounded-circle d-inline ms-4" alt="Profile">
    <div class="media-body ms-5 ">
    <p class="mb-0 fs-5">'. $comment .'</p>
    <div class="container d-flex flex-row justify-content-between">
    <p class="mt-1 fs-6 fw-light mb-0 position-relative"> Posted by '. $userName['user_name'].'</p>
    <span class="mt-1 fs-6 fw-light ms-0 position-relative start-40" > '.$commentTime .'</span>
    </div>
    </div>
    </div>';
}
?>
</div>



<div class="container-fluid " style="min-height:300px;">
 <?php
if($noResult){
    echo '<div class="jumbotron jumbotron-fluid bg-light col-12 " style="min-height:150px;">
    <div class="container d- flex justify-content-center align-items-center">
    <h1 class="display-4 fs-5 fw-bold">No Result Found.</h1>
    <p class="lead">Be the first person to solve this problem.</p>
    </div>
    </div>';
}
?>
</div>



<?php
include "partials/footer.php";
?>