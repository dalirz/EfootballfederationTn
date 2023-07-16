<?php

$login=0;
$invalid=0;

if($_SERVER['REQUEST_METHOD']=='POST'){
    include 'connect.php';
    $username=$_POST['username'];
    $password=$_POST['password'];
    $clannom=$_POST['clannom'];

	$sql="select * from clans where username='$username' and password='$password' and clannom='$clannom'";
	$result=mysqli_query($con,$sql);
	if($result){
		$num=mysqli_num_rows($result);
		if($num>0){
			$login=1;
            session_start();
            $_SESSION['username']=$username;
            header('location:home.php');
		}else{
            $invalid=1;
        }
		
	}

}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LogIn</title>
    <!-- Link css -->
    <link rel="stylesheet" href="css/main.css" />
    <!-- link icons -->
    <link
      rel="stylesheet"
      href="https://unicons.iconscout.com/release/v4.0.0/css/line.css"
    />
    <!-- link swiper.min.css -->
    <link rel="stylesheet" href="./swiper-bundle.min.css" />
  </head>
  <body>
    <div class="header">
      <div class="lowerSection">
        <div class="logoDiv">
          
        </div>

        <!-- <div class="logInBtn">
                                <a href="#">
                                    Log In 
                                </a>
                            </div> -->

        <div class="navBar">
          
        </div>

        <div class="navBarBtn">
          
        </div>
      </div>
    </div>

    <div class="aboutBanner" style="padding: 10rem 0 5rem">
    </div>

    <!-- Login Section ======================== -->
    <section class="loginSection section">
      <div class="sectionIntro">
        <h2 class="title">Clan</h2>
      </div>
      <div class="formContainer">
        <div class="overlay"></div>
        <form action="login.php" method="post">
          <div class="rows grid">
            <div class="row selectRow">
              <label for="clubName">Clan Name</label>
              <input
                type="text"
                id="clannom"
                name="clannom"
                placeholder="Enter your Clan Name"
              />
            </div>
            <div class="row">
              <label for="username">User Name</label>
              <input
                type="text"
                id="username"
                name="username"
                placeholder="Enter your User Name"
              />
            </div>

            <div class="row">
              <label for="password">Password</label>
              <input
                type="password"
                id="password"
                name="password"
                placeholder="Enter Password"
              />
            </div>

            <div class="row">
              <input
                type="submit"
                name="submit"
                class="submitBtn"
                value="Login"
              />
            </div>
          </div>
        </form>
      </div>
    </section>
    <!-- Login Section ends ======================== -->
    <footer>
      <h2>Developed by Dali Rzeygui</h2>
    </footer>

    <!-- swiper.js link -->
    <script src="./swiper-bundle.min.js"></script>
    <!-- link javascript -->
    <script src="./main.js"></script>
  </body>
</html>
