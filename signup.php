<!DOCTYPE html>
<html>
<head>
	<title>SIGN UP</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
     <form action="signup-check.php" method="post">
     	<h2>SIGN UP</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

          <?php if (isset($_GET['success'])) { ?>
               <p class="success"><?php echo $_GET['success']; ?></p>
          <?php } ?>

           
          <label>Carte d'identité National :</label>

          <?php if (isset($_GET['cin'])) { ?>
               <input type="number" 
                      name="cin" 
                      placeholder="Carte d'identité National :"
                      value="<?php echo $_GET['cin']; ?>"><br>
          <?php }else{ ?>
               <input type="number" 
                      name="cin" 
                      oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="8"
                      placeholder="Carte d'identité National :"><br>
          <?php }?>

          <label>Nom :</label>

          <?php if (isset($_GET['nom'])) { ?>
               <input type="text" 
                      name="nom" 
                      placeholder="Name :"
                      value="<?php echo $_GET['nom']; ?>"><br>
          <?php }else{ ?>
               <input type="text" 
                      name="nom" 
                      oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="20"

                      placeholder="Name :"><br>
          <?php }?>

          <label>Prenom</label>

          <?php if (isset($_GET['prenom'])) { ?>
               <input type="text" 
                      name="prenom" 
                      placeholder="surname :"
                      value="<?php echo $_GET['prenom']; ?>"><br>
          <?php }else{ ?>
               <input type="text" 
                      name="prenom" 
                      oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="20"

                      placeholder="surname :"><br>
          <?php }?>

          <label>Email :</label>

          <?php if (isset($_GET['email'])) { ?>
               <input type="email" 
                      name="email" 
                      placeholder="Email :"
                      value="<?php echo $_GET['email']; ?>"><br>
          <?php }else{ ?>
               <input type="email" 
                      name="email" 
                      placeholder="Email :"><br>
          <?php }?>

          

     	<label>Password : </label>
     	<input type="password" 
                 name="pwd" 
                 placeholder="Password :"><br>

          <label>Re Password</label>
          <input type="password" 
                 name="re_password" 
                 placeholder="Re_Password :"><br>



          <label>Telephone :</label>

          <?php if (isset($_GET['telephone'])) { ?>
               <input type="tel" 
                      name="telephone" 
                      placeholder="Telephone :"
                      value="<?php echo $_GET['telephone']; ?>"><br>
          <?php }else{ ?>
               <input type="tel" 
                      name="telephone" 
                      placeholder="Telephone :"><br>
          <?php }?>

          <label>Categorie :</label>

          <?php if (isset($_GET['categorie'])) { ?>
                               <select name="categorie" id="categorie">
 
                                        <optgroup label="Enseignant">
                                            <option value="Proffesseur">Proffesseur</option>
                                            <option value="Maitre de Conference">Maitre de Conference</option>
                                            <option value="Maitre Assisstant">Maitre Assisstant</option>
                                        </optgroup>
                                            <optgroup label="Etudiant" >
                                            <option value="Etudiant Mastere" selected >Etudiant Mastere</option>
                                            <option value="Etudiant doctorat">Etudiant doctorat</option>
                                        </optgroup>
                                </select>
           <?php }else{ ?>
               <select name="categorie" id="categorie">
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
               
               
               <br>
          <?php }?>


         


     	<button type="submit">Sign Up</button>
          <a href="index.php" class="ca">Already have an account?</a>
     </form>
</body>
</html>