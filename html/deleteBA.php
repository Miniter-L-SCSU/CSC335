<?php
    session_start();
    include './connect_to_db.php';
    $db_name = 'shop';
    $conn = get_db_connection($db_name);
    $item_id = $_GET["itm"];

    $sql = "delete from BillAddr where user_id = $_SESSION[user_id] and bill_seq = $item_id;";
    echo '<script> console.log("'.$sql.'")</script>';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    header("Location: " . './account.php');
    $stmt->close();
    $conn->close();

?>
