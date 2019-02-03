<?php 

setcookie('page', basename(__FILE__), time() - 86400, '/', null, null, true);
setcookie('page', basename(__FILE__), time() + 86400, '/', null, null, true);

?>



<!DOCTYPE html>

<html>

<head>
	<title>PHP Sign Up</title>
  <? include "PHP_components/css.php"; ?>
</head>

<body>

<?php include 'php_components/menu.php';

echo"<a href='send.php' class='link_to_pages'>Login</a> </div>";?>

<div class='input_pages'>


<?php

//if the get request signUp is present
if (isset($_GET["form"])) {

echo "<form action='process.php' method='POST' class='error_msg_form'>";
  echo "<h2>Sign Up</h2>";
 
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
   echo "<p class='msg'>Error, choose a different username and password</p>";

   break; 


    //default to make a message if get request is Sign Up but is blank for some reason
     default:
    
    //messageto suggest for them to try again
     echo "<p class='msg'>Did you send a form? Please try to sign up again</p>";

     break;
 };

 

} else{

echo "<form action='process.php' method='POST'>";
 echo "<h2>Sign Up</h2>";

};


?>

<form>

  <p>(only smybols <strong class="important_info">. @ _ ! € $ ^ </strong> allowed, <strong class="important_info">no spaces</strong>)</p>


  <div> 



    Username : <input type="text" name="username" data-type-regex_attributes="username" class="logs"></input>


    <p>

  This username must be between:</p>
<ul>
   <li data-type-regex="username">5-30 characters</li>
 </ul>

  </div>

  <!-- <div> <span id="emailInput">Email : </span> <input type="text" name="email" class="logs"></input><p>

  This Email must be between 5-45 characters (only smybols . @ _ ! € $ ^ allowed, no spaces)

  </p></div> -->

<div>Password : <input type="password" name="password" data-type-regex_attributes="password Caps num" class="logs"></input>
  <p>
  This password must be between:</p>
<ul>
  <li data-type-regex="password">9-30 characters</li>
  <li data-type-regex="Caps">at least one capital</li>
  <li data-type-regex="num">containing at least two number</li>
    </ul>
</div>

<input type="submit" value="Sign Up" name="submit" class="submit"></input>

</form> 

</div>

<script src="php.js"></script>

</body>

</html>
