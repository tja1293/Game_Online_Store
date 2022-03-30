<?php
    require "mail.php";
    require "functions.php";
    $errors = array();
    if($_SERVER['REQUEST_METHOD'] == "GET" && !checked_verified()){
        //send email
        $vars['code'] = rand(10000, 99999);

        //save to database
        $vars['expires'] = (time() + (60 * 10));
        $vars['email'] = $_SESSION['USER'] ->email;

        $query = 'INSERT into verify_t (code, expires, email) VALUES (:code, :expires, :email)';

       //echo $query;die;//
        database_run($query, $vars);

        $message = "Your code is " . $vars['code'];
        $subject = "GameHub Email Verification";
        $recipient = $vars['email'];

        send_mail($recipient, $subject, $message);
    }

    if($_SERVER['REQUEST_METHOD'] == "POST"){

        if(!checked_verified()){
            $query = 'SELECT * from verify_t where code = :code && email = :email';
            $vars = array();
            $vars ['email'] = $_SESSION['USER']->email;
            $vars ['code'] = $_POST['code'];

            $row = database_run($query, $vars);

            if(is_array($row)){
                $row = $row[0];
                $time = time();

                if($row ->expires > $time){
                    $id = $_SESSION['USER']->id;
                    $query = "UPDATE users set email_verified = email where id = '$id' limit 1";
                    database_run($query);

                    header("Location: profile.php");
                    die;
                }else{
                    echo "Code expired";
                }
            }else{
                echo "wrong code";
            }
        }else{
            echo "You're already verified";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>verify</title>
</head>
<body>
    <?php include('header.php')?>
    <br> <br>
    <div>
        <br> an email was sent to your address. Paste the code from the email here<br>
        <div>
            <?php if(count($errors) > 0) :?>
                <?php foreach ($errors as $error):?>
                    <?= $error?> <br>
                <?php endforeach;?>
            <?php endif;?>
        </div> <br>
        <form method="post">
            
            <input type="text" name="code" placeholder="Enter the code"><br>
            <br>
            <input type="submit" value="Verify">
        </form>
    </div>
</body>
</html>