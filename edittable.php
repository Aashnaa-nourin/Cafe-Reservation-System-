
<?php
$con=new mysqli("localhost","root","","cafe");
                    $t_id = $_GET['id'];
                    if(empty($_GET['id'])){
                        header("Location: ./displayt.php");
                    }
                    $sql= $con->query("select * from `table_list` where t_id=$t_id");
                    $tableDetails = $sql->fetch_assoc();
                    $tablename = $tableDetails['t_name'];

                    if(isset($_POST['update'])){
                        $t_name=$_POST['t_name'];
                        $place= $_POST['place'];
                        $capacity=$_POST['capacity'];
                        $tableUpdateSql= "UPDATE `table_list` SET `t_name`='$t_name',`place`='$place',`capacity`='$capacity' WHERE t_id=$t_id";
                        // $tableUpdateSql = "update `table` set t_name=$t_name,place =$place, capacity=$capacity  where t_id=$t_id";
                        //sql to update login table
                        // $sqlUpdateLogin = "update login set username='$t_name',password='$password' where username='$username'";
                        // $test1 = $con->query($sqlUpdateLogin);
                        $test = $con->query($tableUpdateSql);
                        header("Location: ./displayt.php");
                    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit table</title>
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
    <!-- <a href="admintable.html" class="bt1">back</a> -->
    <form method="post">
        <label for="name">Table Name:</label>
        <input type="text" id="name" name="t_name" value="<?php echo $tableDetails['t_name']; ?>" required>

        <label for="id">place:</label>
        <input type="text" id="id" name="place" value="<?php echo $tableDetails['place']; ?>" required>

        
        <label for="Phone Number">capacity:</label>
        <input type="text" id=""  name="capacity" value="<?php echo $tableDetails['capacity']; ?>" required><br><br>


        <input type="submit" name="update" value="update">
    </form>
</body>
</html>
