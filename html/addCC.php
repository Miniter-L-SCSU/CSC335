<?php
    session_start();
    include './connect_to_db.php';
    $db_name = 'shop';
    $conn = get_db_connection($db_name);
    $item_id = $_GET["itm"];
    $name = $_GET["CCname"];
    $num = $_GET["CCnum"];
    $exp = $_GET["CCexp"];

    $sql = "insert into Payment (user_id, card_name, card_num, exp_date) values ('$_SESSION[user_id]', '$name', '$num', '$exp');"; 
    echo '<script> console.log("'.$sql.'")</script>';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    header("Location: " . './account.php');
    $stmt->close();
    $conn->close();

?>

<p> TODO check code </p>