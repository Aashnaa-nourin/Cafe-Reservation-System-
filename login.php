<?php

include("./conn.php");

// if(isset($_POST['login']))
// {
    
//     $a=$_POST["username"];
//     $b=$_POST["password"];
//     $res=$conn->query("SELECT * from login  where username='$a' and password='$b'");
//     if($res->num_rows>0)
//     {
//         $row=$res->fetch_assoc();
//         if($row['status'] == "customer"){
//             $sql = $conn->query("select * from register where email='$a'");
//             $customerResult = $sql->fetch_assoc();  
//             session_start();
//             $_SESSION["is_auth"] = true;
//             $_SESSION["customerName"] = $customerResult['name'];
//             $_SESSION["c_id"] = $customerResult['c_id'];
//             echo "<script>alert('login succesfully');</script>";
//             header("location: products.php");
            
//         }else  if($row['status'] == "staff"){
//             $sql = $conn->query("select * from user where u_name='$a'");
//         $staffResult = $sql->fetch_assoc();  
//         session_start();
//         $_SESSION["is_auth"] = true;
//         $_SESSION["staffName"] = $staffResult['u_name'];
//         $_SESSION["u_id"] = $staffResult['u_id'];
//         echo "<script>alert('login succesfully');</script>";
//         header("location: staffhome.html");
//         }else if($row['status'] == "chef" ){
//             $sql = $conn->query("select * from user where u_name='$a'");
//             $chefResult = $sql->fetch_assoc();  
//             session_start();
//             $_SESSION["is_auth"] = true;
//             $_SESSION["chefName"] = $chefResult['name'];
//             $_SESSION["u_id"] = $chefResult['u_id'];
//             echo "<script>alert('login succesfully');</script>";
//             header("location: chefhome.html");

//         }else if($row['status'] == "waiter"){
//             $sql = $conn->query("select * from user where u_name='$a'");
//             $waiterResult = $sql->fetch_assoc();  
//             session_start();
//             $_SESSION["is_auth"] = true;
//             $_SESSION["waiterName"] = $waiterResult['name'];
//             $_SESSION["u_id"] = $waiterResult['u_id'];
//             echo "<script>alert('login succesfully');</script>";
//             header("location: waiterhome.html");
//         }    
//     }else{
//         echo "<script>alert('login unsuccesfull');</script>";
//     }
// }

