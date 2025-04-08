<?php 
include("./auth/functions.php");
include ("./auth/auth.php");
$c_id = $_SESSION["c_id"];
// echo $c_id;
$cm_id = $_GET['cm_id'];
if(empty($cm_id)){
    redirect('./cart.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Reservation</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 1em;
        }

        section {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
        }

        input, select {
            margin-bottom: 16px;
            padding: 8px;
        }

        button {
            background-color: #333;
            color: #fff;
            padding: 10px;
            cursor: pointer;
            border: none;
        }
        .btn{
            background-color: #0c0606;
    color: #fff;
    padding: 10px;
    border: none;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
    display: block;
    font-size: 16px;
    margin: 10px auto;
    }
    
.btn:hover {
  background-color: #0056b3; /* Change the background color when hovering */
}
    </style>
</head>
<body>
    <header>
        <h1>Table Reservation</h1>
    </header>

    <section>
        <form method="POST">
            <div> <a href="cart.php" class=""><h3>back</h3></a>
            <a href="tabler.html" class="btn"><h4>CHECK TABLE FORMATION</h4 ></a>
            </div>
            <label for="table-size">Table Name:</label>
            <select id="table-size" name="table-size" required>
                <?php 
                    include "./conn.php";
                    $sql = $conn->query("SELECT * FROM `table_list` where table_status=1");
                    while($tableResult = $sql->fetch_assoc()){
                    ?>
                    <option value="<?php echo $tableResult['t_id']?>"><?php echo $tableResult['t_name'] ." ". "[Seat Capacity"." ". $tableResult['capacity']."]" ?></option>
                    <?php
                    }
                 ?>
            </select>

            <label for="date">Date:</label>
            <input type="date" id="dateInput" name="dateInput" required>

            <label for="time">Time:</label>
            <select id="timeslot" name="timeslot" required>
                <option selected>SELECT</option>
                <?php 
                        
                        // Fetch time slots from the database based on the selected date
                        $query = "SELECT slotid, timeSlot FROM timeslot WHERE status = 1";
                        $result = $conn->query($query);

                        // Extract start times, end times, and slot IDs from the database timeSlot column
                        $timeSlots = $result->fetch_all(MYSQLI_ASSOC);
                        $timeSlotsAfterCurrentTime = [];

                        foreach ($timeSlots as $slot) {
                            list($startTime, $endTime) = explode(' - ', $slot['timeSlot']);
                            // Check if the slot starts from the next hour or later and ends before 10:00 PM
                                $timeSlotsAfterCurrentTime[$slot['slotid']] = $slot['timeSlot'];
                        }

                        foreach ($timeSlotsAfterCurrentTime as $slotid => $fullTimeSlot) {
                            echo "<option value=\"$slotid\">$fullTimeSlot</option>";
                        }
                    ?>
            </select>
            <button type="submit">Reserve Table</button>
        </form>
    </section>
    <script>
        // Get the current date
        var currentDate = new Date();

        // Set the date to the last day of the current year
        var lastDayOfYear = new Date(currentDate.getFullYear(), 11, 32);

        // console.log(lastDayOfYear);

        // Format the dates as strings in the 'YYYY-MM-DD' format
        var formattedCurrentDate = currentDate.toISOString().split('T')[0];
        var formattedLastDayOfYear = lastDayOfYear.toISOString().split('T')[0];


        // Set the min and max attributes of the date input
        document.getElementById('dateInput').setAttribute('min', formattedCurrentDate);
        document.getElementById('dateInput').setAttribute('max', formattedLastDayOfYear);
   
</script>
</body>
</html>
<?php 
        if($_SERVER["REQUEST_METHOD"] == "POST"){

            $timeslot = $_POST['timeslot'];
            $dateInput = $_POST['dateInput'];
            $table_size = $_POST['table-size'];

            $sql = $conn->query("select timeSlot from `timeslot` where slotid='$timeslot'");
            $SelectedTimeSlot = $sql->fetch_assoc()['timeSlot'];

            $timeSlotCheck = isTimeSlotValid($SelectedTimeSlot,$dateInput);
          
            if($timeSlotCheck == 1){
                $amount = getTotalPrice($conn,$cm_id);
                $tablestatus = isTableReserved($conn, $table_size, $dateInput, $timeslot,$c_id);
                if($tablestatus == false){
                    jsredirect("./payment/pay.php?cm_id=$cm_id&tableid=$table_size&slotid=$timeslot&dt=$dateInput");
                }
                else{
                    echo "<script>alert('Already reserved! select another slot ')</script>";
                }
            }else{
                echo "<script>alert('Check Time Slot!')</script>";
            }
        }

?>
