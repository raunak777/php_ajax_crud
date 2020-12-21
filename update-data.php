<?php

$id= $_POST['id'];
$fname= $_POST['fname'];
$lname= $_POST['lname'];

$conn= new mysqli('localhost', 'root', '', 'ajaxdata') or die("Failed") ;

$qu= "update users set fname = '{$fname}', sname = '{$lname}' where id = '{$id}'";

if ($conn->query($qu) or die("Query not executed")) {
	echo 1;
}
else{
	echo 0;
}

?>