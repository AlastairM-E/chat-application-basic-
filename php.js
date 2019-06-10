var logins = document.querySelectorAll('.logs');              //get all the inputs          
var submit = document.getElementsByClassName("submit")[0]; 

//submit is set to disabled before being engaged

submit.disabled = true;


/*REGEX OBJECT*/

//Username RegEx check
//Password RegEx check
//Email RegEx check
//Capital leters for check
//numbers letters check
//Check if password has caps and nums

var regEx = {                                                     

  username:/^[\w\.@_!€$£^]{5,30}$/i,                              
  password:/^[\w\.@_!€$£^]{9,30}$/i,                              
  //email:/^[\w@_!€$£^]{1,20}@[\w@_!€$£^]{1,20}\.(com|co\.uk)$/i,  s

// SECURITY CHECHKS

  Caps:/[A-Z]/,                                                   
  num:/\d.*\d/                                                    

};


class validation {

 constructor(field, input, form_logins){

this.field = field;
this.input = input;
this.form_logins = form_logins;

}

/*regEx_valid.forEach((regEx_check2) => {

if (!regEx[regEx_check2].test(this.input.value)){

this.input.classList.remove("valid_input");
this.input.classList.add("invalid_input");



}

});*/

valid_or_not(){

let regEx_valid = this.field.split(" ");

regEx_valid.forEach((regEx_check) => {

let checker = document.querySelector("[data-type-regex='" + regEx_check + "']");

if (regEx[regEx_check].test(this.input.value)){

checker.classList.remove("invalid_check");
checker.classList.add("valid_check");

} else{

checker.classList.remove("valid_check");
checker.classList.add("invalid_check");

};

if (this.input.parentElement.childNodes[5].querySelectorAll(".valid_check").length 
  === this.input.parentElement.childNodes[5].children.length){

  this.input.classList.remove("invalid_input");
  this.input.classList.add("valid_input");

} else{

this.input.classList.remove("valid_input");
this.input.classList.add("invalid_input");

};

});

}

submit_or_not(){

for (var i = 0; i < this.form_logins.length; i++) {

  if(!this.form_logins[i].classList.contains("valid_input")){
    submit.disabled = true;
    break;
  } else {
    submit.disabled = false;
  }
}



}

};

// for each elemt in the login selector All
//at any addEventListener (keyup event) to
//each element in login selector All
//call the val function refering this to
//current target of the event and the regex
//with the current name as the index


logins.forEach((lo) =>{                                      

lo.addEventListener("keyup", (e) =>{                      

let obj_valid = new validation(e.target.attributes[2].nodeValue, e.target, logins);

obj_valid.valid_or_not();
obj_valid.submit_or_not();   

}); 

});