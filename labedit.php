<?php
// On démarre une session
include_once("auth.php");
$laboratoires=true;

require_once('connect.php');
$sqlsj = 'SELECT * FROM `departements`';
// On prépare la requête
$querysj = $db->prepare($sqlsj);
// On exécute la requête
$querysj->execute();
// On stocke le résultat dans un tableau associatif
$resultsj = $querysj->fetchAll(PDO::FETCH_ASSOC);
        $sqlusr = 'SELECT * FROM `users` WHERE categorie LIKE "Proffesseur"';
        // On prépare la requête
        $queryusr = $db->prepare($sqlusr);
        // On exécute la requête
        $queryusr->execute();
        // On stocke le résultat dans un tableau associatif
        $resultusr = $queryusr->fetchAll(PDO::FETCH_ASSOC);


if($_POST){
    if(isset($_POST['id']) && !empty($_POST['id'])
    && isset($_POST['intitule']) && !empty($_POST['intitule'])
    && isset($_POST['abreviation']) && !empty($_POST['abreviation'])
    && isset($_POST['departement_id']) && !empty($_POST['departement_id'])
    && isset($_POST['directeur_labo_id']) && !empty($_POST['directeur_labo_id'])
    ){
        // On inclut la connexion à la base
        require_once('connect.php');

        // On nettoie les données envoyées
                    $id = strip_tags($_GET['id']);
                    $intitule = strip_tags($_POST['intitule']);
                    $abreviation = strip_tags($_POST['abreviation']);
                    $departement_id = strip_tags($_POST['departement_id']);
                    $directeur_labo_id = strip_tags($_POST['directeur_labo_id']);
                   

       
       $sql = "UPDATE `laboratoires` SET `intitule`=:intitule,`abreviation`=:abreviation,`departement_id`=:departement_id, `directeur_labo_id`=:directeur_labo_id  WHERE `id`=:id;";
             //  UPDATE `laboratoires` SET `intitule`='Droit Politiquee', `abreviation`='Droit' WHERE  `id`=6;

       $query = $db->prepare($sql);
                    $query->bindValue(':id', $id, PDO::PARAM_INT);
                    $query->bindValue(':intitule', $intitule, PDO::PARAM_STR);
                    $query->bindValue(':abreviation', $abreviation, PDO::PARAM_STR);
                    $query->bindValue(':departement_id', $departement_id, PDO::PARAM_INT);
                    $query->bindValue(':directeur_labo_id', $directeur_labo_id, PDO::PARAM_INT);
                    


        $query->execute();

        $_SESSION['message'] = "laboratoires modifié";
        require_once('close.php');
        header('Location: lablist.php');
    }else{
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

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
    }
}
else
{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: lablist.php');
}

                    if(!empty($_SESSION['erreur']))
                    {
                        echo '<div class="alert alert-danger" role="alert">
                                '. $_SESSION['erreur'].'
                            </div>';
                        $_SESSION['erreur'] = "";
                    }

                    
include_once("header.php");
include_once("main.php");
                ?>
                
                 
                <h1>Modifier le laboratoire <?= $laboratoire['id'] ?> </h1>

                <p>
                    <a  class="btn btn-primary"href="lablist.php">Liste des laboratoires <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-columns-reverse" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M0 .5A.5.5 0 0 1 .5 0h2a.5.5 0 0 1 0 1h-2A.5.5 0 0 1 0 .5Zm4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10A.5.5 0 0 1 4 .5Zm-4 2A.5.5 0 0 1 .5 2h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 4h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 6h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 8h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5Z"/>
                                            </svg></a> 

                    <a  class="btn btn-info" href="labdetail.php?id=<?= $laboratoire['id'] ?>">Détails
                                                                                            
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
                                                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                            <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                                                            </svg>
                    </a> 
                                        
                        
                    <a  class="btn btn-danger" href="labdel.php?id=<?= $laboratoire['id'] ?>">Supprimer 
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                    </svg>
                    </a>
             </p>
                
                <form method="post">
                    <div class="form-group">
                                <label for="intitule">intitule :</label>
                                <input type="text" name="intitule" id="intitule" value="<?= $laboratoire['intitule'] ?>" class="form-control" >
                    </div>
                    <div class="form-group">
                                <label for="abreviation">abreviation</label>
                                <input type="text" name="abreviation" id="abreviation" value="<?= $laboratoire['abreviation'] ?>"
                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="9"
                                 class="form-control">
                    </div>
                    <div class="form-group">
                                <label for="departement_id">departement_id</label>
 
                                <select name="departement_id" id="departement_id" class="form-control"> 
                                     <option value="<?= $laboratoire['departement_id'] ?>" > 
                                     <?php echo $laboratoire['departement_id']; ?>
                                    </option>

                                        
                                        <?php foreach ( $resultsj as $optionsj ) : ?>
                                            <option value="<?php echo $optionsj['id']; ?>">
                                            <?php echo $optionsj['id']; ?> :
                                            <?php echo $optionsj['intitule']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                    </div>
                    <div class="form-group">
                                <label for="directeur_labo_id">directeur_labo_id</label>
                                 <select name="directeur_labo_id" id="directeur_labo_id" class="form-control"> 
                                     <option value="<?= $laboratoire['directeur_labo_id'] ?>" selected ><?php echo $laboratoire['directeur_labo_id']; ?></option>

                                        
                                        <?php foreach ( $resultusr as $optionusr ) : ?>
                                            <option value="<?php echo $optionusr['id']; ?>">
                                            <?php echo $optionusr['id']; ?> :
                                            <?php echo $optionusr['nom']; ?>_
                                            <?php echo $optionusr['prenom']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                    </div>

                     
                    
                    
                    <input type="hidden" value="<?= $laboratoire['id']?>" name="id">
                    <button class="btn btn-primary">Modifier</button>
                </form>
            </section>
        </div>
    </main>
         
<?php 
include_once("footer.php");
?>