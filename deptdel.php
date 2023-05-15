<?php
// On démarre une session
include_once("auth.php");

// Est-ce que l'id existe et n'est pas vide dans l'URL
if(isset($_GET['id']) && !empty($_GET['id'])){
    require_once('connect.php');

    // On nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `departements` WHERE `id` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On récupère le produit
    $departement = $query->fetch();

    // On vérifie si le produit existe
    if(!$departement){
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: listuser.php');
        die();
    }

    $sql = 'DELETE FROM `departements` WHERE `id` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();
    $_SESSION['message'] = "Département supprimé";
    header('Location: deptlist.php');


}else{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: deptlist.php');
}