if (isset($_POST['login'])) {
    $a = $_POST["username"];
    $b = $_POST["password"];
    $query = "SELECT * FROM login WHERE username='$a' AND password='$b' AND login_status = 1";
    $res = $conn->query($query);

    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $status = $row['status'];

        session_start();
        $_SESSION["is_auth"] = true;


        switch ($status) {
            case "customer":
                $roleQuery = "SELECT * FROM register WHERE email='$a'";
                $roleResult = $conn->query($roleQuery);
                $userResult = $roleResult->fetch_assoc();

                $_SESSION["customerName"] = $userResult['name'];
                $_SESSION["c_id"] = $userResult['c_id'];
                header("location: products.php");
                break;

            case "staff":
                $roleQuery = "SELECT * FROM user WHERE u_name='$a'";
                $roleResult = $conn->query($roleQuery);
                $staffResult = $roleResult->fetch_assoc();

                $_SESSION["staffName"] = $userResult['u_name'];
                $_SESSION["u_id"] = $staffResult['u_id'];
                header("location: staffhome.html");
                break;

            case "chef":
                $roleQuery = "SELECT * FROM user WHERE u_name='$a'";
                $roleResult = $conn->query($roleQuery);
                $chefResult = $roleResult->fetch_assoc();
                
                $_SESSION["chefName"] = $chefResult['u_name'];
                $_SESSION["u_id"] = $chefResult['u_id'];
                header("location: chefhome.html");
                break;

            case "waiter":
                $roleQuery = "SELECT * FROM user WHERE u_name='$a'";
                $roleResult = $conn->query($roleQuery);
                $waiterResult = $roleResult->fetch_assoc();

                $_SESSION["waiterName"] = $waiterResult['name'];
                $_SESSION["u_id"] = $waiterResult['u_id'];  
                header("location: waiterhome.html");
                break;
        }
        echo "<script>alert('Login successful');</script>";
    } else {
        echo "<script>alert('Login unsuccessful');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" conntent="width=div, initial-scale=1.0">
    <title>login-cAfeARo</title>
    <style>
        *{
            margin: 0px;
            padding: 0px;
        }
        #nav1 {
            width: 50%;
            color: white;
            display: flex;
            justify-content: start;
            gap: 50px;
            padding-left: 50px;
        }

        #nav1::first-letter {
            color: rgb(221, 255, 0);
        }

        #navbar {
            width: 100%;
            position: fixed;
            display: flex;
            padding: 30px;
         
            background-color: rgb(24, 24, 24);
        }

        .nav-link {
            color: rgb(255, 255, 255);
            text-decoration: none;
            font-size: larger;
            font-weight: 900;
            font-family: monospace;
            text-transform: capitalize;
        }

        .nav-link:hover {
            color: rgb(8, 0, 17);
        }

        #footer {
            padding: 30px;
            color: white;

            padding-left: 50px;
            background-color: rgb(10, 1, 17);
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

        #nav2 {
            display: flex;
            width: 50%;
            gap: 50px;
            justify-content: space-around;
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

        #mainfooter2 {
            background-color: rgb(11, 1, 20);

        }
        #hero
        {
            width: 100%;
          color: white;
            text-align: center;
            display: flex;
            justify-content: center;
            background-image: url('./pictures/jay-wennington-N_Y88TWmGwA-unsplash.jpg');
            background-size: cover;
        }
        #hero_bt
        {
            margin-top: 20px;
            padding:20px;
            width:200px;
            background-color: rgb(11, 2, 19);
            border: none;
            color: white;
            font-size: 18px;
            border-radius: 50px;
        }
        .inp{
            padding: 10px;
            border-radius: 5px;
            border: none;
            font-family: cursive;
            

        }
        .nav-link1{
            color: rgb(255, 255, 255);
            text-decoration: none   ;
            font-size: larger;
            font-weight: 900;
            font-family: monospace;
            text-transform: capitalize;
            background: transparent;
        }   
        .nav-link1:hover {
            color: red;
        }
        select{
            border: none;
            background: transparent;
            color: white;
        }

        .dropdown {
            position: relative;
            width: 50px;
        }

        /* Style for the dropdown button */
        .dropdown-button {
            width: 50%;
            padding: 5px;
            /* color: rgb(255, 255, 255); */
            text-decoration: none;
            font-size: larger;
            font-weight: 900;
            font-family: monospace;
            text-transform: capitalize;
            background-color: rgb(24, 24, 24);
            color: #fff;
            border: none;
            border-radius: 1px;
            cursor: pointer;
        }

        /* Style for the dropdown conntent */
        .dropdown-conntent {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 50%;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        /* Style for dropdown options */
        .dropdown-option {
            padding: 10px 16px;
            text-decoration: none;
            display: block;
            color: #333;
        }

        /* Hover effect for dropdown options */
        .dropdown-option:hover {
            background-color: #ddd;
        }

        /* Show the dropdown conntent when the button is hovered */
        .dropdown:hover .dropdown-conntent {
            display: block;
        }

    </style>
</head>

<body>
    <!-- Navbar opening-->
    <div id="navbar">
       <!-- <img src="./pi ctures/annie-spratt-R3LcfTvcGWY-unsplash.jpg" height=100px;> -->
        <div id="nav1"><h1>cAfeARo</h1>
        </div>
        <div id="nav2">
            <a href="home.html" class="nav-link">home</a>
            <a href="about.html" class="nav-link">about</a>
            <a href="contact.html" class="nav-link">contact us</a>
        <div class="dropdown">
            <a class="dropdown-button" herf="login.php" >login</a>
                <div class="dropdown-conntent">
                    <a class="dropdown-option" href="login.php">customer</a>
                    <a class="dropdown-option" href="admin.php ">admin</a>
                </div>
        </div> 

            <a href="register.php" class="nav-link">register</a>
        </div>
    </div>
    <!-- Navbar closing-->
    <!-- hero section opening -->
    <div id="hero">
      <div style="display: flex;width:100%; justify-content: center;background-color: rgba(0, 0, 0, 0.772);  padding: 150px;">
        <div style="width: 60%;">
            <h1 id="her_head">login </h1>
            <p id="hero_conntent">
                <form action="" method="POST">
                    <table>    
                        <tr>
                            <td style="color:white;">Username</td>
                            <td> <input required class="inp" type="text" name="username" id="" placeholder="name"></td>
                        </tr>
                        <tr>
                            <td style="color:white;">Password</td>
                            <td>
                                <input required class="inp" type="password" name="password" id="" placeholder="password">
                                  </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                           <p style="color:white;">forgot password?<a href="forgot_password.html" class="nav-link1">change password</a></p>
                           </td></tr>
                        <!-- <tr>
                            <td>type</td>
                            <td>
                                  
                                
                           <select class="inp">
                               <option value="aadmin">admin</option>
                               <option value="staff">staff</option>
                               <option value="cook">cook</option>
                               <option value="waiter">waiter</option>
                               <option value="customer">customer</option>
                           </select></td>
                        </tr> -->
                        <tr>
                            <td></td>
                            <td> <button id="hero_bt"  name="login" type="submit">login</button></td>
                        </tr>
                    </table>
                   
                   
                  
                    
                   
                   </form>
                </p>
            </p>
            <!-- <button id="hero_bt" >login</button> -->
           </div>
      </div>
    </div>
    <!-- hero section closing -->
    <!-- about open-->
    <!-- <div id="about" style="padding: 200px;">
        hello
    </div> -->
    <!-- about closed -->
    <!-- footer opening -->
    <div id="footer">
        <div id="mainfooter1">
            <div id="foot1">
                <h3>downloads</h3>
                preparation <br>
                development <br>
                workshop <br>
            </div>
            <div id="foot2">
                <h3>conntact Us</h3>
                cAfeARo2023@gmail.com<br>
                9876543212<br>
            </div>
            <div id="foot3">
                <h3>Useful links</h3>
                <div style="display: flex;justify-content: space-around;">
                    <a href="home.html" class="nav-link">home</a>
                    <a href="about.html" class="nav-link">about</a>
                    <a href="contact.html" class="nav-link">contact us</a>
                    <a href="login.php" class="nav-link">login</a>
                    <a href="register.php" class="nav-link">register</a>
                </div>

            </div>
        </div>
        <div id="mainfooter2">
            <div id="footer2">
            <p>&copy;c A f e A R o 2 0 2 3</p>
            </div>
        </div>
    </div>

    <!-- footer closing -->

</body>

</html>



 