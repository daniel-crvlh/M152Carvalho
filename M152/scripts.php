<?php


//Connexion à la base de données
function connectDB()
{
    $dbServer = "127.0.0.1";
    $dbName = "M152";
    $dbUser = "adminDaniel";
    $dbPwd = "Super1234";

    static $bdd = null;

    if ($bdd === null) {
        $bdd = new PDO("mysql:host=$dbServer;dbname=$dbName;charset=utf8", $dbUser, $dbPwd);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    return $bdd;
}

//Ajoute un média dans un post
function addMedia($nomMedia, $typeMedia, $idPost)
{

    try {
        $id = -1;

        $db = connectDB();

        $db->beginTransaction();

        $sql = "INSERT INTO Media(nomMedia, typeMedia, idPost) VALUES(:nomMedia, :typeMedia, :idPost);";

        $request = $db->prepare($sql);

        $request->execute(array('nomMedia' => $nomMedia,
            'typeMedia' => $typeMedia,
            'idPost' => $idPost)) ;
        $id = $db->lastInsertId();
        $db->commit();
        return $id;
        
    } catch (Exception $e) {
        $db->rollBack();
    }
    
}

//Ajoute un post avec un commentaire
function addPost($commentaire)
{
    try {
        $id = -1;
        $db = connectDB();
        $db->beginTransaction();
        $sql = "INSERT INTO Post(commentaire) VALUES(:commentaire);";

        $request = $db->prepare($sql);
        $request->execute(array('commentaire' => $commentaire));
        $id = $db->lastInsertId();
        $db->commit();
        return $id;
    } catch (Exception $e) {
        $db->rollBack();
    }
}

//Obtient tous les posts
function getAllPosts()
{

    $db = connectDB();
    $sql = "SELECT * FROM Post ORDER BY idPost DESC";
    $request = $db->prepare($sql);
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}
//Obtient tous les medias
function getAllMedias()
{
    $db = connectDB();

    $sql = "SELECT * FROM Media ORDER BY idPost DESC ";
    $request = $db->prepare($sql);
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}
//Supprime un post
function deletePost($idPost)
{
    $db = connectDB();

    $sql = "DELETE FROM Post WHERE idPost = :idPost;";

    $request = $db->prepare($sql);
    return ($request->execute(array('idPost' => $idPost)));
}
//Supprime un media
function deleteMedia($idMedia)
{
    $db = connectDB();

    $sql = "DELETE FROM Media WHERE idMedia = :idMedia;";

    $request = $db->prepare($sql);
    return ($request->execute(array('idMedia' => $idMedia)));
}


/*
Met à jour le commentaire d'un post précis
retourne True si c'est bon, sinon ça retourne false
*/
function updateComment($idPost, $commentaire){
    $db = connectDB();

    $sql = "UPDATE Post SET commentaire = :commentaire WHERE idPost = :idPost;";

    $request = $db->prepare($sql);

    if ($request->execute(array(
        'idPost' => $idPost,
        'commentaire' => $commentaire
    ))) {
        return true;
    } else {
        return false;
    }

}

/*
retourne le nombre de médias pour un post précis
*/
function nbMediasPourUnPost($idPost){
    $db = connectDB();

    $sql = "SELECT COUNT(*) FROM Media WHERE idPost = :idPost;";

    $request = $db->prepare($sql);

    if ($request->execute(array(
        'idPost' => $idPost
    ))) {
        return $request->fetchColumn();
    }
}
/*
retourne un un commentaire d'un post précis
*/
function getCommentaireOfPost($idPost){
    $db = connectDB();
    $sql = "SELECT commentaire FROM Post WHERE idPost = :idPost;";
    $request = $db->prepare($sql);
    $request->execute(array("idPost" => $idPost));
    return $request->fetchAll(PDO::FETCH_ASSOC);

}
