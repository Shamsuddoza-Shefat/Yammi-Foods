<?php

include "./Include/DashBoardHeader.php";
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-xl-4 mb-6">
            <div class="card">
                <form action="../controller/Bannerstore.php" enctype="multipart/form-data" method="POST">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Add Banner</h5>
                        <button class="btn btn-primary">Store</button>
                    </div>
                    <div class="card-body">
                        <input type="text" name="title" class="form-control my-2" placeholder="Banner Title">
                        <span class="text-danger"><?= $_SESSION["errors"]["title_error"] ?? null ?></span>
                        <textarea name="detail" class="form-control my-2" placeholder="Banner Detail"></textarea>
                        <span class="text-danger"><?= $_SESSION["errors"]["detail_error"] ?? null ?></span>
                        <input name="ctaTitle" type="text" class="form-control my-2" placeholder="Cta Title">
                        <input name="ctaLink" type="text" class="form-control my-2" placeholder="Cta Link">
                        <input name="videoLink" type="text" class="form-control my-2" placeholder="Video Link">
                        <label for="" class="d-block">
                            Banner Image
                            <input name="bannerImage" type="file" class="form-control my-2">
                        </label>
                        <span class="text-danger"><?= $_SESSION["errors"]["bannerImage_error"] ?? null ?></span>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-xl-8 mb-6">
            <div class="card">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>#</th>
                            <th>Banner Title</th>
                            <th>Cta</th>
                            <th>Video</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td>#</td>
                            <td>Banner Title</td>
                            <td>Cta</td>
                            <td>Video</td>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

include "./Include/DashBoardFooter.php";
?>

<?php

if(isset($_SESSION['success'])){
?>


<script>
    Toast.fire({
  icon: "success",
  title: "Banner Store successfully"
});
</script>



<?php
}

unset($_SESSION['errors']);