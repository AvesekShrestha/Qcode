<?php include "partials/header.php";
      include "partials/dbconnect.php";
?>

<h2 class="mt-5 text-center">Search results for '<?php echo $_GET['search'];?>'</h2>
<div class="container-fluid d-flex  flex-column ps-5 pe-5"  style="min-height:700px;" >

    <?php
    $searchContent = $_GET['search'];
    $sql = "SELECT * FROM `thread_record` WHERE MATCH (thread_title , thread_desc) against ('$searchContent')";
    $result = mysqli_query($connect , $sql);
    $resultfound = false;
    while($data = mysqli_fetch_assoc($result)){
    $title = $data['thread_title'];
    $desc = $data['thread_desc'];
    $threadId = $data['thread_id'];
    $resultfound = true;
    $url = "thread.php?threadId='.$threadId.'";
    echo '<div class="result mt-5" style="width:85vw;">
                <h4 class="text-dark text-decoration-none"><a class="text-dark text-decoration-none" href="'.$url.'">'.$title.'</a></h4>
                <p>'. $desc.'</p>
        </div>';
}
if(!$resultfound){
        echo '<div class="jumbotron jumbotron-fluid bg-light col-12 mt-5 " style="min-height:250px;">
        <div class="container d- flex justify-content-center align-items-center">
        <h1 class="display-4 fs-5 fw-bold">No Result Found.</h1>
        <p class="lead">Suggestions:</p>
        <li>Make sure that all words are spelled correctly.</li>
        <li>Try different keywords.</li>
        <li>Try more general keywords.</li>
        </div>
        </div>';
}

    ?>


</div>
<?php include "partials/footer.php"; ?>