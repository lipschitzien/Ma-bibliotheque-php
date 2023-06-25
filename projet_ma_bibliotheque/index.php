<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ma bibliothèque</title> <!--le titre de la page index.php-->
    <link rel="stylesheet" type="text/css" href="styles/style.css"> <!--le lien vers le fichier css-->
    <link rel="stylesheet" type="text/css" href="styles/style_index.css"> <!--le lien vers le fichier css pour index.php-->
</head>

<body>

    <h2>Ma bibliothèque</h2> <!--un titre-->

    <a href="livres.php" class="lien mt-8 mb-24"> Liste des livres </a> <!--un lien vers le fichier livres.php.-->

    <form action = "index.php" method = "post"> <!--une formulaire à remplir avec méthode POST-->
        
        <fieldset><!--fieldset 1-->
            <legend class="legend-1">AJOUTER UN LIVRE</legend>

            <!--lier chaque label avec "for" et "id" pour chaque champ-->
            <!--les champs de texte: titre, prenom et nom sont obligatoire-->

            <div class="ml-18 mt-24">
                <label for = "titre_label">Titre<small>(obligatoire)</small> </label>
                <input type = "text" name = "titre_input" id = "titre_label" class="d-block mt-8" required>
            </div>

            <fieldset class="flex-1 my-24 p-16"><!--fieldset 1.1-->
                <legend>Auteur</legend>

                <div>
                    <label for = "prenom_label">Prénom<small>(obligatoire)</small></label>
                    <input type = "text" name = "prenom_input" id = "prenom_label" class="d-block mt-8" required>
                </div>

                <div class="ml-4">
                    <label for = "nom_label">Nom<small>(obligatoire)</small></label>
                    <input type = "text" name ="nom_input" id = "nom_label" class="d-block mt-8" required>
                </div>

            </fieldset><!--fieldset 1.1-->

            <fieldset class="my-24 p-16"><!--fieldset 1.2-->
                <legend>Catégorie(s)<small>(obligatoire)</small></legend>
                <!--un multi-checkbox, il va créer une tableau vide,
                et ajouter chaque fois le "value" qu'on choisit à la fin du tableau-->
                
                <div class = "box">

                    <div class = "box-left">
                
                        <div>
                            <input type = "checkbox" name = "categorie[]" value = "aventures" id = "Aventure_label">
                            <label for = "Aventure_label"> Aventures </label>
                        </div>

                        <div>
                            <input type = "checkbox" name = "categorie[]" value = "conte" id = "Conte_label">
                            <label for = "Conte_label"> Conte </label>
                        </div>

                        <div>
                            <input type = "checkbox" name = "categorie[]" value = "fantasy" id = "Fantasy_label">
                            <label for = "Fantasy_label"> Fantasy </label>
                        </div>

                        <div>
                            <input type = "checkbox" name = "categorie[]" value = "horreur" id = "Horreur_label">
                            <label for = "Horreur_label"> Horreur </label>
                        </div>

                        <div>
                            <input type = "checkbox" name = "categorie[]" value = "romance" id = "Romance_label">
                            <label for = "Romance_label"> Romance </label>
                        </div>

                    </div>

                    <div class = "box-right">
                        
                        <div>
                            <input type = "checkbox" name = "categorie[]" value = "biographie" id = "Biographie_label">
                            <label for = "Biographie_label"> Biographie </label>
                        </div>
                
                        <div>
                            <input type = "checkbox" name = "categorie[]" value = "fantastique" id = "Fantastique_label">
                            <label for = "Fantastique_label"> Fantastique </label>
                        </div>

                        <div>
                            <input type = "checkbox" name = "categorie[]" value = "historique" id = "Historique_label">
                            <label for = "Historique_label"> Historique </label>
                        </div>
                
                        <div>
                            <input type = "checkbox" name = "categorie[]" value = "policier" id = "Policier_label">
                            <label for = "Policier_label"> Policier </label>
                        </div>

                        <div>
                            <input type = "checkbox" name = "categorie[]" value = "science-fiction" id = "Science-fiction_label">
                            <label for = "Science-fiction_label"> Science-fiction </label>
                        </div>

                    </div>

                </div>

            
            </fieldset><!--fieldset 1.2-->   

            <button type = "submit" name = "envoie"> Ajouter </button>
            <!--le bouton de soumission du formulaire.-->

        </fieldset> <!--fieldset 1-->

    </form> 

    <?php
    
    //pour moi: afficher tous les valeurs dans le $_POST pour vérifier.
    /*
    echo "<pre>";
    print_r($_POST); //pour moi
    echo "</pre>"; 
    */

    //vérifier si les valeurs de $_POST pour les 3 premiers champs sont reçues.
    if(isset($_POST["titre_input"]) && isset($_POST["prenom_input"]) && isset($_POST["nom_input"])){//0.0

        $titre = trim($_POST["titre_input"]);
        $prenom = trim($_POST["prenom_input"]);
        $nom = trim($_POST["nom_input"]);

        if(empty($titre) || empty($prenom) || empty($nom)){//1.1
            //si on a reçu tous les 3 premiers champs, vérifier s'il y a des erreurs.
            //si oui, afficher ce message à l'utilisateur, et on ne fait rien.

            echo "<p><strong>Tous les champs sont obligatoires.</strong></p>";
        }//1.1

        //si on a bien reçu et sans erreur, alors
        else{//1.2

            //vérifier si le tableau de catégories de checkbox est vide.
            //si ce n'est pas vide, on affecte ce tableau dans une variable $categorie.
            if(isset($_POST["categorie"])){//2.1
                $categorie = $_POST["categorie"];

                //s'il n'y a pas d'erreur, alors
                if(!(empty($categorie))){//3.1
                    $liste_categorie = "";
                    //créer une chaine de caractère vide

                    foreach($categorie as $val){//4.1
                    //parcourir le tableau de catégorie (dimension 1) 

                        $liste_categorie = $liste_categorie . " " . $val . " ";
                        //concatener les catégories dans la chaine de caractère $liste_categorie, le séparateur est l'espace.
                        //parce que pour utiliser fgetcsv, on a besoins d'une chaine de caractère comme catégotie, mais pas un tableau.

                    }//4.1
                    
                    $livre = array("TITRE" => $titre, "PRENOM" => $prenom, "NOM" => $nom, "CATEGORIE" => $liste_categorie);
                    //créer un tableau de dimention 1, pour affecter les valeurs (type String) avec les clefs.

                    //parcourir cette tableau, pour fabriquer un tableau avec que les clefs de $livre(c'est pour l'entête après).
                    foreach ($livre as $key=>$tete){//5.1

                        $key_tete[] = $key;
                        //on crée un tableau vide $key_tete
                        //chaque fois on affecte la clef dans le tableau $key_tete
                        //$key_tete sera utilisé comme la ligne d'entête.

                    }//5.1


                    $filename = "mes_livres.csv";
                    $file = fopen($filename, "a+");
                    //ouvrir le fichier en écriture et en lecture, en plaçant à la fin du fichier.
                    //si le fichier n’existe pas, il va être créé.

                    $rang = 0; //un compteur pour qu'on puisse faire les itérations dans la boucle while

                    $tete_existe = false; //un vérificateur pour savoir si la ligne d'entête existe.

                    $livre_existe = false; //un vérificateur pour savoir si le livre existe déjà dans le fichier.

                    //récupérer son contenu avec la fonction fgetcsv.
                    //on affecte le contenu dans une variable $ligne

		            //on lit le fichier mes_livres.csc ligne par ligne,
                    //pour savoir si la ligne d'entête et le livre existent déjà dans le fichier.
 		            //une fois la boucle while est fini(valeur égale false), on arrête.
                    
                    while(($ligne = fgetcsv($file))!== false){//6.1

                        if(preg_match_all("/^(?i)(categorie)$/", $ligne[3])){//7.1
                            $tete_existe = true;
                            //vérifier si l'entête existe, si oui, renvoie true.
                            //c'est suffit de juste vérifier si le 4ème élément est "categorie", parce qu'on n'a pas de catégorie qui s'appelle "CATEGORIE" ou "categorie".
                            //(mais on peut avoir un livre qui s'appelle vraiment "TITRE" ou "titre" etc.)

                            //utiliser l'expression régulière pour ignorer le majuscule et le miniscule quand on compare.

                        }//7.1
                        else if(preg_match_all("/^(?i)$ligne[0]$/", $titre) and preg_match_all("/^(?i)$ligne[1]$/", $prenom) and preg_match_all("/^(?i)$ligne[2]$/", $nom)){//7.2
                            $livre_existe = true;
                            //vérifier si le livre existe, si oui, renvoie true.
                            //utiliser l'expression régulière pour ignorer le majuscule et le miniscule quand on compare.

                            //si ce livre existe déjà, on affiche les message à l'utilisateur, et on ne fait rien.
                            //la première notice est pour qu'on puisse comparer les données qu'on a saisie et les données qui existent dans une ligne de mes_livres.csv.
                            //on peut observer que $titre == $ligne[0], $prenom == $ligne[1], $nom == $ligne[2](ignorer le majuscule et le miniscule).
                            echo "<p>Notice: Vous voulez ajouter encore une fois le livre [$titre] de [$prenom] [$nom].</p>";
                            echo "<p>Vous avez déjà ajouté le livre [$ligne[0]] de [$ligne[1]] [$ligne[2]].</p>";

                            break;
                            //une fois qu'on a trouvé le même livre, on n'a pas besoins de continuer,
                            //on sort immédiatement de la boucle while.

                        }//7.2

                        $rang++; //incrémentation pour le compteur
                        
                    }//6.1
                
                    //Puis on saisit un livre, il y a 3 cas possibles.
                    
                    if($tete_existe == false){//9.1
                    //le premier cas: si la ligne d'entête n'existe pas,
                    //c'est-à-dire que c'est un fichier vide,
                    //alors on sait que ce livre n'existe pas dans le fichier non plus.
                    //(on a forcément $livres_existe == false)

                    //alors on ajoute la ligne d'entête dans le fichier d'abord
                    //puis on ajoute la ligne d'informations du livre dans ce fichier.
                        fputcsv($file, $key_tete);
                        fputcsv($file, $livre);

                        //puis on affiche ce message à l'utilisateur.
                        echo "<p>J’ai bien ajouté le livre [$titre] de [$prenom] [$nom] dans la(les) catégorie(s) [$liste_categorie].</p>";
                    }//9.1

                    else if($tete_existe == true and $livre_existe == false){//9.2
                    //le deuxième cas: si la ligne d'entête existe déjà, mais ce livre n'existe pas dans le fichier

                    //alors on ajoute la ligne d'informations du livre dans le fichier.
                        fputcsv($file, $livre);

                        //puis on affiche ce message à l'utilisateur.
                        echo "<p>J’ai bien ajouté le livre [$titre] de [$prenom] [$nom] dans la(les) catégorie(s) [$liste_categorie].</p>";
                   
                    }//9.2

                    //le troisième cas: si ce livre existe déjà dans le fichier.
                    //donc dans la condition else if($livre_existe == true)
                    //c'est-à-dire l'entête existe déjà, on a forcément $tete_existe == true.
                    //on a déjà afficher les messages dans la boucle while(la ligne 218 et la ligne 219), puis on ne fait rien pour ce cas.
      
                    fclose($file);
                    //fermer le fichier après tous les opérations.

                }//3.1
            }//2.1
            else{//2.2
                echo "<p><strong>Il faut choisir au moins une catégorie.</strong></p>";
                //si on a reçu aucune catégorie de checkbox, afficher ce message et on ne fait rien.
            }//2.2
            
        }//1.2

    }//0.0

    ?>

</body>
</html>