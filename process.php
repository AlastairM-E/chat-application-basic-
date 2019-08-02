<?php

session_start();

function checksLog($logU, $logP,$url,$signUp,$ZorO,$gEt,$endU,$endP) { 

include 'sql.php';  //include sql.php in file

 /*ESCAPING THE STRINGS*/  

//Post sent username data escaped
//Post sent password data escaped 

$loginU = mysqli_real_escape_string($db, $_POST[$logU]);                                               
$loginP = mysqli_real_escape_string($db, $_POST[$logP]);                        

/*REGEX TO CHECK THE ESCAPED STRINGS*/

//if username is not a match with the regex                                                                              
//Send user back to sign Up page with a failed username message
//if password is not a match with the regex and security checks (one capital and one digit)
//Send user back to sign Up/login page with a failed Password message

if (!preg_match("/^[\w\.@_!€$^]{5,30}$/i", $loginU)) {                               

  header("Location:http://localhost/Web_Dev_copy/login_Project/".$url."?form=Failed_".$endU);  

} elseif (!preg_match("/^[\w\.@_!€$^]{9,30}$/i", $loginP)                               
	|| !preg_match("/[A-Z]/", $loginP) 
	|| !preg_match("/\d.*\d/", $loginP)) {                                            

header("Location:http://localhost/Web_Dev_copy/login_Project/".$url."?form=Failed_".$endP);   
	
} else {  

/*CHECK THE INPUTED DATA ISN'T THE SMAE AS ANOTHER PART OF THE DATA*/

//SQL search check the username //and password are the same (AND pass=?;) 
//The statement is initialized   
//Prepare the prepared statement: if the prepared statement fails
//Send user with Error back to the signUp/login page if the SQL statement has failed
//if the prepared statement didn't fail   
//Bind parameters to the placeholders(this will add the username and password entered) of the statement
//excute said statement
//Get the result of the statements excution
//check how many rows are got with the statement
//if the rows are one (sign up) or zero (login) 
//return an error message, else continue

  $search = "SELECT user,pass FROM login WHERE user=?;"; 
                                                                           
  $stmtn = mysqli_stmt_init($db);                                                 
                                                                                 
if (!mysqli_stmt_prepare($stmtn, $search)) {                                     

  header("Location:http://localhost/Web_Dev_copy/login_Project/".$url."?form=Error&type=1");

} else{                                                                     

  mysqli_stmt_bind_param($stmtn, "s", $loginU); //s per parameter                                                                                                          
  mysqli_stmt_execute($stmtn);                                                    

  $result = mysqli_stmt_get_result($stmtn);                                       
  $check = mysqli_num_rows($result);

if ($check === $ZorO){	    
                                                 
    header("Location:http://localhost/Web_Dev_copy/login_Project/".$url."?form=Error&type=3"); 
	
}else{

/*INSERT THE INPUTS IN THE DATABASE SO USE CAN SIGN UP*/

//If signUp variable is set to true (which is to say that the signUp function has been called)
//encrypt the passwor input
//SQL statement with placeholders,
//initize the statement
//if the prepared statement, with values implement are incorrect
//return with error message and type 2
//else bind the parames of the login Input and encrypted Password
//excute the staement
//send user to the Login page with get request form equal to success

if ($signUp) {

 $encryptP = PASSWORD_HASH($loginP, PASSWORD_DEFAULT);
 $insPass = "INSERT INTO login (user,pass) VALUES (?,?);";
 $stmt = mysqli_stmt_init($db);

  if (!mysqli_stmt_prepare($stmt, $insPass)) {                                     //Prepare the prepared statement: if the prepared statement fails

   header("Location:http://localhost/Web_Dev_copy/login_Project/".$url."?form=Error&type=2"); //Send user with Error back to the signUp page if the SQL statement has failed

  } else {                                                                        //else of the prepared staement has not failed

   mysqli_stmt_bind_param($stmt, "ss", $loginU, $encryptP);
   mysqli_stmt_execute($stmt); 
   header("Location:http://localhost/Web_Dev_copy/login_Project/send.php?form=signedUp");

 };

} else {

/*CHECK ENCRYPTED PASSWORD IS THE SAME AS INPUTTED PASSWORD AND LOGIN SESSION CREATED*/

//else (if the signUp variable was false, indicating it's a login page requesting access
//while the row is equal to what can be fetched by the result of the excuted sentence
//variable decrypt is equal to whether the login password is equal to the rows encrypt password, when the key is added
//if variable decrypt returns true
//have the session (which is started at the top) login equal to true and usersession equal to the login Input
//send user to the access page with get request of form saying the user has logined in
//else if variable decrypt did equal to false (so the password inpute and the decrypted password didn't match)
//send them back with an error message of type 4 to the send.php page (so they try to relogin again).
//however if the wile failed sent use back with failed login attempt

 	while($row = mysqli_fetch_assoc($result)){

 	 $decrypt = password_verify($loginP, $row['pass']); 

 		if($decrypt){

        $_SESSION['login'] = true;
        $_SESSION['user'] = $loginU;
        header("Location:http://localhost/Web_Dev_copy/login_Project/access.php?form=Logined");

 	  } else{

 			 header('Location:http://localhost/Web_Dev_copy/login_Project/send.php?form=Error&type=4');
      
 		};
 	};

header('http://localhost/Web%20Dev%20copy/login%20Project/send.php?form=Failed_Login');

/*END OF TE FUNCTIONS AND IF ELSE STATEMENTS*/

//1.) end of else statement for sign Up or login if statement
//2.) end of else statement for the check to see if the username exists on the database
//3.) end of else statement for the prepared statement suceed, with the if true of that casung a redirect and error message
//4.) end of else statements for the regEx security checks
//5.) end of the function of checking what has been logged in

};
 };
  };
   }; 
    };

/*CHECK FORM HAS BEEN SENT AND RUN CHECKS*/

//if the sumbit button has not been clicked sending the data
//Send User back with a Failed message, saying that they need to enter information, before using the data
//else if the submit button of 'submit' has been clicked
//checksLog for the sign up
//else if the submit button of 'LogSubmit' has been clicked
//checksLog for the login
    
if(!isset($_POST['submit']) && !isset($_POST['LogSubmit'])){                     

 header("Location:http://localhost/Web_Dev_copy/login_Project/".$_COOKIE['page']."?form=not_sent"); 

} elseif(isset($_POST['submit'])) {                                             

 checksLog('username','password',"sign_up.php",true,1,"form","_username","_password");               

} elseif (isset($_POST['LogSubmit'])){                                           

 checksLog('logUser','logPass',"send.php",false, 0,"Login","_Login","_Login");  

};

?>
