<?php
include('conn.php');
include("./auth/functions.php");
include("./auth/auth.php");
$c_id = $_SESSION["c_id"];
extract($_GET);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Order Details</title>
    <link rel="stylesheet" type="text/css" href="styles4.css">
    <style>
        body{
    background:#eee;
}
.card {
    box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: 1rem;
}
.text-reset {
    --bs-text-opacity: 1;
    color: inherit!important;
}
a {
    color: #5465ff;
    text-decoration: none;
}
    </style>
</head>

<body>
    <header>
        <h1 style="display:flex;">c A f e A R o</h1>
    </header>

    <section class="menu">
        <h2>Order Details</h2>
            <?php
            $sql = $conn->query("SELECT *
            FROM reservations r
            INNER JOIN cartmaster cm ON cm.cm_id = r.cm_id
            INNER JOIN table_list t ON t.t_id = r.table_id 
            INNER JOIN timeslot tm ON tm.slotid = r.slot_id 
            WHERE r.reservation_id='$id'");
                
            $OrderDetails = $sql->fetch_assoc();

            ?>
                <form method="POST">
                    <div class="container-fluid">
                        <div class="container">
                            <!-- Title -->
                            <div class="d-flex justify-content-between align-items-center py-3">
                                <h2 class="h5 mb-0"><a href="#" class="text-muted"></a> Order #<?php echo $OrderDetails['reservation_id']; ?></h2>
                            </div>

                            <!-- Main content -->
                            <div class="row">
                                <div class="col-lg-8">
                                    <!-- Details -->
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="mb-3 d-flex justify-content-between">
                                                <div>
                                                    <span class="me-3"><?php echo $OrderDetails['reservation_date']; ?></span>
                                                    <span class="me-3">#<?php echo $OrderDetails['reservation_id']; ?></span>
                                                    <!-- Add other details dynamically as needed -->
                                                </div>      
                                                <!-- Add other buttons or actions as needed -->
                                            </div>
                                            <!-- Display order items dynamically -->
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <td>

                                                        <?php 
                                                            $cm_id = $OrderDetails['cm_id'];

                                                            $sqlCart = $conn->query("SELECT * FROM cartchild cc 
                                                            INNER JOIN cartmaster cm on cc.mt_id = cm.cm_id
                                                            INNER JOIN product p ON p.productid = cc.f_id
                                                            WHERE cc.mt_id=$cm_id and cart_status = 0");

                                                            // Fetching the result set using the correct variable $sqlCart
                                                            while($productDetails = $sqlCart->fetch_array()){
?>
                                                            <div class="d-flex mb-2">
                                                                <!-- Display product image dynamically -->
                                                                <div class="flex-shrink-0">
                                                                    <img src="<?php echo $productDetails['photo']; ?>"
                                                                        alt="" width="35" class="img-fluid">
                                                                </div>
                                                                <div class="flex-lg-grow-1 ms-3">
                                                                    <h6 class="small mb-0"><a href="#" class="text-reset"><?php echo $productDetails['productname']; ?></a></h6>
                                                                    <!-- Add other product details dynamically -->
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <!-- Add other order item details dynamically -->
                                                        <td><?php echo $productDetails['quantity']; ?></td>
                                                        <td class="text-end"><?php echo $productDetails['price']; ?></td>
                                                        <?php } ?>
                                                    </tr>
                                                    <!-- Add more rows for additional order items -->
                                                </tbody>
                                                <!-- Display order totals dynamically -->
                                                <tfoot>
                                                    <tr class="fw-bold">
                                                        <td colspan="2">TOTAL</td>
                                                        <td class="text-end"><?php 
                                                        $totalprice = getTotalPrice($conn,$cm_id);
                                                        echo $totalprice; ?></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    </section>

    <footer>
        <p>&copy;c A f e A R o 2 0 2 3 </p>
    </footer>

    <script src="script.js"></script>
</body>

</html>
