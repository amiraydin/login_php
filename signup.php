<?php
include('header.php');
require('fonctions.php');
$signupPage = "signup.php";
// inscription d'un(e) nauveau personnel
if (!empty($_POST['pr_passe']) && !empty($_POST['mail'])) {
    $mail = filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL);
    $prPasse = stripslashes($_POST['pr_passe']);
    // pour mot de passe avec des condition
    // $pattern = '(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}';
    // if (!preg_match($pattern, $prPasse)) messageAlert("Le mot de passe doit comporter au moins 8 caractères et contenir au moins un chiffre \n 
    // // une lettre minuscule, une lettre majuscule.", $signupPage);
    $hashedPass = password_hash($prPasse, PASSWORD_BCRYPT, ['cost' => rand(8, 13)]);

    try {
        $personnelExist = $bdd->prepare('SELECT count(*) FROM personnel WHERE email = ?');
        $personnelExist->execute([$mail]);
        $persoExist = $personnelExist->fetchColumn();
        if ($persoExist == 0) {
            $inPersonnel = $bdd->prepare('INSERT INTO personnel(email, pr_passe) VALUES(?, ?)');
            $inPersonnel->execute([$mail, $hashedPass]);
            $persoId = $bdd->lastInsertId();
            if ($persoId) {
                messageAlert("Personnel a été ajouté !", "index.php");
            }
        } else messageAlert("Infos existe déjà !", $signupPage);
    } catch (PDOException $th) {
        if ($th->getCode() == '23000') {
            messageAlert($th->getMessage(), "personnel");
        } else {
            die("Insersion de personnel erreur : <br/>" . $th->getMessage() . " à la ligne " . $th->getLine());
        }
    }
}
?>

<div style="min-height: 79vh">
    <div class="col-6 m-auto">
        <div class="">
            <h5 class="" id="inscript">Inscription : </h5>
        </div>
        <form action="" onsubmit="return(continueConfirm())" method="post" enctype="multipart/form-data">
            <div class="row d-flex flex-wrap justify-content-center align-items-center p-3">
                <div class="">
                    <div class="card-body text-black">
                        <!-- email -->
                        <div class="row borders rounded mb-2 p-2 bg-light">
                            <div class="mb-2">
                                <div class="form-outline">
                                    <label class="form-label" for="maillabel">Adresse Email *</label>
                                    <input type="email" required maxlength="49" pattern="^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$" name="mail" autocomplete="off" placeholder="votre email *" id="maillabel" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <!-- Mot de passe -->
                        <div class="row borders rounded p-2 bg-light">
                            <div class="mb-2">
                                <div class="form-outline position-relative">
                                    <label class="form-label" for="passinput">Mot de passe *</label>
                                    <input type="password" minlength="8" autocomplete="off" maxlength="20" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required name="pr_passe" id="passinput" class="form-control" />
                                    <span><i id="togeye" class="fas fa-eye-slash position-absolute top-50 end-0 p-2 pe-3" role="button"></i></span>
                                </div>
                            </div>
                        </div>
                        <!-- btn -->
                        <div class="d-flex justify-content-end pt-3">
                            <button type="reset" class="btn btn-light btn-lg">Reset</button>
                            <button class="btn btn-outline-primary btn-lg ms-2" type="submit">Envoyer</button>
                            <button class="btn btn-outline-primary btn-lg ms-2"> <a href="/login_php">Se connecter</a></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<footer>
    <?php require('footer.php'); ?>
</footer>