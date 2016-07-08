	
		
		<div class="col-xs-1 col-sm-2 col-md-3 col-lg-3"></div>
		<div class="container col-xs-10 col-sm-8 col-md-6 col-lg-6" style="background-color: #f7f8f3; border-radius: 25px; text-align:center; margin:auto; top:100px;">
			<div class="col-xs-1 col-sm-1 col-md-2 col-lg-3"></div>
			<div class="row" style="background-color: #f7f8f3; border-radius: 25px;">
				<div class="hd-img col-xs-4 col-sm-5 col-md-6 col-lg-6" style="text-align:center;">
					<?php echo "<br>";
						echo "<img class='img-resposive' style='border-radius: 50%; overflow: hidden;' src=".$avatar.">"; 
					?>
					<h2> <?php echo "<p class='profile_name'>Welcome <em>".$firstName."</em>!</p>";?></h2>
			
						<i class="glyphicon glyphicon-envelope"></i><?php echo "<p>Email : ".$email."</p>"; ?>
						<?php
							echo "<p>ID : ".$id."</p>";
							echo "<p>Name : ".$name."</p>";
							echo "<p>First Name : ".$firstName."</p>";
							echo "<p>Last Name : ".$lastName."</p>";
						?>
						
						<div class="btn-group">
							<a href="<?php echo site_url('login/logout') ?>"><button type="button" class="btn btn-primary" style="background-color: #303030;">Logout</button></a>
						</div>	
				</div>
			<div class="col-xs-1 col-sm-1 col-md-2 col-lg-3"></div>	
			</div>
		</div>
		<div class="col-xs-1 col-sm-2 col-md-3 col-lg-3"></div>
		

