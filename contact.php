
    <?php
    include 'partials/header.php';
    ?>


    <h2 class="text-center mt-5">QCode - Contact Us</h2>
    <div class="container-fluid d-flex flex-column justify-content-center align-items-center" style="height:75vh;">
        <div class="mb-5">
            <label for="exampleFormControlInput1" class="form-label fs-4 fw-bold">Email address</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" style="width:50vw;">
        </div>
        <div class="mb-5">
            <label for="exampleFormControlTextarea1" class="form-label fs-4 fw-bold">Roport Bugs</label>
            <textarea class="form-control fs-5" id="exampleFormControlTextarea1" rows="3" style="width:50vw; height:150px"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>

    </div>
    <?php
    include 'partials/footer.php';
    ?>
