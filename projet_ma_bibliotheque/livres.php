<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Liste des livres</title> <!--le titre de la page livres.php-->
	<link rel="stylesheet" type="text/css" href="styles/style.css"> <!--le lien vers le fichier css-->
	<link rel="stylesheet" type="text/css" href="styles/style_livres.css"> <!--le lien vers le fichier css pour livres.php-->
</head>

<body>
	<div class="main">
		
    	<h2>Ma bibliothèque</h2> <!--un titre-->

    	<a href="index.php" class="lien mt-8"> Ajouter un livre </a> <!--un lien vers le fichier livres.php.-->	

	
		<?php
	
		$filename = "mes_livres.csv";

		if(file_exists($filename)){//1.1
		//vérifier si le fichier existe, si oui on continue.

			$file_lecture_seule = fopen($filename, "r");
			//Si le fichier existe, l'ouvrir en lecture seule.

			echo "<table class='mb-16'>"; //tableau commence

			echo "<caption>";
			echo "Liste des livres dans ma bibliothèqe"; //caption du tableau
			echo "</caption>";

			//récupérer son contenu une fois, avec la fonction fgetcsv.
			//donc on affecte la première ligne dans une variable $entete
			if (($entete = fgetcsv($file_lecture_seule)) !== false){//2.1

				echo "<tr>";
				foreach($entete as $tete){//5.1
				//on saisit la première ligne comme la ligne d'entête.
				//parce qu'on a affecté les clefs à la première ligne dans l'index.php
					echo "<th>";
					echo "$tete";
					echo "</th>";				
				}//5.1
				echo "</tr>";

			}//2.1

			$rang = 0; //un compteur pour qu'on puisse faire les itérations dans la boucle while

			//récupérer son contenu à partir de la deuxième ligne, avec la fonction fgetcsv.
			//(on a déjà lit la première ligne comme une ligne d'entête)
			
			//on affecte le contenu dans une variable $ligne
			//on lit le fichier mes_livres.csc ligne par ligne.
 			//une fois c'est fini(valeur égale false), on arrête.
			while(($ligne = fgetcsv($file_lecture_seule))!== false){//3.1

				//pour chaque ligne, on saisit les données dans une ligne du tableau
				echo "<tr>";
				foreach ($ligne as $info){//4.1
				//on saisit chaque donnée dans chaque cellule de cette ligne.
					echo "<td>";
					echo "$info";
					echo "</td>";
				}//4.1
				echo "</tr>";

				$rang++; //incrémentation pour le compteur
			}//3.1

		echo "</table>"; //tableau fini

			fclose($file_lecture_seule); 
			//fermer le fichier après tous les opérations.
		}//1.1
	
		else{//1.2
			echo "<p>Le fichier $filename est introuvable.</p>";
			//Si le fichier n'existe pas, afficher ce message et on ne fait rien.
		}//1.2

		?>
	

	</div>
</body>
</html>