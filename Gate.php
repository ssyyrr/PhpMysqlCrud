<?php
include_once("auth.php");
require_once('connect.php');

 

$sql = 'SELECT * FROM `users`';

// On prépare la requête
$query = $db->prepare($sql);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);


foreach($result as $user)
{
    $_SESSION['nom'] = $row['nom'];

                
                
                        if($user['actif'] == 1 )
                                {
                                    
                                  echo   $user['id'] ;                                               

                               }
 }          

require_once('close.php');
?>