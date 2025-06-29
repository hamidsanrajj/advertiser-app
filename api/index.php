<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$servername = "localhost";
$username = "root";
$password = "";
$database = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";


if (isset($_POST['submit'])) {
	
$name = $_POST['name'];

$sql = "INSERT INTO record (name)
VALUES ('$name')";

if ($conn->query($sql) === TRUE) {
  echo "<script> alert('New name added!!'); </script>";

  header('Location: index.php');

} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

}

?>