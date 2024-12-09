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

            <?php
                include './connect_to_db.php';

                $db_name = 'shop';

                $conn = get_db_connection($db_name);

                session_start();

                $stmt = $conn->prepare("SELECT user_id, item_id, quantity FROM Cart WHERE user_id=?");
                $stmt->bind_param("s", $_SESSION["user_id"]);
	            $stmt->execute();

                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    
                    echo "<form action=\"./adjust_cart.php\">";
                    echo "<div>";
                     while($row = $result->fetch_assoc()) {   
                        //flexbox not working idk
                        // open to changing it from value = item id to item name, dunno if names could be redundant
                        echo "<div style=\"border:solid; margin: 3px;\">" . 
                        "<p>" . "Item ID " . $row["item_id"] . "</p>" . 
                        "<label for='cart_quantity'>Desired Quantity </label>" .
                        "<input name='cart_quantity' value='". $row["quantity"] . "' >" . "</button>" . "   " .
                         "<button name ='rmv' type='submit' value='" . $row["item_id"] . "' >" . "Add/Remove from Cart? ". "</button>".
                         "</div>";
                        
                    }
                    echo "</div>";
                    echo "</form>";
                } else {
                    echo "You have nothing in your cart";
                }

                $stmt->close();
                $conn->close();
            
            ?>
            <br/><br/>
            <!-- todo add validation -->
            <!--
            <a href="checkout.php">
                <button>Checkout</button>
                <input type="int">
            </a>
            -->
            <?php
                echo "<form action='./checkout.php'>";
                echo "<button>Checkout</button>";
                echo "</form>";
            ?>
        

        </div>

    </body>
</html>