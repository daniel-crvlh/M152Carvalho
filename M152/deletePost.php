<?php
include "scripts.php";
//Récupère l'id du post en get
$idPost = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING);

$medias = getAllMedias();
//Parcoure tous les medias et vérifie lesquels sont ceux qui appartiennent à un post
foreach ($medias as $media) {
    if ($media["idPost"] == $idPost) {
        //Supprime le fichier d'un dossier choisi
        unlink("rsc/" . $media["nomMedia"]);        
    }
}
deletePost($idPost);

header('Location: index.php');
exit();
