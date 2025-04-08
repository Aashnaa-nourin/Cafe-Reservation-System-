
<?php
$con=new mysqli("localhost","root","","project");
                    $u_id = $_GET['id'];
                    if(empty($_GET['id'])){
                        header("Location: ./displays.php");
                    }
                    $sql= $con->query("select * from user where u_id='$u_id'");
                    $staffDetails = $sql->fetch_assoc();
                    $username = $staffDetails['u_name'];

                    if(isset($_POST['update'])){
                        $u_name=$_POST['u_name'];
                        $email= $_POST['email'];
                        $phn=$_POST['phn'];
                        $address=$_POST['address'];
                        $doj=$_POST['doj'];
                        $exp=$_POST['exp'];
                        //$doj=$_POST['doj'];
                        $password=$_POST['password'];
                        // sql to update staff table 
                        $StaffUpdateSql = "update user set u_name='$u_name',email ='$email', phn='$phn',address='$address',doj='$doj',exp='$exp',password='$password' where u_id='$u_id'";
                        //sql to update login table
                        $sqlUpdateLogin = "update login set username='$u_name',password='$password' where username='$username'";
                        $test1 = $con->query($sqlUpdateLogin);
                        $test2 = $con->query($StaffUpdateSql);
                        header("Location: ./displays.php");
                    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Staff</title>
    <style>
        h1 {
            text-align: center;
        }
        form {
            width: 400px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
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
    <h1>Edit Details</h1>
    <!-- <a href="adminstaff.html" class="bt1">back</a> -->
    <form method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="u_name" value="<?php echo $staffDetails['u_name']; ?>" required>

        <label for="id">Email:</label>
        <input type="text" id="id" name="email" value="<?php echo $staffDetails['email']; ?>" required>

        
        <label for="Phone Number">Phone Number:</label>
        <input type="text" id=""  name="phn" value="<?php echo $staffDetails['phn']; ?>" required><br><br>

        <label for="">Address:</label>
        <input type="text" id=""  name="address" value="<?php echo $staffDetails['address']; ?>" required><br><br>

        <label for="">Date Of Join:</label>
        <input type="date" id=""  name="doj"  value="<?php echo $staffDetails['doj']; ?>" required><br><br>

        <label for="">Experience:</label>
        <input type="text" id=""  name="exp" value="<?php echo $staffDetails['exp']; ?>" required><br><br>


        <label for="">Password:</label>
        <input type="text" id=""  name="password" value="<?php echo $staffDetails['password']; ?>" required><br><br>

        <input type="submit" name="update" value="update">
    </form>
</body>
</html>
