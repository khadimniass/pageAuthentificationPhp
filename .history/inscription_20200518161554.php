<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <title></title>
	<link href="connexion.css" rel="stylesheet" />
    </head>

    <body>
      <form id="login" action="" method="post">
        <div class="login-wrap">
	<div class="login-html">
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked>
    <label for="tab-1" class="tab">INSCRIPTION</label>
		<input id="tab-2" type="radio" name="tab" class="sign-up">
    <label for="tab-2" class="tab"><a href="connexion.php">CONNEXION</a></label>
		<div class="login-form">
  			<div class="sign-in-htm">
  				<div class="group">
    					<label for="pseudo" class="label">Username</label>
    					<input name="pseudo" id="user" type="text" class="input">
  				</div>

  				<div class="group">
    					<label for="pass" class="label">Password</label>
    					<input name="pass" id="pass" type="password" class="input" data-type="password">
  				</div>

          <div class="group">
    					<label for="pass" class="label">Confirmation</label>
    					<input name="pass2" id="pass" type="password" class="input" data-type="password">
  				</div>

          <div class="group">
    					<label for="pass" class="label">Email</label>
    					<input name="email" id="pass" type="email" class="input" data-type="email">
  				</div>

  				<div class="group">
  					  <input name="submit" type="submit" class="button" value="S'inscrire">
  				</div>

      </form>
      <?php
            try{
              $bdd = new PDO('mysql:host=localhost;dbname=Tp_Open;charset=utf8', 'root', '');
            }

            catch (Exception $e){
              die('Erreur : ' . $e->getMessage());
            }
            // Vérification de la validité des informations
            if(isset($_POST['submit'])){
                  $pseudo=$_POST['pseudo'];
                  $pass=$_POST['pass'];
                  $pass2=$_POST['pass2'];
                  $email=$_POST['email'];

                  if(empty($_POST['pseudo']) OR empty($_POST['pass']) OR empty($_POST['pass2']) OR empty($_POST['email'])){
                    echo "Veuillez remplir tous les champs svp.";
                    exit;
                  }
                  else {
                        // code...
                        if($_POST['pass'] != $_POST['pass2']){
                            echo "Erreur! Rentrer à nouveau le mot de passe svp.";
                            exit;
                        }

                        if (isset($_POST['email'])){
                              $_POST['email'] = htmlspecialchars($_POST['email']); // On rend inoffensives les balises HTML que le visiteur a pu rentrer

                              if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])){
                                echo 'L\'adresse ' . $_POST['email'] . ' est <strong>valide</strong> !';
                              }

                              else{
                                  echo 'L\'adresse ' . $_POST['email'] . ' n\'est pas valide, recommencez !';
                                  exit;
                              }
                        }


                        $pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT);

                        // Insertion
                        $req = $bdd->prepare('INSERT INTO MEMBRES(pseudo, pass, email, date_inscription) VALUES(:pseudo, :pass, :email, CURDATE())');
                        $req->execute(array(
                            'pseudo' => $pseudo,
                            'pass' => $pass_hache,
                            'email' => $email));
                            // header("Location: connexion.php");
                  }
            }
      ?>
    </body>
</html>
