<?php

$ud= $_POST['id'];
echo $ud;

$conn= new mysqli('localhost', 'root', '', 'ajaxdata') or die("Failed");

$qu= "select * from users where id=$ud";
$res= $conn->query($qu) or die("Query not executed");

$output="";
if($res->num_rows>0)
{
	while ($row = $res->fetch_assoc()) {
		$output .= "<tr>
    				<td>First Name </td>
    				<td><input type='text' id='edit-fname' value='{$row["fname"]}'>
    				<input type='text' id='edit-id' hidden value='{$row["id"]}'>
    				</td>
    			</tr>
    			<tr>
    				<td>Last Name </td>
    				<td><input type='text' id='edit-lname' value='{$row["sname"]}'></td>
    			</tr>
    			<tr>
    				<td></td>
    				<td><input type='submit' class='btn btn-secondary' id='edit-submit' value='save'></td>
    			</tr>";
	}
	$conn->close();
	echo $output;
}
else{
	echo "<h2 class='text-danger text-center'><strong>Record Not found!?</strong></h2>";
}

?>
