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
                <button type="button"> Login/Logout </button>
            </a>
        </div>

        <div class="center">

            <?php
                include './connect_to_db.php';

                $db_name = 'shop';

                $conn = get_db_connection($db_name);

            ?>
            <p> TODO: need to develop getting items from db with php </p>
            <!-- todo php to fetch info like username, full name, for viewing and editing -->
            <a href="order-history.php">
                <button>Order History</button>
            </a>
            <!-- todo fetch billing , payment, and shipping info and handle editting them --> 
            

        </div>

    </body>
</html>