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


function addMedia($nomMedia, $typeMedia)
{
    $db = connectDB();

    $sql = "INSERT INTO Media(nomMedia, typeMedia) VALUES(:nomMedia, :typeMedia);";

    $request = $db->prepare($sql);

    if ($request->execute(array(
        'nomMedia' => $nomMedia,
        'typeMedia' => $typeMedia
    ))) {
        return $db->lastInsertID();
    } else {
        return NULL;
    }
}

function addPost($commentaire, $datePost)
{
    $db = connectDB();

    $sql = "INSERT INTO Post(commentaire, datePost) VALUES(:commentaire, :datePost);";

    $request = $db->prepare($sql);

    if ($request->execute(array(
        'commentaire' => $commentaire,
        'datePost' => $datePost
    ))) {
        return $db->lastInsertID();
    } else {
        return NULL;
    }
}

function addConnection($idPost, $idMedia)
{
    $db = connectDB();

    $sql = "INSERT INTO Contient(idMedia, idPost) VALUES(:idPost, :idMedia);";

    $request = $db->prepare($sql);

    if ($request->execute(array(
        'idPost' => $idPost,
        'idMedia' => $idMedia
    ))) {
        return $db->lastInsertID();
    } else {
        return NULL;
    }
}

function getIdMediaWithNameAndType($nomMedia, $typeMedia)
{
    $db = connectDB();

    $sql = "SELECT idMedia FROM Media WHERE nomMedia= :nomMedia AND typeMedia= :typeMedia ";
    $request = $db->prepare($sql);
    $request->execute(array(
        "nomMedia" => $nomMedia,
        "typeMedia" => $typeMedia
    ));
    return $request->fetch(PDO::FETCH_ASSOC);
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

function getAllIdPostAndIdMedia()
{
    $db = connectDB();

    $sql = "SELECT idPost, idMedia FROM Contient";
    $request = $db->prepare($sql);
    $request->execute();
    return $request->fetch(PDO::FETCH_ASSOC);
}

function getCommentWithIdPost($idPost)
{
    $db = connectDB();

    $sql = "SELECT commentaire FROM Post WHERE idPost = :idPost";
    $request = $db->prepare($sql);
    $request->execute(array(
        "idPost" => $idPost
    ));
    return $request->fetch(PDO::FETCH_ASSOC);
}

function getMediaWithIdMedia($idMedia)
{
    $db = connectDB();

    $sql = "SELECT nomMedia FROM Media WHERE idMedia = :idMedia";
    $request = $db->prepare($sql);
    $request->execute(array(
        "idMedia" => $idMedia
    ));
    return $request->fetch(PDO::FETCH_ASSOC);
}

