
<?php 

/*PHP POSTS PREPARATION*/

//include 'sql.php' which has the database connections
//check if the post method has sent any php data
//open the "content.json" file for writing
//select from the table blog everthing in desceding order (only the top 25)
//utitlise the query in the database
//get the num of rows gotten by the database query
//check if results are zero

include 'sql.php';

if (isset($_POST["php"])){

$Ajax_data_writing = fopen("content.json","w");

$select_from_blog = "SELECT * FROM blog ORDER BY blog_id ASC LIMIT 25;";

$result_select_blog = mysqli_query($db, $select_from_blog);
$result_check = mysqli_num_rows($result_select_blog);

if ($result_check > 0) {

/*PHP LOAD UP COMMENTS*/
 
//switch statement for the different methods (POST method of data 'php')
//if the POST data is equal to 'load_up'
//write to the AJAX file (the start of the 'Posts''s array)
//get from the results of database and while the rows are present
//write new line into the file
//write the array of the post, the username and the blog id
//write two new line, and end the comments in order to have correct JSON syntax
//write another two new lines and close the file / break from the switch statement

			switch ($_POST['php']) {

		case 'load_up':
		
fwrite($Ajax_data_writing, '{ "Posts" : [');

while($row = mysqli_fetch_assoc($result_select_blog)){

fwrite($Ajax_data_writing, "\n");
fwrite($Ajax_data_writing, ' [" '.$row['posts'].'","'.$row['user_name'].'" , '.$row['blog_id'].'], ');


}; 

fwrite($Ajax_data_writing, "\n\n");
fwrite($Ajax_data_writing, '"end of comments"] } ');
fwrite($Ajax_data_writing, "\n\n");


fclose($Ajax_data_writing); 

break;

/*PHP UPDATING THE COMMENTS*/

//if the php data is equal to update
//select the latest post from the table
//utilise that query into the databse
//get the rows from the result
//write a new line into the file
//while their are rows from the selected query (one row)
//wrtie to the file
//the 'Posts' are set to none
//array of the rows of posts, with username and row number of the blog id
//close the file and break the loop
// -> [end of switch statement and result_check statement]

case 'update':

$sql_select_last = "SELECT * FROM `blog` ORDER BY blog_id DESC LIMIT 1;"; /*SELECT blog_id FROM blog WHERE blog_id>".$_POST["num"]." ORDER BY blog_id DESC*/

$select_last_query = mysqli_query($db, $sql_select_last);
$result_check_last = mysqli_num_rows($select_last_query);

fwrite($Ajax_data_writing, "\n");

while($row1 = mysqli_fetch_assoc($select_last_query)){

fwrite($Ajax_data_writing, '{"Posts" : [["'.$row1['posts'].'" , "'.$row1['user_name'].'", '.$row1['blog_id'].' , '.$_POST["num"].']]} ');

 }; 

 fclose($Ajax_data_writing);
				
break;

};

 };

/*PHP SEND THE COMMENT TO THE DATABASE*/

//if the POST data is "send" (in order to work if their is no new comment)
//insert sql statement for the comment and it's name
//escape both of the string to make the data safe for using
//intiaze the database
//if the prepare statement of the intilaized database and the SQL statement is not ok
//$comment_ok is false
//else bind the parameters to the statement
//and excute the statement
//else (the POST data isn't "send")
//write that Posts is equal to false
//close the file
// -> [the end of isset Post method php]


 if ($_POST['php'] === "send") {  

$username = mysqli_real_escape_string($db, $_POST['user']);
$post_content = mysqli_real_escape_string($db, $_POST['content']);

$insBlog = "INSERT INTO blog (user_name,posts) VALUES (?,?);";
$stmtBlog = mysqli_stmt_init($db);

if (!mysqli_stmt_prepare($stmtBlog, $insBlog)) {

	return false;

} else {

	mysqli_stmt_bind_param($stmtBlog, "ss", $username, $post_content);
    mysqli_stmt_execute($stmtBlog); 

};

} else{

fwrite($Ajax_data_writing, '{"Posts" : [false] }');
fclose($Ajax_data_writing);

};

  };

?>
