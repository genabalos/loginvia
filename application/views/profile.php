<html>
	<head>
		<title>Login via Facebook</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>">
		<script src="<?php echo base_url('jquery-3.0.0.min');?>"></script>
		<script src="<?php echo base_url('bootstrap/js/bootstrap.min.js');?>"></script>
		<script language="JavaScript" type="text/javascript"></script>
		<link rel="stylesheet" type="text/css" href="<? echo base_url('styles.css');?>">
		
		<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
	</head>
	
	<body>
	
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					<div class="well well-sm">
						<div class="row">
							<div class="col-sm-4 col-md-4 col-lg-4">
								<?php echo "<img class='fb_profile' src=".$picture_url.">"; ?>
							</div>
							<div class="col-sm-8 col-md-8 col-lg-8">
								<h2> <?php echo "<p class='profile_name'>Welcome <em>".$name."</em></p>";
									 ?>
								</h2>
						
									<i class="glyphicon glyphicon-envelope"></i><?php echo "<p>Email : ".$email."</p>"; ?>
									<?php
									echo "<p>ID : ".$id."</p>";
									echo "<p>Name : ".$name."</p>";
									echo "<p>First Name : ".$first_name."</p>";
									echo "<p>Last Name : ".$last_name."</p>";
									echo "<p>Email : ".$email."</p>";
									
									echo "<p>Gender : ".$gender."</p>";
									echo "<p>Facebook URL : "."<a href=".$link." target='_blank'"."> https://www.facebook.com/".$id."</a></p>";
									
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
		
		
	</body>
</html>