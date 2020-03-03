<?php

include "scripts.php";
//Récupère l'id du post en get
$idMedia = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING);
$idPost = filter_input(INPUT_GET, "idPost", FILTER_SANITIZE_STRING);
$medias = getAllMedias();
//Traverse tous les medias
foreach ($medias as $media) {
    if ($media["idMedia"] == $idMedia) {
        deleteMedia($media["idMedia"]);
        unlink("rsc/" . $media["nomMedia"]);
    }
}
$postComment = getCommentaireOfPost($idPost);
$nbMedias = nbMediasPourUnPost($idPost);
if ($nbMedias <= 0 && $postComment[0]["commentaire"] == "") {
    header("Location: deletePost.php?id=" . $idPost);
    exit();
}

header('Location: updatePost.php?id=' . $idPost);
exit();
