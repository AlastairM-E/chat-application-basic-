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


<?php

if ($_SESSION['login'] === true) {

//echo "success";


/*session_unset();
session_destroy();*/

} else{

	//header('Location:http://localhost/Web%20Dev%20copy/login%20Project/send.php?form=Failed_Login');
};

include "PHP_components/menu.php";

echo "<a href='http://localhost/Web_Dev_copy/login_Project/send.php' class='link_to_pages'>Sign Out</a>
</div>";

?>

<div id="gridLog">




<!--- tab column-->

<div class="heading"> Username: <strong><?php echo " ".$_SESSION['user'] ?></strong></div>



<!-- live chat column -->
<div id="livechat">

<div id="wrapper_chat">
<textarea name="postArea" id="comment_textarea"></textarea>

<!-- <button type="submit" name="PostSubmit" id="submit_btn">submit</button>-->
<button id="button">submit</button>

<br><br>

<div id="comments"></div> <!--- comments end -->



</div> <!-- live chat div end -->




</div>


<div id="board"></div>
 
</div> <!-- grid wrapper end -->


   <script src="tab.js"></script>

  </body>

</html>
