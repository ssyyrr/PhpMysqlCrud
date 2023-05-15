<?php
// On démarre une session
include_once("auth.php");
$departements=true;

if($_POST){
        if(isset($_POST['intitule']) && !empty($_POST['intitule'])
             
            && isset($_POST['abreviation']) && !empty($_POST['abreviation'])){

            

        // On inclut la connexion à la base
        require_once('connect.php');

        // On nettoie les données envoyées
                $id = strip_tags($_POST['id']);
                $intitule = strip_tags($_POST['intitule']);
                $abreviation = strip_tags($_POST['abreviation']);

        $sql = 'INSERT INTO `departements` ( `intitule`,  `abreviation`) VALUES (:intitule,:abreviation);';
        $query = $db->prepare($sql);

        $query->bindValue(':intitule', $intitule, PDO::PARAM_STR);
        $query->bindValue(':abreviation', $abreviation, PDO::PARAM_STR);

        $query->execute();

        $_SESSION['message'] = "Departement ajouté";
        require_once('close.php');

        header('Location: deptlist.php');
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
                <h1>Ajouter un Département</h1>
                
                <form method="post">
                
                    <div class="form-group">
                            <label for="intitule">Intitule</label>
                            <input type="text" name="intitule" id="intitule"
                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="30"
                            class="form-control">
                    </div>
                    
                    <div class="form-group">
                            <label for="abreviation">Abreviation :</label>
                            <input type="text" name="abreviation" id="abreviation" 
                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10"
                            class="form-control">
                    </div>
                    <button class="btn btn-primary">Envoyer</button>
                </form>

                </div>

            </section>
        </div>
    </main>
       
<?php 
include_once("footer.php");
?>