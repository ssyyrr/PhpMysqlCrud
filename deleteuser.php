<?php
// On démarre une session
include_once("auth.php");


// Est-ce que l'id existe et n'est pas vide dans l'URL
if(isset($_GET['id']) && !empty($_GET['id'])){
    require_once('connect.php');

    // On nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `users` WHERE `id` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On récupère le produit
    $user = $query->fetch();

    // On vérifie si le produit existe
    if(!$user){
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: listuser.php');
        die();
    }

    $sql = 'DELETE FROM `users` WHERE `id` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();
    $_SESSION['message'] = "utilisateur supprimé";
    header('Location: listuser.php');


}else{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: listuser.php');
}
