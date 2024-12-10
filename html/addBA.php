<?php
    session_start();
    include './connect_to_db.php';
    $db_name = 'shop';
    $conn = get_db_connection($db_name);
    $item_id = $_GET["itm"];
    $street = $_GET["BAstreet"];
    $appt = $_GET["BAappt"];
    $st = $_GET["BAstate"];
    $city = $_GET["BAcity"];
    $zip = $_GET["BAzip"];
    
    $sql = "insert into BillAddr (user_id, bill_seq, street, appt, city ,state ,zip) 
    values($_SESSION[user_id], $item_id, '$street', '$appt', '$city', '$st', '$zip');";
    echo '<script> console.log("'.$sql.'")</script>';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    header("Location: " . './account.php');
    $stmt->close();
    $conn->close();

?>

<p> TODO check code </p>