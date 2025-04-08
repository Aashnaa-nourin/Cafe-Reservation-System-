<?php
include("./conn.php");
include("./auth/functions.php");

$errors = array(
    'name' => '',
    'email' => '',
    'phoneNumber' => ''
);

if (isset($_POST['add'])) {
    $formData = array(
        'name' => test_input($_POST["u_name"]),
        'email' => test_input($_POST["email"]),
        'phoneNumber' => test_input($_POST["phn"])
    );

    $errors = validateForm($formData);

    // If there are no errors, you can proceed with further processing
    if (empty(array_filter($errors))) {
        $a = test_input($_POST['u_name']);
        $b = test_input($_POST['email']);
        $c = test_input($_POST['phn']);
        $d = test_input($_POST['address']);
        $e = test_input($_POST['doj']);
        $f = test_input($_POST['exp']);
        $g = test_input($_POST['password']);

        if (isEmailExists($conn, $b)) {
            alert("Email Exist!");
        } else {
    
            $inss = $conn->query("INSERT INTO login(username, password, status) VALUES ('$b','$g','Chef')");
            $ins = $conn->query("INSERT INTO `user`( `u_name`, `email`, `phn`, `address`, `doj`, `exp`, `password`,`type`) VALUES ('$a','$b','$c','$d','$e','$f','$g','chef')");
            // echo "$inss";
            if ($inss) {
                echo "<script>alert(' succesfull');</script>";
    
            } else {
                echo "<script>alert(' unsuccesfull');</script>";
            }
        }

    }

    //  $a=$_POST['u_name'];
    //   $b=$_POST['email'];
    //     $c=$_POST['phn'];

    
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Add Chef Details</title>
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

        .bt1 {
            padding: 10px;
            color: white;
            border: 1px solid white;
            display: inline-block;
            background-color: black;
            font-family: monospace;
            text-transform: capitalize;
        }

        .error{
            color:red;
        }
    </style>
</head>

<body>
    <h1>Add Chef Details</h1>
    <!-- <a href="adminchef.html" class="bt1">back</a> -->

    <form method="post" action="">
        <label for="name">Name:</label>
        <input type="text" id="name" name="u_name" required>
        <span class="error" id="nameError"><?php echo $errors['name'];?></span><br>

        <label for="id">Email:</label>
        <input type="text" id="id" name="email" required>
        <span class="error" id="emailError"><?php echo $errors['email'];?></span><br>

        <label for="Phone Number">Phone Number:</label>
        <input type="text" id="" name="phn" required><br><br>
        <span class="error" id="phoneNumberError"><?php echo $errors['phoneNumber'];?></span>
        <br>

        <label for="">Address:</label>
        <input type="text" id="" name="address" required><br><br>

        <label for="">Date Of Join:</label>
        <input type="date" id="" name="doj" required><br><br>

        <label for="">Experience:</label>
        <input type="text" id="" name="exp" required><br><br>


        <label for="">Password:</label>
        <input type="text" id="" name="password" required><br><br>

        <input type="submit" name="add" value="Add Chef">


    </form>
</body>

</html>