<?php

$dbServer = "localhost";
$user = "root";
$pass = "";
$nameFileDB = "new test 0";

$db = mysqli_connect($dbServer, $user, $pass, $nameFileDB);

	
/*CREATE TABLE login (

    login_id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user varchar(100) NOT NULL,
    pass varchar(100) NOT NULL
);

CREATE TABLE blog(

    blog_id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_name varchar(100) NOT NULL,
    posts varchar(800) NOT NULL
);

//Using the data for the website

if($check < 0){

while($row = mysqli_fetch_assoc($result)){

  echo $row['posts'];

}; 

};

};

};

*/

/*if ($check > 0){

	while ($row = mysqli_fetch_assoc($result)) {


   };//end of ()

  };// end of ()

  /*
//include sql.php in file
include 'sql.php';



/*CHECK OF THE SUBMIT BUTTON *|/

//if the sumbit button has not been clicked sending the data /*\
if(!isset($_POST['LogSubmit'])){ 

//Send User back with a Failed message, saying that they need to enter information, before using the data
 header("Location:http://localhost/Web%20Dev%20/login%20Project/send.php?Login=unSent"); 

//else if the submit button has been clicked \*|/
} else {




/*ESCAPING THE STRINGS *|/

//Post sent username data escaped   
$logU = mysqli_real_escape_string($db,$_POST['logUser']); 

//Post sent password data escaped  
$logP = mysqli_real_escape_string($db,$_POST['logPass']);



/*REGEX TO CHECK THE ESCAPED STRINGS*|/


//if username is not a match with the regex
if (!preg_match("/^[\w\.@_-]{5,30}$/i", $logU)) {

 //Send user back to sign Up page with a failed login message
 header("Location:http://localhost/Web%20Dev%20/login%20Project/send.php?Login=Failed_Login"); 

//if password is not a match with the regex and security checks (one capital and one digit)
} elseif (!preg_match("/^[\w\.@_-]{8,30}$/i", $logP) 
	|| !preg_match("/[A-Z]/", $logP) 
	|| !preg_match("/\d/", $logP)) {

     //Send user back to sign Up page with a failed login message
	header("Location:http://localhost/Web%20Dev%20/login%20Project/send.php?Login=Failed_Login"); 
	
//if both the username and apssword are able to pass then run prepared statement
} else {



/*CHECK THE INPUTED DATA IS THE SAME AS ANOTHER PART OF THE DATA*|/


$search = "SELECT user,pass FROM login WHERE user=? AND pass=?;";

$stmtn = mysqli_stmt_init($db);
//Prepare the prepared statement: if the prepared statement fails
if (!mysqli_stmt_prepare($stmtn, $search)) {

//Send user with Error back to the Login page if the SQL statement has failed
 header("Location:http://localhost/Web%20Dev%20/login%20Project/send.php?Login=Error1");

//if the prepared statement didn't fail
} else{ 

//Bind parameters to the placeholders(this will add the username and password entered)
mysqli_stmt_bind_param($stmtn, "ss", $logU, $logP);  
//two parameters, two Ss'
 
 //execute the statement
 mysqli_stmt_execute($stmtn);

//The result of stmtn 
 $result = mysqli_stmt_get_result($stmtn);
 
 //this will check if the result is current
 $check = mysqli_num_rows($result);



//if the ran the parameters with the statement inside ths database are false
if ($check === 0){	

    header("Location:http://localhost/Web%20Dev%20/login%20Project/send.php?Login=Not_Sign_Up");
	
  //else if the ran the parameters with the statement inside ths database are true
}else{

    header("Location:http://localhost/Web%20Dev%20/login%20Project/send.php?Login=Logined");

	};//end of (else if the ran the parameters with the statement inside ths database are false)

  };//end of (if the prepared statement didn't fail)

 };//end of (if both the username and apssword are able to pass then run prepared statement) 

}; //end of (else if the submit button has been clicked) */


?>

