<?php 
include 'header.php';
$id = '';
if(isset($_GET['id'])){
    $id = $_GET['id'];
}

$conn = mysqli_connect('localhost', 'root', '', 'mydb');
if (mysqli_connect_errno()) {
    echo 'connection failed';
}
$query = "SELECT * FROM recipes WHERE id = $id";
$result = mysqli_query($conn, $query);
$recipe_arr = mysqli_fetch_assoc($result);
$query2 = "SELECT * FROM comments WHERE id = $id";
$result2 = mysqli_query($conn, $query);
$comments = mysqli_fetch_all($result2, MYSQLI_ASSOC);
$ingredients = json_decode($recipe_arr['ingredients']);
$diets = json_decode($recipe_arr['diet']);
//title, image, diet, health, servings, time, ingredients, directions, calories, username
$ammount_pattern = "/^(\d+\s)?(\d+\/\d+)?(.*)/";
$servings = $recipe_arr['servings'];

if(isset($_POST['servings'])){
    $servings = $_POST['servings'];
}

function convertToDecimal ($fraction) {
    $numbers=explode("/",$fraction);
    return round($numbers[0]/$numbers[1],6);
}

function convertAmounts ($orig_servings, $new_servings, $number = 0, $fraction = 0) {
    if($number == 0 && $fraction == 0) {
          return '';
    }
    $decimal = 0;
    if($fraction != 0){
        $decimal = convertToDecimal ($fraction);
    }
    return round((((float) $number + (float) $decimal) / (float) $orig_servings) * (float) $new_servings, 1);
}
if (isset($_POST['updated'])){
    //echo 'hello';  
    $ingredients2 = [];
    foreach ($ingredients as $ingredient){
        preg_match_all($ammount_pattern, $ingredient, $matches, PREG_PATTERN_ORDER);
        $ammount = convertAmounts($recipe_arr['servings'], $_POST['servings'], $matches[1][0], $matches[2][0]);
        echo $ammount.", ";
        array_push($ingredients2, $ammount.' '.$matches[3][0]);
    }
    $ingredients = $ingredients2; 
}
?>
<script src="js/StarRating.js"></script>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-xl-6 mx-auto">
                    <div class="card card-signin my-5 shadow">
                        <img src="<?php echo $recipe_arr['imgUrl']; ?>" class="card-img-top" alt="img here">
                        <div class="card-body mx-5">
                            <h2 class="text-center"><?php echo $recipe_arr['title']; ?></h2>                           
                            <hr>
                            <div class="input-section text-left">
                                <b>Ingredients</b>
                                <ul>
                                <?php foreach ($ingredients as $ingredient) : ?>
                                    <li><?php echo $ingredient; ?></li>
                                <?php endforeach; ?>  
                                </ul>
                            </div>
                            <hr>
                            <p><?php echo $recipe_arr['directions']; ?></p>
                            <hr>
                            <div class="input-section text-left">
                                <div class="my-2">
                                <b>Time: </b><?php echo empty($recipe_arr['time']) ? 'N/A' : $recipe_arr['time'] ?>&nbsp;min.<br/>
                                </div>
                                <div>
                                <b>Calories per serving: </b><?php echo empty($recipe_arr['caloriesPerServing']) ? 'N/A' : $recipe_arr['caloriesPerServing'] ?><br/>
                                </div>
                                <div class="my-2">
                                <b>Diets: </b>
                                <?php 
                                    if(!empty($recipe_arr['diet'])) {
                                        foreach ($diets as $label) {
                                            echo $label.', ';
                                        }
                                    }
                                    else {echo 'N/A';}
                                ?>
                                </div>
                            </div>
                            <form action="?<?php echo 'id='.$id ?>" method="post">
                                <label for="servings"><b>Servings:</b></label>
                                <span><input type="number" name="servings" min="1" max="500" value="<?php echo $servings; ?>">
                                    <button type="submit" name="updated" class="mx-2 btn btn-sm btn-custom" id="updateServings">Update</button></span>
                            </form>
                            <hr>
                            <div class="input-section text-center">
                                <b>Rate this recipe</b><br/>
                                <span class="rating big-gold"></span>
                            </div>
                            <div class="clearfix text-center">
                                <button id="save" class="btn btn-custom mx-2" type="submit" name="submitted" value="Submit">Save</button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php 
include 'footer.php'; ?>

