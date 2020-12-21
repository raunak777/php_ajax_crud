<?php

$firstname= $_POST['first_name'];
$lastname= $_POST['last_name'];

$conn= new mysqli('localhost', 'root', '', 'ajaxdata') or die("Failed") ;

$qu= "insert into users(fname, sname) values('{$firstname}','{$lastname}')";

if ($conn->query($qu)) {
	echo 1;
}
else{
	echo 0;
}
?>