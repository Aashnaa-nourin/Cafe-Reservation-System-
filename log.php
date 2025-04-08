<?php
include("./functions/connection.php");
session_start();
if(isset($_GET['login']))
{
    
    $username=$_GET['username'];
    $password=$_GET['password'];
    $res=$con->query("SELECT * from login where username='$username' and password='$password' and status=1");
    if($res->num_rows>0)
    {
        $loginResult = $res->fetch_assoc();
        if($loginResult["role"]=="employer"){
            $sql = $con->query("select * from employer where email='$username'");
            $result = $sql->fetch_assoc();
            $_SESSION['isAuthenticated_emp'] = true;
            $_SESSION['empid'] = $result['empid'];
            echo "<script>alert('login succesfully')</script>";
            header("location: ./emdashboard/emdashboard.php");
        }else if($loginResult['role']=="jobseeker") {
            $sql = $con->query("select userid,fname,lname from register where username='$username'");
            $result = $sql->fetch_assoc();
            $_SESSION['isAuthenticated_user'] = true;
            $_SESSION['userid'] = $result['userid'];
            echo "<script>alert('login succesfully')</script>";
            header("location: ./index.php");
        }
    }
    else
    {
        echo "<script>alert('login unsuccesfully')</script>";
        // echo "invalid";
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
        margin: 0px;
        padding: 0px;
    }
        #nav1 {
            width: 50%;
            color: rgb(28, 28, 83);
            display: flex;
            justify-content: start;
            gap: 10px;
            padding-left: 10px;
            font-family: cursive;
            font-size: 26px;
            font-weight: bold;


        }

        #nav1::first-letter {
            color: rgb(221, 255, 0);

        }

        #nav2 {
            width: 30%;
            display: flex;
            justify-content: start;
            gap: 20px;
            font-size: 20px;
            font-weight: bold;
        }

        #navbar {
            display: flex;
            width: 100%;
            position: fixed;
            padding: 10px;
            padding-left: 50px;
            background-color: rgb(139, 155, 158);

        }

        .navbar img {
            position: absolute;
            top: 35px;
            left: 35px;
            margin: 0;
            float: left;
            /* margin: 10px; */
            height: 3px;
            /* Adjust the height as needed */
            justify-content: start;
            position: relative;
        }

        /* .logo { 
      float:right;
      size-adjust: 50%;
      padding-right: 100%; 
     } */


        .nav-link {
            color: rgb(28, 28, 83);
            text-decoration: none;
            font-size: larger;
            font-weight: 900;
            font-family: cursive;
            text-transform: capitalize;
            justify-content: space-between;
        }

        .nav-link:hover {
            color: antiquewhite;
        }



        /*#copy {
            
            font-size: medium;
            font-weight: 900;
            text-align: center;
            font-family: monospace;
            background-color: #28defe;
        }*/


        #hero {
            width: 100%;
            color: rbg(28, 28, 83);
            text-align: center;
            font-size: 20px;
            font-style: oblique;
            font-weight: 900;
            display: flex;
            justify-content: center;
            background-image: url('./assets/1520079199716.jpg');
            background-color: dimgray;
            background-size: cover;

        }

        #hero_bt {
            margin-top: 20px;
            padding: 20px;
            width: 200px;
            background-color: rgb(28, 28, 83);
            border: none;
            color: #dcdce8;
            font-size: 18px;
            border-radius: 50px;
        }

        #footer {
            padding: 30px;
            background-color: rgb(139, 155, 158);
        }

        #foot1 {

            justify-content: start;
            font-size: 16px;
            font-weight: 900;

        }

        #foot2 {

            display: flex;
            justify-content: end;
            padding: 2px;
            gap: 20px;
        
            /* text-align: center; */

        }

        h3 {
            font-size: 25px;
            font-weight: -1200;
            text-align: end;
            padding-top: -800px;
           justify-content: end;
            color: #0e0e0e;
            margin: -10px;
            margin-right: -100px;
            margin-top: -30px;
        }

        #copy {
            justify-content: center;
            background-color:rgb(139, 155, 158);
            text-align: center;
            font-size: 20px;
            font-weight: 900;
        }
        #her_head {
            display: flex;
            text-transform: uppercase;
            font-size: 25px;
            font-weight: 1200;
            font-family: cursive;
        }
        #social{
    display: flex;
    justify-content: center; /* Center-align horizontally */
    align-items: center; /* Center-align vertically */
    height: 100px; /* Adjust height as needed */
    background-color: rgb(139, 155, 158); /* Just for visualization */
}
.inp{
            padding: 10px;
            border-radius: 5px;
            font-family: cursive;
            border: none;

        }
        td{
            padding: 15px;
        }
        #select{
            font-size: 20px;
        display: flex;
            padding-bottom: 2px;
        }
    </style>
