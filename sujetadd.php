<?php
// On démarre une session
include_once("auth.php");
$sujets=true;

if($_POST){
        if(isset($_POST['intitule']) && !empty($_POST['intitule'])
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
 
        $sql = 'INSERT INTO `sujetsprojets`
               (`intitule`, `abreviation`, `enseignant_id`, `etudiant_id`, `labo_id`, `NiveauSujet`, `Description`, `Detail`, `Objectif`, `DatesDelais`) 
        VALUES (:intitule, :abreviation, :enseignant_id, :etudiant_id, :labo_id, :NiveauSujet, :Description, :Detail, :Objectif, :DatesDelais);';
        $query = $db->prepare($sql);

        $query->bindValue(':intitule', $intitule, PDO::PARAM_STR);
        $query->bindValue(':abreviation', $abreviation, PDO::PARAM_STR);
        $query->bindValue(':enseignant_id', $enseignant_id, PDO::PARAM_STR);
        $query->bindValue(':etudiant_id', $etudiant_id, PDO::PARAM_STR);
        $query->bindValue(':labo_id', $labo_id, PDO::PARAM_STR);
        $query->bindValue(':NiveauSujet', $NiveauSujet, PDO::PARAM_STR);
        $query->bindValue(':Description', $Description, PDO::PARAM_STR);
        $query->bindValue(':Detail', $Detail, PDO::PARAM_INT);
        $query->bindValue(':Objectif', $Objectif, PDO::PARAM_INT);
        $query->bindValue(':DatesDelais', $DatesDelais, PDO::PARAM_INT);

        $query->execute();

        $_SESSION['message'] = "sujet ajouté";
        require_once('close.php');

        header('Location: sujetlist.php');
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
                <h1>Ajouter un Sujet</h1>
                <p>
                    <a  class="btn btn-primary"href="sujetlist.php">Liste des sujets <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-columns-reverse" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M0 .5A.5.5 0 0 1 .5 0h2a.5.5 0 0 1 0 1h-2A.5.5 0 0 1 0 .5Zm4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10A.5.5 0 0 1 4 .5Zm-4 2A.5.5 0 0 1 .5 2h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 4h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 6h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 8h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5Z"/>
                                            </svg></a> 

                </p>
                
                <form method="post">
                <div class="form-group">
                            <label for="intitule">intitule :</label>
                            <input type="text" name="intitule" id="intitule" class="form-control">
                    </div>
                    <div class="form-group">
                            <label for="abreviation">abreviation</label>
                            <input type="text" name="abreviation" id="abreviation" class="form-control">
                    </div>
                    <div class="form-group">
                            <label for="enseignant_id">enseignant_id</label>
                            <input type="number" name="enseignant_id" id="enseignant_id" class="form-control">
                    </div>
                    <div class="form-group">
                            <label for="etudiant_id">etudiant_id</label>
                            <input type="number" name="etudiant_id" id="etudiant_id" class="form-control">
                    </div>
                    <div class="form-group">
                            <label for="labo_id">labo_id :</label>
                            <input type="number" name="labo_id" id="labo_id" class="form-control">
                    </div>
                    <div class="form-group">
                            <label for="NiveauSujet">NiveauSujet</label>
                             <select  name="NiveauSujet" id="NiveauSujet" class="form-control">
                                <option value="">--Please choose an option--</option>
                                <option value="Master de Recherche">Master de Recherche</option>
                                <option value="These de Doctorat">These de Doctorat</option>
                             </select>

                    </div>

                    <div class="form-group">
                            <label for="Description">Description</label>
                            <input type="text" name="Description" id="Description" class="form-control">

                    </div>
                    <div class="form-group">
                            <label for="Detail">Detail :</label>
                            <input type="text" name="Detail" id="Detail" class="form-control">
                    </div>
                    <div class="form-group">
                            <label for="Objectif">Objectif :</label>
                            <input type="text" name="Objectif" id="Objectif" class="form-control">
                    </div>
                    <div class="form-group">
                            <label for="DatesDelais">DatesDelais :</label>
                            <input type="date" name="DatesDelais" id="DatesDelais" class="form-control">
                    </div>

                    <button class="btn btn-primary">Envoyer</button>
                </form>
            </section>
        </div>
    </main>
       
<?php 
include_once("footer.php");
?>