<?php 
   
class func
{
 
	public static function checkLoginState($dbh)
	{
		if (!isset($_SESSION))
		{
		    session_start();
		}
		if (isset($_COOKIE['userid']) && isset($_COOKIE['token']) && isset($_COOKIE['serial']))
		{
			$query = "SELECT * FROM sessions WHERE session_userid = :userid AND session_token = :token AND session_serial = :serial;";

			$userid = $_COOKIE['userid'];
			$token = $_COOKIE['token'];
			$serial = $_COOKIE['serial'];

			$stmt = $dbh->prepare($query);
			$stmt->execute(array(':userid' => $userid,
								 ':token' => $token,
								 ':serial' => $serial));

			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			if ($row['session_userid'] > 0)
			{
				if (
					$row['session_userid'] == $_COOKIE['userid'] &&
					$row['session_token']  == $_COOKIE['token']  &&
					$row['session_serial'] == $_COOKIE['serial']
					)
				{
					if (
					$row['session_userid'] == $_SESSION['userid'] &&
					$row['session_token']  == $_SESSION['token']  &&
					$row['session_serial'] == $_SESSION['serial']
						)
					{
						return true;
					}
					else
					{
				func::createSession($_COOKIE['username'], $_COOKIE['userid'], $_COOKIE['token'], $_COOKIE['serial'], $_COOKIE['usertype']);
				return true;
					}
				}
			}
		}
	}
		 
	public static function createRecord($dbh, $user_username, $id, $user_usertype)
	{
	 	$query = "INSERT INTO sessions (session_userid, session_token, session_serial) VALUES (:id, :token, :serial);";

	 	$dbh->prepare("DELETE FROM sessions WHERE session_userid= :session_userid;")->execute(array(':session_userid' => $id));

	 	$token = func::createString(30); 
	 	$serial = func::createString(30);

	 	func::createCookie($user_username, $id, $token, $serial, $user_usertype);
	 	func::createSession($user_username, $id,  $token, $serial, $user_usertype);
	 	
	 	$stmt = $dbh->prepare($query);
	 	$stmt->execute(array(':id' => $id,
	 						 ':token' => $token,
	 						 ':serial' => $serial));
	}

	public static function createCookie($user_username, $id, $token, $serial, $user_usertype)
	{
	 	setcookie('userid', $id, time() + (86400) * 30, "/");
	 	setcookie('username', $user_username, time() + (86400) * 30, "/");
	 	setcookie('token', $token, time() + (86400) * 30, "/");
	 	setcookie('serial', $serial, time() + (86400) * 30, "/");
	 	setcookie('usertype', $user_usertype, time() + (86400) * 30, "/");
	}

	public static function deleteCookie()
	{
	 	setcookie('userid', '', time() - 1, "/");
	 	setcookie('username', '', time() - 1, "/");
	 	setcookie('token', '', time() - 1, "/");
	 	setcookie('serial', '', time() - 1, "/");
	 	setcookie('usertype', '', time() - 1, "/");
	 	session_destroy();
	}

	public static function createSession($user_username, $id, $token, $serial, $user_usertype)
	{
	 	if (!isset($_SESSION))
	 	{
	 		session_start();
	 	}
	 	$_SESSION['userid'] = $id;
	 	$_SESSION['token'] = $token;
	 	$_SESSION['serial'] = $serial;
	 	$_SESSION['username'] = $user_username;
	 	$_SESSION['usertype'] = $user_usertype;
	}

	public static function createString($len)
	{
		$string = "1qay2wsx3edc4rfv5tgb6zhn7ujm8ik9olpAQWSXEDCVFRTGBNHYZUJMKILOP";

		return substr(str_shuffle($string), 0, 30);
	}

	public static function userlog_insert($dbh, $userlog_name)
	{

	 	$query = "INSERT INTO `userlog` (`userlog_name`, `userlog_action`, `userlog_timestamp`) 
	 			  VALUES (:userlog_name, 'Login', NOW());";
	 	$stmt = $dbh->prepare($query);
	 	$stmt->bindValue(':userlog_name', $userlog_name);
		$stmt->execute();

	}

	// public static function userlog_insert_out($dbh)
	// {
	// 	$user_username = $_POST['username'];

	//  	$query = "INSERT INTO `userlog` (`userlog_name`, `userlog_action`, `userlog_timestamp`) 
	//  			  VALUES (:userlog_name, 'Logout', NOW());";
	//  	$stmt = $dbh->prepare($query);
	//  	$stmt->bindValue(':userlog_name', $user_username);
	// 	$stmt->execute();

	// }


}

?>