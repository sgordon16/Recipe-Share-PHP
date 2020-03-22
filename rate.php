<?php
$rating = $_POST['rating'];
$id = $_POST['id'];

$conn = mysqli_connect('localhost', 'root', '', 'mydb');
if (mysqli_connect_errno()) {
    echo 'connection failed';
}
$query = "UPDATE recipes SET totalRating = totalRating + ${rating}, rates = rates + 1 WHERE ID = '${id}'";
if(mysqli_query($conn, $query)) {}
else {echo 'error with database';}
?>

