<?php
include 'header.php';

$conn = mysqli_connect('localhost', 'root', '', 'mydb');
if (mysqli_connect_errno()) {
    echo 'connection failed';
}
if(isset($_COOKIE['username'])){
    $username = $_COOKIE['username'];
    $query_info = "SELECT * FROM users WHERE username = '".$username."'";
    $query_diet = "SELECT user_diets.username, user_diets.diet FROM user_diets JOIN diet_options ON user_diets.diet=diet_options.name WHERE username = '".$username."'";
    $result_info = mysqli_query($conn, $query_info);
    $result_diet = mysqli_query($conn, $query_diet);
    $info = mysqli_fetch_assoc($result_info);
    $diet_arr = mysqli_fetch_all($result_diet, MYSQLI_ASSOC);
    $reason_for_eating = $info['reason_for_eating'];
    $tz  = new DateTimeZone('America/New_York');
    $name = ucwords($info['username']);
    $email = $info['email']; 
    $date = new DateTime($info['dob']);
    $dob = $date->format('m/d/Y');
    $gender = ucwords($info['gender']);
    $height = $info['height'];
    $weight = $info['weight'];
    $age = DateTime::createFromFormat('m/d/Y', $dob, $tz)
    ->diff(new DateTime('now', $tz))
    ->y;
    $bmr = (4.536 * $weight) + (15.88 * $info['height']) - (5 * $age) + ($gender == 'Male' ? 5 : -161);
}
?>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-xl-6 mx-auto">
                    <div class="card card-signin flex-row my-4 shadow">
                        <div class="card-body text-left">
                            <?php if(isset($_COOKIE['username'])) : ?>
                            <h1 class="text-center">Your Profile</h1>
                            <hr>
                            <div class="row">
                                <div class="col text-right"><h5>Username:</h5></div>
                                <div class="col text-left "><?php echo $name; ?></div>
                                <div class="w-100 my-2"></div>
                                <div class="col text-right"><h5>Email:</h5></div>
                                <div class="col text-left"><?php echo $email; ?></div>
                                <div class="w-100 my-2"></div>
                                <div class="col text-right"><h5>Birthday:</h5></div>
                                <div class="col text-left "><?php echo $dob; ?></div>
                                <div class="w-100 my-2"></div>
                                <div class="col text-right"><h5>Gender:</h5></div>
                                <div class="col text-left"><?php echo $gender; ?></div>
                                <div class="w-100 my-2"></div>
                                <div class="col text-right"><h5>Height:</h5></div>
                                <div class="col text-left "><?php echo $height; ?><small>&nbsp;in.</small></div>
                                <div class="w-100 my-2"></div>
                                <div class="col text-right"><h5>Weight:</h5></div>
                                <div class="col text-left"><?php echo $weight; ?><small>&nbsp;lbs.</small></div>
                                <div class="w-100 my-2"></div>
                                <div class="col text-right"><h5>Diets:</h5></div>
                                <div class="col text-left">
                                    <?php foreach ($diet_arr as $diet) : ?>
                                        <li class="mx-2"><?php echo $diet['diet']; ?></li>
                                    <?php endforeach; ?>  
                                </div>
                                <div class="w-100 my-2"></div>
                                <div class="col text-right"><h5>Main reason for eating:</h5></div>
                                <div class="col text-left"><?php echo $reason_for_eating; ?></div>
                                <div class="w-100 my-2"></div>
                                <div class="col text-right"><h5>Recommended Daily Calories:</h5></div>
                                <div class="col text-left"><?php echo $bmr; ?></div>
                            </div>
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