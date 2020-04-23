<?php

$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');
if(isset($_POST['forminscription']))
{
	$pseudo = htmlspecialchars($_POST['pseudo']);
		$mail = htmlspecialchars($_POST['mail']);
		$mail2 = htmlspecialchars($_POST['mail2']);
		$mdp = sha1($_POST['mdp']);
		$mdp2 = sha1($_POST['mdp2']);

	if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']))
	{

		$pseudolength =  strlen($pseudo);
		if($pseudolength <= 255)
		{
			if($mail == $mail2)
			{
				if(filter_var($mail, FILTER_VALIDATE_EMAIL))
				{
					if($mdp == $mdp2)
					{
						$insertmbr = $bdd->prepare("INSERT INTO membres(pseudo, mail, motdepasse) VALUES (?, ?, ?)");
						$insertmb->execute(array($pseudo, $mail, $mdp));
						$erreur = "Votre compte est crée!";
					}
						else
						{
						$erreur = "Vous devez rentrer le même mot de passe que précédement! Vérifié!";
						}
					}
					else
					{
						$erreur = "Votre adresse mail n'est pas valide!";
					}

				}
				else
				{
					$erreur = "Vos adresses mail ne correspondent pas! Dommage!";
				}
			}
		else
		{
			$erreur = "Votre pseudo ne doit pas dépasser les 255 caractères!";
		}

	}
	else
	{
		$erreur = "TOUS LES CHAMPS DOIVENT ETRE COMPLETE!";
	}
}

?>



<!DOCTYPE html>
<html>
<head>
	<title>Inscription</title>
	<meta charset="utf-8">
</head>
<body>
	<div align="center">
		<style type="text/css"> h1{color:red ;} </style>
		<style type="text/css"> body {background-color:#C5F6CA ;}</style>
		<style type="text/css"> p {color:#547F80} </style>
		<style type="text/css"> a { color: blue; } </style>
		<h1>Inscription</h1>
		<br /><br />
		<form method="POST" action="">
			<table>
				<tr>
					<td align="right">
						<label for="pseudo">Pseudo:</label>
					</td>
					<td>
						<input type="text"
						placeholder="Votre pseudo"
						id="pseudo" 
						name="pseudo" value="<?php if(isset($pseudo)) { echo $pseudo;} ?>" />
					</td>
				</tr>
				<tr>
					<td align="right">
						<label for="mail">Adresse mail:</label>
					</td>
					<td align="right">
						<input type="text"
						placeholder="Votre adresse mail"
						id="mail" 
						name="mail"  value="<?php if(isset($mail)) { echo $mail; } ?>"/>
					</td>
				</tr>
				<tr>
					<td align="right">
						<label for="mail2">Confirmation de l'adresse mail:</label>
					</td>
					<td align="right">
						<input type="email"
						placeholder="Retaper votre adresse mail."
						id="mail2" 
						name="mail2" value="<?php if(isset($mail2)) { echo $mail2; } ?>" />
					</td>
					<tr>
					<td align="right">
						<label for="mdp">Mot de passe:</label>
					</td>
					<td align="right">
						<input type="password"
						placeholder="Votre mot de passe."
						id="mdp" 
						name="mdp" />
					</td>
					<tr>
					<td align="right">
						<label for="mdp2">Confirmation du mot de passe :</label>
					</td>
					<td align="right">
						<input type="password"
						placeholder="Retaper mot de passe."
						id="mdp2" 
						name="mdp2" />
					</td>
				</tr>
				<tr>
					<td></td>
					<td align="center"><input type="submit" name="forminscription" value="Je m'inscris"></td>
				</tr>
			</table>
		</form>
		<br>
		<a href="index.html">Retour à la page d'acceuil.</a>
		<?php
		if(isset($erreur))
		{
			echo '<font color="red">'.$erreur."</font>";
		}
		?>
	</div> 

</body>
</html>