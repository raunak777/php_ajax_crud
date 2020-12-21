<?php
$id= $_POST['id'];

$conn= new mysqli('localhost', 'root', '', 'ajaxdata') or die("Failed") ;

$qu= "delete from users where id={$id}";

if ($conn->query($qu) or die("Query not executed")) {
	echo 1;
}
else{
	echo 0;
}
?>