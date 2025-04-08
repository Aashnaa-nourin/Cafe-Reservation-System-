<?php include('./conn.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    require("./lib/fpdf.php");

    $dateError = NULL;

    function validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }

    $dated = false;

    $NORMAL_SQL = "SELECT u_name,email,`address`,phn FROM `user` where type='chef'";
    $stmt = $conn->query($NORMAL_SQL);
    $staffDetails = $stmt->fetch_all(MYSQLI_ASSOC);


    class PDF extends FPDF
    {
    function Header(){
    }
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

    function FancyTable($header, $staff)
    {
        // Colors, line width and bold font
        $this->SetFillColor(255,255,255);
        $this->SetTextColor(0);
        //$this->SetDrawColor(128,0,0);
        $this->SetLineWidth(.5);
        $this->SetFont('Arial','B',10);
        // Header
        $w = array(20, 50, 30, 90);
        $this->SetFillColor(53, 98, 222);
        $this->SetTextColor(255);
        for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],8,$header[$i],1,0,'C',true);
        $this->SetFillColor(220,220,220);
        $this->SetTextColor(0);
        $this->Ln();
        // Color and font restoration
        $this->SetTextColor(0);
        $this->SetFont('Arial','',10);
        // Data
        $fill = false;

        foreach ($staff as $result) {
            $fill = !$fill;
            $y = $this->GetY();
            $x = $this->GetX() + $w[0];
            $x0 = $this->GetX();
            $this->SetFont('Arial', '', 10);
            $this->MultiCell($w[0], 15, "", 'LR', 'L', $fill);
            $this->SetXY($x0, $y);
            $this->MultiCell($w[0], 7.5, $result['u_name'], 'LRT', 'L', $fill);
            $this->SetXY($x, $y);
            $this->SetFont('Arial', '', 12);
            $x = $this->GetX() + $w[1];
            $this->MultiCell($w[1], 15, $result['email'], 'LRBT', 'C', $fill);
            $this->SetXY($x, $y);
            $x = $this->GetX() + $w[2];
            $this->MultiCell($w[2], 15, $result['phn'], 'LRBT', 'C', $fill);
            $this->SetXY($x, $y);
            $x = $this->GetX() + $w[3];
            $this->MultiCell($w[3], 15, $result['address'], 'LRBT', 'L', $fill);
            $this->SetXY($x, $y);
            $this->Ln();
            $this->Cell(array_sum($w), 0, "", 'TB');
            $this->Ln();
        }
        $this->Ln();
    }
}

// Instanciation of inherited class
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->SetMargins(10, 10);
    $pdf->AddPage();

    $pdf->SetFont('Arial', 'B', 13);
    // Title
    $pdf->SetFillColor(230, 230, 0);
    $pdf->SetLineWidth(0.4);
    $pdf->Cell(190, 10, ' Chef Report | Cafearo ', 0, 0, 'C');
    // Line break
    $pdf->Ln(20);

    $titles = array("Name", "Email", "Number", "Address");
    $pdf->FancyTable($titles, $staffDetails);

    $pdf->Output('D', 'Chef Details.pdf');
}

