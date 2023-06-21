<?php
include("friends.php");
include("db.php");


$target = $_POST['input'];

$query = "INSERT into notification (Email, NotiFrom) values ('$target', '$youremail')";
$db->query($query);