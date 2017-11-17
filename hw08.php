<!--Megan Taite-->
<!--Homework 8 -->

<!-- Database Test 3 -->
<!-- Allows Records to be Added to and Deleted from the Warehouse Table -->
<!-- Contains multiple forms that are also processed by this script -->

<html>

<?php

// connect the database, password changed for privacy purposes
$DBconn = new mysqli ("deltona.birdnest.org", "my.taitem2", "xxx", "my_taitem2_default"); 

//is there anything to delete?
if(isset($_POST['whDel'])){
	$toDelete = $_POST['whDel'];
	$query = "DELETE FROM warehouse WHERE WhNumb = '$toDelete'";
	$result = mysqli_query ($DBconn, $query);
}

//flag for adding new warehouses to the table
$valid = true;

//begin to check for city, whNumb, and floors
//to output appropriate error messages in the
//event the user is attempting to add a warehouse
if(isset($_POST['City'])){
//check for a city
$c = $_POST['City'];
if (strlen($c) == 0)
{
	echo "<P>Error: You need to enter a city!<br>";
	$valid = false;
}}

if(isset($_POST['WhNumb'])){
//check for a whNumb
$w = $_POST['WhNumb'];
if (strlen($w) == 0)
{
	echo "Error: You need to enter a warehouse number!<br>";
	$valid = false;
}}

if(isset($_POST['Floors'])){
$f = $_POST['Floors'];
if(strlen($f) == 0)
{
	echo "Error: You need to enter the number of floors!<br>";
	$valid = false;
}}

//if we have all the data we need, add the warehouse to the database
if($valid)
{
   if(isset($_POST['WhNumb']) && isset($_POST['City']) && isset($_POST['Floors'])){
   	$WhNumb = $_POST['WhNumb'];
   	$City   = $_POST['City'];
  	$Floors = $_POST['Floors'];
   	$query  = "INSERT INTO warehouse VALUES ('$WhNumb', '$City', $Floors)";
   	$result = mysqli_query ($DBconn, $query);
	}
}

echo "
<hr>
<table rules=all border=5>
<tr>
<td bgcolor=black colspan=4 align=center><font color=white>Existing Warehouses
<tr>
<td bgcolor=lightgrey>WhNumb
<td bgcolor=lightgrey>City
<td bgcolor=lightgrey>Floors
<td bgcolor=lightgrey>Delete
";

// submit and process the query for existing warehouses
$query = "select * from warehouse;";
$result = mysqli_query ($DBconn, $query);

//have separate forms for delete with hidden values within the table
while($row = mysqli_fetch_object ($result)){
	echo "<form action=hw08.php method=post>";  
	echo "<tr> <td> $row->WhNumb <td> $row->City <td> $row->Floors";
	echo "<td> <input type = 'submit' value='Delete'><input type = 'hidden' name ='whDel' value='".$row->WhNumb ."'>";
	echo "</form>";
}

?>

</table>
<P>
<hr>
<P>

<form action=hw08.php method=post>
<pre>
       New Warehouse Info:
WhNumb <input type=text name="WhNumb">
  City <input type=text name="City">
Floors <input type=text name="Floors">
       <input type=submit value="Add Record">
</pre>
</form>

<P>
<hr>
</html>
