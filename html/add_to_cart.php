<?php
    include './connect_to_db.php';

    $db_name = 'shop';

    $conn = get_db_connection($db_name);

    // TODO -> add item id to cart where user = user id
    // requires log in working to get user id
    // also might need actual quantity validation i forgot the variables
    // so that if its out of stock for good u cant add it

    //redirect back to the item or cart page 
    header("Location: " . './cart.php');

?>

<p> TODO check code </p>