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
    if(isset($_POST['id']) && !empty($_POST['id'])
    && isset($_POST['cin']) && !empty($_POST['cin'])
    && isset($_POST['nom']) && !empty($_POST['nom'])
    && isset($_POST['prenom']) && !empty($_POST['prenom'])
    && isset($_POST['email']) && !empty($_POST['email'])
    && isset($_POST['pwd']) && !empty($_POST['pwd'])
    && isset($_POST['telephone']) && !empty($_POST['telephone'])
    && isset($_POST['categorie']) && !empty($_POST['categorie'])
     && isset($_POST['sujet_id']) && !empty($_POST['sujet_id']))
     {
            // On inclut la connexion à la base
            require_once('connect.php');

            // On nettoie les données envoyées
                        $id = strip_tags($_GET['id']);
                        $cin = strip_tags($_POST['cin']);
                        $nom = strip_tags($_POST['nom']);
                        $prenom = strip_tags($_POST['prenom']);
                        $email = strip_tags($_POST['email']);
                        $pwd = strip_tags($_POST['pwd']);
                        $telephone = strip_tags($_POST['telephone']);
                        $categorie = strip_tags($_POST['categorie']);
                        $sujet_id = strip_tags($_POST['sujet_id']);


            // $sql = 'UPDATE `liste` SET `produit`=:produit, `prix`=:prix, `nombre`=:nombre WHERE `id`=:id;';
            $sql = "UPDATE `users` SET `cin`=:cin, `nom`=:nom, `prenom`=:prenom, `email`=:email, 
            `pwd`=:pwd, `telephone`=:telephone, `categorie`=:categorie, `sujet_id`=:sujet_id  WHERE `id`=:id;";
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id, PDO::PARAM_INT);
                        $query->bindValue(':cin', $cin, PDO::PARAM_INT);
                        $query->bindValue(':nom', $nom, PDO::PARAM_STR);
                        $query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
                        $query->bindValue(':email', $email, PDO::PARAM_STR);
                        $query->bindValue(':pwd', $pwd, PDO::PARAM_STR);
                        $query->bindValue(':telephone', $telephone, PDO::PARAM_STR);
                        $query->bindValue(':categorie', $categorie, PDO::PARAM_STR);
                        $query->bindValue(':sujet_id', $sujet_id, PDO::PARAM_INT);

            $query->execute();
            require_once('close.php');
            
            header('Location: listuser.php');
           $_SESSION['message'] = "Utilisateur modifié";

    }
        else{
            $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

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
    }
}
else
{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: listuser.php');
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
                
               <h1>Modifier l'utilisateur <?= $user['id'] ?></h1>
                <p>
                    <a  class="btn btn-primary" href="listuser.php">Liste des utilisateurs <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-columns-reverse" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M0 .5A.5.5 0 0 1 .5 0h2a.5.5 0 0 1 0 1h-2A.5.5 0 0 1 0 .5Zm4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10A.5.5 0 0 1 4 .5Zm-4 2A.5.5 0 0 1 .5 2h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 4h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 6h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 8h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5Z"/>
                                            </svg></a> 

                    <a  class="btn btn-info" href="detailsuser.php?id=<?= $user['id'] ?>">Détails
                                                                                            
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
                                                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                            <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                                                            </svg>
                    </a> 
                                        
                        
                    <a  class="btn btn-danger" href="deleteuser.php?id=<?= $user['id'] ?>">Supprimer 
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                    </svg>
                    </a>
                    </p>
                
                <form method="post">
                    <div class="form-group">
                                <label for="cin">Carte d'identité National :</label>
                                <input type="number" 
                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="8"
                                name="cin" id="cin" value="<?= $user['cin'] ?>" class="form-control" >
                    </div>
                    <div class="form-group">
                                <label for="nom">NOM</label>
                                <input type="text"
                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="20"
                                 name="nom" id="nom" value="<?= $user['nom'] ?>" class="form-control">
                    </div>

                    <div class="form-group">
                                <label for="prenom">Prenom</label>
                                <input type="text" 
                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="20"
                                name="prenom" id="prenom" value="<?= $user['prenom'] ?>" class="form-control">
                    </div>

                    <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" value="<?= $user['email'] ?>" class="form-control" >

                    </div>
                    <div class="form-group">
                                <label for="pwd">Password</label>
                                <input type="password" name="pwd" id="pwd" value="<?= $user['pwd'] ?>"class="form-control" >

                    </div>
                    <div class="form-group">
                                <label for="telephone">Telephone</label>
                                <input type="tel"
                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="9"
                                 name="telephone" id="telephone" value="<?= $user['telephone'] ?>"class="form-control" >

                    </div>
                    <div class="form-group">
                                <label for="categorie">Categorie</label>
                               
                                <select name="categorie" id="categorie"
                                 class="form-control">
                                             <option value="<?= $user['categorie'] ?>" selected>
                                              <?= $user['categorie'] ?>
                                            </option>
                                        <optgroup label="Enseignant">
                                            
                                        <option value="Proffesseur">Proffesseur</option>
                                            <option value="Maitre de Conference">Maitre de Conference</option>
                                            <option value="Maitre Assisstant">Maitre Assisstant</option>
                                        </optgroup>
                                            <optgroup label="Etudiant">
                                            <option value="Etudiant Mastere">Etudiant Mastere</option>
                                            <option value="Etudiant doctorat">Etudiant doctorat</option>
                                        </optgroup>
                                </select>
                    </div>
                    
                    <div class="form-group">
                            <label for="sujet_id">Sujet :</label>
                                     <select name="sujet_id" id="sujet_id" class="form-control"> 
                                     <option value="<?= $user['sujet_id'] ?>" selected ><?= $user['sujet_id'] ?></option>

                                        
                                        <?php foreach ( $resultsj as $optionsj ) : ?>
                                            <option value="<?php echo $optionsj['id']; ?>">
                                            <?php echo $optionsj['id']; ?> :
                                            <?php echo $optionsj['intitule']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>

                    </div>
                    
                    <input type="hidden" value="<?= $user['id']?>" name="id">
                    <button class="btn btn-primary">Envoyer</button>
                </form>
            </section>
        </div>
    </main>
         
<?php 
include_once("footer.php");
?>