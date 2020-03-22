<?php
$id = $_POST['id'];
$username = '';
if(!isset($_COOKIE['username'])){
   echo 'You must be logged in to save recipe';
}
else {
    $username = $_COOKIE['username'];
    $conn = mysqli_connect('localhost', 'root', '', 'mydb');
    if (mysqli_connect_errno()) {
        echo 'connection failed';
    }
    $query = "insert into users_saved_recipes (username, recipe_id) values('$username', '$id')";
    echo 'Recipe Saved';
    if(mysqli_query($conn, $query)) {}
    else {echo 'error with database';}
}
