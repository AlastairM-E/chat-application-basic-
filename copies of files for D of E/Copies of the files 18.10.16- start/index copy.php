<?php 

setcookie('page', basename(__FILE__), time() - 86400, '/', null, null, true);
setcookie('page', basename(__FILE__), time() + 86400, '/', null, null, true);

?>



<!DOCTYPE html>

<html>

<head>
	<title>PHP Sign Up</title>
	<link rel="stylesheet" type="text/css" href="CSS/php.css">
</head>

<body>

<h2>Sign Up</h2>

<?php

//if the get request signUp is present
if (isset($_GET["form"])) {
 
 switch ($_GET["form"]) {


//if the get request is equal to "Failed"
case "Failed":
    
//sent a message that the form has been sent
echo "<p class='msg'>This form has not been sent</p>";

break;


 //if the get request is equal to "Failed_Username"
 case "Failed__username";

 //sent message that username isn't correctly written
 echo "<p class='msg'>Your Username didn't comply with the standard that we set you</p>" ;

 break; 


  //if the get request is equal to "Failed_Password"
  case "Failed__password";

  //sent a message that the password hasn't been correctly written
  echo "<p class='msg'>Your Password didn't comply with the standard that we set you</p>";

  break; 


   //if the get request is equal to "Error"
   case"Error";

   //sent a message that the user has to send a different username and password
   echo "<p class='msg'>Error found with your submission, choose a different username and password</p>";

   break; 


    //default to make a message if get request is Sign Up but is blank for some reason
     default:
    
    //messageto suggest for them to try again
     echo "<p class='msg'>Did you send a form? Please try to sign up again</p>";

     break;
 };

};


?>

<form action="process.php" method="POST">

	<div>Username : <input type="text" name="username" class="logs"></input><p>

	This username must be between 5-30 characters (only smybols . @ _ ! € $ ^ allowed, no spaces)

	</p></div>

  <!-- <div> <span id="emailInput">Email : </span> <input type="text" name="email" class="logs"></input><p>

  This Email must be between 5-45 characters (only smybols . @ _ ! € $ ^ allowed, no spaces)

  </p></div> -->

<div>Password : <input type="password" name="password" class="logs"></input>
	<p>
	This password must be between 9-30 characters at least one capital and two number (only smybols . @ _ ! € $ ^ allowed, no spaces)
    </p>
</div>

<input type="submit" value="Sign Up" name="submit" class="submit"></input>

</form> 

<script src="php.js"></script>

</body>

</html>
