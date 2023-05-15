<?php
// On démarre une session
include_once("auth.php");

$users=true;



require_once('connect.php');
$sqlsj = 'SELECT * FROM `sujetsprojets`';
// On prépare la requête
$querysj = $db->prepare($sqlsj);
// On exécute la requête
$querysj->execute();
// On stocke le résultat dans un tableau associatif
$resultsj = $querysj->fetchAll(PDO::FETCH_ASSOC);
 

if($_POST){
        if(isset($_POST['cin']) && !empty($_POST['cin'])
            && isset($_POST['nom']) && !empty($_POST['nom'])
            && isset($_POST['prenom']) && !empty($_POST['prenom'])
            && isset($_POST['email']) && !empty($_POST['email'])
            && isset($_POST['pwd']) && !empty($_POST['pwd'])
            && isset($_POST['telephone']) && !empty($_POST['telephone'])
            && isset($_POST['categorie']) && !empty($_POST['categorie'])
            && isset($_POST['sujet_id']) && !empty($_POST['sujet_id'])){

            

        // On inclut la connexion à la base
        require_once('connect.php');

        // On nettoie les données envoyées
                $cin = strip_tags($_POST['cin']);
                $nom = strip_tags($_POST['nom']);
                $prenom = strip_tags($_POST['prenom']);
                $email = strip_tags($_POST['email']);
                $pwd = strip_tags($_POST['pwd']);
                $telephone = strip_tags($_POST['telephone']);
                $categorie = strip_tags($_POST['categorie']);
                $sujet_id = strip_tags($_POST['sujet_id']);

        $sql = 'INSERT INTO `users` (`cin`, `nom`, `prenom`, `email`, `pwd`, `telephone`, `categorie`, `sujet_id`)
                                 VALUES (:cin, :nom, :prenom, :email, :pwd, :telephone, :categorie, :sujet_id);';
        $query = $db->prepare($sql);

        $query->bindValue(':cin', $cin, PDO::PARAM_INT);
        $query->bindValue(':nom', $nom, PDO::PARAM_STR);
        $query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->bindValue(':pwd', $pwd, PDO::PARAM_STR);
        $query->bindValue(':telephone', $telephone, PDO::PARAM_STR);
        $query->bindValue(':categorie', $categorie, PDO::PARAM_STR);
        $query->bindValue(':sujet_id', $sujet_id, PDO::PARAM_INT);

        $query->execute();


        



        $_SESSION['message'] = "Utilisateur ajouté";
        require_once('close.php');

        header('Location: listuser.php');
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
                <h1>Ajouter un utilisateur</h1>
                <p>
                    <a  class="btn btn-primary" href="listuser.php">Liste des utilisateurs <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-columns-reverse" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M0 .5A.5.5 0 0 1 .5 0h2a.5.5 0 0 1 0 1h-2A.5.5 0 0 1 0 .5Zm4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10A.5.5 0 0 1 4 .5Zm-4 2A.5.5 0 0 1 .5 2h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 4h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 6h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 8h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5Z"/>
                                            </svg></a> 

                </p>
                                
                <form method="post">
                <div class="form-group">
                            <label for="cin">Carte d'identité National :</label>
                            <input  type="number" 
                                     oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="8"
                                     name="cin" id="cin" class="form-control">
                    </div>
                    <div class="form-group">
                            <label for="nom">NOM</label>
                            <input type="text" name="nom" id="nom" class="form-control"
                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="20"
                            >
                    </div>
                    <div class="form-group">
                            <label for="prenom">Prenom</label>
                            <input type="text" name="prenom" id="prenom" 
                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="20"
                            class="form-control">
                    </div>
                    <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                            <label for="pwd">Password</label>
                            <input type="password" name="pwd" id="pwd" class="form-control">
                    </div>
                    <div class="form-group">
                            <label for="Telephone">Telephone</label>
                            <input type="tel"
                              id="telephone" name="telephone"
                              oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="9"
                             class="form-control">
                    </div>

                    <div class="form-group">
                            <label for="categorie">Categorie</label>
                            <select name="categorie" id="categorie"
                                 class="form-control">
                                        <optgroup label="Enseignant">
                                            <option value="Proffesseur">Proffesseur</option>
                                            <option value="Maitre de Conference">Maitre de Conference</option>
                                            <option value="Maitre Assisstant">Maitre Assisstant</option>
                                        </optgroup>
                                            <optgroup label="Etudiant" >
                                            <option value="Etudiant Mastere" selected>Etudiant Mastere</option>
                                            <option value="Etudiant doctorat">Etudiant doctorat</option>
                                        </optgroup>
                                </select>
                    </div>
                    
                    
                    <div class="form-group">
                            <label for="sujet_id">Sujet :</label>
                                     <select name="sujet_id" id="sujet_id" class="form-control"> 
                                     <option value="" selected="selected">Please Choose</option>

                                        
                                        <?php foreach ( $resultsj as $optionsj ) : ?>
                                            <option value="<?php echo $optionsj['id']; ?>">
                                            <?php echo $optionsj['id']; ?> :
                                            <?php echo $optionsj['intitule']; ?>
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