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
                    header("Location: " . './cart.php');
                    
                } else {
                    
                    while($row = $result->fetch_assoc()) {
                        
                        echo "<br/>Item: " . $row["item_id"] . " <br/>";
                        echo "<br/>Quantity: " . $row["quantity"] . " <br/>";
                        // t.odo add price and other stuff about the item
                        // not to mention billing stuff

                    }
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