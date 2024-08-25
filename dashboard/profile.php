<?php

  include "./include/DashboardHeader.php" ;
?>
              
              
      <div class="row">

      <div class="col-lg-8">
        <div class="card shadow">
           <form enctype="multipart/form-data" action="../controller/ProfileUpdate.php" method="POST">
           <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Profile</h4>
            <button class="btn btn-primary">Update Profile</button>
           </div>
            <div class="card-body">
                
                <div class="row align-items-center">
                    <div class="col-lg-2">
                        
                        <label for="avatar">
                                <img src="<?= getProfileImg() ?>" alt="" class="rounded-circle w-100 profileImage">
                        </label>
                         <input accept=".jpg,.png,.svg" type="file" id="avatar"  class="d-none" name="profileImage">
                    </div>
                    <div class="col-lg-9">
                        <input type="text" name="name" class="form-control my-2" value="<?= $_SESSION['auth']['name'] ?>" placeholder="Your Name">
                        <span class="text-danger"><?= $_SESSION['errors']['name_error'] ?? null ?></span>
                        <input type="text" name="email" class="form-control my-2" value="<?= $_SESSION['auth']['email'] ?>" placeholder="Your Email">
                        <span class="text-danger"><?= $_SESSION['errors']['email_error'] ?? null ?></span>
                        <span class="text-danger"><?= $_SESSION['errors']['profileImage_error'] ?? null ?></span>
                    </div>
                </div>

            </div>
           </form>
        </div>
      </div>
      <div class="col-lg-4">
      <div class="card shadow">
            <form action=" ../controller/UpdatePassword.php" method="POST">
                <h3 class="card-header">Update Password</h3>
                <div class="card-body">
                    <input type="password" name="old_password" class="form-control my-2" placeholder="Enter old password">
                    <span class="text-danger"><?= $_SESSION['errors']['old_password_error'] ?? null ?></span>
                    <input type="password" name="new_password" class="form-control my-2" placeholder="Enter new password">
                    <span class="text-danger"><?= $_SESSION['errors']['new_password_error'] ?? null ?></span>
                    <input type="password" name="confirm_password" class="form-control my-2" placeholder="Confirm password">
                    <span class="text-danger"><?= $_SESSION['errors']['confirm_password_error'] ?? null ?></span>
                    <button class="btn btn-primary">Update Password</button>
                </div>
            </form>
                
            </div>
        </div>
      </div>


      </div>




<?php

include "./include/DashboardFooter.php" ;
?>

<script>

    const inputImage = document.querySelector('#avatar')
    const profileImage = document.querySelector('.profileImage')

    function changeProfileImage(event) {
        
        profileImage.src = URL.createObjectURL(event.target.files[0])
        
    }

    inputImage.addEventListener('change', changeProfileImage)



    // const changeProfileImage = () => {}
</script>

<?php

if(isset($_SESSION['success'])){
?>


<script>
    Toast.fire({
  icon: "success",
  title: "Profile Updated successfully"
});
</script>



<?php
}

unset($_SESSION['errors']);
unset($_SESSION['success']);