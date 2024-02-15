<?php
include('header.php');
require('fonctions.php');

$comptePage = "compteInfo.php";
// Recuperer les informations d'un(e) personnel
if ($currentUser == "utilisateur") {
    $userInfo = getPersoById($currentUserID);
}
?>

<?php if ($userMail) : ?>
    <div class="compt_info" style="min-height: 79vh">
        <div class="container">
            <div class="main-body">
                <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">
                        <div class="card cards">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <div class="profilepic">
                                        <form action="" method="post" id="img_form" enctype="multipart/form-data">
                                            <img src="./uploads/user_avat.png" alt="photo profile" class="profilepic_image" />
                                            <label for="chose_img" class="profilepic_content">
                                                <span class="profilepic_icon"><i class="fas fa-camera"></i></span>
                                                <h6 class="profilepic_text">Profile </h6>
                                            </label>
                                        </form>
                                    </div>
                                    <div class="mt-3">
                                        <h4><?= ($currentUserID) ? ($userInfo['email']) : "" ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
<?php else : require('errorPage.php');
endif; ?>