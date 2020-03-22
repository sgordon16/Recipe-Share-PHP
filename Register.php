<?php
include 'header.php';
$conn = mysqli_connect('localhost', 'root', '', 'mydb');
if (mysqli_connect_errno()) {
    echo 'connection failed';
}
$query2 = "SELECT option_description FROM eating_options";
$result2 = mysqli_query($conn, $query2);
$options2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);
$query3 = "SELECT name FROM diet_options";
$result3 = mysqli_query($conn, $query3);
$options3 = mysqli_fetch_all($result3, MYSQLI_ASSOC);
mysqli_free_result($result2);
mysqli_free_result($result3);

$name_error = '';
$psw_error = '';
$psw_match_error = '';
$email_error = '';
$gender_error = '';
$dob_error = '';
$height_error = '';
$weight_error = '';
$reason_for_eating_error = '';

$name = '';
$psw = '';
$email = '';
$inches = '';
$feet = '';
$height = '';
$weight = '';
$diets = [];
$reason_for_eating = '';
$error = false;

if (!empty($_POST['submitted'])) {
    $name = trim(htmlspecialchars($_POST['name']));
    $psw = trim(htmlspecialchars($_POST['psw']));
    $psw_repeat = trim(htmlspecialchars($_POST['psw-repeat']));
    $email = trim(htmlspecialchars($_POST['email']));
    $gender = '';
    
    if(isset($_POST['diets'])){        
        $diets = $_POST['diets'];
    } 
    if(isset($_POST['gender'])){
        $gender = trim($_POST['gender']);
    }
    $dob = $_POST['dob'];
    $inches = htmlspecialchars($_POST['inches']);
    $feet = htmlspecialchars($_POST['feet']);
    
    if(!empty($_POST['feet']) AND !empty($_POST['inches'])){
        $height = $_POST['inches'] + ($_POST['feet'] * 12);
    } 
    $weight = trim(htmlspecialchars($_POST['weight']));
    $reason_for_eating = $_POST['reason_for_eating'];

    if (empty($name)) {
        $name_error = 'Name is required';
        $error = true;
    }
    elseif(!preg_match("/^[a-zA-Z ]*$/", $name)){
        $name_error = 'Only letters and white space allowed';
        $error = true;
    }
    if (empty($psw)) {
        $psw_error = 'Password is required';
        $error = true;
    }
    if ($psw_repeat !== $psw) {
        $psw_match_error = 'Passwords do not match';
        $error = true;
    }
    if (empty($email)) {
        $email_error = 'Email is required';
        $error = true;
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email_error = 'Invalid email';
        $error = true;
    }
    if (empty($gender)) {
        $gender_error = 'You must choose a gender';
        $error = true;
    }
    if (empty($dob)) {
        $dob_error = 'Birthday is required';
        $error = true;
    }
    if (empty($height)) {
        $height_error = 'Height is required';
        $error = true;
    }
    if (empty($weight)) {
        $weight_error = 'Weight is required';
        $error = true;
    }
    if ($reason_for_eating === '-- Please choose a reason --') {
        $reason_for_eating_error = 'Please choose a reason';
        $error = true;
    }
    if($error === false){
        
        $query4 = "INSERT INTO users (username, password, email, dob, gender, height, weight, reason_for_eating)"
                . "VALUES ('$name', '$psw', '$email', '$dob', '$gender', '$height', '$weight', '$reason_for_eating');";
        
        if(!empty($diets)){
            foreach($diets as $diet){
                mysqli_query($conn, "INSERT INTO user_diets (username, diet) VALUES ('$name', '$diet')");
            }
        }    
        //mysqli_query($conn, "INSERT INTO user_diets (username, diet) VALUES ('$name', '$diet')");
        if(mysqli_query($conn, $query4)){
            session_start();
            //$_SESSION['LoggedIn'] = true;
            setcookie('username', $name, time() + 3600);
            mysqli_close($conn);
            header('Location: thankyou.php?message=Thank you for signing up!');
        }
    }
}
?>

