<!DOCTYPE html>
<html lang="en"></html>
<!-- If we have time I'll style it - Kaye -->
<html>
    <head>
        <title> CSC335 - List of all items </title>
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
            <a href="cart.php">
                <button>Cart</button>
            </a>
            <a href="login.php">
                <button type="button"> Login/Logout </button>
            </a>
        </div>

        <div class="center">
            <?php
                include './connect_to_db.php';

                $db_name = 'shop';

                $conn = get_db_connection($db_name);

                $stmt = $conn->prepare("SELECT item_id, item_name, price, available_quantity FROM Item");

                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    echo "<form action=\"./item_page.php\">";
                     while($row = $result->fetch_assoc()) {   
                        //flexbox not working idk
                        // open to changing it from value = item id to item name, dunno if names could be redundant
                        echo "<div style=\"border:solid; margin: 3px;\">" . "<button name=\"itm\" style=\"background:white; type=\"submit\" value=\"" . $row["item_id"] . "\">" . "Item Name: " . $row["item_name"] . "</button>" . " <p>" . $row["price"] . " </p><p> Available Quantity: " . $row["available_quantity"] . "</p>" . "</div>";
                        
                    }
                    echo "</form>";
                } else {
                    echo "0 results";
                }

                $stmt->close();
                $conn->close();
                ?>
            

        </div>

    </body>
</html>