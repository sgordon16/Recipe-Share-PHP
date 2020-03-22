<?php include 'header.php';
//unset($_COOKIE['username']);
//setcookie('username', 'Shlomo', time() + 60);
$conn = mysqli_connect('localhost', 'root', '', 'mydb');
if (mysqli_connect_errno()) {
    echo 'connection failed';
}

$query3 = "SELECT name FROM diet_options";
$result3 = mysqli_query($conn, $query3);
$options3 = mysqli_fetch_all($result3, MYSQLI_ASSOC);
//$query4 = "SELECT name FROM diet_options WHERE type = 'diet'";
//$result4 = mysqli_query($conn, $query4);
//$options4 = mysqli_fetch_all($result4, MYSQLI_ASSOC);

mysqli_free_result($result3);
//mysqli_free_result($result4);
$error_message = 'This field is required!';
$error_style = 'style="border-style:solid;border-width:1px;border-color:red"';

$inputs = array("title"=>"", "image"=>"", "diets"=>[], "servings"=>"", "time"=>"", "ingredients"=>[], "directions"=>"", "calories"=>"");
$error_messages = array("title"=>"", "servings"=>"", "time"=>"", "ingredients"=>"", "directions"=>"", "calories"=>"");

$error = false;
if (!empty($_POST['submitted'])) {
    foreach ($inputs as $key => $value) {      
        if(isset($_POST[$key])){
            if(gettype($value) === 'string'){
               $inputs[$key] = trim(htmlspecialchars($_POST[$key])); 
            }
            else {
               $inputs[$key] = $_POST[$key];
            }
        }   
        if(array_key_exists($key, $error_messages) && empty($inputs[$key])) { 
            $error_messages[$key] = $error_message; 
            $error = true;
        }
        elseif (gettype($value) === 'array'){
            if(empty($inputs[$key][0])){
                $error_messages[$key] = $error_message; 
                $error = true;
            }
        } 
    }
    foreach ($inputs['ingredients'] as $ingredient) {
        if(!is_numeric(substr($ingredient, 0, 1))){
            $error_messages[$ingredient] = "Ingredients must start with a number";
        }
    }
    if($error === false){
        $diets = json_encode($inputs['diets']);
        $username = $_COOKIE['username'];
        $ingredients = json_encode($inputs['ingredients']);
        $query4 = "INSERT INTO recipes (title, ingredients, directions, time, diet, imgUrl, servings, caloriesPerServing, username) "
                . "VALUES ('${inputs['title']}', '$ingredients', '${inputs['directions']}', '${inputs['time']}', '$diets', '${inputs['imgUrl']}', '${inputs['servings']}', '${inputs['calories']}', '$username');";
        
        if(mysqli_query($conn, $query4)){
            //session_start();
            //$_SESSION['LoggedIn'] = true;
            setcookie('username', $name, time() + 3600);
            mysqli_close($conn);
            header('Location: thankyou.php?message=Your recipe has been submitted.');
        }
    }
}
?>

<script>
    $(document).ready(function() {
        $('#add-ingredient').click( function() {
            var ingredient = $('#ingredient').val();
            if(!(ingredient === "")) {
                //$('#ingredient-list').append('<li><span class="input-group-append"><input style="background-color:transparent;" type="text" name="ingredients[]" value="' + ingredient + '" style="border-style: none;"><i class="fas fa-minus-circle fa-lg delete" style="color: red;"></i></span></li>');
                $('#ingredient-list').append('<li><span class="input-group-append"><input class="form-control-plaintext"  type="text" name="ingredients[]" value="' + ingredient + '" readonly><i class="fas fa-minus-circle fa-lg delete" style="color: red;"></i></span></li>');
                $('#ingredient').val(''); 
            }      		
        });
        // Attach a delegated event handler
        $( "#ingredient-list" ).on( "click", ".delete", function( event ) {
            event.preventDefault();
            $(this).parentsUntil('ul').remove();
        });
        $('#login').click( function() {
            window.location.href = "login.php";
        });
    });

