<?php
$con=new mysqli("localhost","root","","quick");
if(isset($_GET['submit']))
{

  $a=$_GET['email'];
  $b=$_GET['message'];
 
$ins=$con->query("INSERT INTO feedback (email,message) VALUES ('$a','$b')");

if($ins)
{
    echo "inserted";
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
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

        #hero {

            width: 100%;
            color: rbg(28, 28, 83);
            text-align: start;
            font-size: 20px;
            font-style: oblique;
            font-weight: 900;
            display: flex;
            justify-content: start;
            background-color: hsl(0, 20%, 97%);
            background-image: url('./assets/images.png');
            background-color: hsla(60, 56%, 91%, 0.233);
            background-size: cover;

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
            word-spacing: 5px;
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
            background-color: rgb(139, 155, 158);
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

        #table {
            border-collapse: collapse;
            border-color: black;
            width: 100%;
            margin-bottom: 20px;
        }

        #social {
            display: flex;
            justify-content: center;
            /* Center-align horizontally */
            align-items: center;
            /* Center-align vertically */
            height: 100px;
            /* Adjust height as needed */
            background-color: rgb(139, 155, 158);
            /* Just for visualization */
        }
        .container {
            max-width: 700px;
            margin: -150px auto;
            padding: 10px 200px;
            background-color: hsla(0, 0%, 100%, 0.626);
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }
        h2 {
            text-align: center;
        }
        .form-group {
            margin: 10px 0px;
            margin-left: -150px;
            background-color: hwb(0 7% 93%)0;
        }
        label {
            display: block;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        textarea {
            width: 150%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            margin-left: 10px;
            border: 1px solid hwb(0 80% 20% / 0.498);
            background-color: hwb(0 97% 2% / 0.922);
            border-radius: 3px;
        }
        textarea {
            height: 150px;
        }
        input[type="submit"] {
            background-color: hsl(132, 4%, 26%);
            color: #fff;
            padding: 10px 35px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: rgb(40, 169, 205);
        }
    </style>
</head>

<body>
    <!-- navbar opening -->
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
            <a href="contact.php" class="nav-link"> contact </a>
            <a href="login.php" class="nav-link"> login </a>
            <a href="register.php" class="nav-link"> register </a>
            <a href="feedback.php" class="nav-link"> feedback </a>

        </div>
    </div>
    <!-- navbar clossing -->
    <!-- hero section opening -->
    <div id="hero">
        <div style="display:flex;
        width: 150%; 
    justify-content:center; 
         background-color:hsla(0, 7%, 66%, 0.47);   
         width: 150%;
            padding:300px;
        ">

            <!-- <div style=width:50%> -->
                


                <div class="container">
                    <h2>Feedback</h2>
                    <form action="#" method=get>
                        <!-- <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" name="name" id="name" required>
                        </div> -->
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Message:</label>
                            <textarea name="message" id="message" required></textarea>
                        </div>
                        <input type="submit" value="submit" name="submit">
                    </form>
                </div>

            </div>
            <!-- <p id="hero_content">Welcome to online Job Portal. It provides facility to the Job Seeker to search for -->
            <!-- various jobs as per his qualification. Here Job Seeker can registered himself on the web portal and -->
            <!-- create his profile along with his educational information. Job Seeker can search various jobs and -->
            <!-- apply -->
            <!-- for the Job</p> -->
            <!-- <p> -->
            <!-- This Portal is also designed for the various employer who required to recruit employees in their organization. Employer can registered himself on the web portal and then he can upload information of various job vacancies in their organization. Employeer can view the applications of Job Seeker and send call latter to the job seekers -->
            <!-- </p> -->
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
            <div id="social">
                <a href="past the link"><img src="assets\facebook.png"></a>
                <a href="past the link"><img src="assets\instagram.png" width="65px"></a>

                <a href="past the link"><img src="assets/youtube.png"></a>
                <a href="past the link"><img src="assets/twitter.jpg"></a>
            </div>
        </div>
        <div id="foot2">
            <h3>Useful links</h3>
            <div style="display: flex;justify-content: space-between; word-spacing: 5px;">
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