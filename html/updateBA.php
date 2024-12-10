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
    
    $sql = "update BillAddr set street = '$street', appt = '$appt', city = '$city', state = '$st', zip = '$zip' where user_id = $_SESSION[user_id] and bill_seq = $item_id;";
    echo '<script> console.log("'.$sql.'")</script>';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    header("Location: " . './account.php');
    $stmt->close();
    $conn->close();

?>

<p> TODO check code </p>