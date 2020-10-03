<?php session_start()  ?>
<!DOCTYPE html>
<html>
<head>
	<title>connected</title>
	<link href="connexion.css" rel="stylesheet" />
</head>
<body>
    <?php 
    if (isset($_SESSION['id'])) {
    echo "Bonjour ".htmlspecialchars($_SESSION['pseudo']);
    }else{
		header("Location: connexion.php");
    }
    ?>
</body>
</html>