<?php
    session_start();
    include './connect_to_db.php';

    $db_name = 'shop';

    $conn = get_db_connection($db_name);
    // TODO -> add an if clause for adding a new quantitiy

    $item_id = $_GET["itm"];
    $item_Q = $_GET["Q"];

    $sql = "insert into Cart (user_id,item_id,quantity)  values(" . "(select user_id from User where username ='". $_SESSION["username"] ."' ), " . $item_id . ", " . $item_Q . " );";
    $stmt = $conn->prepare($sql);
    
    $stmt->execute();
    $result = $stmt->get_result();

    $sql2 = "update item set available_quantity = available_quantity - $item_Q where item_id = $item_id ;";
    $stmt2 = $conn->prepare($sql2);
    
    $stmt2->execute();
    // TODO -> add item id to cart where user = user id
    // requires log in working to get user id
    // also might need actual quantity validation i forgot the variables
    // so that if its out of stock for good u cant add it

    //redirect back to the item or cart page 
    header("Location: " . './cart.php');
    $stmt->close();
    $stmt2->close();
    $conn->close();

?>

<p> TODO check code </p>