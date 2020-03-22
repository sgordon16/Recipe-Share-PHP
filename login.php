<?php
include 'header.php';
$error = '';
$conn = mysqli_connect('localhost', 'root', '', 'mydb');
if (mysqli_connect_errno()) {
    echo 'connection failed';
}

if (isset($_POST['submit'])) {
    $query = "SELECT username FROM users WHERE username = '" . $_POST['username'] . "' AND password = '" . $_POST['psw'] . "'";
    $result = mysqli_query($conn, $query);
    $login = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    if ($login != null) {       
        setcookie('username', $_POST['username'], time() + 3600);
        $_SESSION['LoggedIn'] = true;
        header('Location: thankyou.php?message=You are now logged in');
    }
    else{
        $error = 'Invalid user name or password';
    }
}
mysqli_close($conn);
//header("Location: content.php");
?>

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-xl-6 mx-auto">
            <div class="card card-signin my-5 shadow">
                <div class="card-body mx-5">
                    <form class="form-signin" action="?" method="post">
                        <h2 class="text-center">Login</h2>
                        <hr/>
                        <div class="form-group"><label for="username">Username</label>
                            <input class="form-control" id="username" type="text" placeholder="Username" name="username" <?php if(!empty($error)) {echo 'style="border-style:solid;border-width:1px;border-color:red"';} ?> required/>
                        </div>
                        <div class="form-group"><label for="psw">Password</label>
                            <input class="form-control" id="psw" type="password" placeholder="Password" name="psw" <?php if(!empty($error)) {echo 'style="border-style:solid;border-width:1px;border-color:red"';} ?> required/>
                            <small class="text-danger text-left"><?php echo $error; ?> </small><br />
                        </div>
                        <div class="clearfix text-center">
                            <button class="btn btn-custom mx-2" type="submit" name="submit" value="submit">Submit</button>
                        </div>
                        <div class="form-group text-center mt-4">
                            <span class="text-center"><a href="Register.php" style="color:dodgerblue">Register</a></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'footer.php';
?>
