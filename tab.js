/*Variables*/

//cache for content JSON data via ajax (from the Object Oriented Programming).
//Get the element with the comments id (which will store the comments).
//get the utton Id, for the button which will be clicked on.

let ajax_oop_cache = [];
let chat_app_cache = [-1];
let comments_id = document.getElementById("comments");
let button = document.getElementById('button');

/*Ajax OOP (constructor)*/

//class => called ajax_request.
//contructor for the:
//type of request method (e.g. GET, POST).
//what file will receivingthe request.
//whether the request is asynchrous or not.
//The data sent to the fill if there is any.

class ajax_request {

constructor(Method, File, Type, Data){

	this.Method = Method;
	this.File = File;
	this.Type = Type;
	this.Data = Data;

}

/*Ajax OOP (setup_ajax)*/

//Store in new HTTP Request (let variable type).
//open the file with the relevant information (Method of request, File name, async or not).
//setRequestHeader (so data can be sent).
//send the data to the file stated (with the parament so differnt data can be sent for each subsequent AJAX request)
//On a ready state change (of the XHR) call the annoymous function
//if XHR is compleltely ready and the request is good (status 200).
//check the file name of the request which is sent
//if JSON remove previosu data from the cache and add JSON data from file requested
//if PHP, get request (for potential later usage) on ajax_oop_cache and shift it off.
//default return unknown.
//call the next generator


setup_ajax(){

let XHR = new XMLHttpRequest();

XHR.open(this.Method, this.File, this.Type);
XHR.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
XHR.send(this.Data);

XHR.onreadystatechange = () =>  {

if (XHR.readyState == 4 && XHR.status == 200) { 


switch (this.File.split('.').pop()) {

case "json":

 ajax_oop_cache.shift();
 ajax_oop_cache.push(JSON.parse(XHR.response));


break;

case "php":

 ajax_oop_cache.push(this.Data.split('=').pop());
 ajax_oop_cache.shift();

break;

default:

 return "unknown"

};

gen.next();

};

};

}

/*Ajax OOP (output_comments)*/

//post equal to the JSON data in the ajax_OOP_cache
//for loop going through the JSON data array
//if the comment number is greate r than the previous one (a new comment)
//create new div element.
//create new text node based from the JSON data
//append textnode to div element
//add class "post" (CSS changes)
//insert new div_element to be the first element in comments section
//else (if the comment number is greate r than the previous one (a new comment))
//skip comment go on to the next one

output_comments(){

let post = ajax_oop_cache[0].Posts;

 for (let i = 0; i < post.length; i++) {

  if (chat_app_cache[0] < post[i][2]) {

   let div_element = document.createElement("DIV");
   let post_text = document.createTextNode(post[i][1] + " : " + post[i][0]);
   div_element.append(post_text);
   div_element.classList.add("post");
   comments_id.insertBefore(div_element, comments_id.childNodes[0])
   chat_app_cache[0] = post[i][2];

  } else {

   continue;

  };
 };

}


}; 

/*THE ENGINE (load up and updates the comments)*/

//load_up variable --> request for loading up comments
//ajax retrive variable --> gets content from JSON
//Generator --> if chat_app_cache is at it's base level
//yield load_up PHP request, yield ajax getting json data, yield JSON data otuptuing the comments
//else (if comments have been loaded up)
//update variable --> sent updat request with the comment idefincitation
//yield update request, yield retrivng JSON Data, output comments from the update

let load_up = new ajax_request("POST", "posts.php", true, "php=load_up");
let ajax_retrive = new ajax_request("POST", "content.json", true, "");

function * generator() {

 if (chat_app_cache[0] === -1) {

  yield load_up.setup_ajax();
  yield ajax_retrive.setup_ajax();
  yield ajax_retrive.output_comments();

 } else {

  let update = new ajax_request("POST", "posts.php", true, "php=update&num=" + chat_app_cache[0]);

  yield update.setup_ajax();
  yield ajax_retrive.setup_ajax();
  yield ajax_retrive.output_comments();

 };
};



/*NOT MY CODE source: https://medium.com/@anywhichway/resetable-javascript-generators-ae233db71779*/

//exxentially restarts the generator

function resetableGenerator(f) {

  const proxy = new Proxy( f , {

    apply(target,thisArg,argumentsList) {
      const base = target.call(thisArg,...argumentsList),
      basenext = base.next;

      let generator = base;
      base.next = function next() {

       return generator===base
         ? basenext.call(base) // generator is the original one
         : generator.next(); // generator is the reset one
      }
      // define reset to use the original arguments to create
      // a new generator and assign it to the generator variable
      Object.defineProperty(generator,"reset",{
        enumerable:false,
        value: () => 
          generator =  target.call(thisArg,...argumentsList)
      });
      // return the generator, which now has a reset method
      return generator;
    }
  });
  // return proxy which will create a generator with a reset method
  return proxy;
};

/*END OF NOT MY CODE*/

/*"LIVE" CHAT (part of the ENIGNE*/

//myGenerator variable --> enable generator function tobe restartable
//gen --> iterator to be part of myGenerator
//user (currently) get user from title part of the page (unsecure)
//set interval for every 1 second
//trigger the generator to start and restart the process one finished

let myGenerator = resetableGenerator(generator);
let gen = myGenerator();
let user = document.getElementsByTagName("title")[0].innerText.split("'")[0];

window.onload = () => {

gen.next();
gen.reset();

};

setInterval(() => {

gen.next();
gen.reset();

}, 1000);

/*SENDING COMMENTS*/

//add click event listener to element -> button id
//get the comment from the text area value attribute
//if the comment doesn't strictly contain nothing
//sending_comments --> send post request to "posts.php" with user and comments data.
//initiate jax requst for sending comments

button.addEventListener("click", () => {

let comment_content = document.getElementById("comment_textarea").value;

 if (comment_content !== "") {

  let sending_comments = new ajax_request("POST", "posts.php", true, "php=send&user=" + user + "&content=" + comment_content);
  sending_comments.setup_ajax();

 };

});