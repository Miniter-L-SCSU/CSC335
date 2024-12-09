<!DOCTYPE html>
<html lang="en"></html>
<!-- If we have time I'll style it - Kaye -->
<html>
    <head>
        <title> CSC335 - Item Page </title>
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
                <button value="Redirect">Home Page</button>
            </a>
            <a href="items.php">
                <button>Item Page</button>
            </a>
            <a href="cart.php">
                <button>Cart</button>
            </a>
            <a href="login.php">
                <button type="button"> Login/Logout </button>
            </a>
        </div>

         <div>
                <p> todo develop php to show item details </p>
                <!-- todo develop php to show item detail -->
                <!-- note to self, details to grab, item_name, price, category, manufacturer-->
                <!-- also add to cart button -->

                <?php
                include './connect_to_db.php';

                $db_name = 'shop';

                $conn = get_db_connection($db_name);

                $item_id = $_GET["itm"];

                $sql = "SELECT * FROM ITEM WHERE item_id=?";

                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $item_id);
                
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    // there should be only one row ngl
                    // not sure if we need an add to cart specific page
                    echo "<form action=\"./add_to_cart.php\">";
                    while($row = $result->fetch_assoc()) {
                        echo "<div>" . $row["item_name"] . "<br/> Description: " . $row["item_desc"] . "<br/> Category: " . $row["category"] . "<br/>". $row["price"] . "<br/> Available Quantity: " . $row["available_quantity"] . "<br/> Actual Quantity: " . $row["actual_quantity"] . "<br/> Manufacturer: " . $row["manufacturer"] . "<br/>" . "<button type=\"submit\" value=\"" . $row["item_id"] . "\">" . "Add to Cart " . "</button>" . "</div>";
                    }
                    echo "</form>";
                } else {
                    echo "0 results";
                }
                
                $stmt->close();

                ?>
         </div>

    </body>
</html>