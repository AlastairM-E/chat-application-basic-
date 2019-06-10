<?php 

setcookie('page', basename(__FILE__), time() - 86400, '/', null, null, true);
setcookie('page', basename(__FILE__), time() + 86400, '/', null, null, true);

?>

<!DOCTYPE html>

<html>

<head>
	<title>PHP Login</title>
	<link rel="stylesheet" type="text/css" href="CSS/php.css">
</head>

<body>

<h2>Login</h2>

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
 case "Failed__Login";

 //sent message that username isn't correctly written
 echo "<p class='msg'>Your Login is Incorrect</p>" ;

 break; 

   //if the get request is equal to "Error"
   case "Error";

   //sent a message that the user has to send a different username and password
   echo "<p class='msg'>Your Login is Incorrect</p>";

   break; 

   case "signedUp";

//echo out a message which shows that the person has signed up
 echo "<p class='msg valid'>You have signed up!</p>";

break;

case 'Logined':
	
 echo "<p class='msg valid'>You have Logined in!</p>";

	break;

    //default to make a message if get request is Sign Up but is blank for some reason
     default:
    
    //messageto suggest for them to try again
     echo "<p class='msg'>Did you send a form? Please try to sign up again</p>";

     break;
 };

};


?>

</body>

<form action="process.php" method="POST">

<div>Username : <input type="text" name="logUser" class="logs"></input></div>

<div>Password : <input type="password" name="logPass" class="logs"></input></div>

<input type="submit" value="Login" name="LogSubmit" class="submit"></input>

</form>

</html>
