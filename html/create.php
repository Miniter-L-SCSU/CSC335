<!DOCTYPE html>
<html lang="en"></html>

<html>
    <head>
        <title> CSC335 - Create an Account </title>
        <link rel="stylesheet" href="styling.css">
    </head>
    <body>
        <?php
            include './connect_to_db.php';

            $db_name = 'shop';

            $conn = get_db_connection($db_name);

        ?>

        <h4><b>Create an Account</b></h4>
        <label>Username</label>
        <input type="text" id="username"></input> 
        <br/> <br/>
        <label>Password </label>
        <input type="text" id="password"></input> 
        <br/> <br/>
        <label>Email </label>
        <input type="text" id="email"></input> 
        <br/> <br/>
        <button type="button" id="account_submit" > Submit </button>
        <p><a href="./login.php">Go back?</a></p> 

    </body>
</html>