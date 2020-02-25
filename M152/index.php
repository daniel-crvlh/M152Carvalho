<!--
	Carvalho Daniel
	20.01.2020
	M152

	Template trouvé sur :
	https://usebootstrap.com/download-theme/facebook
	
-->


<!DOCTYPE html>
<html lang="fr">

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>M152</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="assets/css/bootstrap.css" rel="stylesheet">
	<!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
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
						<!-- 







						-->
						<nav class="collapse navbar-collapse" role="navigation">
							<form class="navbar-form navbar-left" action="">
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
									<a href="post.php"><i class="glyphicon glyphicon-plus"></i> Post</a>
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
										<h1>Welcome !</h1>
										<hr>
									</div>


									<div class="panel panel-default">
										<h2>Publications</h2>
										<table>


											<?php
											include "scripts.php";
											$uploadDir = "rsc/";
											$posts = getAllPosts();
											$media = getAllMedias();
											$total = count($posts);
											$totalMedias = count($media);


											for ($i = 0; $i < $total; $i++) {


												echo '<tr><td><div class="panel-body">
											<div class="clearfix"></div>';
												echo '<div class="panel-body">
											<div class="clearfix"></div>
											<hr>

											<p><b>';
												echo $posts[$i]["commentaire"];
												echo "</td><td><a href='deletePost.php?id=" . $posts[$i]["idPost"] . "'> <button class='btn btn-primary btn-sm'>Delete</button></a> 
												<a href='updatePost.php?id=" . $posts[$i]["idPost"] . "'> <button class='btn btn-primary btn-sm'>Update</button></a>";
												echo '</b></p></td></tr>';
												for ($j = 0; $j < $totalMedias; $j++) {
													if ($posts[$i]["idPost"] == $media[$j]["idPost"]) {

														$typeFinal = explode("/", $media[$j]["typeMedia"]);

														echo "<tr><td>";

														if ($typeFinal[0] == "video") {
															echo '<div class="input-group">
																<div class="input-group-btn">'
																. '<video src="' . $uploadDir . $media[$j]["nomMedia"] . '" controls loop autoplay width="350"></video>'  .
																'</div></td>';
														}
														if ($typeFinal[0] == "image") {
															echo '<div class="input-group">
																<div class="input-group-btn">'
																. '<img src="' . $uploadDir . $media[$j]["nomMedia"] . '" width="350">'  .
																'</div></td>';
														}
														if ($typeFinal[0] == "audio") {
															echo '<div class="input-group">
																<div class="input-group-btn">'
																. '<audio src="' . $uploadDir . $media[$j]["nomMedia"] . '" controls width="350"></audio>'  .
																'</div></td>';
														}

														echo "</tr>";
													}
												}

												echo '</div>

										</div>';
											}

											?>
										</table>
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