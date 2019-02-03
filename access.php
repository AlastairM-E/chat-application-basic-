<!DOCTYPE html>

<?php
session_start();
?>

<html>
<head>

<title> <?php echo $_SESSION['user']."'s "; ?> Page</title>
<? include "PHP_components/css.php"; ?>

</head>



<body>

<div id="gridLog">

<?php

if ($_SESSION['login'] === true) {

//echo "success";


/*session_unset();
session_destroy();*/

} else{

	//header('Location:http://localhost/Web%20Dev%20copy/login%20Project/send.php?form=Failed_Login');
};

?>

<!--- tab column-->

<div class='colL'></div>

<!-- live chat column -->
<div class='colL' id="livechat">

<textarea name="postArea" id="comment_textarea"></textarea>

<!-- <button type="submit" name="PostSubmit" id="submit_btn">submit</button>-->
<button id="button">submit</button>

<br><br>

<div id="comments"></div> <!--- comments end -->



</div> <!-- live chat div end -->

<div class='colL' id="board"></div>


 
</div> <!-- grid wrapper end -->


   <script src="tab.js"></script>

  </body>

</html>
