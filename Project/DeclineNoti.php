<?php
include("friends.php");
include("db.php");


$em = $_POST['input'];

$sql = "delete from notification where Email = ? AND NotiFrom = ?";
$query = $db->prepare($sql);
$query->execute([$youremail, $em]);