</script>
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-xl-6 mx-auto">
            <div class="card card-signin my-5 shadow">
                <div class="card-body mx-5">
                    <?php if(isset($_COOKIE['username'])) : ?>
                    <form action="?" method="post">
                        <h1 class="text-center">Enter Recipe</h1>
                        <p class="text-center">Please fill in this form to create a recipe.</p>
                        <hr/>
                        <div class="form-group">
                            <label for="fileUpload">Select image to upload</label>
                            <input class="form-control-file" id="fileUpload" type="file" name="imgUrl" accept="image/*">
                        </div>
                        <div class="form-group">
                            <label for="name">Title</label>
                            <input class="form-control" id="name" type="text" placeholder="Enter Title" name="title" value="<?php echo $inputs['title'];?>" <?php if(!empty($error_messages['title'])) {echo $error_style;} ?>>
                            <div><small class="text-danger"><?php echo $error_messages['title']; ?> </small></div>
                        </div>
                        <div class="form-group">
                            <label for="ingredient">Ingredients</label>
                            <span class="input-group-append">
                                <input class="form-control" id="ingredient" type="text" name="" placeholder="Enter ingredient">
                                <i class="btn fas fa-plus fa-lg" id="add-ingredient"></i>
                            </span>
                            <ul id="ingredient-list">
                                <?php foreach ($inputs['ingredients'] as $ingredient) : ?>
                                    <?php if(!empty($ingredient)) : ?>
                                        <li><span class="input-group-append"><input class="form-control-plaintext" <?php if(array_key_exists($ingredient, $error_messages)) { echo $error_style; } ?> type="text" name="ingredients[]" value="<?php echo trim(htmlspecialchars($ingredient));?>" ><i class="fas fa-minus-circle fa-lg delete" style="color: red;"></i></span></li>
                                        <div><small class="text-danger"><?php echo array_key_exists($ingredient, $error_messages) ? $error_messages[$ingredient] : ''; ?> </small></div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="form-group">
                            <label for="directions">Directions</label>
                            <textarea class="form-control" id="directions" rows="6" cols="52" placeholder="Directions..." name="directions" <?php if(!empty($error_messages['directions'])) {echo $error_style;} ?>>
                                <?php echo $inputs['directions'];?>
                            </textarea>
                            <div><small class="text-danger"><?php echo $error_messages['directions']; ?> </small></div>
                        </div>
                        <hr/>
                        <div class="form-group row">
                            <label class="col-sm-6 col-form-label" for="time">Total time </label>
                            <div class="col-sm-4">
                                <input class="form-control" id="time" type="number" name="time" min="1" max="500" aria-describedby="min" value="<?php echo $inputs['time'];?>" <?php if(!empty($error_messages['time'])) {echo $error_style;} ?>>
                                <div><small class="text-danger"><?php echo $error_messages['time']; ?></small></div>
                            </div>
                            <span id="min">min. </span>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-6 col-form-label" for="servings">Servings</label>
                            <div class="col-sm-4">
                                <input class="form-control" id="servings" type="number" name="servings" min="1" max="100" value="<?php echo $inputs['servings'];?>" <?php if(!empty($error_messages['servings'])) {echo $error_style;} ?>>
                                <div><small class="text-danger"><?php echo $error_messages['servings']; ?></small></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-6 col-form-label" for="calories">Calories per serving</label>
                            <div class="col-sm-4">
                                <input class="form-control" id="calories" type="number" name="calories" min="1" max="2000" value="<?php echo $inputs['calories'];?>" <?php if(!empty($error_messages['calories'])) {echo $error_style;} ?>>
                                <div><small class="text-danger"><?php echo $error_messages['calories']; ?></small></div>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <h5>Choose diets</h5>
                        </div>
                        <div class="form-group">
                            <?php foreach ($options3 as $option) : ?>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="diets[]" value="<?php echo $option['name']; ?>" id="<?php echo $option['name']; ?>"
                                    <?php if(in_array($option['name'], $inputs['diets'])){echo 'checked';} ?>>
                                    <label class="form-check-label" for="<?php echo $option['name']; ?>"><?php echo $option['name']; ?></label><br />
                                </div>
                            <?php endforeach; ?>    
                        </div>
                        <hr/>
                        <div class="clearfix text-center">
                            <button class="btn btn-custom mx-2" type="submit" name="submitted" value="Submit">Submit</button></div>
                    </form>
                    <?php endif; ?>
                    <?php if(!isset($_COOKIE['username'])) : ?>
                        <h1 class="text-center">Please login before uploading a recipe</h1>
                        <div class="clearfix text-center mt-3">
                            <button class="btn btn-custom mx-2" type="submit" id="login">Login</button>
                        <br />
                        <div class="mt-3">
                            <small class="text-center"><a href="form2.php" style="color:dodgerblue">Register</a></small>
                        </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>


