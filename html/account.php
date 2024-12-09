<!DOCTYPE html>
<html lang="en"></html>
<html>
    <head>
        <title> CSC335 - Account Page </title>
        <link rel="stylesheet" href="styling.css">
    </head>
    <body>
        <div>
            <label>Search</label>
            <input type="text" id="item_search"></input> 
            <a href="home.php">
                <button>Home Page</button>
            </a>
            <a href="cart.php">
                <button>Cart</button>
            </a>
            <a href="login.php">
                <button type="button" action="./login.php"> Login/Logout </button>
            </a>
        </div>

        <div class="center">
            <?php
                include './connect_to_db.php';

                $db_name = 'shop';

                $conn = get_db_connection($db_name);
                session_start();

                //echo " Hello " . $_SESSION["username"] . "<br/>"; //debug

                $stmt = $conn->prepare("SELECT user_id, username, f_name, m_name, l_name, email FROM User WHERE username=?");
                $stmt->bind_param("s", $_SESSION["username"]);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
		
                    while($row = $result->fetch_assoc()) {
                        $_SESSION["user_id"] = $row["user_id"]; // idk if theres a better way to do this
                        echo "<div>" . "<p> Username: " . $row["username"] . "</p><br/>" . "</div>";
                        echo "<div>" . "Name: " . $row["f_name"] . " " . $row["m_name"] . " " . $row["l_name"] . "<br/> Email: " . $row["email"] . "</div>";
                        // todo figure out how to edit info
                    }
                    
                } else {
                    echo "0 results... have you tried logging in?";
                }

            ?>
            <br/><br/>
            <a href="order-history.php">
                <button>Order History</button>
            </a>
            <!-- todo fetch billing , payment, and shipping info and handle editting them --> 
            <?php

                echo "<p>Billing Addresses </p>";
                echo "<p>------------</p>";
                // renamed a few of the tables because they were keywords and that might have caused an issue? 
                $stmt = $conn->prepare("SELECT street, appt, city, state_loc, zip FROM BillAddr WHERE user_id=?");
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
            <?php
                echo "<p>Shipping Addresses </p>";
                echo "<p>------------</p>";
                // renamed a few of the tables because they were keywords and that might have caused an issue? 
                $stmt2 = $conn->prepare("SELECT street, appt, city, state_loc, zip FROM ShipAddr WHERE user_id=?");
                $stmt2->bind_param("s", $_SESSION["user_id"]);
                $stmt2->execute();
                $result2 = $stmt2->get_result();
                if ($result2->num_rows > 0) {
                    while($row = $result2->fetch_assoc()) { 
                        echo "<div>" . "<p> Street: " . $row["street"] . "</p>" . "<p> Appt: " . $row["appt"] . "</p>" . "<p> City: " . $row["city"] . "</p>" . "<p> State: " . $row["state_loc"] . "</p>". "<p> ZIP Code: " . $row["zip"] . "</p>" . "------------" . "</div>";
                        // todo figure out how to edit info
                    }
                    
                } else {
                    echo "---";
                }
            ?>
            <?php
                echo "<p>Payments</p>";
                echo "<p>------------</p>";
                // renamed a few of the tables because they were keywords and that might have caused an issue? 
                $stmt3 = $conn->prepare("SELECT card_name, card_num, exp_date FROM Payment WHERE user_id=?");
                $stmt3->bind_param("s", $_SESSION["user_id"]);
                $stmt3->execute();
                $result3 = $stmt3->get_result();
                if ($result3->num_rows > 0) {
		
                    while($row = $result3->fetch_assoc()) {
                        
                        echo "<div>" . "<p> Card Name: " . $row["card_name"] . "</p>" . "<p> Card Num: " . $row["card_num"] . "</p>" . "<p> Expiration Date: " . $row["exp_date"] . "</p>" . "------------" . "</div>";
                        // todo figure out how to edit info
                    }
                    
                } else {
                    echo "---";
                }

            ?>

        </div>

    </body>
</html>