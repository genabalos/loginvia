<html>
	<head>
		<title>Home</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>">
		<script src="<?php echo base_url('jquery-3.0.0.min');?>"></script>
		<script src="<?php echo base_url('bootstrap/js/bootstrap.min.js');?>"></script>
		<script language="JavaScript" type="text/javascript"></script>
		<link rel="stylesheet" type="text/css" href="<? echo base_url('styles.css');?>">
	</head>
	
	<body style="background-image: url(<?php echo base_url('images/basketballcourt3.jpg');?>">

		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="height:30%;"> </div>
		
		<div id="wrapper">
			<div class="col-xs-1 col-sm-2 col-md-3 col-lg-5"></div>
			<div class="slim container col-xs-10 col-sm-8 col-md-6 col-lg-2" style="background-color: #f7f8f3; border-radius: 25px; text-align:center;">
				<div class="row">
					<div class="box01">
						<div class="login-window">
							
							
							<?php echo form_open('login'); ?>
								<br>
								<button class="" value="facebook" name="connectWith" type="submit">
									<img src="<?php echo base_url('images/loginwithfacebook.png'); ?>" class='img-resposive'>
								</button>
								<br>
								<button class="" value="google" name="connectWith" type="submit">
									<img src="<?php echo base_url('images/signinwithgoogle.png'); ?>" class='img-resposive'>
								</button>
							</form>
							
						</div>

					</div>
				</div>
			</div>
			<div class="col-xs-1 col-sm-2 col-md-3 col-lg-5"></div>
			 
			<br><br>
			<footer id="footer" style="text-align: center; margin-top: -180px; color: black; clear: both; position:absolute; bottom:0; width:100%; height: 60px;">
				<br>
				<br>
				<p>© Copyright 2016, ITDC Midyear Internship &nbsp;&nbsp;&nbsp;&nbsp;</p>
			</footer>
		</div>
	</body>
</html>