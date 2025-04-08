<?php 
include('conn.php');
include("./auth/functions.php");
include ("./auth/auth.php");
$c_id = $_SESSION["c_id"];

// echo $c_id;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Orders</title>
    <link rel="stylesheet" type="text/css" href="styles4.css">
    
</head>
<body>
    <header>
        <h1 style="display:flex;">c A f e A R o </h1>
        
    </header>
    </ul>

    <section class="menu">
        <h2>ORDERS</h2>
        <ul>
            <?php 
                $sql = $conn->query("select * from reservations r 
                inner join cartmaster cm  on cm.cm_id = r.cm_id
                inner join table_list t on t.t_id = r.table_id 
                inner join timeslot tm on tm.slotid = r.slot_id where cm.user_id='$c_id'");
                while($OrderDetails = $sql->fetch_assoc()){
            ?>
            <li>
            <form method="POST">
                <div class="item">
                    <!-- <img style="height:200px;width:200px;"src="./<?php echo $ProductResult['photo'] ?>" alt="Food 1"> -->
                    <h3>ORDER ID: <?php echo $OrderDetails['reservation_id']; ?></h3>
                    <p>Reserved Date: <?php echo $OrderDetails['reservation_date']; ?></p>
                    <p><a href="./invoice.php?id=<?php echo $OrderDetails['reservation_id'] ?>" class="order-button" name="addtoCart">View Order Details</a></p>
                </div>
                </form>
            </li>
            <?php 

                }
            ?>
            
            
            <!-- Add more menu items as needed -->
        </ul>
            </section>

   
    <footer>
        <p>&copy;c A f e A R o 2 0 2 3 </p>
    </footer>

    <script src="script.js"></script>
</body>
</html>
