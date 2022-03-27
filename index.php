<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale = 1.0">
        <title>Gamehub - Rent Games</title>
        <link rel="stylesheet" href = "style.css"> 
        <script src="jquery.js" charset="utf-8"></script>   
    </head>
    <body>
       
        <div class="controls">
            <h1 id="sign-up">Sign Up</h1>
            <h1 id="sign-in">Sign In</h1>  
        </div>
        <div class ="container">
            <div class = "form-container">
                <div class ="sign-in">
                    <!--This form for the user Login, the login form contains a input box to enter the user's usernam
                and another for the user to enter the password-->
                <!-- A link for the forgot password -->
                    <form>
                        <!--<i class="fas fa-user"></i>--><!-- This is to have the picture on the sign up box-->
                        <h2>Log In </h2>
                        <input type="text" placeholder = "username" class="box">
                        <input type="password" placeholder = "password" class="box">
                        <input type="submit" value="Login">
                        <a href="#">Forgotten Password?</a>
                    </form>
                </div>
                <div class ="sign-up">
                    <form>
                        <i class="fas fa-user"></i>
                        <h2>Sign Up</h2>
                        <input type="text" placeholder = "username" class="box">
                        <input type="email" placeholder = "e-mail" class="box">
                        <input type="password" placeholder = "password" class="box">
                        <p><span class="small">By continuing, you agree to accept our<br><a href="#">Privacy Policy</a>&amp;<a href="#">Term of Service</a>.</span></p>
                        <input type="submit" value="Sign Up">

                    </form>
                </div>
            </div>
            <div class="image-container">
                <div class="images">
                    <img src="pics/signup.png" >
                    <img src="pics/signup.png" >
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#sign-up').click(function(){
                    $('.sign-in').css('margin-left','-34rem');
                    $(this).css('margin-top','-5rem');
                    $('.images > img').css('margin-left','0rem');
                });
                 $('#sign-in').click(function(){
                    $('.sign-in').css('margin-left','0rem');
                    $(#sign-up).css('margin-top','1rem');
                    $('.images > img').css('margin-left','-18rem');
                });
            });
        </script>
    </body>
</html>