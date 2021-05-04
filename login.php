<?php 
require("lib/core.php");
require("functions/login_functions.php");

$login_error_message = '';
$db = getConnection();

if (func::checkLoginState($db))
      {
        header("location:index.php");
      }
        
    if(isset($_POST['login'])){
    
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;
    
    $query = "SELECT * FROM users WHERE user_username = :username";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':username', $username);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($row === false){
      $login_error_message = 'Invalid login details!';
          
    } 
    else {
        $validPassword = password_verify($passwordAttempt, $row['user_password']);
        if($validPassword){
           func::createRecord($db, $row['user_username'], $row['id'], $row['user_usertype']); 
           func::userlog_insert($db, $row['user_username']);
           header("location:index.php"); //echo func::createString(32);
           exit; 
        } else{
            $login_error_message = 'Invalid login password!';
        }
    }
    
} ?>

<!DOCTYPE html>
<html class="login">
<head>
<link rel="shortcut icon" href="image/iconic.ico">
<title>Alphalab Records Management System</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- LOCAL FILES -->
<!-- <link rel="stylesheet" type="text/css" href="css/bootstrapv3.3.7.min.css"> -->

<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<!-- LOCAL FILES -->
<!-- <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css"> -->

<link rel="stylesheet" type="text/css" href="css/custom.css"> 

</head>
<body class="login">
 
<div class="main center login">
  <center><img src="image/combined.png" alt="Alpha Logo" width="100%" height="100%" draggable="false"></center>
  <hr>
<form id="login_form" action="login.php" method="POST">
    <?php 
          if ($login_error_message != "") {
          echo '<div class="alert alert-danger"><strong>Error: </strong> ' . $login_error_message . '</div>';
      }
      ?>
    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
      <input name="username" id="username" type="text" class="form-control input-sm" placeholder="Username"  autocomplete="off" required="" autofocus>
    </div>
 
    <br>

    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-key" aria-hidden="true"></i></span>
      <input name="password" id="password"  type="password" class="form-control input-sm" name="password" placeholder="Password" autocomplete="off" required="">
    </div>
    
    <button class="btn btn-primary btn-sm" type="submit" name="login" id="login" >LOGIN</button>
</form>

</div>

<p class="bot"> Alphalab © 2019. All rights reserved. </p>


  <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
  <script src="js/jquery-3.3.1.min.js"></script>
  
  <!-- <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
  <script src="js/jquery-3.3.7.min.js" type="text/javascript"></script> 


</body>
</html>
