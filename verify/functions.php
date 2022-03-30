<?php 

session_start();


//--------------SIGN UP PAGE FUNCTION---------------

    function signup($data)
    {
        $errors = array();


        //echo "<pre>";
        //print_r($data);
        //validate
        if(!preg_match('/^[a-zA-Z]+$/', $data['username'])){

            $errors[] = "Please enter a valid username";
        }

        if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){

            $errors[] = "Please enter a valid email";
        }

        if(strlen(trim($data['password'])) < 4){

            $errors[] = "Passwords must be atleast 4 chars long";
        }

        if($data['password'] != $data['password2']){

            $errors[] = "Passwords must match";
        }

        //Ckeck to see whether its an existing email//
        $check = database_run("SELECT * from users where email = :email limit 1", ['email' =>$data['email']]);
        if(is_array($check)){
            $errors[]= "That email already exists";
        }

        
        //save
        if(count($errors) == 0)
        {
           $arr['username'] = $data['username'];
           $arr['email'] = $data['email'];
           $arr['password'] = hash('sha256', $data['password']);
           $arr['date'] = date("Y-m-d H:i:s");
           $query = "INSERT into users (username, email, password, date) values(:username, :email, :password, :date)";
        
           database_run($query, $arr);
        
        }
        return $errors;
    }


//--------------LOGIN PAGE FUNCTION---------------

function login($data)
{
    $errors = array();


    //echo "<pre>";
    //print_r($data);
    //validate

    if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){

        $errors[] = "Please enter a valid email";
    }

    if(strlen(trim($data['password'])) < 4){

        $errors[] = "Passwords must be atleast 4 chars long";
    }

    
    //check
    if(count($errors) == 0)
    {
       $arr['email'] = $data['email'];
       $password = hash('sha256', $data['password']);
       //$password = password_hash($data['password'], PASSWORD_DEFAULT);//

       $query = "SELECT * from users where email = :email limit 1";
    
       $row = database_run($query, $arr);

       if(is_array($row)){
           $row = $row[0];
            if($password === $row->password){
                $_SESSION['USER'] = $row;
                $_SESSION['LOGGED_IN'] = true;
            }else{
                $errors[] = "wrong email or password";
            }
         
       }else{
           $errors[] = "wrong email or password";
       }

      // echo $password . "<br>";//
       //echo $row[0] ->password . "<br>";//
      // die;//
    
    }
    return $errors;
}

function check_login($redirect = true){
    if(isset($_SESSION['USER']) && isset($_SESSION['LOGGED_IN']))
    {
        return true;
    }
    if($redirect){
        header("Location: login.php");
        die;
    }else{
        return false;
    }
    
}


//---------------DATABASE------------


function database_run($query, $vars = array()){

    //make the connection
    $string = "mysql:host=localhost;dbname=verify";
    $con = new PDO ($string, 'root', '');

    //check to see the connection work
    if (!$con){
        return false;
    }
     //run
    $stm = $con->prepare($query);
    $check = $stm->execute($vars);

    

    if($check){
        $data = $stm->fetchAll(PDO:: FETCH_OBJ);
        if(count($data)>0){
            return $data;
        }
    }

    return false;

}



function checked_verified(){
    $id = $_SESSION['USER']->id;
    $query = "SELECT * from users where id = '$id' limit 1";
    $row = database_run($query);

    if(is_array($row)){
        $row = $row[0];

        if($row->email == $row->email_verified){
            return true;
        }
        return false;
    }
    
}

    ?>
