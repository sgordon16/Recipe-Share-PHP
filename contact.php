<?php
include 'header.php';
$name_error = '';
$email_error = '';
$subject_error = '';
$message_error = '';

$name = '';
$email = '';
$message = '';
$subject = '';
$error = false;

if (!empty($_POST['submitted'])) {
    $name = trim(htmlspecialchars($_POST['name']));
    $email = trim(htmlspecialchars($_POST['email']));
    $subject = trim(htmlspecialchars($_POST['subject']));
    $message = trim(htmlspecialchars($_POST['message']));

    if (empty($name)) {
        $name_error = 'Name is required';
        $error = true;
    }
    elseif(!preg_match("/^[a-zA-Z ]*$/", $name)){
        $name_error = 'Only letters and white space allowed';
        $error = true;
    }
    if (empty($subject)) {
        $subject_error = 'Subject is required';
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
    if (empty($message)) {
        $message_error = 'Enter a message';
        $error = true;
    }

    if($error === false){
        require 'PHPMailer-master/PHPMailerAutoload.php';
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPAuth = true;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->Username = 'shlomogordon16@gmail.com';
        $mail->Password = 'keyboard#95';
        $mail->addAddress('shlomogordon16@gmail.com');
        $mail->setFrom($email);
        $mail->Subject = $subject;
        $mail->Body = $message;
        //send the message, check for errors
        if (!$mail->send()) {
            echo "ERROR: " . $mail->ErrorInfo;
        } else {
            header('Location: thankyou.php?message=Your email has been sent');
        }
    }
}
?>

        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-xl-6 mx-auto">
                    <div class="card card-signin flex-row my-5 shadow">
                        <div class="card-body mx-5">
                            <form class="form-signin" action="?" method="post">
                                <h1 class="text-center">Contact Us</h1>
                                <hr>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control" type="text" placeholder="Enter name" name="name" <?php if(!empty($name_error)) {echo 'style="border-style:solid;border-width:1px;border-color:red"';} ?>>
                                    <div><small class="text-danger text-left"><?php echo $name_error; ?> </small></div>
                                </div>
                                <div class="form-group">
                                    <label for="name">Email</label>
                                    <input class="form-control" type="text" placeholder="Enter email" name="email" <?php if(!empty($email_error)) {echo 'style="border-style:solid;border-width:1px;border-color:red"';} ?>>
                                    <div><small class="text-danger text-left"><?php echo $email_error; ?> </small></div>
                                </div>
                                <div class="form-group">
                                    <label for="subject">Subject</label>
                                    <input class="form-control" type="text" placeholder="Enter subject" name="subject" <?php if(!empty($subject_error)) {echo 'style="border-style:solid;border-width:1px;border-color:red"';} ?>>
                                    <div><small class="text-danger text-left"><?php echo $subject_error; ?> </small></div>
                                </div>
                                
                                <div class="form-group"> 
                                    <label for="message">Message</label>
                                    <textarea id="message" class="form-control" rows="6" cols="50" placeholder="Your message..." name="message" <?php if(!empty($messaget_error)) {echo 'style="border-style:solid;border-width:1px;border-color:red"';} ?>></textarea>
                                    <div><small class="text-danger text-left"><?php echo $message_error; ?> </small></div>
                                </div>
                                <div class="clearfix text-center my-4">
                                    <button type="submit" name="submitted" id="submit" value="Submit" class="btn btn-custom mx-2">Send</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php include 'footer.php'; ?>

