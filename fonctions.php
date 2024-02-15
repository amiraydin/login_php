<?php
include('config.inc.php');
// Obtenir la date d'aujourd'hui
$dateAujour = date('Y-m-d');
// Convertir la date en timestamp
$timestampAujourdhui = strtotime($dateAujour);

function getDateDeJour()
{
    return date('Y-m-d');
}

function connectionBD()
{
    include('config.inc.php');
    try {
        $bdd = new PDO('mysql:host=' . $host . ';dbname=' . $db . ';charset=utf8', '' . $user . '', '' . $password . '');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die('Erreur de connexion : ' . $e->getMessage() . " à la ligne " . $e->getLine());
    }
    return $bdd;
}
// connextion global
$bdd = connectionBD();
function messageAlert($alertMes, $urlNav)
{
    echo '<div style="position: fixed; top: 40%; left: 40%; background-color: #E7F7FF; padding: 13px; border-radius: 10px;">';
    echo '<h3> Message </h3>';
    echo '<span class="separator"></span>';
    echo '<h4 style="position: relative; display: flex; flex-direction: column; width: 100%;">' . $alertMes . '</h4>';
    echo '</div>';
    header("Refresh: 3; url=$urlNav");
    exit();
}
function messageAjour($urlNav)
{
    echo '<h4 style="position: fixed; top: 40%; left: 40%; background-color: #E7F7FF; padding: 10px; border-radius: 10px;"> Mis à jour prise en compte !</h4>';
    header("Refresh: 2; url=$urlNav");
    exit();
}
function erreurAjour($nom, $url)
{
    echo "<h4 style='position: fixed; top: 40%; left: 40%; background-color: #E7F7FF; padding: 10px; border-radius: 10px;'>Erreur mis à jour pour $nom !</h4>";
    header("Refresh: 2; url=$url");
    exit();
}

function messageSupprim()
{
    echo '<h4 style="position: fixed; top: 40%; left: 40%; background-color: #E7F7FF; padding: 10px; border-radius: 10px;">Suppression prise en compte !</h4>';
    header("Refresh: 2; url=configuration");
    exit();
}
function erreurSupprim($nom, $url)
{
    echo "<h4 style='position: fixed; top: 40%; left: 40%; background-color: #E7F7FF; padding: 10px; border-radius: 10px;'>Erreur de Suppression pour $nom !</h4>";
    header("Refresh: 2; url=$url");
    exit();
}
// verification de @ et . d'un email 
function checkEmail($mail)
{
    $trv1 = strpos($mail, '@');
    $trv2 = strpos($mail, '.');
    return ($trv1 !== false && $trv2 !== false);
}
function generMatCle($prenom, $nom)
{
    // generer mon mat cle avec deux lettre de nom et prenom plus 9 chiffres   
    $deuxPrLNom = substr($nom, 0, 2);
    $deuxPrLprenom = substr($prenom, 0, 2);
    $monCle = $deuxPrLprenom . $deuxPrLNom . '';
    for ($i = 0; $i < 9; $i++) {
        $monCle .= rand(0, 9);
    }
    return $monCle;
}
function donneesValide($don)
{
    $don = trim($don);
    $don = stripslashes($don);
    $don = htmlspecialchars($don);
    $don = strtolower($don);
    // $don = mb_convert_encoding($don, 'UTF-8', 'ISO-8859-1');
    return $don;
}
function lowHtmlTrim($don)
{
    $don = trim($don);
    $don = htmlspecialchars($don);
    $don = strtolower($don);
    return $don;
}
function lowHtml($don)
{
    $don = htmlspecialchars($don);
    $don = strtolower($don);
    return $don;
}
// Date d'aujourd'hui
$dateAujour = date('Y-m-d');
// #########

// compter le nombre d'objet existant dans une table
function countAll($tab)
{
    $bdd = connectionBD();
    $req = $bdd->prepare("SELECT count(*) FROM $tab");
    $req->execute();
    return $req->fetchColumn();
}
// #####################
// Utilisation principal dans la page personnel (liste personnels)

function getPersoByFullNameAndMail($nom, $prenom, $mail)
{
    $bdd = connectionBD();
    $req = $bdd->prepare("SELECT count(*) FROM personnel as p  WHERE p.nom = $nom AND p.prenom = $prenom AND p.email = $mail");
    $req->execute();
    return $req->fetchColumn();
}

// get perso by id
function getPersoById($id)
{
    $bdd = connectionBD();
    $req = $bdd->prepare('SELECT email FROM personnel WHERE id_personnel = ?');
    $req->execute([$id]);
    return $req->fetch(PDO::FETCH_ASSOC);
}
// get perso by email (pour login)
function getPrByEmail($em)
{
    $bdd = connectionBD();
    $reqLog = $bdd->prepare('SELECT id_personnel, email, pr_passe FROM personnel WHERE email = ?');
    $reqLog->execute([$em]);
    return $reqLog->fetch(PDO::FETCH_ASSOC);
}
function getUserById($id)
{
    $db_con = connectionBD();
    $result = $db_con->prepare("SELECT email FROM personnel WHERE id_personnel = $id");
    $result->execute();
    return $result->fetch(PDO::FETCH_ASSOC);
}
