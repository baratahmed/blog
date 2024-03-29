<?php
	include '../lib/Session.php';
	Session::checkLogin();
	include '../config/config.php';
	include '../lib/Database.php';
	include '../helpers/Format.php';
	$db = new Database();
	$fm = new Format();
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Password Recovery</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<?php
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$email = $fm->validation($_POST['email']);
				$email = mysqli_real_escape_string($db->link,$email);
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				   echo "<span style='color:red;font-size:18px;'>Email Address is invalid!!!</span>";
				}else{
		$mailquery = "SELECT * FROM tbl_user WHERE email = '$email' LIMIT 1";
        $mailcheck = $db->select($mailquery);
                if ($mailcheck != FALSE) {
                    while ($value = $mailcheck->fetch_assoc()) {
                    	$userid = $value['id'];
                    	$username = $value['username'];
                    }
                    $text = substr($email, 0, 3);
                    $rand = rand(10000,99999);
                    $newpass = "$text$rand";
                    $password  = md5($newpass);
                    $updatequery = "UPDATE tbl_user
                    				SET
                    				password = '$password'
                    				WHERE id = '$userid'";
                    			$updated_row = $db->update($updatequery);
                  $mail_to = '$email';
                  $from = 'baratahmed28@gmail.com';
                  $header = "From: $from<br>";
                  $header .= "MIME-Version: 1.0";
    			  $header .= 'Content-type: text/html; charset=iso-8859-1';
    			  $mail_subject = "Your Password";
    			  $mail_message = "Your Username is ".$username." and Password is ".$newpass;
          $sendmail = mail($mail_to, $mail_subject, $mail_message, $header);
          if ($sendmail) {
          	echo "<span style='color:green;font-size:18px;'>Please Check your email for new Password.</span>";
          } else {
          	echo "<span style='color:red;font-size:18px;'>Email not Sent!!! Please Sign up.</span>";
          }
          
                }else{
					echo "<span style='color:red;font-size:18px;'>Email not exists!!! Please Sign up.</span>";
				}
			}
		}
		?>
		<form action="" method="post">
			<h1>Password Recovery</h1>
			<div>
				<input type="text" placeholder="Enter your email" required="" name="email"/>
			</div>
			<div>
				<input type="submit" value="Send" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="login.php">Log in</a>
		</div><!-- button -->
		<div class="button">
			<a href="#">B-Tech-Touch</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>