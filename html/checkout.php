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

            ?>
            
            <a href="order-placed.php">
                <button>Place Order</button>
            </a>

        </div>

    </body>
</html>