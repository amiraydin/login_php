<?php
// session_start();
// require_once("inc/req.php");
// phpinfo();
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
include('header.php');
require('loginControl.php');
$bgLogin = "./uploads/bgLogin.jpg";


?>
<section style="min-height: 79vh">
    <?php if ($bgLogin == "bgLogin.jpg") : ?>
        <img class="img-fluid back_image" src="./uploads/<?= $bgLogin ?>" alt="back_login">
    <?php endif; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 text-black position-absolute" style="top: 15%; right: 1%">
                <div class="px-5 ms-xl-4">
                    <img src="./uploads/logo.png" alt="logo" class="img-fluid" style="max-width: 20%;">
                </div>
                <div class="d-flex align-items-center h-custom-2 p-3">
                    <form action="" class="m-auto col-sm-8" method="post" enctype="multipart/form-data">
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3mail">Adresse email </label>
                            <input type="email" name="logEmail" required autocomplete="off" id="form3mail" class="form-control col-md-4" placeholder="Entrez votre adresse mail " />
                        </div>
                        <div class="form-outline mb-3 position-relative">
                            <label class="form-label" for="passinput">Mot de passe</label>
                            <input id="passinput" type="password" required autocomplete="off" name="logPasse" class="form-control col-md-4" placeholder="Entrez votre mot de passe" />
                            <span><i id="togeye" class="fas fa-eye-slash position-absolute top-50 end-0 p-2 pe-3" role="button"></i></span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="form-check mb-0">
                                <input class="form-check-input me-2" type="checkbox" value="" id="se_souvenir" />
                                <label class="form-check-label" for="se_souvenir">
                                    Se souvenir de moi
                                </label>
                            </div>
                            <a href="#!" class="text-decoration-none text-body">Forgot password?</a>
                        </div>
                        <div class="d-flex justify-content-end pt-3">
                            <button type="submit" class="btn btn-outline-info btn-lg fs-6">Se connecter</button>
                            <button class="btn btn-outline-primry btn-lg fs-6"> <a href="signup.php">Creer un compte</a></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<footer>
    <?php require('footer.php'); ?>
</footer>