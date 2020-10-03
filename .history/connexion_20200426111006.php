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
    <label for="tab-1" class="tab">CONNEXION</label>

		<input id="tab-2" type="radio" name="tab" class="sign-up">
    <label for="tab-2" class="tab"><a href="inscription.php">INSCRIPTION</a></label>

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
    					<input id="check" type="checkbox" class="check" checked>
    					<label for="check"><span class="icon"></span> Keep me Signed in</label>
  				</div>

  				<div class="group">
  					  <input name="connexion" type="submit" class="button" value="Se connecter">
  				</div>

  				<div class="hr"></div>

  				<div class="foot-lnk">
  					  <a href="#forgot">Mot de passe oublié ?</a>
  				</div>
          <div class="hr">

          </div>

          <div class="php">
          <?php
                try{
                  $bdd = new PDO('mysql:host=localhost;dbname=Tp_Open;charset=utf8', 'root', '');
                }
                catch (Exception $e){
                  die('Erreur : ' . $e->getMessage());
                }

                if(isset($_POST['connexion'])){
                $pseudo=$_POST['pseudo'];
                $pass=$_POST['pass'];

                        if(empty($_POST['pseudo']) OR empty($_POST['pass'])){
                          echo "Veuillez remplir tous les champs svp.";
                          exit;
                        }

                        else {
                          // code...
                          //  Récupération de l'utilisateur et de son pass hashé
                                  $req = $bdd->prepare('SELECT id, pass FROM MEMBRES WHERE pseudo = :pseudo');
                                  $req->execute(array(
                                      'pseudo' => $pseudo));
                                  $resultat = $req->fetch();

                                  // Comparaison du pass envoyé via le formulaire avec la base
                                  $isPasswordCorrect = password_verify($_POST['pass'], $resultat['pass']);

                                  if (!$resultat){
                                      echo 'Vérifier votre identifiant !';
                                      exit;
                                  }
                                  else{
                                      if (!$isPasswordCorrect) {
                                        echo 'Vérifier votre mot de passe !';
                                        exit;
                                      }
                                      else {
                                          session_start();
                                          $_SESSION['id'] = $resultat['id'];
                                          $_SESSION['pseudo'] = $pseudo;
                                          echo 'Vous êtes connecté !';
                                      }
                                  }
                                  header("Location: accueil.php");
                        }
                }
            ?>
          </div>
    </div>
          </div>
			</div>

      </form>
    </body>
</html>
