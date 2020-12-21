<?php

$livesearch= $_POST['livesearch'];

$conn= new mysqli('localhost', 'root', '', 'ajaxdata') or die("Failed");

$qu= "select * from users where id like '%{$livesearch}%' or fname like '%{$livesearch}%' or sname like '%{$livesearch}%' ";
$res= $conn->query($qu);
$output="";
if($res->num_rows>0)
{
	$output="<table border='1px' width='100%' cellspacing='0' cellpading='10px'>
		<tr height='50px' class='bg-success'>
		<th width='100px'>ID</th>
		<th>Name</th>
		<th width='100px'>Update</th>
		<th width='100px'>Delete</th>
		</tr>
	";
	while ($row= $res->fetch_assoc()) {
		$output .= "<tr>
		<td>".$row['id']."</td>
		<td>" .$row['fname']. ' '.$row['sname']. "</td><td><button class='edit-btn btn btn-success mb-2 btn-sm' data-eid='{$row['id']}'>Edit</button></td><td><button class='del-btn btn btn-danger mb-2 btn-sm' data-id='{$row['id']}'>Delete</button></td>";
	}
	$output.="</table>";
	$conn->close();
	echo $output;
}
else{
	echo "<h2 class='text-danger text-center'><strong>Record Not found!</strong></h2>";
}

?>