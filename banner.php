<div class="top">
	<a href="./frontpage.php"><img class="banner" src="./img/banner.png" /></a>
	<div style="position:relative; width:250px; height:80px; margin-left:auto; margin-right:20px; top: 15px; background-color:white;">
		<?php
			$user = getUsername();
			if($user == null) {
				//not logged in - provide a login form
				echo "<form action='' method='post' onsubmit='alert(\"loggar in. Ej implementerat.\");'>";
				echo "Username: <input type='text' name='username'><br>";
				echo "Password: <input type='password' name='pwd'><br>";
				echo "<input type='submit' value='Login'></form>";
			} else {
				//logged in - provide a greeting.
				echo "You are signed in as <b>".$user."</b>.<br>\n";
				echo "<a href='./editprofile.php'> Click here to edit your profile </a>";				
			}
		?>
	</div>
</div>
