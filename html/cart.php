<!DOCTYPE html>
<html lang="en"></html>
<html>
    <head>
        <title> CSC335 - Cart </title>
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
            <p> TODO: need to develop getting items from db with php </p>
            <!-- todo php to fetch whats in user carts -->

            <?php
                include './connect_to_db.php';

                $db_name = 'shop';

                $conn = get_db_connection($db_name);

                session_start();

                $stmt = $conn->prepare("SELECT user_id, item_id, quantity FROM Cart WHERE user_id=?");
                $stmt->bind_param("s", $_SESSION["user_id"]);
	            $stmt->execute();

                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    
                    echo "<form action=\"./item_page.php\">";
                    echo "<div class='main-content'>";
                     while($row = $result->fetch_assoc()) {   
                        //flexbox not working idk
                        // open to changing it from value = item id to item name, dunno if names could be redundant
                        echo "<div class = 'item-card' style=\"border:solid; margin: 3px;\">" . 
                        "<button name=\"itm\" style=\"background:white; type=\"submit\" value=\"" . $row["item_id"] . "\">"
                        . "Item ID " . $row["item_id"] . "</button>"
                         . "<p>" . $row["quantity"] . "</p>" . "</div>";
                        
                    }
                    echo "</div>";
                    echo "</form>";
                    // todo edit cart quantity and change action
                } else {
                    echo "You have nothing in your cart";
                }

                $stmt->close();
                $conn->close();
            
            ?>
            <br/><br/>
            <!-- todo add validation -->
            <a href="checkout.php">
                <button>Checkout</button>
                <input type="int">
            </a>

        </div>

    </body>
</html>