<?php
include 'header.php';
$username = '';
if(isset($_COOKIE['username'])){
   $username = $_COOKIE['username'];
}
$conn = mysqli_connect('localhost', 'root', '', 'mydb');
if (mysqli_connect_errno()) {
    echo 'connection failed';
}
$sql = "select ID, title, ingredients, directions, time, diet, imgUrl, servings, caloriesPerServing, users_saved_recipes.username "
        . "from recipes join users_saved_recipes on ID = recipe_id WHERE users_saved_recipes.username = '$username'";
$result1 = mysqli_query($conn, $sql);
$recipes = mysqli_fetch_all($result1, MYSQLI_ASSOC);
mysqli_free_result($result1);
?>
<div class="container my-4">
    <div class="row">
        <?php foreach ($recipes as $recipe) : ?>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100 shadow custom-colors"><img class="card-img-top" src="<?php echo $recipe['imgUrl']; ?>" alt="https://dummyimage.com/500x325/000/fff" />
                <div class="card-body">
                    <a href="ViewRecipe.php?id=<?php echo $recipe['ID']; ?>">
                        <h4 class="card-title text-center"><?php echo $recipe['title']; ?></h4>
                    </a>
                    <div class="text-center">
                        <span class="rating small-gold" data-default-rating="<?php echo $recipe['rating']; ?>" disabled="disabled"></span>
                    </div>
                    <p class="card-text"> 
                        <br/>Calories per serving: <?php echo $recipe['caloriesPerServing']; ?>
                        <br/>Time: <?php echo $recipe['time']; ?> min.
                        <br/>Servings: <?php echo $recipe['servings']; ?></p>
                </div>
            </div>
        </div>
       <?php endforeach; ?> 
    </div>
</div>
<?php include 'footer.php'; ?>
