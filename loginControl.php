<?php
require('fonctions.php');
// login check
$pageLogin = "index.php";
$compteInfo = "compteInfo.php";
if (!empty($_POST['logEmail']) && !empty($_POST['logPasse'])) {
    $email = filter_var(trim($_POST['logEmail']), FILTER_SANITIZE_EMAIL);
    $pass = $_POST['logPasse'];
    try {
        $userPr = getPrByEmail($email);
        if ($userPr && password_verify($pass, $userPr['pr_passe'])) {
            $_SESSION['user_id'] = $userPr['id_personnel'];
            $_SESSION['user_role'] = 'utilisateur';
            $_SESSION['user_email'] = $userPr['email'];
            header("Location: $compteInfo");
            exit();
        } else {
            messageAlert("Email ou mot de passe invalide !", $pageLogin);
        }
    } catch (PDOException $th) {
        if ($th->getCode() == '23000') {
            messageAlert($th->getMessage(), $pageLogin);
        } else {
            die("Login erreur :" . $th->getMessage() . " à la ligne " . $th->getLine());
        }
    }
}
