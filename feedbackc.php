<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Chef Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: hwb(0 0% 100%);
            color: #fff;
            position: fixed;
            height: 100%;
            overflow-y: auto;
        }

        .sidebar a {
            padding: 20px 20px;
            text-decoration: none;
            color: #fff;
            display: block;
        }

        .sidebar a:hover {
            background-color: hwb(0 0% 100%);
        }

        /* Content Area */
        .content {
            margin-left: 250px;
            padding: 20px;
        }

        /* Header */
        .header {
            background-color:hwb(0 0% 100%);
            color: #fff;
            padding: 10px;
            width: 100%;
             margin-left:-20px;
             margin-top: -20px;
        }

        /* Box Container */
        .box-container {
            background-color: hwb(0 0% 100%);
            width: 150px;
            height: 150px;
            padding: 50px;
            margin: 10px 0;
            border-radius: 30px;
          
            display: inline-block;
        }
        /* styles.css */
.hover-effect {
  background-color: #000000;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 10px;
  cursor: pointer;
  transition: background-color 0.3s; /* Add a smooth transition */
}

#hover-effect:hover {
  background-color: #0056b3; /* Change the background color when hovering */
}

    #staff:hover{
        color: rgb(228, 228, 228);
    }
    #cook:hover{
        color: #ffffff;
    }
    #waiter:hover{
        color: #ffffff;
    }
    #customer:hover{
        color: #fff;
    }
    #menu:hover{
        color: #fff;
    }
    #table:hover{
        color: #fff;
    }
    #reservation:hover{
        color: #fff;
    }
    #feedback:hover{
        color: #fff;
    }
    #nav2 {
            display: flex;
            color: rgb(255, 255, 255);
            width: 50%;
            justify-content:end;

        }
        .nav-link{
            color: white;
            text-decoration: none;
        }
       
    
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="#menu"></a>
        <a href="chefhome.html" id="hover-effect">Dashboard</a>
        
        <a href="chefmenu.html" id="hover-effect">MENU</a>
        <a href="cheforder.html" id="hover-effect">ORDER DETAILS</a>
        <a href="feedbackc.php" id="hover-effect">FEEDBACK DETAILS</a>
        <a href="feedback.html" id=""></a>
        <a href="feedback.html" id=""></a>
        <a href="feedback.html" id=""></a>
        <a href="logout.php" id="hover-effect">LOGOUT</a>
    </div>

    <div class="content">
        <div class="header">
            <h1>cAfeARo Chef Dashboard-MENU</h1>
        </div>
       &nbsp;



       <div> <a href="chefhome.html" class="hero_bt"><h3>back</h3></a>
        
       
       <div id="hover-effect" class="hover-effect" style="color: rgb(255, 255, 255);">
            
       
            <p>
                <div class="tst">
                    
                                <table>
                                    <tr>
                                        <th>feedback id  </th><br>
                                        <th>  food id</th>
                                        <th>feeback</th>
                                    </tr>
                                    <?php
                                    $con=new mysqli("localhost","root","","project");
                                    $sel=$con->query("SELECT * FROM feedback");
                                    if($sel->num_rows>0){
                                        while($r=mysqli_fetch_array($sel)){
                                            $id=$r['fb_id'];
                                            $a=$r['f_id'];
                                            $b=$r['message'];
                                            
                                            echo"<tr>
                                            <td>$id</td>
                                            <td>$a</td>
                                            <td>$b</td>";
                                            echo"<td><form action='' method='get'>
                                           
                                            </form></td>
            
                                             </tr>";    
                                        }
                                    }
                                    if(isset($_GET['delete'])){
                                        $a=$_GET['delete'];
                                        $del=$con->query("DELETE FROM `feedback`where email='$a'");
                                        echo"deleted";
                                    }
                                    
                                   ?>
                                </table>
                                </div>
                            </p>
                            
                                
                           
                        
                            
                            
                        </div>
                    </div>
                </div>
                </div>
                <!-- hero section closing -->
            </body>
            
            
            
                   
            
             
            
                </div>
            </body>
            </html>