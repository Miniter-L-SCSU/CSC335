<?php
    session_start();
    include './connect_to_db.php';

    $db_name = 'shop';

    $conn = get_db_connection($db_name);

    $item_id = $_GET["rmv"];
    $cart_quantity = $_GET['cart_quantity'];
    echo " item id " . $item_id . " item quantity " . $cart_quantity;

    // grab current cart info 
    $stmt = $conn->prepare("SELECT user_id, item_id, quantity FROM Cart WHERE user_id=?");
    $stmt->bind_param("s", $_SESSION["user_id"]);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
                    
         while($row = $result->fetch_assoc()) {   
            
            // Check if desired adjusted item matches an item in the result
            if ( $item_id == $row["item_id"] ){
                echo "<br/> DEBUG <br/>";
                echo "Desired Cart Quantity " . $cart_quantity . "<br/>";
                echo "Actual Cart Quantity " . $row["quantity"] . "<br/>";
                echo " Desired Item ID " . $item_id . "<br/>";
                echo " Cart Item ID " . $row["item_id"] . "<br/>";
                echo "<br/><br/>";
                // Check if desired quantity is 0 or less, indicates removing it
                if ($cart_quantity <= 0){
                    $sql = "DELETE FROM Cart WHERE user_id = $_SESSION[user_id] AND item_id = $item_id";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    // add quantity back
                    $sql2 = "Update Item SET available_quantity = available_quantity + " . $row['quantity'] . " WHERE item_id = $item_id";
                    $stmt2 = $conn->prepare($sql2);
                    $stmt2->execute();
                    header("Location: " . './cart.php');
                }
                else{
                    // If desired cart quantity < current cart quantity 
                    // update cart quantity and available stock to remove quantity
                    if ($cart_quantity < $row["quantity"]){
                        $sql = "Update Cart SET quantity = $cart_quantity WHERE item_id = $item_id AND user_id = ". $_SESSION["user_id"];
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $stock_back = $row["quantity"] - $cart_quantity;
                        $sql2 = "Update Item SET available_quantity = available_quantity + " . $stock_back . " WHERE item_id = $item_id";
                        $stmt2 = $conn->prepare($sql2);
                        $stmt2->execute();
                        header("Location: " . './cart.php');
                    }
                    // else if desired cart quantity > actual row quantity
                    // update accordingly 
                    elseif ($cart_quantity > $row['quantity']){
                        echo " TODO ";
                        $tempvar = $row["quantity"];
                        // todo check if desired quantity > available quantity 
                        // else update
                        $sql = "SELECT item_id, available_quantity from Item WHERE item_id = $item_id";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if ($result->num_rows > 0) {
		
                            while($row = $result->fetch_assoc()) {
                                $current_available_quantity = $row["available_quantity"];
                            }
                            if ($current_available_quantity < $cart_quantity){
                                // too many items reserved, can't reserve, go back to cart
                                header("Location: " . './cart.php');
                            }
                            else {
                                // else, reserve the items and add to cart
                                $sql2 = "Update Cart SET quantity = $cart_quantity WHERE item_id = $item_id AND user_id = ". $_SESSION["user_id"];
                                $stmt2 = $conn->prepare($sql2);
                                $stmt2->execute();
                                echo " desired " . $cart_quantity . " actual " . $tempvar;
                                $stock_removed = ($cart_quantity - $tempvar);
                                $sql3 = "Update Item SET available_quantity = available_quantity - " . $stock_removed . " WHERE item_id = $item_id";
                                $stmt3 = $conn->prepare($sql3);
                                $stmt3->execute();
                                header("Location: " . './cart.php');
                            }
                            
                        } else {
                            echo "Hmm... this shouldn't have happened";
                        }

                    }
                    else{
                        // means theyre equal so no changes even if this doesn't log bc of the redirect
                        header("Location: " . './cart.php');
                    }

                }
            } 
            else{
                echo "";
            }
        }
    } else {
        echo "Achievement Unlocked: How did we get here?";
    }

    $stmt->close();
    $conn->close();

?>