</head>

<body>
    <!-- Navbar opening-->
    <div id="navbar">
        <img src="assets\quick-job-logo-template-design-letter-q-logo-fast-vector-38391217.jpg" height=100px;>
        <!-- position=absolute; -->
        <!-- top=100px; -->
        <!-- left=50px; -->
        <!-- margin=500px;> -->

        <div id="nav1">QUICK JOB


            <!-- <a href="#" class="logo"><img src="quick-job-logo-template-design-letter-q-logo-fast-vector-38391217.jpg" ></a> -->

        </div>
        <div id="nav2">
            <a href="index.php" class="nav-link"> home </a>
            <a href="about.php" class="nav-link"> about </a>
            <a href="contact.php" class="nav-link"> contact  </a>
            <a href="login.php" class="nav-link"> login </a>
            <a href="register.php" class="nav-link"> register </a>
            <a href="feedback.php" class="nav-link"> feedback </a>

        </div>
    </div>
    <!-- Navbar closing-->
    <!-- hero section opnening -->
    <div id="hero">
        <div style="display:flex;
        width: 100%;
        justify-content:center;
         background-color:hsla(204, 3%, 37%, 0.568);
             
           padding:300px;">

            <div style=width:50%>
                <h id="her_head">login  </h>
                <form action="" method="get">
                    <table>
                        <tr>
                            <td>Username:</td>
                            <td><input required class="inp" type="email" name="username" id="" placeholder="User_ID"><br></td>

                        </tr>
                        <tr>
                            <td>Password:</td>
                            <td><input required class="inp" type="password" name="password" id=""><br></td>
                        </tr>
                        <!-- <tr>
                            <td> <label for="class" class="inp" id="select" name="selet">don't have an account? <a href="register.php" >register</a></label></td>
                        </tr> -->
                        <tr>
                            <td></td>
                            <td><button id="hero_bt" type="submit" name="login">login</button></td>
                        </tr>
                        
                    </table>
                </form>
                
                <!-- <button id="hero_bt"> login</button> -->
            </div>
        </div>
    </div>
    <!-- hero section closing -->
    <!-- footer opening -->
    <div id="footer">
        <div id="foot1">
            contact<br>
            nooru@gmail.com <br>
            9961822083
            <div id="social" >
                <a href="past the link"><img src = "assets\facebook.png"></a>
                <a href="past the link"><img src = "assets\instagram.png" width="65px"></a>
                    
                    <a href="past the link"><img src = "assets/youtube.png"></a>
                    <a href="past the link"><img src = "assets/twitter.jpg"></a>
            </div>
        </div>
        <div id="foot2">
            <h3>Useful links</h3>
            <div style="display: flex;justify-content: space-around;">
                <a href="index.php" class="nav-link">home</a>
                <a href="about.php" class="nav-link">about</a>
                <a href="contact.php" class="nav-link">contact </a>
                <a href="login.php" class="nav-link">login</a>
                <a href="register.php" class="nav-link">register</a>
            <a href="feedback.php" class="nav-link"> feedback </a>

            </div>

        </div>
    </div>
    <div id="copy">
        copyright@nooru
    </div>



    <!-- footer closing -->

</body>

</html>