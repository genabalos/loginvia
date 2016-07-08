<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>">
		<script src="<?php echo base_url('jquery-3.0.0.min');?>"></script>
		<script src="<?php echo base_url('bootstrap/js/bootstrap.min.js');?>"></script>
		<script language="JavaScript" type="text/javascript"></script>
		<link rel="stylesheet" type="text/css" href="<? echo base_url('styles.css');?>">
		<link rel="stylesheet" media="screen and (max-width: 600px) and (min-width: 0px)" type="text/css" href="<?php echo base_url(); ?>css/styleresponsive2.css">
		<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
	</head>
	
	<body>
	
		<div id="main">
			<div id="envelope">
				<?php if (isset($authUrl)){ ?>
				<header id="sign_in">
				<h2>CodeIgniter Login With Google Oauth PHP</h2>
				</header>
				
				<div id="content">
				<center><a href="<?php echo $authUrl; ?>"><img id="google_signin" src="<?php echo base_url(); ?>images/google_login.jpg" width="100%" ></a></center>
				</div>
				
				<?php }else{ ?>
				
					<div class="container">
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
								<div class="well well-sm">
									<div class="row">
										<div class="col-sm-4 col-md-4 col-lg-4">
											<?php //echo "<img class='fb_profile' src=".$picture_url.">"; ?>
										</div>
										<div class="col-sm-8 col-md-8 col-lg-8">
											<h2> <?php echo "<p class='profile_name'>Welcome <em>".$displayName."</em></p>";
												 ?>
											</h2>
									
												<i class="glyphicon glyphicon-envelope"></i>
												
												<?php
												echo "<p>ID : ".$id."</p>";
												echo "<p><b> Name : </b>" . $displayName . "</p>";
												
												?>
												<div class="btn-group">
													<a href="<?php echo site_url('oauth_login/logout') ?>">
														<button type="button" class="btn btn-primary">Logout</button>
													</a>
												</div>	
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				
				<?php }?>
			</div>
		</div>
	</body>
</html>