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


function addMedia($nomMedia, $typeMedia, $idPost)
{
    $db = connectDB();

    $sql = "INSERT INTO Media(nomMedia, typeMedia, idPost) VALUES(:nomMedia, :typeMedia, :idPost);";

    $request = $db->prepare($sql);

    if ($request->execute(array(
        'nomMedia' => $nomMedia,
        'typeMedia' => $typeMedia,
        'idPost' => $idPost
    ))) {
        return $db->lastInsertID();
    } else {
        return NULL;
    }
}

function addPost($commentaire)
{
    $db = connectDB();

    $sql = "INSERT INTO Post(commentaire) VALUES(:commentaire);";
     var_dump($db);
    $request = $db->prepare($sql);

    if ($request->execute(array(
        'commentaire' => $commentaire
    ))) {
        return $db->lastInsertID();
    } else {
        return NULL;
    }
}



function getIdPostWithCommentAndDate($commentaire, $datePost)
{
    $db = connectDB();

    $sql = "SELECT idPost FROM Post WHERE commentaire = :commentaire AND datePost = :datePost;";
    $request = $db->prepare($sql);
    $request->execute(array(
        "commentaire" => $commentaire,
        "datePost" => $datePost
    ));
    return $request->fetch(PDO::FETCH_ASSOC);
}

function getAllPosts(){

    $db = connectDB();
    $sql = "SELECT * FROM Post ORDER BY idPost DESC";
    $request = $db->prepare($sql);
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);

}

function getAllMedias(){
    $db = connectDB();

    $sql = "SELECT * FROM Media ORDER BY idPost DESC ";
    $request = $db->prepare($sql);
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

