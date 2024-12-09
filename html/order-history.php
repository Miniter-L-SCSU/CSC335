<!DOCTYPE html>
<html lang="en"></html>
<html>
    <head>
        <title> CSC335 - Account Page </title>
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
            <p> TODO: show user's orders in table </p>
            <?php
                include './connect_to_db.php';

                $db_name = 'shop';

                $conn = get_db_connection($db_name);

                session_start();

                echo "<p>Orders </p>";
                // renamed a few of the tables because they were keywords and that might have caused an issue? 
                // todo fix
                $stmt = $conn->prepare("SELECT order_id, delivery_time, ship_seq, bill_seq, pay_id FROM Orders WHERE user_id=?");
                $stmt->bind_param("s", $_SESSION["user_id"]);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
		
                    while($row = $result->fetch_assoc()) {
                        
                        echo "<div>" . "<p> Street: " . $row["street"] . "</p>" . "<p> Appt: " . $row["appt"] . "</p>" . "<p> City: " . $row["city"] . "</p>" . "<p> State: " . $row["state_loc"] . "</p>". "<p> ZIP Code: " . $row["zip"] . "</p>" . "------------" . "</div>";
                        // todo figure out how to edit info
                    }
                    
                } else {
                    echo "---";
                }

            ?>
            <!-- todo php to fetch info like username, full name, for viewing and editing -->
        </div>

    </body>
</html>