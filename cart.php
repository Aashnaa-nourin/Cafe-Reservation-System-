<?php 
include("./auth/functions.php");
include ("./auth/auth.php");
include('conn.php');
$c_id = $_SESSION["c_id"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style/bootstrap.min.css">
    <link rel="stylesheet" href="./style/font-awesome.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="styles4.css"> -->
    <style>
        body{
        background: #ddd;
        min-height: 100vh;
        vertical-align: middle;
        display: flex;
        font-family: sans-serif;
        font-size: 0.8rem;
        font-weight: bold;
    }
    .title{
        margin-bottom: 5vh;
    }
    .card{
        margin: auto;
        max-width: 950px;
        width: 90%;
        box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        border-radius: 1rem;
        border: transparent;
    }
    @media(max-width:767px){
        .card{
            margin: 3vh auto;
        }
    }
    .cart{
        background-color: #fff;
        padding: 4vh 5vh;
        border-bottom-left-radius: 1rem;
        border-top-left-radius: 1rem;
    }
    @media(max-width:767px){
        .cart{
            padding: 4vh;
            border-bottom-left-radius: unset;
            border-top-right-radius: 1rem;
        }
    }
    .summary{
        background-color: #ddd;
        border-top-right-radius: 1rem;
        border-bottom-right-radius: 1rem;
        padding: 4vh;
        color: rgb(65, 65, 65);
    }
    @media(max-width:767px){
        .summary{
        border-top-right-radius: unset;
        border-bottom-left-radius: 1rem;
        }
    }
    .summary .col-2{
        padding: 0;
    }
    .summary .col-10
    {
        padding: 0;
    }.row{
        margin: 0;
    }
    .title b{
        font-size: 1.5rem;
    }
    .main{
        margin: 0;
        padding: 2vh 0;
        width: 100%;
    }
    .col-2, .col{
        padding: 0 1vh;
    }
    a{
        padding: 0 1vh;
    }
    .close{
        margin-left: auto;
        font-size: 0.7rem;
    }
    img{
        width: 3.5rem;
    }
    .back-to-shop{
        margin-top: 4.5rem;
    }
    h5{
        margin-top: 4vh;
    }
    hr{
        margin-top: 1.25rem;
    }
    form{
        padding: 2vh 0;
    }
    select{
        border: 1px solid rgba(0, 0, 0, 0.137);
        padding: 1.5vh 1vh;
        margin-bottom: 4vh;
        outline: none;
        width: 100%;
        background-color: rgb(247, 247, 247);
    }
    input{
        border: 1px solid rgba(0, 0, 0, 0.137);
        padding: 1vh;
        margin-bottom: 4vh;
        outline: none;
        width: 100%;
        background-color: rgb(247, 247, 247);
    }
    input:focus::-webkit-input-placeholder
    {
          color:transparent;
    }
    .btn{
        background-color: #000;
        border-color: #000;
        color: white;
        width: 100%;
        font-size: 0.7rem;
        margin-top: 4vh;
        padding: 1vh;
        border-radius: 0;
    }
    .btn:focus{
        box-shadow: none;
        outline: none;
        box-shadow: none;
        color: white;
        -webkit-box-shadow: none;
        -webkit-user-select: none;
        transition: none; 
    }
    .btn:hover{
        color: white;
    }
    a{
        color: black; 
    }
    a:hover{
        color: black;
        text-decoration: none;
    }
     #code{
        background-image: linear-gradient(to left, rgba(255, 255, 255, 0.253) , rgba(255, 255, 255, 0.185)), url("https://img.icons8.com/small/16/000000/long-arrow-right.png");
        background-repeat: no-repeat;
        background-position-x: 95%;
        background-position-y: center;
    }
    </style>
