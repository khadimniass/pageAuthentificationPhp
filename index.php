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
    echo "<center class='middle'> Bonjour vous êtes connecté en tant que ".htmlspecialchars($_SESSION['pseudo'])."</center>";
    }else{
		header("Location: connexion.php");
    }
    ?>
    <center class="middle">
    <form id="login" action="" method="get">
    	<div class="group">
    		<label for="comment" class="label">comment</label>
    		<input name="comment" id="comment" type="text" class="input">
  		</div>
  		<div class="group">
  			<input name="submit" type="submit" class="button" value="ENVOYER">
  		</div>
  	</form>
  	</center>
  	<?php 
  	if (isset($_GET['comment'])){
    echo "<center class='middle'>".htmlspecialchars($_SESSION['pseudo'])." a écrit :". $_GET['comment']."</center>";
  	}
  	?>
</body>
</html>