
<?php
include("./conn.php");
if(isset($_POST['login']))
{
    
    $a=$_POST["username"];
    $b=$_POST["password"];
    $res=$conn->query("SELECT * from `login` where username='$a' and password='$b'");
    if($res->num_rows>0)
    {
        echo "<script>alert('login succesfully');</script>";
        header("location:adminhomepage.html");
    }
    else
    {
        echo "<script>alert('login unsuccesfull');</script>";
}
}

?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=div, initial-scale=1.0">
    <title>Document</title>
    <style>
          *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            scroll-padding-top: 2rem;
            scroll-behavior: smooth;
            list-style: none;
            text-decoration: none; 
            font-family: "Poppins", sans-serif;
            }
.nav-link {
            color: rgb(255, 255, 255);
            text-decoration: none;
            font-size: larger;
            font-weight: 900;
            font-family: monospace;
            text-transform: capitalize;
        }
:root{
--main-color: #fe5b3d; 
--second-color: #ffac38;
--text-color: #444;
--gradient: linear-gradient(#fe5b3d, #ffac38);

}

html:: -webkit-scrollbar {
width: 0.5rem;
}

html:: -webkit-scrollbar-track {
background: transparent;
}

html:: webkit-scrollbar-thumb {
background: var(--main-color);
border-radius: 5rem;
}

section {
padding: 50px 100px;
}

/* header {
position: fixed;
width: 100%;
top: 0;
right: 0;
z-index: 1000;
display: flex;
align-items: center;
justify-content: space-between;
background: #eeeff1;
padding: 15px 100px;
} */
#navbar {
            width: 100%;
            position: fixed;
            display: flex;
            padding: 30px;
         
            background-color: rgb(24, 24, 24);
        }

.logo img {
width: 40px;
}

.navbar {
display: flex;
}
 
.navbar li {
position: relative;
}

.navbar a{
 font-size: 1rem;
padding: 10px 20px;
color: var(--text-color);
font-weight: 500;
}

.navbar a::after {
content: "";
widows: 0;
height: 3px;
background: var(--gradient);
position: absolute;
bottom: -4px;
left: 0;
transition: 0.5s;
}
#nav1 {
            width: 50%;
            color: white;
            display: flex;
            justify-content: start;
            gap: 50px;
            padding-left: 50px;
        }
        #nav2 {
            display: flex;
            width: 50%;
            justify-content: space-around;
        }

.navbar a:hover::after {
width: 100%;
}

#menu-icon {
font-size: 24px;
cursor: pointer;
z-index: 10001;
display: none;
}

.header-btn a{
padding: 10px 20px;
color: var(--text-color);
font-weight: 500;
}

.header-btn .register{
background: #474fa0;
color: #fff;
border-radius: 0.5rem;
}

.header-btn .register:hover{
background: var(--main-color);
}

.header-btn .login{
background: #474fa0;
color: #fff;
border-radius: 0.5rem;
}

.header-btn .login:hover{
background: var(--main-color);
}




.heading{
text-align: center;
}

.heading span {
font-weight: 500;
text-transform: uppercase;
}

.heading h1{
font-size: 2rem;
}





@media (max-width:991px){
header{
padding: 18px 40px;
}
}



@media (max-width: 768px) {
header {
padding: 11px 40px;
}

#menu-icon {
display: initial;
}

.sign-up{
display: none;
}


header .navbar {
position: absolute;
top: 100%;
left: 0;
right: 0;
display: flex;
flex-direction: column;
background: #fff;
box-shadow: 0 4px 4px rgba(0,0,0,0.1);
transition: 0.2s ease;
text-align: left;
}

.navbar.active{
top: 100%;
}

.navbar a {
padding: 1rem;
border-left: 2px solid var(--main-color);
margin: 1rem;
display: block;
}

.navbar a:hover {
color: #fff;
background: var(--main-color);
border: none;
}

.navbar a::after {
display: none;
}
}


       
      
/*         
        footer {
          background-color: #333;
          color: #fff;
          padding: 1rem 0;
      } */

     .footer-content {
       display: flex;
      flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;

}

.footer-logo img {
    max-width: 100px; /* Adjust the max-width as needed */
    margin-bottom: 1rem;
}

.footer-info {
    margin-top: 1rem;
    font-size: 1rem;
}

