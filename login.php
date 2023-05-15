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
if (isset($_POST['email']) && isset($_POST['pwd'])) 
{

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$email = validate($_POST['email']);
	$pwd = validate($_POST['pwd']);

			if (empty($email)) 
			{
				header("Location: index.php?error=email is required");
				exit();
			}
			else
			if(empty($pwd)){
				header("Location: index.php?error=Password is required");
				exit();
			}else
				{
					// ===> hashing the password : changer $pass par $pwd
					$pass = md5($pass);

					
					$sql = "SELECT * FROM users WHERE email='$email' AND pwd='$pwd'";

					$result = mysqli_query($conn, $sql);

					if (mysqli_num_rows($result) === 1) 
							{
								$row = mysqli_fetch_assoc($result);
									if ($row['email'] === $email && $row['pwd'] === $pwd)
									{
													$_SESSION['email'] = $row['email'];
													$_SESSION['nom'] = $row['nom'];
													$_SESSION['prenom'] = $row['prenom'];
													$_SESSION['id'] = $row['id'];
													$_SESSION['auth'] = 'true';
										
										header("Location: listuser.php");
										exit();
									}else{
										header("Location: index.php?error=Incorect email or password");
										exit();
									}
							}
							else
							{
								header("Location: index.php?error=Incorect email or password");
								exit();
							}
				}
	
}
else{
	header("Location: index.php");
	exit();
}