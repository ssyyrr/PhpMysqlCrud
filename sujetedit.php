<?php
// On démarre une session
include_once("auth.php");
$sujets=true;



if($_POST){
    if(isset($_POST['id']) && !empty($_POST['id'])
    && isset($_POST['intitule']) && !empty($_POST['intitule'])
    && isset($_POST['abreviation']) && !empty($_POST['abreviation'])
    && isset($_POST['enseignant_id']) && !empty($_POST['enseignant_id'])
    && isset($_POST['etudiant_id']) && !empty($_POST['etudiant_id'])
    && isset($_POST['labo_id']) && !empty($_POST['labo_id'])
    && isset($_POST['NiveauSujet']) && !empty($_POST['NiveauSujet'])
    && isset($_POST['Description']) && !empty($_POST['Description'])
    && isset($_POST['Detail']) && !empty($_POST['Detail'])
    && isset($_POST['Objectif']) && !empty($_POST['Objectif'])
    && isset($_POST['DatesDelais']) && !empty($_POST['DatesDelais'])
    ){
        // On inclut la connexion à la base
        require_once('connect.php');

        // On nettoie les données envoyées
                    $id = strip_tags($_GET['id']);
                    $intitule = strip_tags($_POST['intitule']);
                    $abreviation = strip_tags($_POST['abreviation']);
                    $enseignant_id = strip_tags($_POST['enseignant_id']);
                    $etudiant_id = strip_tags($_POST['etudiant_id']);
                    $labo_id = strip_tags($_POST['labo_id']);
                    $NiveauSujet = strip_tags($_POST['NiveauSujet']);
                    $Description = strip_tags($_POST['Description']);
                    $Detail = strip_tags($_POST['Detail']);
                    $Objectif = strip_tags($_POST['Objectif']);
                    $DatesDelais = strip_tags($_POST['DatesDelais']);
                   

       
       $sql = "UPDATE `sujetsprojets` SET

                         `intitule`=:intitule,
                        `abreviation`=:abreviation,
                        `enseignant_id`=:enseignant_id,
                        `etudiant_id`=:etudiant_id,
                        `NiveauSujet`=:NiveauSujet,
                        `Description`=:Description,
                        `Detail`=:Detail,
                        `Objectif`=:Objectif,
                        `DatesDelais`=:DatesDelais,
                        `labo_id`=:labo_id  
                WHERE `id`=:id;";
             //  UPDATE `sujets` SET `intitule`='Droit Politiquee', `abreviation`='Droit' WHERE  `id`=6;

       $query = $db->prepare($sql);
                    $query->bindValue(':id', $id, PDO::PARAM_INT);
                    $query->bindValue(':intitule', $intitule, PDO::PARAM_STR);
                    $query->bindValue(':abreviation', $abreviation, PDO::PARAM_STR);
                    $query->bindValue(':enseignant_id', $enseignant_id, PDO::PARAM_INT);
                    $query->bindValue(':etudiant_id', $labo_id, PDO::PARAM_INT);
                    $query->bindValue(':labo_id', $labo_id, PDO::PARAM_INT);
                    $query->bindValue(':NiveauSujet', $NiveauSujet, PDO::PARAM_STR);
                    $query->bindValue(':Description', $Description, PDO::PARAM_STR);
                    $query->bindValue(':Detail', $Detail, PDO::PARAM_STR);
                    $query->bindValue(':Objectif', $Objectif, PDO::PARAM_STR);
                    $query->bindValue(':DatesDelais', $DatesDelais, PDO::PARAM_STR);
                    


        $query->execute();

        $_SESSION['message'] = "sujet modifié";
        require_once('close.php');
        header('Location: sujetlist.php');
    }else{
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

// Est-ce que l'id existe et n'est pas vide dans l'URL
if(isset($_GET['id']) && !empty($_GET['id'])){
    require_once('connect.php');

    // On nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `sujetsprojets` WHERE `id` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On récupère le produit
    $sujet = $query->fetch();

    // On vérifie si le produit existe
    if(!$sujet){
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: sujetlist.php');
    }
}
else
{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: sujetlist.php');
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
                
                 
                <h1>Modifier le sujet <?= $sujet['id'] ?> </h1>

                <p>
                    <a  class="btn btn-primary"href="sujetlist.php">Liste des sujets <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-columns-reverse" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M0 .5A.5.5 0 0 1 .5 0h2a.5.5 0 0 1 0 1h-2A.5.5 0 0 1 0 .5Zm4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10A.5.5 0 0 1 4 .5Zm-4 2A.5.5 0 0 1 .5 2h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 4h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 6h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 8h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5Z"/>
                                            </svg></a> 

                    <a  class="btn btn-info" href="sujetdetail.php?id=<?= $sujet['id'] ?>">Détails
                                                                                            
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
                                                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                            <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                                                            </svg>
                    </a> 
                                        
                        
                    <a  class="btn btn-danger" href="sujetdel.php?id=<?= $sujet['id'] ?>">Supprimer 
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                    </svg>
                    </a>
             </p>
                
            
                <form method="post">
                    <div class="form-group">
                                <label for="intitule">intitule :</label>
                                <input type="text" name="intitule" id="intitule" value="<?= $sujet['intitule'] ?>"
                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="50"
                                 class="form-control" >
                    </div>

                    <div class="form-group">
                                <label for="abreviation">abreviation</label>
                                <input type="text" name="abreviation" id="abreviation" value="<?= $sujet['abreviation'] ?>" 
                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="20"
                                class="form-control" >
                    </div>
                    <div class="form-group">
                                <label for="enseignant_id">enseignant_id</label>
                                <input type="number" name="enseignant_id" id="enseignant_id" value="<?= $sujet['enseignant_id'] ?>" class="form-control">
                    </div>
                    <div class="form-group">
                                <label for="etudiant_id">etudiant_id</label>
                                <input type="number" name="etudiant_id" id="etudiant_id" value="<?= $sujet['etudiant_id'] ?>" class="form-control">
                    </div>
                    <div class="form-group">
                                <label for="labo_id">labo_id</label>
                                <input type="number" name="labo_id" id="labo_id" value="<?= $sujet['labo_id'] ?>" class="form-control">
                    </div>

                   
                    <div class="form-group">
                            <label for="NiveauSujet">NiveauSujet</label>
                             <select  name="NiveauSujet" id="NiveauSujet" class="form-control">
                                <option value="<?= $sujet['NiveauSujet'] ?>" selected> <?= $sujet['NiveauSujet'] ?> </option>
                                <option value="Master de Recherche">Master de Recherche</option>
                                <option value="These de Doctorat">These de Doctorat</option>
                             </select>

                    </div>

                    <div class="form-group">
                            <label for="Description">Description</label>
                            <input type="text" name="Description" id="Description" value="<?= $sujet['Description'] ?>"  class="form-control">

                    </div>
                    <div class="form-group">
                            <label for="Detail">Detail :</label>
                            <input type="text" name="Detail" id="Detail" value="<?= $sujet['Detail'] ?>"  class="form-control">
                    </div>
                    <div class="form-group">
                            <label for="Objectif">Objectif :</label>
                            <input type="text" name="Objectif" id="Objectif" value="<?= $sujet['Objectif'] ?>"  class="form-control">
                    </div>
                    <div class="form-group">
                            <label for="DatesDelais">DatesDelais :</label>
                            <input type="date" name="DatesDelais" id="DatesDelais" value="<?= $sujet['DatesDelais'] ?>"  class="form-control">
                    </div>

                    
                    
                    <input type="hidden" value="<?= $sujet['id']?>" name="id">
                    <button class="btn btn-primary">Envoyer</button>
                </form>
            </section>
        </div>
    </main>
         
<?php 
include_once("footer.php");
?>