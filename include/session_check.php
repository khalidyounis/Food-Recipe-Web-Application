<?php
function isLoginSessionExpired()
{
	$login_session_duration = 60 * 60;  //Session time is 1 hour
	$current_time = time();
	if (isset($_SESSION['loggedin_time']) and isset($_SESSION["email"])) {
		if (((time() - $_SESSION['loggedin_time']) > $login_session_duration)) {
			return true;
		}
	}
	return false;
}
