<html>
<head>
    <title> CSC335 - Home Page </title>
    <link rel="stylesheet" href="styling.css">
</head>
    
<body>
    <div class="center">
        <?php
            session_start();
            echo "Welcome to the Shop ".$_SESSION["username"];
        ?>
    </div>
    <div>
        <a href="account.php">
            <button>Account Page</button>
        </a>
        <label>Search</label>
        <input type="text" id="item_search"></input> 
        <a href="cart.php">
                <button>Cart</button>
        </a>
        <a href="login.php">
            <button type="button"> Login/Logout </button>
        </a>
        </div>

    <div class="center">
        <p> TODO: need to develop the php for getting a few items from db  </p>
        <!-- TODO items will go here  -->

        <?php
        echo "My first PHP script! - i'll remove this later";
        ?>


        <p><a href="./items.php">See List of Items </a></p> 
    </div>

</body>
</html>