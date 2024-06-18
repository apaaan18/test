<?php 

    $msg = '';
    $msgClass= '';

    if(filter_has_var(INPUT_POST, 'submit')){
    
        $email = $_POST['email'];
        $name = $_POST['name'];
        $message = $_POST['message'];

        if(!empty($name) && !empty($email) && !empty($message)){
            if(filter_var($email, FILTER_VALIDATE_EMAIL) === false ){
                $msg = 'Enter a valid email address';
                $msgClass = 'alert';
            } else {
                $toEmail = 'espinaclydeivan@gmail.com';
                $subject = 'Contact Request From' . $email;
                $body =    `<h2>Contact Request</h2>
                    <h4>Name</h4><p> . $name . </p?>
                    <h4>Email</h4><p> . $email . </p?>
                    <h4>Message</h4><p> . $message . </p?>
                    `;

                //Email Headers
                $header = "MIME-Version 1.0" . "\r\n";
                $header .= "Content-Type:text/html;charset=UTF" . "\r\n";
                //Additional Headers
                $header .= "From:" . $name . "<".$email.">" ."\r\n"; 

                if(mail($toEmail, $subject, $body, $header)) {
                    //Sent Email

                    $msg = "Your email has been sent";
                    $msg = "alert";
                }else {
                    $msg = "Your email was not sent";
                    $msg = "alert";
                }
                
            }
        } else {
            $msg = 'Please fill all the fields';
            $msgClass = 'alert';
        }
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="index.css"/>
</head>
<body>
    <?php if($msg != ''): ?>
        <div class="<?php echo $msgClass; ?>">
            <div>
                <?php echo $msg ?></div>
            </div>
    <?php endif; ?>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
        <div>
        <div class="label">
            <label for="">Name</label>
            <div>
            <input type="text" name="name" value="<?php echo isset($_POST['name']) ? $name : ''?>">
            </div>
        </div>
        <div class="label">
            <label for="" >Email</label>
            <div>
            <input type="text" name="email" value="<?php echo (isset($_POST['email'])) ? $email : '';?>">
            </div>
        </div>
        <div class="label">
            <label for="" >Message</label>
            <div>
            <textarea name="message"><?php echo (isset($_POST['message'])) ? $message : '';?></textarea>
            </div>
        </div>
        <button type="submit" name="submit">Submit</button>
        </div>
    </form>
</body>
</html>