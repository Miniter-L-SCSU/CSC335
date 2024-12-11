<!DOCTYPE html>
<html lang="en"></html>
<html>
    <head>
        <title> CSC335 - Order Placed </title>
        <link rel="stylesheet" href="styling.css">
    </head>
    <body>
        <div>
            <a href="account.php">
                <button>Account Page</button>
            </a>
            <label>Search</label>
            <input type="text" id="item_search"></input> 
            <a href="home.php">
                <button>Home Page</button>
            </a>
            <a href="login.php">
                <button type="button"> Login/Logout </button>
            </a>
        </div>

        <div class="center">
            <p> Congratulations! Your order was placed </p>
            <?php
                $bill_seq = $_POST["billing"];
                $ship_seq = $_POST["shipping"];
                $pay_id = $_POST["payment"];

                include './connect_to_db.php';

                $db_name = 'shop';

                $conn = get_db_connection($db_name);

                session_start();

                if ($_SESSION["username"] == ""){
                    // can't place an order if you're not logged in!
                    
                    header("Location: " . './login.php');
                }

                // Creates order
                // ideally there'd be handling so it doesnt create a new order everytime someone visits the page if they already placed the order
                $sql = "INSERT INTO Orders (user_id, bill_seq, ship_seq, pay_id) values(" . $_SESSION['user_id'] . ", " . $bill_seq . ", " . $ship_seq . ", " . $pay_id . ");";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $stmt->close();
                
                // fetches order, not sure if there's a better way to do this
                $stmt2 = $conn->prepare("SELECT * FROM Orders WHERE user_id=" . $_SESSION['user_id'] . " ORDER BY order_id DESC limit 1;");
                $stmt2->execute();
                $result2 = $stmt2->get_result();
                $stmt2->close();

                if ($result2->num_rows > 0) {
 
                    while($row2 = $result2->fetch_assoc()) {
                        $order_id = $row2["order_id"];
                    }
                    echo "<br/> Order Number $order_id <br/>";
                    
                } else {
                    echo "0 results on fetch order... contact a coder ";
                }

                // add cart to ordered items
                $stmt3 = $conn->prepare("SELECT * FROM Cart WHERE user_id=" . $_SESSION['user_id']);
                $stmt3->execute();
                $result3 = $stmt3->get_result();
                $stmt3->close();

                if ($result3->num_rows > 0) {
 
                    while($row3 = $result3->fetch_assoc()) {
                        $sql = "INSERT INTO Ordered (item_id, order_id, quantity) values(" . $row3["item_id"] . ", " . $order_id . ", " . $row3["quantity"] . ");";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $stmt->close();

                        $sql2 = "Update Item SET actual_quantity = actual_quantity - " . $row3["quantity"] . " WHERE item_id = " . $row3["item_id"] .";";
                        $stmt2 = $conn->prepare($sql2);
                        $stmt2->execute();
                        
                        echo "<br/> Item ID " . $row3["item_id"] . " Quantity Purchased" . $row["quantity"] . "<br/>";
                    }                    
                } else {
                    echo "0 results on cart query... contact a coder ";
                }

                // Delete everything from user's cart because they bought it!
                $sql = "DELETE FROM CART WHERE user_id = " . $_SESSION["user_id"];
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $stmt->close();

            ?>

            <a href="home.php">
                <br/><br/>
                <button>Go back to home page</button>
            </a>
            <a href="order-history.php">
                <button>View Order History</button>
            </a>

        </div>

    </body>
</html>