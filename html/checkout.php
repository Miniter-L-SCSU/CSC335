<!DOCTYPE html>
<html lang="en"></html>
<html>
    <head>
        <title> CSC335 - Checkout </title>
        <link rel="stylesheet" href="styling.css">
    </head>
    <body>
        <div>
            <a href="account.php">
                <button>Account Page</button>
            </a>
            <a href="home.php">
                <button>Home Page</button>
            </a>
            <a href="login.php">
                <button type="button"> Login/Logout </button>
            </a>
        </div>

        <div class="center">
            <a href="cart.php">
                <button>Go Back To Cart</button>
            </a>

            <p> TODO: need to add all of this logic to choose shipping and billing info and add it if neededs  </p>
            <!-- todo add all of this logic -->
            <?php
                include './connect_to_db.php';

                $db_name = 'shop';

                $conn = get_db_connection($db_name);

                session_start();
                
                if ($_SESSION["username"] == ""){
                    // can't check out if you're not logged in!
                    
                    header("Location: " . './login.php');
                }

                // check if cart is empty, if not redirect back
                $stmt = $conn->prepare("SELECT * FROM Cart WHERE user_id=?");
                $stmt->bind_param("s", $_SESSION["user_id"]);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows == 0) {
                    // empty cart, redirects bac
                    header("Location: " . './cart.php');
                    
                } else {
                    echo "<br/> Contents of Cart <br/>";
                    while($row = $result->fetch_assoc()) {
                        // show items in cart
                        echo "<br/>Item: " . $row["item_id"] . " <br/>";
                        echo "<br/>Quantity: " . $row["quantity"] . " <br/>";                        
                        echo "<br/> ---------- <br/>";

                    }

                    // Select Payment
                    $stmt2 = $conn->prepare("SELECT * FROM Payment WHERE user_id = " . $_SESSION["user_id"]);
                    $stmt2->execute();
                    $result2 = $stmt2->get_result();
                    echo "Choose a payment: ";
                    if ($result2->num_rows > 0) {
                        echo "<select name='billing' id='billing'>";
                            
                        while($row2 = $result2->fetch_assoc()) {
                            echo "<option value='" . $row2["pay_id"] . "' >" . "Card " . $row2["pay_id"] . " -- " . $row2["card_num"] . " -- " .$row2["exp_date"] . "</option>";
                        }
                        
                        echo "</select>";
                        echo "<br/><br/>";
                    }
                    
                    else {
                        // make a payment
                        header("Location: " . './account.php');
                    }
                    $stmt2->close();
                    echo "<br/>";
                    // Select Shipping Address
                    $stmt3 = $conn->prepare("SELECT * FROM ShipAddr WHERE user_id = " . $_SESSION["user_id"]);
                    $stmt3->execute();
                    $result3 = $stmt3->get_result();
                    echo "Choose a Shipping Address: ";
                    if ($result3->num_rows > 0) {
                        echo "<select name='shipping' id='shipping'>";
                            
                        while($row3 = $result3->fetch_assoc()) {
                            echo "<option value='" . $row3["ship_seq"] . "' >" . "Address " . $row3["ship_seq"] . " -- " . $row3["street"] . " -- " . $row3["zip"] . "</option>";
                        }
                        
                        echo "</select>";
                        echo "<br/><br/>";
                    }
                    else {
                        // make a shipping address
                        header("Location: " . './account.php');
                    }
                    $stmt3->close();
                    // Select Billing Address
                    $stmt4 = $conn->prepare("SELECT * FROM BillAddr WHERE user_id = " . $_SESSION["user_id"]);
                    $stmt4->execute();
                    $result4 = $stmt4->get_result();
                    echo "Choose a Billing Address: ";
                    if ($result4->num_rows > 0) {
                        echo "<select name='billing' id='billing'>";
                            
                        while($row4 = $result4->fetch_assoc()) {
                            echo "<option value='" . $row4["bill_seq"] . "' >" . "Address " . $row4["ship_seq"] . " -- " . $row4["street"] . " -- " . $row4["zip"] . "</option>";
                        }
                        
                        echo "</select>";
                        echo "<br/><br/>";
                        $stmt4->close();
                    }
                    else {
                        // make a billing address
                        header("Location: " . './account.php');
                    }
                    $stmt->close();

                }

            ?>
            <br/>
            <?php
                echo "<form action='./order-placed.php'>";
                echo "<button>Place Order</button>";
                echo "</form>";
            ?>
        

        </div>

    </body>
</html>