<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Staff Dashboard</title>
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
    
    </style>
</head>
<body>

    <div class="sidebar">
        <a href="#menu"></a>
        <a href="staffhome.html" id="hover-effect">Dashboard</a>
        <a href="staffchef.html" id="hover-effect">CHEF</a>
        <a href="staffwaiter.html" id="hover-effect">WAITER</a>
        <a href="staffcustomer.html" id="hover-effect">CUSTOMER</a>
        <a href="staffmenu.html" id="hover-effect">MENU</a>
        <a href="stafftable.html" id="hover-effect">TABLE DETAILS</a>
        <a href="stafforder.html" id="hover-effect">ORDER DETAILS</a>
        <a href="feedback.php" id="hover-effect">FEEDBACK DETAILS</a>
        <a href="feedback.html" id=""></a>
        <a href="feedback.html" id=""></a>
        <a href="feedback.html" id=""></a>
        <a href="logout.php" id="hover-effect">LOGOUT</a>
    </div>


    <div class="content">
        <div class="header">
            <h1>cAfeARo Staff Dashboard-FEEDBACK DETAILS</h1> 
        <!-- </div> <div> <a href="adminhomepage.html" class="hero_bt"><h3>back</h3></a> -->
        </div>&nbsp;

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