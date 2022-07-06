<?php include "partials/header.php";
      include "partials/dbconnect.php";

?>

<!-- slider -->
<div id="carouselExampleControls" class="carousel slide mb-5" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://source.unsplash.com/2500x500/?coding,c++,c#" class="d-block w-100" alt="Image 1">
        </div>
        <div class="carousel-item">
            <img src="https://source.unsplash.com/2500x500/?coding,html,webdevelopment" class="d-block w-100"
                alt="Image 2">
        </div>
        <div class="carousel-item">
            <img src="https://source.unsplash.com/2500x500/?coding,python,apple,javascript" class="d-block w-100"
                alt="Image 3">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>


<h2 class="text-center mt-5">QCode - Categories</h2>

<!-- categories content -->
<div class="container-fluid d-flex flex-row flex-wrap justify-content-center align-items-center">
<?php
$sql = "SELECT * FROM `categories`";
$result = mysqli_query($connect , $sql);

while($data = mysqli_fetch_assoc($result)){
   echo ' <div class="card m-5" style="width: 18rem;">
   <img src="https://source.unsplash.com/500x400/?coding,'.$data['categorie_name'].',code" class="card-img-top" alt="Image">
   <div class="card-body">
       <h5 class="card-title"><a href="threadlist.php?id='.$data['categorie_id'].' " class="text-decoration-none">' .$data['categorie_name'].' </a></h5>
       <p class="card-text">'. substr( $data['categorie_disc'],0 ,100).'...</p>
       <a href="threadlist.php?id='.$data['categorie_id'].'" class="btn btn-primary">View Threads</a>
   </div>
</div>'; 
}
?>

</div>

<?php include "partials/footer.php"; ?>