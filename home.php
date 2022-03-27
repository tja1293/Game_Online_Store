<?php
	include'header.php'
?>

<?php
if(isset($_SESSION["useruid"])){
	header("location:../~2007780/home.php");
}
?>

    <div class="full-page">
        <div id='login-form'class='login-page'>
            <div class="form-box">
                <div class='button-box'>
                    <div id='btn'></div>
                    <button type='button'onclick='login()'class='toggle-btn'>Log In</button>
                    <button type='button'onclick='register()'class='toggle-btn'>Register</button>
                </div>

                <form id='login' class='input-group-login' action="login.inc.php" method="post">
                    <div class="input-container name">
                        <label for="fname"></label>
                        <input type='text'class='input-field'placeholder="Email" name="uid" required></input>
                    </div>
                    <div class="input-container password">
                        <label for="password"></label>
                        <input type='password'class='input-field'placeholder="Enter Password" name="pwd" required></input>
                    </div>
		            <input type='checkbox'class='check-box'><span>Remember Password</span></input>
		            <button type='submit'class='submit-btn-1' name="submit">Log in</button>
		        </form>



		        <form id='register' class='input-group-register' action="signup.inc.php" method="post">
                    <div class="input-container name">
                        <label for="fname"></label>
                        <input type='text'class='input-field'placeholder="First Name" name="name" required></input>
                    </div>
                    <div class="input-container secondname">
                        <label for="sname"></label>
                        <input type='text'class='input-field'placeholder="Last Name" name="sname" required></input>
                    </div>
                    <div class="input-container email">
                        <label for="email"></label>
                        <input type='text'class='input-field'placeholder="Email" name="email" required></input>
                    </div>
                    <div class="input-container username">
                        <label for="username"></label>
                        <input type='text'class='input-field' placeholder="Mobile No" name="uid" required></input>
                    </div> 
                    <div class="input-container password">
                        <label for="password"></label>
                        <input type='password'class='input-field'placeholder="Enter Password" name = "pwd" required></input>
                    </div> 
                    <div class="input-container Rpassword">
                        <label for="rpassword"></label>
                        <input type='password'class='input-field'placeholder="Confirm Password" name="pwdrepeat" required></input>
                    </div>             
                    <button type='submit'class='submit-btn-2' name="submit">Register</button>
                    <section class="copy legal">
						<p><span class="small">By continuing, you agree to accept our<br><a href="pt.html">Privacy Policy</a>&amp;<a href="pt.html">Term of Service</a>.</span></p>
					</section>

                    
	            </form>
            </div>
        </div>
    </div>
    <?php
    if(isset($_GET["error"])){
        if($_GET["error"]== "emptyinput"){
            echo "<script>alert(' Fill in all fields!')</script>";
        }
        else if($_GET["error"] =="wronglogin"){
            echo "<script>alert('Invalid Login Information')</script>";
        }
    }
    ?>
    <?php
        if(isset($_GET["error"])){
            if($_GET["error"]== "emptyinput"){
                echo "<script>alert('Fill in all fields!')</script>";
            }	
            else if($_GET["error"] =="invaliduid"){
                echo "<script>alert('Choose a proper username')</script>";
            }
            else if($_GET["error"] =="invalidEmail"){
                echo "<script>alert('Choose a proper email')</script>";
            }
            else if($_GET["error"] =="passwordsdontMatch"){
                echo "<script>alert('Passwords does not match woth each other')</script>";
            }
            else if($_GET["error"] =="usernametaken"){
                echo "<script>alert('The username is already taken')</script>";
            }
            else if($_GET["error"] =="stmtfailed"){
                echo "<script>alert('Something went wrong, try again')</script>";
            }
            else if($_GET["error"] =="none"){
                echo "<script>alert('You have signed up')</script>";
            }
        }
    ?>
    <script>
        var x=document.getElementById('login');
		var y=document.getElementById('register');
		var z=document.getElementById('btn');
		function register()
		{
			x.style.left='-400px';
			y.style.left='50px';
			z.style.left='110px';
		}
		function login()
		{
			x.style.left='50px';
			y.style.left='450px';
			z.style.left='0px';
		}
	</script>
<?php
	include_once'footer.php'
?>
