<html>
<head>
    <title> CSC335 - Home Page </title>
    <link rel="stylesheet" href="styling.css">
</head>

<body>
    <div class="center">
    <?php
        include './connect_to_db.php';

        $db_name = 'shop';

        $conn = get_db_connection($db_name);

        session_start();

        $stmt = $conn->prepare("SELECT user_id, username FROM User WHERE username=?");
        $stmt->bind_param("s", $_SESSION["username"]);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
		
            while($row = $result->fetch_assoc()) {
                $_SESSION["user_id"] = $row["user_id"]; // idk if theres a better way to do this
            }
                    
        } else {
            echo "..";
        }

        echo "Welcome to the Shop ".$_SESSION["username"] . " : " . $_SESSION["user_id"];
        ?>
    </div>
    <div>
        <a href="./account.php">
            <button>Account Page</button>
        </a>
        <label>Search</label>
        <input type="text" id="item_search"></input> 
        <a href="cart.php">
            <button>Cart</button>
        </a>
        <a href="./login.php">
            <button type="button"> Login/Logout </button>
        </a>
        </div>

    <div class="center">
        <p> Ideally we would have some items here...  </p>
        <!-- TODO items will go here  -->
        <p><a href="./items.php">See List of Items </a></p> 
    </div>

</body>
</html>