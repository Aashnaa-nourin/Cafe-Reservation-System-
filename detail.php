<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            margin: 0px;
            padding: 0px;
        }
        #navbar{
            width: 96.8%;
            position: fixed;
            background-color:black;
            display: flex;
            padding: 26px;
        }
        #nav1{
            width: 90%;
            padding-left: 50px;
            color: white;
            /* text-decoration: none; */
            /* display: flex; */
            font-family: monospace;
            font-weight: 900;
            justify-content: start;
            font-size: 18px;
        }
        #nav2{
            display: flex;
            width: 50%;
            justify-content: space-around;
            /* text-transform: uppercase; */
            color: white;
            font-size: large;
            text-transform: capitalize;
            text-decoration: none;
        }
        .nav-link {
            color:black;
            text-decoration: none;
            font-size: larger;
            font-weight: 900;
            font-family: monospace;
            text-transform: uppercase;
        }
        .nav-link:hover{
         color: rgb(45, 148, 45);
        }
        
        #hero{
            width: 90%;
            text-align: left;
            display: flex;
            justify-content: start;
            background-color:white;
            /* background-image:linear-gradient(rgba(0,0,0,0.6),rgba(0,0,0,0.7)), url(./images/istockphoto-1297806097-1024x1024.jpg); */
            background-size: cover; 
            /* margin-top: -40px; */
            
        }
        #hero_head{
            color: black;
            /* text-align: center; */
            text-transform: uppercase;
            font-size: 30px;
            /* font-family: monospace; */
            
        }
        #hero_content{
            color: black;
            font-family: monospace ;
            justify-content: space-between;
            font-size: larger;
            text-transform: capitalize;
        }
          .hero_bt {   
             margin-top: 5px; 
            padding: 10px;
            width: 100px;
            /* background-color:black; */

            /* border: none; */
            color:black; 
            font-size: 18px;
            /* border-radius: 50px; */
            display: inline-block;
            text-decoration: none;
            border: 1px solid black;
        }
        .hero_bt:hover {
            color: white;
            /* background-color: white; */
            border: 1px solid white;
         }
         table,tr{
            border: 1px solid black;
            color:black;
        }
        td{
            padding: 5px;
            border: 1px solid black;
            color:black;
        }
        th{
            color: black;
        }
        .hero_bt {   
         margin-top: 3px; 
        padding: 3px;
        width: 55px;
        background-color:black;

        /* border: none; */
        color: white; 
        font-size: 18px;
        /* border-radius: 50px; */
        display: inline-block;
        text-decoration: none;
        border: 1px solid white;
        margin-left: 830px;
        text-align: center;
    }
    .hero_bt:hover {
        color:white;
        /* background-color: white; */
        border: 1px solid white;
     }
     .hero_bt1 {   
        margin-top: -29px; 
        padding: 3px;
        width: 55px;
        background-color:black;

        /* border: none; */
        color: white; 
        font-size: 18px;
        /* border-radius: 50px; */
        display: inline-block;
        text-decoration: none;
        border: 1px solid white;
        margin-left: 710px;
        float:right;
        /* padding-left: 200px; */
        /* gap:0px; */
        text-align: center;
    }
    .hero_bt1:hover {
        color:white;
        /* background-color: white; */
        border: 1px solid white;
        /* float: right; */
     }
     .abc{
        text-decoration: none;
        color:black;
     }


        .bt{
            padding: 10px;
            color: black;
            border: 1px solid white;
            display: inline-block;
            background-color:red;
            font-family:monospace;
            text-transform: capitalize;
        }
        .bt:hover{
            background-color: black; 
            color: white; 
        }
        
        .bt1{
            padding: 10px;
            color: white;
            border: 1px solid white;
            display: inline-block;
            background-color:black;
            font-family:monospace;
            text-transform: capitalize;
        }
    </style>
</head>
<body>
    <!-- navbar opening --> 
    <!-- <div id="navbar">
        <div id="nav1">EMPLOYEE TASK MANAGEMENT SYSTEM
             <h4 id="head-2">TASK MANAGEMENT SYSTEM</h4> -->
        <!-- </div>
        <div id="nav2">
            admin user
            <a href="admindasboard.html" id="nav2">logout</a>
        </div>
</div> --> 
    <div id="hero">
        <div style="display: flex;justify-content: start;padding: 130px; ">
            <div style="width: 100%;">
                <h2 id="hero_head">STAFF DETAILS</h2><br><br>
                <a href="products.php" class="bt1">back</a>
                <p id="hero_content"> 
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>NAME</th>
                            <th>EMAIL</th>
                            <th>PHONE NUMBER</th>
                            <th>ADDRESS</th>
                            <th>DATE OF JOIN</th>
                            <th>EXPERIENCE</th>
                            <th>TYPE</th>
                        </tr>
                        <?php
                        $con=new mysqli("localhost","root","","cafe");
                        $sel=$con->query("SELECT * FROM `user` where 1");
                        if($sel->num_rows>0){
                            while($result=mysqli_fetch_array($sel)){
                                $u_id=$result['u_id'];
                                $user_name=$result['u_name'];
                                $email=$result['email'];
                                $phn=$result['phn'];
                                $add=$result['address'];
                                $doj=$result['doj'];
                                $exp=$result['exp'];
                                $type=$result['type'];
                                echo"<tr>
                                <td>$u_id</td>
                                <td>$user_name</td>
                                <td>$email</td>
                                <td>$phn</td>
                                <td>$add</td>
                                <td>$doj</td>
                                <td>$exp</td>
                                <td>$type</td>
                                ";
                                
                                ?>
                               
                                 </tr>
                                 <?php 

                            }
                        }
                       