?>

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
     .bt1{
            padding: 10px;
            color: white;
            border: 1px solid white;
            display: inline-block;
            background-color:black;
            font-family:monospace;
            text-transform: capitalize;
        }

        .bt{
            padding: 10px;
            color: black;
            border: 1px solid white;
            display: inline-block;
            background-color:red;
            font-family:monospace;
            text-transform: capitalize;
            text-decoration: none;
        }
        .bt:hover{
            background-color: black; 
            color: white; 
        }
        
        button.print-button {
    width: 100px;
    height: 100px;
    float:right;
    }
    span.print-icon, span.print-icon::before, span.print-icon::after, button.print-button:hover .print-icon::after {
    border: solid 4px #333;
    }
    span.print-icon::after {
    border-width: 2px;
    }

    button.print-button {
    position: relative;
    padding: 0;
    border: 0;
    
    border: none;
    background: transparent;
    }

    span.print-icon, span.print-icon::before, span.print-icon::after, button.print-button:hover .print-icon::after {
    box-sizing: border-box;
    background-color: #fff;
    }

    span.print-icon {
    position: relative;
    display: inline-block;  
    padding: 0;
    margin-top: 20%;

    width: 60%;
    height: 35%;
    background: #fff;
    border-radius: 20% 20% 0 0;
    }

    span.print-icon::before {
    content: "";
    position: absolute;
    bottom: 100%;
    left: 12%;
    right: 12%;
    height: 110%;

    transition: height .2s .15s;
    }

    span.print-icon::after {
    content: "";
    position: absolute;
    top: 55%;
    left: 12%;
    right: 12%;
    height: 0%;
    background: #fff;
    background-repeat: no-repeat;
    background-size: 70% 90%;
    background-position: center;
    background-image: linear-gradient(
        to top,
        #fff 0, #fff 14%,
        #333 14%, #333 28%,
        #fff 28%, #fff 42%,
        #333 42%, #333 56%,
        #fff 56%, #fff 70%,
        #333 70%, #333 84%,
        #fff 84%, #fff 100%
    );

    transition: height .2s, border-width 0s .2s, width 0s .2s;
    }

    button.print-button:hover {
    cursor: pointer;
    }

    button.print-button:hover .print-icon::before {
    height:0px;
    transition: height .2s;
    }
    button.print-button:hover .print-icon::after {
    height:120%;
    transition: height .2s .15s, border-width 0s .16s;
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
<form action="" method="post">
    <button type="submit" class="print-button" name="print"><span class="print-icon"></span></button>
</form>
    <div id="hero">
    <div style="display: flex;justify-content: start;padding: 130px; ">
            <div style="width: 100%;">
                <h2 id="hero_head">MANAGE CHEF DETAILS</h2><br><br>
                <!-- <a href="adminchef.html" class="bt1">back</a> -->
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
                            <th>PASSWORD</th>
                        </tr>
                        <?php
                        
                        $sel=$conn->query("SELECT * FROM `user` inner join `login` on `user`.email=`login`.username where `login`.status='chef'");
                        if($sel->num_rows>0){
                            while($result=mysqli_fetch_array($sel)){
                                $u_id=$result['u_id'];
                                $user_name=$result['u_name'];
                                $email=$result['email'];
                                $phn=$result['phn'];
                                $add=$result['address'];
                                $doj=$result['doj'];
                                $exp=$result['exp'];
                                $password=$result['password'];
                                $status = $result['login_status'];
                                echo"<tr>
                                <td>$u_id</td>
                                <td>$user_name</td>
                                <td>$email</td>
                                <td>$phn</td>
                                <td>$add</td>
                                <td>$doj</td>
                                <td>$exp</td>
                                <td>$password</td>
                                ";
                                
                                if($status== 1){
                                    echo "<td><span style='color:green;'>Active</span></td>";
                                }else{
                                    echo "<td><span style='color: red;'>Deactive</span></td>";
                                    
                                }
                                ?>
                                <td>
                                <form method="POST">
                                    <?php  if($status == 1){
                                    ?>
                                    <a  class='bt'  href='./status/chefStatus.php?email=<?php echo $email; ?>&status=0'>Deactivate</a><br></td>
                                    <?php                                         
                                    }else{
                                        ?>
                                    <a style="background-color: green;"class='bt activet' href='./status/chefStatus.php?email=<?php echo $email; ?>&status=1''>Activate</a><br></td>
                                        <?php
                                    }
                                        ?>
                                <td>
                                 
                                <td><button class='bt' type='button' name='edit' id='edit' onclick="fn('<?php echo $u_id; ?>')">Edit</button>
                                </td>
                                </form>
                                 </tr>
                                 <?php 

                            }
                        }
                        if(isset($_POST['delete'])){
                            $a=$_POST['delete'];
                            if(!empty($a)){
                                $del=$con->query("DELETE FROM `user`where u_id ='$a'");
                                echo"deleted";
                                echo "<script>window.location.replace('../cafe/displayc.php')</script>";
                            }else{
                                echo "Something went wrong!";
                            }
                            
                        }
                       ?>

                       <script>
                        const fn = (id) => {
                            window.location.replace(`./editchef.php?id=${id}`);
                        }
                        </script>