<?php
    require "functions.php";
    check_login();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=P, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    <h1> Profile </h1>
    <?php include('header.php');?>

    <?php if(check_login(false)):?>
         Hi,  <?=$_SESSION['USER']->username?>;
        <br> <br>

        <?php if(!checked_verified()):?>
            <a href = "verify.php">
            <button> Verify </button>
            </a>
        <?php endif;?>
<?php endif;?>
</body>
</html>