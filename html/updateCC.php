<?php
    session_start();
    include './connect_to_db.php';
    $db_name = 'shop';
    $conn = get_db_connection($db_name);
    $item_id = $_GET["itm"];
    $name = $_GET["CCname"];
    $num = $_GET["CCnum"];
    $exp = $_GET["CCexp"];

    $sql = "update Payment set card_name = '$name', card_num = '$num', exp_date = '$exp' where user_id = $_SESSION[user_id] and pay_id = $item_id;";
    echo '<script> console.log("'.$sql.'")</script>';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    header("Location: " . './account.php');
    $stmt->close();
    $conn->close();

?>

<p> TODO check code </p>