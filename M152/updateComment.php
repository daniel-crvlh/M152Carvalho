<?php
include "scripts.php";
//Récupère l'id du post en get
$idPost = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING);
$commentaire = filter_input(INPUT_GET, "comment", FILTER_SANITIZE_STRING);

updateComment($idPost, $commentaire);

header('Location: updatePost.php?id='.$idPost);
exit();