<?php 
session_start(); 
$sname= "localhost";
$unmae= "root";
$password = "clubafricain";

$db_name = "pfa";
$port=3306;
$conn = mysqli_connect($sname, $unmae, $password, $db_name,$port);

if (!$conn) 
{
	echo "Connection failed!";
}

if (isset($_POST['cin']) && isset($_POST['pwd'])
    && isset($_POST['nom']) && isset($_POST['re_password'])
	&& isset($_POST['prenom']) && isset($_POST['email'])
	&& isset($_POST['telephone']) && isset($_POST['categorie'])
	) 
{

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$cin = validate($_POST['cin']);
	$pwd = validate($_POST['pwd']);
	$nom = validate($_POST['nom']);
	$prenom = validate($_POST['prenom']);
	$email = validate($_POST['email']);
 	$telephone = validate($_POST['telephone']);
	$categorie = validate($_POST['categorie']);
	$re_pass = validate($_POST['re_password']);
 
	$user_data = 'nom='. $nom. '&prenom='. $prenom;


	if (empty($nom)) {
		header("Location: signup.php?error=User Name is required&$user_data");
	    exit();
	}else if(empty($pwd)){
        header("Location: signup.php?error=Password is required&$user_data");
	    exit();
	}
	else if(empty($re_pass)){
        header("Location: signup.php?error=Re Password is required&$user_data");
	    exit();
	}

	else if(empty($prenom)){
        header("Location: signup.php?error=Surname is required&$user_data");
	    exit();
	}

	else if($pwd !== $re_pass){
        header("Location: signup.php?error=The confirmation password  does not match&$user_data");
	    exit();
	}

	else{

					// ===> hashing the password : changer $pass par $pwd
					$pass = md5($pass);

	    $sql = "SELECT * FROM users WHERE nom='$nom' ";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			header("Location: signup.php?error=The username is taken try another&$user_data");
	        exit();
		}else {
          // $sql2 = "INSERT INTO users(user_name, password, name) VALUES('$nom', '$pass', '$name')";
		   $sql2 = 'INSERT INTO `users` (`cin`, `nom`, `prenom`, `email`, `pwd`, `telephone`, `categorie`, `sujet_id`)
                                 VALUES (:cin, :nom, :prenom, :email, :pwd, :telephone, :categorie);';

           $result2 = mysqli_query($conn, $sql2);
           if ($result2) {
           	 header("Location: signup.php?success=Your account has been created successfully");
	         exit();
           }else {
	           	header("Location: signup.php?error=unknown error occurred&$user_data");
		        exit();
           }
		}
	}
	
}else{
	header("Location: signup.php");
	exit();
}