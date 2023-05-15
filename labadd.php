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
        if(isset($_POST['intitule']) && !empty($_POST['intitule'])
            && isset($_POST['abreviation']) && !empty($_POST['abreviation'])
            && isset($_POST['departement_id']) && !empty($_POST['departement_id'])
            && isset($_POST['directeur_labo_id']) && !empty($_POST['directeur_labo_id'])){

             

        // On inclut la connexion à la base
        require_once('connect.php');

        // On nettoie les données envoyées
                $id = strip_tags($_POST['id']);
                $intitule = strip_tags($_POST['intitule']);
                $abreviation = strip_tags($_POST['abreviation']);
                $departement_id = strip_tags($_POST['departement_id']);
                $directeur_labo_id = strip_tags($_POST['directeur_labo_id']);

        $sql = 'INSERT INTO `laboratoires` (`intitule`, `abreviation`, `departement_id`, `directeur_labo_id`)
                                     VALUES (:intitule, :abreviation, :departement_id, :directeur_labo_id);';
        $query = $db->prepare($sql);

        

        $query->bindValue(':intitule', $intitule, PDO::PARAM_STR);
        $query->bindValue(':abreviation', $abreviation, PDO::PARAM_STR);
        $query->bindValue(':departement_id', $departement_id, PDO::PARAM_INT);
        $query->bindValue(':directeur_labo_id', $directeur_labo_id, PDO::PARAM_INT);

        $query->execute();

        $_SESSION['message'] = "Laboratoire ajouté";
        require_once('close.php');

        header('Location: lablist.php');
    }else{
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
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
                <h1>Ajouter un Laboratoire</h1>
                <p>
                    <a  class="btn btn-primary"href="lablist.php">Liste des laboratoires <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-columns-reverse" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M0 .5A.5.5 0 0 1 .5 0h2a.5.5 0 0 1 0 1h-2A.5.5 0 0 1 0 .5Zm4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10A.5.5 0 0 1 4 .5Zm-4 2A.5.5 0 0 1 .5 2h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 4h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 6h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 8h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5Z"/>
                                            </svg></a> 

                     </p>
                
                <form method="post">
                 
                    <div class="form-group">
                            <label for="intitule">intitule</label>
                            <input type="text" name="intitule" id="intitule" 
                            class="form-control">
                    </div>
                    <div class="form-group">
                            <label for="abreviation">abreviation</label>
                            <input type="text" name="abreviation" id="abreviation" 
                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10"
                            class="form-control">
                    </div>
                    <div class="form-group">
                            <label for="departement_id">departement</label>
                            <select name="departement_id" id="departement_id" class="form-control"> 
                                     <option value="" selected="selected">Please Choose</option>

                                        
                                        <?php foreach ( $resultsj as $optionsj ) : ?>
                                            <option value="<?php echo $optionsj['id']; ?>">
                                            <?php echo $optionsj['id']; ?> : 
                                            <?php echo $optionsj['intitule']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                    </div>
                   
                    <div class="form-group">
                            <label for="directeur_labo_id">directeur_labo_id :</label>
                             <select name="directeur_labo_id" id="directeur_labo_id" class="form-control"> 
                                     <option value="" selected>Please Choose</option>

                                        
                                        <?php foreach ( $resultusr as $optionusr ) : ?>
                                            <option value="<?php echo $optionusr['id']; ?>">
                                            <?php echo $optionusr['id']; ?> : <?php echo $optionusr['nom']; ?> _  <?php echo $optionusr['prenom']; ?>

                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                            
                    </div>
                    <button class="btn btn-primary">Envoyer</button>
                </form>
            </section>
        </div>
    </main>
       
<?php 
include_once("footer.php");
?>