/* Add a border-top to separate the footer from the content */
/* footer {
    border-top: 2px solid #ffcc00; /* You can change the color as desired */

    

/* Responsive design for the footer */
@media (max-width: 768px) {
    .footer-logo img {
        max-width: 80px; /* Adjusted max-width for smaller screens */
    }
    
    .footer-info {
        font-size: 0.9rem; /* Adjusted font size for smaller screens */
    }
}
    
    .login-container {
      background-color: #ffffff;
      border-radius: 5px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      padding: 200px;
      width: 1250px;
    }
    
    .login-container h2 {
      text-align: center;
      margin-bottom: 20px;
    }
    
    .form-group {
      margin-bottom: 20px;
    }
    
    .form-group label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }
    
    .form-group input[type="text"],
    .form-group input[type="password"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }
    
    .login-button {
      width: 100%;
      background-color: black;
      color: #fff;
      border: none;
      padding: 10px;
      border-radius: 3px;
      cursor: pointer;
    }
    
    #footer {
            padding: 30px;
            color: white;

            padding-left: 50px;
            background-color: black;
        }

        #mainfooter1 {

            display: flex;

        }

        #footer2 {
            text-align: center;
            font-family: monospace;
            letter-spacing: 5px;
            font-weight: bold;
            font-size: 16px;

        }
        #foot1 {
            color: white;
            text-transform: capitalize;
            font-weight: bold;
            padding-left: 50px;
            width: 70%;
        }

        #foot2 {
            color: white;
            width: 50%;
            font-weight: bold;

        }

        #foot3 {
            color: white;
            text-transform: capitalize;
            font-weight: bold;
            text-align: center;
            width: 50%;
        }

        /* #mainfooter2 {
            background-color: rgb(23, 3, 41);

        } */
    .login-button:hover {
      background-color: #0056b3;
    }
    </style>
</head>

<body>
    <!-- Navbar opening-->
    <header>
        <div id="navbar">
            <div id="nav1">cAfeARo admin login
            </div>
            <!-- <div id="nav2">
                <a href="home.html" class="nav-link">home</a>
                <a href="about.html" class="nav-link">about</a>
                <a href="contact.html" class="nav-link">contact us</a>
                <a href="login.html" class="nav-link">login</a>
                <a href="register.html" class="nav-link">register</a>
            </div> -->
        </div>
        <!-- <a href="#" class="logo"> <img src="img/jeep.png" alt=""> </img></a>
        
        <div class="bx bx-menu" id="menu-icon"></div>
        
        <ul class="navbar">
        
        <li><a href="home.html">Home</a></li>
        <li><a href="about.html">about us</a></li>
        <li><a href="contact.html">contact us</a></li>
        <li><a href="#reviews">Reviews</a></li>
        </ul>
        
        <div class="header-btn">
        <a href="register.php" class="register">Sign Up</a>
        <a href="login.php" class="login">Login</a>
        </div>
         -->
        </header>
    <!-- Navbar closing-->
    <!-- hero section opening -->
    
    <div class="login-container">
        <h2> Login</h2>
        <form action="" method="POST">
          <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
          </div>
          <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
          </div>
          <button type="submit" class="login-button" name="login">Login</button>
        </form>
      </div>
      
    <!-- hero section closing -->
 
   
    <!-- footer opening -->
    
    <footer>
      <div id="footer">
        <div id="mainfooter1">
            <!-- <div id="foot1">
                <h3>downloads</h3>
                preparation <br>
                development <br>
                workshop <br>
            </div> -->
            <div id="foot2">
                <!-- <h3>Contact Us</h3>
                ashnanourin@gmail.com <br>
                987654321 <br>
            </div> -->
            <div id="foot3">
                <!-- <h3>Useful links</h3>
                <div style="display: flex;justify-content: space-around;">
                    <a href="home.html" class="nav-link">home</a>
                    <a href="about.html" class="nav-link">about</a>
                    <a href="contact.html" class="nav-link">contact us</a>
                    <a href="login.html" class="nav-link">login</a>
                    <a href="register.html" class="nav-link">register</a> -->
                </div>

            </div>
        </div>
        <div id="mainfooter2">
            <div id="footer2">
                copyright@ashnanourin
            </div>
        </div>
    </div>

    </footer>
    

    <!-- footer closing -->

</body>

</html>