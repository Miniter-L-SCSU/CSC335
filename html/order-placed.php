<!DOCTYPE html>
<html lang="en"></html>
<html>
    <head>
        <title> CSC335 - Order Placed </title>
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
            <p> Congratulations! Your order was placed </p>
            <!-- todo php to fetch order info -->
            <?php
                include './connect_to_db.php';

                $db_name = 'shop';

                $conn = get_db_connection($db_name);

                session_start();

                if ($_SESSION["username"] == ""){
                    // can't check out if you're not logged in!
                    
                    header("Location: " . './login.php');
                }

                /*
                    T.ODO 
                    validate order being placed 
                    affect actual quantity 
                    show the ordered items
                */

            ?>

            <a href="home.php">
                <button>Go back to home page</button>
            </a>

        </div>

    </body>
</html>