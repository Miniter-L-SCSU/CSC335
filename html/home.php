<!DOCTYPE html>
<html lang="en"></html>
<!-- If we have time I'll style it - Kaye -->
<html>
    <head>
        <title> CSC335 - Home Page </title>
        <link rel="stylesheet" href="styling.css">
    </head>
    <body>
        <h4><b>Welcome to the Shop!</b></h4>
        <div>
            <a href="account.php">
                <button>Account Page</button>
            </a>
            <label>Search</label>
            <input type="text" id="item_search"></input> 
            <!-- todo idk if we need this to redirect to a page but def have the session stuff-->
            <button type="button" id="login" > Login/Logout </button>
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