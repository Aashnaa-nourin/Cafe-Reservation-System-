<?php
include('conn.php');
include("./auth/functions.php");
include("./auth/auth.php");
// $c_id = $_SESSION["c_id"];
extract($_GET);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Order Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="./style/invoice.min.css" rel="stylesheet">

    <head>
        <!-- Your other head content -->
        <style type="text/css">
            body {
                margin-top: 20px;
                background: #eee;
            }

            .invoice {
                padding: 30px;
            }

            .invoice h2 {
                margin-top: 0px;
                line-height: 0.8em;
            }

            .invoice .small {
                font-weight: 300;
            }

            .invoice hr {
                margin-top: 10px;
                border-color: #ddd;
            }

            .invoice .table tr.line {
                border-bottom: 1px solid #ccc;
            }

            .invoice .table td {
                border: none;
            }

            .invoice .identity {
                margin-top: 10px;
                font-size: 1.1em;
                font-weight: 300;
            }

            .invoice .identity strong {
                font-weight: 600;
            }


            .grid {
                position: relative;
                width: 100%;
                background: #fff;
                color: #666666;
                border-radius: 2px;
                margin-bottom: 25px;
                box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.1);
            }
        </style>
    </head>

<body>
    <button id="downloadBtn" onclick="downloadDivAsPDF()">Download PDF</button>
    <div class="invoice" id="invoice">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="grid invoice">
                        <div class="grid-body">
                            <div class="invoice-title">
                                <div class="row">

                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h2>Invoice<br>
                                            <span class="small">Order #<?php echo $id; ?></span>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <?php
                            // $userDetails = fetchUserDetails($conn, $c_id);

                            $sql = $conn->query("SELECT *
                            FROM reservations r
                            INNER JOIN cartmaster cm ON cm.cm_id = r.cm_id
                            INNER JOIN table_list t ON t.t_id = r.table_id 
                            INNER JOIN timeslot tm ON tm.slotid = r.slot_id 
                            WHERE r.reservation_id='$id'");

                            $OrderDetails = $sql->fetch_assoc();
                            $cm_id = $OrderDetails['cm_id'];
                            $userDetails = getCustomerDetailsByCartMasterId($conn, $cm_id);

                            ?>
                            <div class="row">
                                <div class="col-xs-6">
                                    <address>
                                        <strong>Billed To:</strong><br>
                                        <?php echo $userDetails['name']; ?>,<br>
                                        <?php echo $userDetails['email']; ?>,<br>
                                        <abbr title="Phone">+91 <?php echo $userDetails['phn']; ?></abbr>
                                    </address>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <address>

                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <address>
                                        <!-- <strong>Payment Method:</strong><br>
                                    Visa ending **** 1234<br>
                                    <a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                        data-cfemail="eb83c58e878a82858eab8c868a8287c5888486">[email&#160;protected]</a><br> -->
                                    </address>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <address>
                                        <strong>Order Date:</strong><br>
                                        <?php echo $OrderDetails['reservation_date']; ?>
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>ORDER SUMMARY</h3>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr class="line">
                                                <td><strong>#</strong></td>
                                                <td class="text-center"><strong>IMAGE</strong></td>
                                                <td class="text-center"><strong>ITEM</strong></td>
                                                <td class="text-center"><strong>QUANTITY</strong></td>
                                                <td class="text-right"><strong>RATE</strong></td>
                                                <td class="text-right"><strong>SUBTOTAL</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 

                                            $sqlCart = $conn->query("SELECT *,cc.quantity as cqty FROM cartchild cc 
                                        INNER JOIN cartmaster cm on cc.mt_id = cm.cm_id
                                        INNER JOIN product p ON p.productid = cc.f_id
                                        WHERE cc.mt_id=$cm_id and cart_status = 0");
                                            $i = 1;
                                            while ($productDetails = $sqlCart->fetch_array()) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $i++; ?></td>
                                                    <td><img style="width:100px;height:100px;" src='<?php echo $productDetails['photo']  ?>'></td>
                                                    <td><?php echo $productDetails['productname'] ?></td>
                                                    <td class="text-center"><?php echo $productDetails['cqty']; ?></td>
                                                    <td class="text-center">&#8377; <?php echo $productDetails['price']; ?></td>
                                                    <td class="text-right">&#8377; <?php echo $productDetails['cqty'] * $productDetails['price']; ?> </td>
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                <td colspan="3">
                                                </td>
                                                <td class="text-right"><strong>Total</strong></td>
                                                <?php
                                                $totalprice = getTotalPrice($conn, $cm_id);
                                                ?>
                                                <td class="text-right"><strong>&#8377;<?php echo $totalprice; ?></strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

    <script src="./script/min.js"></script>
    <!-- Add the following JavaScript code at the end of your HTML file -->
    <script src="./script/jspdf.min.js"></script>
    <script src="./script/html2canvas.js"></script>
    <script>
        function downloadDivAsPDF() {
            var pdf = new jsPDF('p', 'pt', 'a4');

            html2canvas(document.getElementById('invoice')).then(function(canvas) {
                var imgData = canvas.toDataURL('image/png');
                var imgWidth = pdf.internal.pageSize.getWidth();
                var imgHeight = (canvas.height * imgWidth) / canvas.width;

                pdf.addImage(imgData, 'PNG', 0, 0, imgWidth, imgHeight);

                pdf.save('invoice.pdf');
            });
        }
    </script>
</body>

</html>