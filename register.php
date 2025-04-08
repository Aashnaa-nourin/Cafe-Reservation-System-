
<?php
include("./conn.php");
include("./auth/functions.php");

$errors = array(
    'name' => '',
    'email' => '',
    'phoneNumber' => ''
);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formData = array(
        'name' => test_input($_POST["name"]),
        'email' => test_input($_POST["email"]),
        'phoneNumber' => test_input($_POST["phn"])
    );

    $errors = validateForm($formData);

    // If there are no errors, you can proceed with further processing
    if (empty(array_filter($errors))) {
        $a=test_input($_POST['name']);
        $b=test_input($_POST['email']);
        $c=test_input($_POST['phn']);
        $d=test_input($_POST['password']);

        if(isEmailExists($conn,$b)){
            alert("Email Exist!");
        }else{
            $inss=$conn->query("INSERT INTO login(username, password, status) VALUES ('$b','$d','customer')");
            $ins=$conn->query("INSERT INTO register(name, email, phn, password) VALUES ('$a','$b','$c','$d')");

            if($ins){
                echo "<script>alert('registered succesfully');</script>";
                header("location: login.php");
            }else{
                echo "<script>alert('register unsuccesfull');</script>";
             }
        }
    }    
}
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=div, initial-scale=1.0">
    <title>register-cAfeARo</title>
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
            background-image: url('./pictures/ruben-ramirez-xhKG01FN2uk-unsplash.jpg');
            background-size: cover;
        }
        #hero_bt
        {
            margin-top: 20px;
            padding:20px;
            width: 200px;
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
        .error{
            color:red;
        }
    </style>
</head>

<body>
    <!-- Navbar opening-->
    <div id="navbar">
        <div id="nav1"><h1>cAfeARo</h1>
        </div>
        <div id="nav2">
            <a href="home.html" class="nav-link">home</a>
            <a href="about.html" class="nav-link">about</a>
            <a href="contact.html" class="nav-link">contact us</a>
            <a href="login.php" class="nav-link">login</a>
            <a href="register.php" class="nav-link">register</a>
        </div>
    </div>
    <!-- Navbar closing-->
    <!-- hero section opening -->
    <div id="hero">
      <div style="display: flex;justify-content: center;background-color: rgba(0, 0, 0, 0.772);  padding: 100px; padding-left: 50px; width: 100%;">
        <div style="width: 30%;">
            <h1 id="her_head">register here</h1>
            <p id="hero_content">
               
                <form  method="POST">


                    <table>
                        <tr>
                            <td>Name</td>
                            <td> <input required class="inp" type="text" name="name" id="" placeholder="Write your full name"></td>
                            <td><span class="error" id="nameError"><?php echo $errors['name'];?></span></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td> <input required class="inp" type="email" name="email" id="" placeholder="Write your Email "></td>
                            <td><span class="error" id="emailError"><?php echo $errors['email'];?></span></td>
                        </tr>
                        <!-- <tr>
                            <td>Address</td>
                            <td>  <textarea name="address" id="" cols="22" rows="3" class="inp" required></textarea></td>
                        </tr> -->
                        <tr>
                            <td>Phone</td>
                            <td><input required class="inp" type="text" name="phn" id="" placeholder="Phone number"></td>
                            <td><span class="error" id="phoneNumberError"><?php echo $errors['phoneNumber'];?></span></td>
                        </tr>
                        <!-- <tr>
                            <td>Username</td>
                            <td> <input required class="inp" type="text" name="username" id="" placeholder="user id"></td>
                        </tr> -->
                        <tr>
                            <td>Password</td>
                            <td>
                                <input required class="inp" type="password" name="password" id="" placeholder="password">
                                  </td>
                        </tr>
                        <!-- <tr>
                            <td>dateofjoin</td>
                            <td>
                                <input required class="inp" type="date" name="password" id="" placeholder="dd/mm/yyyy">
                                  </td>
                        </tr>
                        <tr>
                            <td>experience</td>
                            <td>
                                <input required class="inp" type="text" name="password" id="" placeholder="experience">
                                  </td>
                        </tr> -->

                            <!-- <tr>
                            <td>type</td>
                            <td>
                                <input required class="inp" type="text" name="t" id="" placeholder="experience">
                                  </td>
                                   -->
<!--                                 
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
                            <td>
                           <p>HAVE AN ACCOUNT?<a href="login.php" class="nav-link1">LOGIN</a></p>
                           </td></tr>
                        <tr>
                            <td></td>
                            <td> <button id="hero_bt"  name="register" type="submit">Register</button></td>
                        </tr>
                    </table>
                   
                   
                  
                    
                   
                   </form>  

            </p>
           
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
                <h3>Contact Us</h3>
                cAfeARo2023@gmail.com<br>
                9876543212 <br>
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


