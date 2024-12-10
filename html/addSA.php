<?php
    session_start();
    include './connect_to_db.php';
    $db_name = 'shop';
    $conn = get_db_connection($db_name);
    $item_id = $_GET["itm"];
    $street = $_GET["SAstreet"];
    $appt = $_GET["SAappt"];
    $st = $_GET["SAstate"];
    $city = $_GET["SAcity"];
    $zip = $_GET["SAzip"];
    
    $sql = "insert into ShipAddr (user_id, ship_seq, street, appt, city ,state ,zip) 
    values($_SESSION[user_id], $item_id, '$street', '$appt', '$city', '$st', '$zip');";
    echo '<script> console.log("'.$sql.'")</script>';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    header("Location: " . './account.php');
    $stmt->close();
    $conn->close();

?>

<p> TODO check code </p>