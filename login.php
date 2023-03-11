<?php
// Call the the header.php file
include('include/header.php');

// Check if the user is logged in
if (isset($_SESSION['user_logged_in'])) {
	// Redirect to the index page
	header('Location:index.php');
}


extract($_REQUEST);


if (isset($login)) {

	$email = filter_input(INPUT_POST, 'email');
	$pass = filter_input(INPUT_POST, 'pass');

	//Get the user information from the database.
	$stmt = $pdo->prepare("select id, email, password from users where email=?");
	$stmt->execute([$email]);
	$row = $stmt->fetch();
	$user_id = $row['id'];
	if ($row) {

		$db_password = $row['password'];

		if (password_verify($pass, $db_password)) {

			session_regenerate_id();
			// set session to authenticated
			$_SESSION['auth'] = TRUE;
			$_SESSION['user_logged_in'] = TRUE;

			$_SESSION['email'] = $email;
			$_SESSION['loggedin_time'] = time();
			$_SESSION['user_id'] = $user_id;

			echo "<script src='include/assets/js/sweetalert2.all.min.js'></script>";
			echo "<script language = javascript>
			Swal.fire({
				icon: 'success',
				title: 'You logged in successfully',
				showConfirmButton: false,
				timer: 2000
			  }).then(function() {
				window.location.href = 'index.php';
			})
          </script>";
		} else {
			$_SESSION['login_failure'] = "Invalid email or password";
			echo "<script src='include/assets/js/sweetalert2.all.min.js'></script>";
			echo "<script language = javascript>
        Swal.fire({
            icon: 'error',
            text: 'Invalid email or password',
          })
          </script>";

			header('Location:login.php');
		}
	} else {
		$_SESSION['login_failure'] = "Invalid email or password";
		echo "<script src='include/assets/js/sweetalert2.all.min.js'></script>";
		echo "<script language = javascript>
        Swal.fire({
            icon: 'error',
            text: 'Invalid email or password',
          })
          </script>";
	}
} else

if (isset($signup)) {

	$currdate = date('m/d/Y', time());
	$currtime = date('H:i:s', time());
	$sql = "INSERT INTO users(display_name,user_type,email,password,user_status,system_date,system_time, update_date, update_time) values(?,?,?,?,?,?,?,?,?)";
	$displayName_input = filter_input(INPUT_POST, 'displayName_var');
	$email_input = filter_input(INPUT_POST, 'email_var');
	$pass_input = filter_input(INPUT_POST, 'pass_var');
	$hash_password = password_hash($pass_input, PASSWORD_DEFAULT);

	$signup_stmt = $pdo->prepare($sql);
	$signup_stmt->execute([$displayName_input, 'user', $email_input, $hash_password,  1, $currdate, $currtime, '', '']);

	if ($signup_stmt) {

		echo "<script src='include/assets/js/sweetalert2.all.min.js'></script>";
		echo "<script language = javascript>
		  Swal.fire({
			  icon: 'success',
			  title: 'The user has been registered successfully. Please sign in.',
			  showConfirmButton: false,
			  timer: 2000
			})
		</script>";
	}
}
?>

