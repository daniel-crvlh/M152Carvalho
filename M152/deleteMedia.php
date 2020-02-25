<?php

include "scripts.php";
//Récupère l'id du post en get
$idMedia = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING);
$idPost = filter_input(INPUT_GET, "idPost", FILTER_SANITIZE_STRING);
$medias = getAllMedias();
//Travaerse tous les medias
foreach ($medias as $media) {
    if ($media["idMedia"] == $idMedia) {
        deleteMedia($media["idMedia"]);
        unlink("rsc/" . $media["nomMedia"]);        
    }
}


header('Location: updatePost.php?id='.$idPost);
exit();