<!--
<? //php if(!empty($name_error)) { echo 'style="border-width:1px;border-color:red"';} ?> 
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-xl-6 mx-auto">
                    <div class="card card-signin flex-row my-4 shadow">
                        <div class="card-body mx-5">
                            <form class="form-signin" action="?" method="post" novalidate>
                                <h1 class="text-center">Sign Up</h1>
                                <p class="text-center">Please fill in this form to create an account.</p>
                                <hr>
                                <div class="form-group">
                                    <label for="name">Username</label>
                                    <input class="form-control" type="text" placeholder="Enter Username" name="name" value="<?php echo $name;?>" <?php if(!empty($name_error)) {echo 'style="border-style:solid;border-width:1px;border-color:red"';} ?>>
                                    <div><small class="text-danger text-left"><?php echo $name_error; ?> </small></div>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input class="form-control" type="text" placeholder="Enter Email" name="email" value="<?php echo $email;?>" <?php if(!empty($email_error)) {echo 'style="border-style:solid;border-width:1px;border-color:red"';} ?>>
                                    <div><small class="text-danger text-left"><?php echo $email_error; ?> </small></div>
                                </div>

                                <div class="form-group">
                                    <label for="psw">Password</label>
                                    <input class="form-control" type="password" placeholder="Enter Password" name="psw" value="<?php echo $psw;?>"<?php if(!empty($psw_error)) {echo 'style="border: 1px solid red;"';} ?>>
                                    <div><small class="text-danger text-left"><?php echo $psw_error; ?> </small></div>
                                </div>

                                <div class="form-group">
                                    <label for="psw-repeat">Repeat Password</label>
                                    <input class="form-control" type="password" placeholder="Repeat Password" name="psw-repeat" <?php if(!empty($psw_match_error)) {echo 'style="border: 1px solid red;"';} ?>>
                                    <div><small class="text-danger text-left"><?php echo $psw_match_error; ?> </small></div>
                                </div>

                                <div class="form-group">
                                    <label for="dob">Birthday</label>
                                    <input class="form-control" type="date" placeholder="Birthday" name="dob" <?php if(!empty($dob_error)) {echo 'style="border: 1px solid red;"';} ?>>
                                    <div><small class="text-danger text-left"><?php echo $dob_error; ?> </small></div>
                                </div>

                                <div class="form-group my-4"><h5>Gender</h5></div>
                                    <div class="form-group row mx-auto<?php if(!empty($gender_error)) {echo 'style="border: 1px solid red;"';} ?>">
                                        <div class="form-check form-check-inline mx-auto">
                                            <input class="form-check-input" type="radio" name="gender" value="male" id="male">
                                            <label class="form-check-label" for="male">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline mx-auto">
                                            <input class="form-check-input" type="radio" name="gender" value="female" id="male">
                                            <label class="form-check-label" for="female">Female</label>
                                        </div>
                                    </div>
                                    <div><small class="text-danger"><?php echo $gender_error; ?> </small></div>
                                
                                <div class="form-group my-4"><h5>Height</h5></div>
                                    <div class="form-group row mx-auto <?php if(!empty($height_error)) {echo 'style="border: 1px solid red;"';} ?>">
                                        <div class="col-sm-3">
                                        <input id="feet" class="form-control" type="number" name="feet" min="1" max="8" value="<?php echo $feet;?>">
                                        </div>
                                        <label class="col-form-label" for="feet">Feet</label>
                                        <div class="col-sm-3">
                                        <input id="inches" class="form-control" type="number" name="inches" min="1" max="11" value="<?php echo $inches;?>">
                                        </div>
                                        <label class="col-form-label" for="inches">Inches</label>
                                    </div>
                                    <div><small class="text-danger"><?php echo $height_error; ?> </small></div>
                                

                                    <div class="form-group my-4"><h5>Weight</h5></div>
                                    <div class="form-group row mx-auto<?php if(!empty($weight_error)) {echo 'style="border: 1px solid red;"';} ?>">
                                        <div class="col-sm-3">
                                        <input id="weight" class="form-control" type="number" name="weight" min="1" max="500" value="<?php echo $weight;?>">
                                        </div>
                                        <label class="col-form-label" for="weight">Pounds</label>
                                    </div>
                                    <div><small class="text-danger"><?php echo $weight_error; ?> </small></div>
                                <div class="form-group my-4">
                                    <h5>Choose diets</h5>
                                </div>
                                <div class="form-group">
                                    <?php foreach ($options3 as $option) : ?>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="diets[]" value="<?php echo $option['name']; ?>" id="<?php echo $option['name']; ?>"
                                            <?php if(in_array($option['name'], $diets)){echo 'checked';} ?>>
                                            <label class="form-check-label" for="<?php echo $option['name']; ?>"><?php echo $option['name']; ?></label>
                                        </div>
                                    <?php endforeach; ?>    
                                </div>
                                <div class="form-group text-center my-4">
                                    <label for="options"><h5>What is your main reason for eating?</h5></label>
                                    <div class="form-group <?php if(!empty($reason_for_eating_error)) {echo 'style="border: 1px solid red;"';} ?>">
                                        <select class="form-control" id="options" name="reason_for_eating" value="<?php echo $reason_for_eating;?>">
                                            <option>-- Please choose a reason --</option>
                                            <?php foreach ($options2 as $option) : ?>
                                            <option <?php if($option['option_description'] == $reason_for_eating){echo 'selected';} ?>><?php echo $option['option_description']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div><small class="text-danger"><?php echo $reason_for_eating_error; ?> </small></div>
                                </div>

                                <hr>
                                <div class="text-center my4">
                                    <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
                                </div>

                                <p class="text-center">By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

                                <div class="clearfix text-center my-4">
                                    <button class="btn btn-custom mx-2" type="submit" name="submitted" value="Submit">Sign Up</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php include 'footer.php'; ?>




