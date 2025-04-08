<?php  
    function redirect($url) {
        ob_start();
        header("Location: {$url}");
        ob_end_flush();
        die();
    }

    function alert($msg){
        echo "<script>alert('$msg')</script>";
    }
    
    function jsredirect($url) {
        echo "<script>window.location.replace('{$url}')</script>";
    }
    
// Function to validate form input
function validateForm($data) {
    // Initialize error messages
    $errors = array(
        'name' => '',
        'email' => '',
        'phoneNumber' => ''
    );

    // Validate name
    if (empty($data['name'])) {
        $errors['name'] = "Name is required";
    } else {
        // Check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $data['name'])) {
            $errors['name'] = "Only letters and white space allowed";
        }
    }

    // Validate email
    if (empty($data['email'])) {
        $errors['email'] = "Email is required";
    } else {
        // Check if the email address is well-formed
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid email format";
        }
    }

    // Validate phone number
    if (empty($data['phoneNumber'])) {
        $errors['phoneNumber'] = "Phone number is required";
    } else {
        // Check if phone number is exactly 10 digits
        if (!preg_match("/^[0-9]{10}$/", $data['phoneNumber'])) {
            $errors['phoneNumber'] = "Phone number must be 10 digits";
        }
    }

    // Output errors
    return $errors;
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Function to check if a table is reserved for a specific date and time slot
    function isTableReserved($conn, $tableId, $reservationDate, $timeSlot,$user_id) {
        $sql = "SELECT COUNT(*) as count FROM reservations res inner join cartmaster cm on res.cm_id = cm.cm_id WHERE res.table_id = ? AND res.reservation_date = ? AND res.slot_id = ? AND cm.user_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issi", $tableId, $reservationDate, $timeSlot,$user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        // Check if the count is greater than 0, indicating the table is reserved
        return $row['count'] > 0;
    }

    function isTimeSlotValid($timeSlot,$dateInput){
        $tz = 'Asia/Kolkata';   
        date_default_timezone_set($tz);
        
        $current_time = time();
        
        $currentDate = date("Y-m-d");
        list($start_time, $end_time) = explode(' - ', $timeSlot);

        $start_timestamp = strtotime($start_time);
        $end_timestamp = strtotime($end_time);
        
        
        if ($currentDate != $dateInput) {
            return 1;
        } else {
            if ($current_time > $start_timestamp) {
                return 0;
            } else {
                return 1;
            }
        }
        
    
}
    function getTotalPrice($conn,$cartMsterid){
        $sql = $conn->prepare("select * ,cc.quantity as qty,p.quantity as pqty from cartmaster cm 
                                        inner join cartchild cc on cm.cm_id = cc.mt_id
                                        inner join product p on p.productid = cc.f_id
                                        inner join category cat on p.categoryid = cat.categoryid 
                                        where cm.cm_id=? ");
        $sql->bind_param("i", $cartMsterid);
        $sql->execute();
        $result = $sql->get_result();
        $totalProductPrice = 0; 
        while($cartResult = $result->fetch_assoc()){
        $qty = (int)$cartResult["qty"];
        $unitprice = (int)$cartResult["price"];
        $totalPrice = $qty * $unitprice;
        $totalProductPrice += $totalPrice;
        }
        return $totalProductPrice;        
    }


function decreaseProductQuantities($conn,$cartMasterID) {

    // Fetch the cartChild entries for the given cartMasterID
    $sqlCartChild = "SELECT f_id, quantity FROM cartchild WHERE mt_id = ?";
    $stmtCartChild = $conn->prepare($sqlCartChild);
    $stmtCartChild->bind_param("i", $cartMasterID);
    $stmtCartChild->execute();
    $resultCartChild = $stmtCartChild->get_result();

    // Loop through each cartChild entry and update the product quantity
    while ($row = $resultCartChild->fetch_assoc()) {
        $productID = $row['f_id'];
        $quantityToDecrease = $row['quantity'];
        // Perform the update query for each cartChild entry
        updateProductQuantity($conn, $productID, $quantityToDecrease);
    }

    $stmtCartChild->close();
}

function updateProductQuantity($conn, $productID, $quantityToDecrease) {
    // Perform the update query for each cartChild entry
    $sqlUpdateProduct = "UPDATE product SET quantity = quantity - ? WHERE productid = ?";
    $stmtUpdateProduct = $conn->prepare($sqlUpdateProduct);
    $stmtUpdateProduct->bind_param("ii", $quantityToDecrease, $productID);
    $stmtUpdateProduct->execute();
    $stmtUpdateProduct->close();
}

function isEmailExists($conn,$email) {

    // Sanitize the email to prevent SQL injection
    $email = $conn->real_escape_string($email);
    // Prepare and execute the query
    $query = "SELECT * FROM login WHERE username = '$email'";
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        // Email exists in the database
        return true;
    } else {
        // Email does not exist in the database
        return false;
    }
}

function fetchUserDetails($conn,$user_id) {
    

    // SQL query to fetch user details
    $sql = "SELECT email, name, phn FROM register WHERE c_id = $user_id";

    // Execute the query
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result === FALSE) {
        die("Error: " . $conn->error);
    }

    // Fetch the results
    $user_details = $result->fetch_assoc();


    // Return the user details
    return $user_details;
}

function getCustomerDetailsByCartMasterId($conn, $cartMasterId) {
    $stmt = $conn->prepare("SELECT * FROM cartmaster cm
                            INNER JOIN register rs ON cm.user_id = rs.c_id
                            WHERE cm.cm_id = ?");
    $stmt->bind_param("i", $cartMasterId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null; // No matching record found
    }
}

?>