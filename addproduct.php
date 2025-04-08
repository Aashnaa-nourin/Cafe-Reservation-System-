<?php
	include('conn.php');
	include('./auth/functions.php');

	$pname=$_POST['pname'];
	$price=$_POST['price'];
	$category=$_POST['category'];


	$sql = $conn->query("select * from product where productname = '$pname'");

	if($sql->num_rows>0){
		alert("Product Already Exsist!");
	}else{
		
		$fileinfo=PATHINFO($_FILES["photo"]["name"]);

		if(empty($fileinfo['filename'])){
			$location="";
		}
		else{
		$newFilename=$fileinfo['filename'] ."_". time() . "." . $fileinfo['extension'];
		move_uploaded_file($_FILES["photo"]["tmp_name"],"upload/" . $newFilename);
		$location="upload/" . $newFilename;
	}

		$sql="insert into product (productname, categoryid, price, photo) values ('$pname', '$category', '$price', '$location')";
		$conn->query($sql);
	}
	jsredirect('product.php');
?>