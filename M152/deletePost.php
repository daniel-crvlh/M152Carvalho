<?php
include "scripts.php";

$idPost = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING);

$medias = getAllMedias();

foreach ($medias as $media) {
    if ($media["idPost"] == $idPost) {
        deleteMedia($media["idMedia"]);
        unlink("rsc/" . $media["nomMedia"]);        
    }
}

deletePost($idPost);

header('Location: index.php');
exit();
