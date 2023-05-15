<?php
// On démarre une session
include_once("auth.php");

// Est-ce que l'id existe et n'est pas vide dans l'URL
if(isset($_GET['id']) && !empty($_GET['id'])){
    require_once('connect.php');

    // On nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `laboratoires` WHERE `id` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On récupère le produit
    $laboratoire = $query->fetch();

    // On vérifie si le produit existe
    if(!$laboratoire){
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: lablist.php');
        die();
    }

    $sql = 'DELETE FROM `laboratoires` WHERE `id` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();
    $_SESSION['message'] = "laboratoire supprimé";
    header('Location: lablist.php');


}else{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: lablist.php');
}
