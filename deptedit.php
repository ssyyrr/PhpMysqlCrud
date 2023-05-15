<?php
// On démarre une session
include_once("auth.php");
$departements=true;


if($_POST){
    if(isset($_POST['id']) && !empty($_POST['id'])
    && isset($_POST['intitule']) && !empty($_POST['intitule'])
    && isset($_POST['abreviation']) && !empty($_POST['abreviation'])
    ){
        // On inclut la connexion à la base
        require_once('connect.php');

        // On nettoie les données envoyées
                    $id = strip_tags($_GET['id']);
                    $intitule = strip_tags($_POST['intitule']);
                    $abreviation = strip_tags($_POST['abreviation']);
                    
                 


       
       $sql = "UPDATE `departements` SET `intitule`=:intitule, `abreviation`=:abreviation  WHERE `id`=:id;";
             //  UPDATE `departements` SET `intitule`='Droit Politiquee', `abreviation`='Droit' WHERE  `id`=6;

       $query = $db->prepare($sql);
                    $query->bindValue(':id', $id, PDO::PARAM_INT);
                    $query->bindValue(':intitule', $intitule, PDO::PARAM_STR);
                    $query->bindValue(':abreviation', $abreviation, PDO::PARAM_STR);
                    


        $query->execute();

        $_SESSION['message'] = "departements modifié";
        require_once('close.php');
        header('Location: deptlist.php');
    }else{
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

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
        header('Location: deptlist.php');
    }
}
else
{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: deptlist.php');
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
                
                 
                <h1>Modifier le departement <?= $departement['id'] ?></h1>

                <p>
                    <a  class="btn btn-primary"href="deptlist.php">Liste des departements 
                        
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-columns-reverse" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M0 .5A.5.5 0 0 1 .5 0h2a.5.5 0 0 1 0 1h-2A.5.5 0 0 1 0 .5Zm4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10A.5.5 0 0 1 4 .5Zm-4 2A.5.5 0 0 1 .5 2h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 4h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 6h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 8h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5Z"/>
                                            </svg></a> 

                    <a  class="btn btn-info" href="deptdetail.php?id=<?= $departement['id'] ?>">Détails
                                                                                            
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
                                                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                            <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                                                            </svg>
                    </a> 
                                        
                        
                    <a  class="btn btn-danger" href="deptdel.php?id=<?= $departement['id'] ?>">Supprimer 
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                    </svg>
                    </a>
             </p>
                
                <form method="post">
                    <div class="form-group">
                                <label for="intitule">intitule :</label>
                                <input type="text" name="intitule" id="intitule" value="<?= $departement['intitule'] ?>" 
                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="30"
                                class="form-control" >
                    </div>
                    <div class="form-group">
                                <label for="abreviation">abreviation</label>
                                <input type="text" name="abreviation" id="abreviation" value="<?= $departement['abreviation'] ?>" 
                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10"
                                class="form-control">
                    </div>

                     
                    
                    
                    <input type="hidden" value="<?= $departement['id']?>" name="id">
                    <button class="btn btn-primary">Envoyer</button>
                </form>
            </section>
        </div>
    </main>
         
<?php 
include_once("footer.php");
?>