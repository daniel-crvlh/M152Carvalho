<!--
	Carvalho Daniel
	20.01.2020
	Exercice Chapitre 1

	Template trouvé sur :
	https://usebootstrap.com/download-theme/facebook
	
-->

<?php

include 'scripts.php';
$btnSubmit = filter_input(INPUT_POST, "valider", FILTER_SANITIZE_STRING);
$uploadDir = "rsc/";
if ($btnSubmit) {
    //Obtient le nombre total d'images
    $total = count(array_filter($_FILES['img']['name']));

    //Récupére le commentaire inséré et la date
    $commentaire = filter_input(INPUT_POST, "commentaire", FILTER_SANITIZE_STRING);
    $date = date('Y-m-d H:i:s');

    $error = "Oui";

    $db = connectDB();


    //Vérifie qu'il y ait des fichiers à importer ou au moins un commentaire
    if ($total  > 0 || $commentaire != "") {
        $idPost = addPost($commentaire);
        for ($i = 0; $i < $total; $i++) {
            //Vérifie que le fichier ne soit pas plus grand que 3Mo
            if ($_FILES['img']['size'][$i] <= 9145728) {
                $imgName =  $_FILES['img']['name'][$i];
                $_FILES['img']['name'][$i] = time() . "_" . $imgName;
                $imgName = $_FILES['img']['name'][$i];
                $imgTmpName = $_FILES['img']['tmp_name'][$i];
                $imgType = $_FILES['img']['type'][$i];

                //Vérifie si l'importation a bien été réalisée
                if (move_uploaded_file($imgTmpName, $uploadDir . $imgName)) {

                    addMedia($imgName, $imgType, $idPost);
                } 
            } 
        }
        header("Location: index.php");
        exit();
    } 
}




?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Chapitre 2</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/facebook.css" rel="stylesheet">
</head>

<body>

    <div class="wrapper">
        <div class="box">
            <div class="row row-offcanvas row-offcanvas-left">


                <!-- /sidebar -->

                <!-- main right col -->
                <div class="column col-sm-10 col-xs-11" id="main">

                    <!-- top nav -->
                    <div class="navbar navbar-blue navbar-static-top">
                        <div class="navbar-header">
                            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a href="http://usebootstrap.com/theme/facebook" class="navbar-brand logo">D</a>
                        </div>
                        <nav class="collapse navbar-collapse" role="navigation">
                            <form class="navbar-form navbar-left">
                                <div class="input-group input-group-sm" style="max-width:360px;">
                                    <input class="form-control" placeholder="Search" name="srch-term" id="srch-term" type="text">
                                    <div class="input-group-btn">
                                        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                    </div>
                                </div>
                            </form>
                            <ul class="nav navbar-nav">
                                <li>
                                    <a href="index.php"><i class="glyphicon glyphicon-home"></i> Home</a>
                                </li>
                                <li>
                                    <!-- Insèrer un lien pour la page POST  -->
                                    <a href="" role="button" data-toggle="modal"><i class="glyphicon glyphicon-plus"></i>Post</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <!-- /top nav -->

                    <div class="padding">
                        <div class="full col-sm-9">

                            <!-- content -->
                            <div class="row">

                                <!-- main col left -->
                                <div class="col-sm-5">

                                    <div class="panel panel-default">
                                        <div class="panel-thumbnail"><img src="assets/img/bg_5.jpg" class="img-responsive"></div>
                                        <div class="panel-body">
                                            <p class="lead">Urbanization</p>
                                            <p>45 Followers, 13 Posts</p>

                                            <p>
                                                <img src="assets/img/uFp_tsTJboUY7kue5XAsGAs28.png" height="28px" width="28px">
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- main col right -->

                                <div class="col-sm-7">

                                    <!--Mot accueil-->
                                    <div>
                                        <hr>
                                        <h1>Add a post</h1>
                                        <hr>
                                    </div>


                                    <!-- Ajout de post -->


                                    <form action="post.php" method="POST" enctype="multipart/form-data">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4>Post <?php echo $error; ?></h4>
                                            </div>
                                            <div class="panel-body">
                                                <a href="#">Comment : </a>
                                                <input type="text" class="form-control" name="commentaire" placeholder="Add a comment here !" />
                                                <div class="clearfix"></div>
                                                <hr>
                                                Choose images : <input type="file" name="img[]" multiple accept="image/*,video/*, audio/*"/>

                                                <hr>
                                                <input type="submit" value="Post" name="valider" class='btn btn-primary btn-sm' />

                                    </form>

                                </div>
                            </div>



                        </div>
                    </div>
                    <!--/row-->

                    <div class="row">
                        <div class="col-sm-6">
                            <a href="#">Twitter</a> <small class="text-muted">|</small> <a href="#">Facebook</a>
                            <small class="text-muted">|</small> <a href="#">Google+</a>
                        </div>
                    </div>

                    <div class="row" id="footer">
                        <div class="col-sm-6">

                        </div>
                    </div>

                    <hr>

                    <h4 class="text-center">
                        <a href="http://usebootstrap.com/theme/facebook" target="ext">Source template</a>
                    </h4>

                    <hr>


                </div><!-- /col-9 -->
            </div><!-- /padding -->
        </div>
        <!-- /main -->

    </div>
    </div>
    </div>


    <!--post modal-->
    <div id="postModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>
                    Update Status
                </div>
                <div class="modal-body">
                    <form class="form center-block">
                        <div class="form-group">
                            <textarea class="form-control input-lg" autofocus="" placeholder="What do you want to share?"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div>
                        <button class="btn btn-primary btn-sm" data-dismiss="modal" aria-hidden="true">Post</button>
                        <ul class="pull-left list-inline">
                            <li><a href=""><i class="glyphicon glyphicon-upload"></i></a></li>
                            <li><a href=""><i class="glyphicon glyphicon-camera"></i></a></li>
                            <li><a href=""><i class="glyphicon glyphicon-map-marker"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="assets/js/jquery.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('[data-toggle=offcanvas]').click(function() {
                $(this).toggleClass('visible-xs text-center');
                $(this).find('i').toggleClass('glyphicon-chevron-right glyphicon-chevron-left');
                $('.row-offcanvas').toggleClass('active');
                $('#lg-menu').toggleClass('hidden-xs').toggleClass('visible-xs');
                $('#xs-menu').toggleClass('visible-xs').toggleClass('hidden-xs');
                $('#btnShow').toggle();
            });
        });
    </script>
</body>

</html>