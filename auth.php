<?php
session_start();
if(!$_SESSION['auth'])
{
    header("Location: index.php?error=Priere de s'identifier");
	exit();
}
?>