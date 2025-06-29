<?php
header('Access-Control-Allow-Origin: http://localhost:3000');
include('config.php');

$url = $_SERVER['REQUEST_URI'];
$x = parse_url($url, PHP_URL_QUERY);

$_POST['name'] = $_GET['name'];
$_POST['email'] = $_GET['email'];
$_POST['phone'] = $_GET['phone'];
$_POST['message'] = $_GET['message'];

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];

$sql = "INSERT INTO contacts (name, email, phone, message) VALUES ('$name','$email','$phone','$message')";
if ($conn->query($sql) === TRUE) {
  echo "<script> alert('New name added!!'); </script>";

  header('Location: http://localhost:3000');

} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close(); 

?>