<?php
include("friends.php");
include("db.php");


$em = $_POST['input'];

$query = "INSERT into friends (Email, Femail) values ('$youremail', '$em')";
$db->query($query);

$query = "INSERT into friends (Email, Femail) values ('$em', '$youremail')";
$db->query($query);

$sql = "delete from notification where Email = ? AND NotiFrom = ?";
$query = $db->prepare($sql);
$query->execute([$youremail, $em]);