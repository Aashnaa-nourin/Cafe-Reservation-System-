<?php
include('./conn.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    require("./lib/fpdf.php");

    $dateError = NULL;

    function validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }

    $dated = false;

    // Use prepared statements to prevent SQL injection
    $NORMAL_SQL = "SELECT * FROM reservations r 
    INNER JOIN cartmaster cm ON cm.cm_id = r.cm_id
    INNER JOIN table_list t ON t.t_id = r.table_id 
    INNER JOIN register rs ON cm.user_id = rs.c_id
    INNER JOIN timeslot tm ON tm.slotid = r.slot_id";
    $stmt = $conn->prepare($NORMAL_SQL);
    $stmt->execute();
    $staffDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);
    class PDF extends FPDF
    {
        function Header()
        {
        }

        function Footer()
        {
            // Position at 1.5 cm from bottom
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial', 'I', 8);
            // Page number
            $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
        }

        function FancyTable($header, $staff)
        {
            // Colors, line width, and bold font
            $this->SetFillColor(255, 255, 255);
            $this->SetTextColor(0);
            $this->SetLineWidth(.5);
            $this->SetFont('Arial', 'B', 10);
            // Header
            $w = array(50, 50, 50, 50);
            $this->SetFillColor(53, 98, 222);
            $this->SetTextColor(255);
            for ($i = 0; $i < count($header); $i++)
                $this->Cell($w[$i], 8, $header[$i], 1, 0, 'C', true);
            $this->SetFillColor(220, 220, 220);
            $this->SetTextColor(0);
            $this->Ln();
            // Color and font restoration
            $this->SetTextColor(0);
            $this->SetFont('Arial', '', 10);
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
                $this->MultiCell($w[0], 7.5, $result['reservation_id'], 'LRT', 'C', $fill);
                $this->SetXY($x, $y);
                $this->SetFont('Arial', '', 12);
                $x = $this->GetX() + $w[1];
                $this->MultiCell($w[1], 15, $result['reservation_date'], 'LRBT', 'C', $fill);
                $this->SetXY($x, $y);
                $x = $this->GetX() + $w[2];
                $this->MultiCell($w[2], 15, $result['name'], 'LRBT', 'C', $fill);
                $this->SetXY($x, $y);
                $x = $this->GetX() + $w[3];
                $this->MultiCell($w[3], 15, $result['timeSlot'], 'LRBT', 'C', $fill);
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
    $pdf->Cell(190, 10, ' Order Report | Cafearo ', 0, 0, 'C');
    // Line break
    $pdf->Ln(20);

    $titles = array("Reservation ID", "Reservation Date", "Customer Name", "Time Slot");
    $pdf->FancyTable($titles, $staffDetails);

    $pdf->Output('D', 'Order Details.pdf');
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
        .bt1{
            padding: 10px;
            color: white;
            border: 1px solid white;
            display: inline-block;
            background-color:black;
            font-family:monospace;
            text-transform: capitalize;
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
    <form action="" method="post">
        <button type="submit" class="print-button" name="print"><span class="print-icon"></span></button>
    </form>
    <div id="hero">
        <div style="display: flex;justify-content: start;padding: 130px; ">
            <div style="width: 100%;">
                <h2 id="hero_head">RESERVED TABLE DETAILS</h2><br><br>
                <p id="hero_content">
                    <table>
                        <tr>
                            <th>ORDER ID</th>
                            <th>RESERVATION DATE</th>
                            <th>CUSTOMER NAME</th>
                            <th>TIME SLOT</th>
                        </tr>
                        <?php
                        $sel = $conn->prepare("SELECT * FROM reservations r 
                        INNER JOIN cartmaster cm ON cm.cm_id = r.cm_id
                        INNER JOIN table_list t ON t.t_id = r.table_id 
                        INNER JOIN register rs ON cm.user_id=rs.c_id
                        INNER JOIN timeslot tm ON tm.slotid = r.slot_id");
                        $sel->execute();
                        $resultSet = $sel->get_result();

                        // Fetch all rows as an associative array
                        $results = $resultSet->fetch_all(MYSQLI_ASSOC);
                        if (count($results) > 0) {
                            foreach ($results as $result) {
                                $r_id = $result['reservation_id'];
                                $r_date = $result['reservation_date'];
                                $name = $result['name'];
                                $slot = $result['timeSlot'];
                                echo "<tr>
                                <td>$r_id</td>
                                <td>$r_date</td>
                                <td>$name</td>
                                <td>$slot</td>
                                <td><button class='bt' type='button' name='edit' id='edit' onclick='fn($r_id)'>View details</button></td>
                            </tr>";
                            }
                        }
                        ?>
                    </table>
                </p>
            </div>
        </div>
    </div>

    <script>
        const fn = (id) => {
            window.location.replace(`./admininvoice.php?id=${id}`);
        }
    </script>
</body>

</html>