</head>
<body>
    <!-- <header>
        <h1>c A f e A R o </h1>
    </header> -->
    <div class="card">
        <div class="row">
            <div class="col-md-8 cart">
                <div class="title">
                    <div class="row">
                        <div class="col"><h4><b>My Cart</b></h4></div>
                        <?php 
                        $countsql = $conn->query("select cm.cm_id as cm_id,count(cc.ch_id) as count 
                        from cartmaster cm 
                        inner join cartchild cc on cm.cm_id = cc.mt_id where cm.user_id='$c_id' AND cm.cart_status=1");
                        $result = $countsql->fetch_assoc();
                        $countrow = $result['count'];
                        $cm_id = (int) $result['cm_id'];
                        ?>
                        <div class="col align-self-center text-right text-muted"><?php echo $countrow ?> items</div>
                    </div>
                </div>
                <?php 
                     $flag = 0;
                    $sql = $conn->query("select * ,cc.quantity as qty,p.quantity as pqty from cartmaster cm 
                                        inner join cartchild cc on cm.cm_id = cc.mt_id
                                        inner join product p on p.productid = cc.f_id
                                        inner join category cat on p.categoryid = cat.categoryid 
                                        where cm.user_id='$c_id' AND cm.cart_status = 1");
                    $totalProductPrice = 0; 
                                        if($sql->num_rows > 0){
                    while ($cartResult = $sql->fetch_assoc()){
                        // var_dump($cartResult);
                        //die();
                        $qty = (int)$cartResult["qty"];
                        // echo $qty;
                        $unitprice = (int)$cartResult["price"];
                        $totalPrice = $qty * $unitprice;
                        $totalProductPrice += $totalPrice;
                        ?>
                <div class="row border-top border-bottom">
                    <div class="row main align-items-center">
                        <div class="col-2"><img class="img-fluid" src="<?php echo $cartResult['photo']?>"></div>
                        <div class="col">
                            <div class="row text-muted"><?php echo $cartResult['productname']?></div>
                            <div class="row"><?php echo $cartResult['type']?></div>
                        </div>
                        <div class="col">
                            <?php if($cartResult['pqty'] > 0){
                                ?>
                                <a href="./manage/quantityupdate.php?ch_id=<?php echo $cartResult['ch_id']?>&product_id=<?php echo $cartResult['f_id']?>&type=sub">-</a>
                                <span ><?php echo $cartResult['qty']?></span>
                                <a href="./manage/quantityupdate.php?ch_id=<?php echo $cartResult['ch_id']?>&product_id=<?php echo $cartResult['f_id']?>&type=add">+</a>
                            </div>
                            <div class="col"> &#8377; <?php echo $totalPrice; ?>
                <?php  
                            }else{
                                $flag=1;
                                ?>
                                    
                                    <span class="label label-danger">Product is out of stock</span>
                                <?php
                            }
             ?>          
             <a class="close" href="./manage/deletecart.php?id=<?php echo $cartResult['ch_id']; ?>">&#10005;</a></div>

                    </div>
                </div>
                        <?php 
                    }
                }else{
                    $flag=1;
                    echo "cart is empty!";
                }
                ?>
                <!-- <div class="row">
                    <div class="row main align-items-center">
                        <div class="col-2"><img class="img-fluid" src="https://i.imgur.com/ba3tvGm.jpg"></div>
                        <div class="col">
                            <div class="row text-muted">Shirt</div>
                            <div class="row">Cotton T-shirt</div>
                        </div>
                        <div class="col">
                            <a href="#">-</a><a href="#" class="border">1</a><a href="#">+</a>
                        </div>
                        <div class="col">&euro; 44.00 <span class="close">&#10005;</span></div>
                    </div>
                </div>
                <div class="row border-top border-bottom">
                    <div class="row main align-items-center">
                        <div class="col-2"><img class="img-fluid" src="https://i.imgur.com/pHQ3xT3.jpg"></div>
                        <div class="col">
                            <div class="row text-muted">Shirt</div>
                            <div class="row">Cotton T-shirt</div>
                        </div>
                        <div class="col">
                            <a href="#">-</a><a href="#" class="border">1</a><a href="#">+</a>
                        </div>
                        <div class="col">&euro; 44.00 <span class="close">&#10005;</span></div>
                    </div>
                </div> -->
                <div class="back-to-shop"><a href="products.php">&leftarrow;</a><span class="text-muted">Back to shop</span></div>
            </div>
            <div class="col-md-4 summary">
                <div><h5><b>Summary</b></h5></div>
                <hr>
                <div class="row">
                    <div class="col" style="padding-left:0;">ITEMS <?php ?></div>
                    <div class="col text-right"> <?php echo $countrow ?></div>
                </div>
                <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                    <div class="col">TOTAL PRICE</div>
                    <div class="col text-right"> &#8377; <?php echo $totalProductPrice ?></div>
                </div>
                <input type="hidden" name="cm_id" value="<?php echo $cm_id; ?>">
                <?php  
                if($flag==0){
                    ?>
                    <a href="booktable.php?cm_id=<?php echo $cm_id ?>"><button class="btn">BOOK TABLE</button></a>
                    <?php
                    }else{
                        ?>
                    <a href="./products.php"><button class="btn">Check Your Cart</button></a>
                        <?php
                    }?>
            </div>
        </div>
    </div>
</body>
<script src="./script/bootstrap.bundle.min.js"></script>
<script src="./script/jquery.min.js"></script>
</html>