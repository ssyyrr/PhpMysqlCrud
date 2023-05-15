<?php
// On démarre une session
include_once("auth.php");

// Est-ce que l'id existe et n'est pas vide dans l'URL
if(isset($_GET['id']) && !empty($_GET['id']))
{
    require_once('connect.php');

    // On nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `users` WHERE `id` = :id;';
     // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);
   // $query->bindValue(':id', $id, PDO::PARAM_STR);
    
    // On exécute la requête
    $query->execute();

    // On récupère le produit
    $user = $query->fetch();
    // On vérifie si le produit existe
        if(!$user){
            $_SESSION['erreur'] = "Cet id n'existe pas";
            header('Location: listuser.php');
        }

   // $actif = ($user['actif'] == "0") ?"1"  : "0";
    $actif = ($user['actif'] == 0) ?1  : 0;

   // var_dump($actif);
   // echo $actif ;

    $sql = 'UPDATE `users` SET `actif`=:actif WHERE `id` = :id;';

    //var_dump($sql);
    // On prépare la requête
    $query = $db->prepare($sql);
   //var_dump($query);
    // On "accroche" les paramètres
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->bindValue(':actif', $actif, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();
    
   header('Location: listuser.php');
            if($user['actif'] == 1 )
        {
            $_SESSION['message'] = "Utilisateur Desactiver ";
            }
        else 
        {
            $_SESSION['message'] = "Utilisateur Activer";
        }



}
else
{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: listuser.php');
}