<div class="login-container mt-4 center-container" id="login-container">
	<div class="form-container sign-up-container">
		<form method="POST" method="post" enctype="multipart/form-data">
			<h1>Create Account</h1>
			<input required type="text" name="displayName_var" id="displayName_var" placeholder="Display Name" />
			<input required type="email" name="email_var" id="email_var" placeholder="Email" />
			<div class="main-password">
				<input required type="password" name="pass_var" id="pass_var" class="input-password" placeholder="Password" aria-label="password" />
				<a href="JavaScript:void(0);" class="icon-view">
					<i class="fa fa-eye"></i>
				</a>
			</div>
			<div class="password-check form-group" id="popover-password">
				<p><span id="result"></span></p>
				<div class="progress">
					<div id="password-strength" class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%">
					</div>
				</div>
				<ul class="list-unstyled">
					<li class="">
						<span class="low-upper-case">
							<i class="fa fa-circle" aria-hidden="true"></i>
							&nbsp;Lowercase &amp; uppercase
						</span>
					</li>
					<li class="">
						<span class="one-number">
							<i class="fa fa-circle" aria-hidden="true"></i>
							&nbsp;Numbers (0-9)
						</span>
					</li>
					<li class="">
						<span class="one-special-char">
							<i class="fa fa-circle" aria-hidden="true"></i>
							&nbsp;Special characters (!@#$%^&*)
						</span>
					</li>
					<li class="">
						<span class="eight-character">
							<i class="fa fa-circle" aria-hidden="true"></i>
							&nbsp;At least 8 characters
						</span>
					</li>
				</ul>
			</div>

			<button type="submit" class="mt-3" name="signup" id="signup">Sign Up</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form method="POST" method="post" enctype="multipart/form-data">
			<h1>Sign in</h1>
			<input required type="email" name="email" id="email" placeholder="Email" />
			<div class="main-password">
				<input required type="password" name="pass" id="pass" class="input-password" placeholder="Password" aria-label="password" />
				<a href="JavaScript:void(0);" class="icon-view">
					<i class="fa fa-eye"></i>
				</a>
			</div>
			<button type="submit" name="login" id="login" class="mt-3">Sign In</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Hello!</h1>
				<p>Already have an account?</p>
				<button class="ghost" id="signIn">Sign In</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Hello!</h1>
				<p>Don't have an account?</p>
				<button class="ghost" name="signUp" id="signUp">Sign Up</button>
			</div>
		</div>
	</div>
</div>

<?php

// Call the the footer.php file
include('include/footer.php');
?>

<script>
	$(document).ready(function() {

		$('#signup').hide();


		let state = false;
		let password = document.getElementById("pass_var");
		let passwordStrength = document.getElementById("password-strength");
		let lowUpperCase = document.querySelector(".low-upper-case i");
		let number = document.querySelector(".one-number i");
		let specialChar = document.querySelector(".one-special-char i");
		let eightChar = document.querySelector(".eight-character i");

		password.addEventListener("keyup", function() {
			let pass = document.getElementById("pass_var").value;
			checkStrength(pass);
		});

		// This function is to check the password strength when it is enter by the user during the signup
		function checkStrength(password) {
			let strength = 0;

			//If password contains both lower and uppercase characters
			if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) {
				strength += 1;
				lowUpperCase.classList.remove('fa-circle');
				lowUpperCase.classList.add('fa-check');
			} else {
				lowUpperCase.classList.add('fa-circle');
				lowUpperCase.classList.remove('fa-check');
			}
			//If it has numbers and special characters
			if (password.match(/([0-9])/)) {
				strength += 1;
				number.classList.remove('fa-circle');
				number.classList.add('fa-check');
			} else {
				number.classList.add('fa-circle');
				number.classList.remove('fa-check');
			}
			//If it has one special character
			if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) {
				strength += 1;
				specialChar.classList.remove('fa-circle');
				specialChar.classList.add('fa-check');
			} else {
				specialChar.classList.add('fa-circle');
				specialChar.classList.remove('fa-check');
			}
			//If password is greater than 7
			if (password.length > 7) {
				strength += 1;
				eightChar.classList.remove('fa-circle');
				eightChar.classList.add('fa-check');
			} else {
				eightChar.classList.add('fa-circle');
				eightChar.classList.remove('fa-check');
			}

			// If value is less than 2
			if (strength < 2) {
				passwordStrength.classList.remove('progress-bar-warning');
				passwordStrength.classList.remove('progress-bar-success');
				passwordStrength.classList.add('progress-bar-danger');
				passwordStrength.style = 'width: 10%';
				//Hide the signup button
				$('#signup').hide();
			} else if (strength == 3) {
				passwordStrength.classList.remove('progress-bar-success');
				passwordStrength.classList.remove('progress-bar-danger');
				passwordStrength.classList.add('progress-bar-warning');
				passwordStrength.style = 'width: 60%';
				$('#signup').hide();
			} else if (strength == 4) {
				passwordStrength.classList.remove('progress-bar-warning');
				passwordStrength.classList.remove('progress-bar-danger');
				passwordStrength.classList.add('progress-bar-success');
				passwordStrength.style = 'width: 100%';
				//Show the signup button when the user enter a password the meets the password criteria
				$('#signup').show();
			}
		}

		// Show and hide the password field
		$('.main-password').find('.input-password').each(function(index, input) {
			var $input = $(input);
			$input.parent().find('.icon-view').click(function() {
				var change = "";
				if ($(this).find('i').hasClass('fa-eye')) {
					$(this).find('i').removeClass('fa-eye')
					$(this).find('i').addClass('fa-eye-slash')
					change = "text";
				} else {
					$(this).find('i').removeClass('fa-eye-slash')
					$(this).find('i').addClass('fa-eye')
					change = "password";
				}
				var rep = $("<input type='" + change + "' />")
					.attr('id', $input.attr('id'))
					.attr('name', $input.attr('name'))
					.attr('class', $input.attr('class'))
					.val($input.val())
					.insertBefore($input);
				$input.remove();
				$input = rep;
			}).insertAfter($input);
		});

		// Switch between Sing in and Signup
		const signUpButton = document.getElementById("signUp");
		const signInButton = document.getElementById("signIn");
		const loginContainer = document.getElementById("login-container");

		signUpButton.addEventListener("click", () => {
			loginContainer.classList.add("right-panel-active");
		});

		signInButton.addEventListener("click", () => {
			loginContainer.classList.remove("right-panel-active");
		});

	});
</script>