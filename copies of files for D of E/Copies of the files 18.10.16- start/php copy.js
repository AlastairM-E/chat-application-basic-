var logins = document.querySelectorAll('.logs');              //get all the inputs          
var logins1 = logins[2];                                      //get the password input   
var submit = document.getElementsByClassName("submit")[0];                                             

submit.disabled = true; //submit is set to disabled before being engaged

var regEx = {                                                     

	username:/^[\w\.@_!€$£^]{5,30}$/i,                              //Username RegEx check
	password:/^[\w\.@_!€$£^]{9,30}$/i,                              //Password RegEx check
	//email:/^[\w@_!€$£^]{1,20}@[\w@_!€$£^]{1,20}\.(com|co\.uk)$/i,   //Email RegEx check

// SECURITY CHECHKS

	Caps:/[A-Z]/,                                                   //Capital leters for check
	num:/\d.*\d/,                                                   //numbers letters check
	check:false                                                     //Check if password has caps and nums

};


logins.forEach((lo) =>{                                      // for each elemt in the login selector All

lo.addEventListener("keyup", (e) =>{                         //at any addEventListener (keyup event) to
                                                             //each element in login selector All

val(e.target, regEx[e.target.attributes.name.value]);        //call the val function refering this to
                                                             //current target of the event and the regex
                                                             //with the current name as the index
}); 

});

function val(field, regex){

   if(regex.test(field.value)){                              //if the regEx tested on the input isvalid

   	field.className = "logs valid";                          // the className of the input is valid

   } else if((!regEx["check"]) && (!regex.test(field.value))) {     // however regEx test result is not valid or
   	                                                                // the Password check is false
   	field.className = "logs invalid";                              //the input's className is invalid

   };// end of if else if statement

      if (field === logins1) {                                  //if the target is the password log

	if(!regEx["Caps"].test(logins1.value)|!regEx["num"].test(logins1.value)){  //if the caps or num is
		                                                                       //false pass input is
		                                                                       //class invalid
	
	logins1.className = "logs invalid";                                        //changes pass input
		                                                                       //to className invalid

     } else{                                                                   //else

	   regEx["check"] = true;                                                  //change regEx check to
	                                                                           //true
     }; //else statement

   };//check end


  if ((logins[0].className === "logs valid")                //if username and passworf input is valid
  	 && (logins1.className === "logs valid")) {             

  	 	submit.disabled = false;                            //the submit is undisabled
  	 
  	 } else {

  	 	submit.disabled = true;                             //the submit is disabled
  	 
  	 }

};//end of function



