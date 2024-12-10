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
            <script>
                var pre = '1'
                function foc(val,cur) {
                    console.log("foc val = "+val)
                    console.log("foc cur = "+cur)
                    pre = cur
                }                
                function hide(val,pre) {
                    console.log("hide val = "+val)
                    console.log("hide pre = "+pre)
                    document.getElementById(pre).style.display = "none";
                    document.getElementById(val).style.display = "block";
                }
            </script>
            <a href="order-history.php">
                <button>Order History</button>
            </a>
            <!-- todo fetch billing , payment, and shipping info and handle editting them --> 
            <?php

                echo "<p>Billing Addresses </p>";
                echo "<p>------------</p>";
                // renamed a few of the tables because they were keywords and that might have caused an issue? 
                $stmt = $conn->prepare("SELECT bill_seq, street, appt, city, state, zip FROM BillAddr WHERE user_id=?");
                $stmt->bind_param("s", $_SESSION["user_id"]);
                $stmt->execute();
                $result = $stmt->get_result();
                    echo "<label for='BA'>Billing Addresses: </label>";
                    echo "<select name='BA' id='BA' onchange='hide(this.value, pre)'  onclick='foc(pre, this.value)'>";
                    $a = 1;
                    $b = "";
                    $c = "style='display: block;'";
                    $d = 1;
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='BA".$a."' name='BA".$a."'>".$a."</option>";
                        echo "<script> console.log('before BA $a')</script>";
                        //if($a == 1) {
                        //    $c = "style='display: block;'";
                        //    echo '<script> console.log("set BA a= '.$a.' c= '.$c.'")</script>';
                        //} 
                        //else {
                        //    $c = "style='display: none;'";
                        //    echo '<script> console.log("set BA a= '.$a.' c= '.$c.'")</script>';
                        //}
                            $b = $b . "
                            <div $c id='BA".$a."' name='BA".$a."' > 
                            <form action='./updateBA.php'>
                            <label style='padding-left:40px' for='BAstreet'>street: </label>
                            <input type='text' id='BAstreet' name='BAstreet' value='$row[street]' > <br>
                            <label style='padding-left:40px' for='BAappt'>appt: </label>
                            <input type='text' id='BAappt' name='BAappt' value='$row[appt]' > <br>
                            <label style='padding-left:40px' for='BAcity'>city: </label>
                            <input type='text' id='BAcity' name='BAcity' value='$row[city]' > <br>
                            <label style='padding-left:40px' for='BAstate'>state: </label>
                            <input type='text' id='BAstate' name='BAstate' value='$row[state]' > <br>
                            <label style='padding-left:40px' for='BAzip'>zip: </label>
                            <input type='text' id='BAzip' name='BAzip' value='$row[zip]' > <br>
                            <button name= 'itm' type= 'submit' value= '$row[bill_seq]'>update </button> 
                            </form>
                            <form action='./deleteBA.php'>
                            <button name= 'itm' type= 'submit' value= '$row[bill_seq]'>delete </button> 
                            </form>
                            </div>";
                        // todo figure out how to edit info
                        $a = $a + 1;
                        $c = "style='display: none;'";
                        echo "<script> console.log('after BA $a')</script>";
                        $d = $row["bill_seq"] + 1;
                    }
                    echo "<option value='BA".$a."' name='BA".$a."'>add</option>";
                    echo '</select>';
                    $b = $b . "
                    <form action='./addBA.php'>
                    <div $c id='BA".$a."' name='BA".$a."' > 
                    <label style='padding-left:40px' for='BAstreet'>street: </label>
                    <input type='text' id='BAstreet' name='BAstreet'> <br>
                    <label style='padding-left:40px' for='BAappt'>appt: </label>
                    <input type='text' id='BAappt' name='BAappt'> <br>
                    <label style='padding-left:40px' for='BAcity'>city: </label>
                    <input type='text' id='BAcity' name='BAcity'> <br>
                    <label style='padding-left:40px' for='BAstate'>state: </label>
                    <input type='text' id='BAstate' name='BAstate'> <br>
                    <label style='padding-left:40px' for='BAzip'>zip: </label>
                    <input type='text' id='BAzip' name='BAzip'> <br>
                    <button name= 'itm' type= 'submit' value= '$d'>add </button> 
                    </div>
                    </form>";        
                    echo $b;           

            ?>
            <?php
                echo "<p>Shipping Addresses </p>";
                echo "<p>------------</p>";
                // renamed a few of the tables because they were keywords and that might have caused an issue? 
                $stmt2 = $conn->prepare("SELECT ship_seq, street, appt, city, state, zip FROM ShipAddr WHERE user_id=?");
                $stmt2->bind_param("s", $_SESSION["user_id"]);
                $stmt2->execute();
                $result2 = $stmt2->get_result();
                echo "<label for='SA'>Shipping Addresses: </label>";
                echo "<select name='SA' id='SA' onchange='hide(this.value,pre)' onclick='foc(pre, this.value)'>";
                $a = 1;
                $b = "";
                $c = "";
                $d = 1;
                while($row = $result2->fetch_assoc()) {
                    echo "<option value='SA".$a."' name='SA".$a."'>".$a."</option>";
                    echo "<script> console.log('before SA $a')</script>";
                    //if ($a == 1) {
                    //    $c = "style='display: block;'";
                    //    echo '<script> console.log("set SA a= '.$a.' c= '.$c.'")</script>';
                    //} else {
                    //    $c = "style='display: none;'";
                    //    echo '<script> console.log("set SA a= '.$a.' c= '.$c.'")</script>';
                    //}
                        $b = $b . "
                        <form action='./updateSA.php'>
                        <div $c id='SA".$a."' name='SA".$a."' > 
                        <label style='padding-left:40px' for='SAstreet'>street: </label>
                        <input type='text' id='SAstreet' name='SAstreet' value='$row[street]' > <br>
                        <label style='padding-left:40px' for='SAappt'>appt: </label>
                        <input type='text' id='SAappt' name='SAappt' value='$row[appt]' > <br>
                        <label style='padding-left:40px' for='SAcity'>city: </label>
                        <input type='text' id='SAcity' name='SAcity' value='$row[city]' > <br>
                        <label style='padding-left:40px' for='SAstate'>state: </label>
                        <input type='text' id='SAstate' name='SAstate' value='$row[state]' > <br>
                        <label style='padding-left:40px' for='SAzip'>zip: </label>
                        <input type='text' id='SAzip' name='SAzip' value='$row[zip]' > <br>
                        <button name= 'itm' type= 'submit' value= '$row[ship_seq]'>update </button> 
                        </form>
                        <form action='./deleteSA.php'>
                        <button name= 'itm' type= 'submit' value= '$row[ship_seq]'>delete </button> 
                        </form>
                        </div>";
                    // todo figure out how to edit info
                    $a = $a + 1;
                    $c = "style='display: none;'";
                    echo "<script> console.log('after SA a= $a')</script>";
                    $d = $row["ship_seq"] + 1;

                }
                echo "<option value='SA".$a."' name='SA".$a."'>add</option>";
                echo '</select>';
                $b = $b . "
                <form action='./addSA.php'>
                <div $c id='SA".$a."' name='SA".$a."' > 
                <label style='padding-left:40px' for='SAstreet'>street: </label>
                <input type='text' id='SAstreet' name='SAstreet'> <br>
                <label style='padding-left:40px' for='SAappt'>appt: </label>
                <input type='text' id='SAappt' name='SAappt'> <br>
                <label style='padding-left:40px' for='SAcity'>city: </label>
                <input type='text' id='SAcity' name='SAcity'> <br>
                <label style='padding-left:40px' for='SAstate'>state: </label>
                <input type='text' id='SAstate' name='SAstate'> <br>
                <label style='padding-left:40px' for='SAzip'>zip: </label>
                <input type='text' id='SAzip' name='SAzip'> <br>
                <button name= 'itm' type= 'submit' value= '$d'>add </button> 
                </div>
                </form>";  
                echo $b;    


            ?>




            <?php
                echo "<p>Payments</p>";
                echo "<p>------------</p>";
                // renamed a few of the tables because they were keywords and that might have caused an issue? 
                $stmt3 = $conn->prepare("SELECT pay_id, card_name, right(card_num,4) 'card_num', exp_date FROM Payment WHERE user_id=?");
                $stmt3->bind_param("s", $_SESSION["user_id"]);
                $stmt3->execute();
                $result3 = $stmt3->get_result();
                echo "<label for='CC'>Credit Cards: </label>";
                echo "<select name='CC' id='CC' onchange='hide(this.value, pre)'  onclick='foc(pre, this.value)'>";
                $a = 1;
                $b = "";
                $c = "style='display: block;'";
                $d = 1;
                while($row = $result3->fetch_assoc()) {
                    echo "<option value='CC".$a."' name='CC".$a."'>".$a."</option>";
                    echo "<script> console.log('before CC $a')</script>";
                    //if($a == 1) {
                    //    $c = "style='display: block;'";
                    //    echo '<script> console.log("set CC a= '.$a.' c= '.$c.'")</script>';
                    //} 
                    //else {
                    //    $c = "style='display: none;'";
                    //    echo '<script> console.log("set CC a= '.$a.' c= '.$c.'")</script>';
                    //}
                        $b = $b . "
                        <div $c id='CC".$a."' name='CC".$a."' > 
                        <form action='./updateCC.php'>
                        <label style='padding-left:40px' for='CCname'>Card Name: </label>
                        <input type='text' id='CCname' name='CCname' value='$row[card_name]' > <br>
                        <label style='padding-left:40px' for='CCnum'>Card Number: </label>
                        <input type='text' id='CCnum' name='CCnum' value='****-****-****-$row[card_num]' > <br>
                        <label style='padding-left:40px' for='CCexp'>Expiration Date: </label>
                        <input type='text' id='CCexp' name='CCexp' value='$row[exp_date]' > <br>
                        <button name= 'itm' type= 'submit' value= '$row[pay_id]'>update </button> 
                        </form>
                        <form action='./deleteCC.php'>
                        <button name= 'itm' type= 'submit' value= '$row[pay_id]'>delete </button> 
                        </form>
                        </div>";
                    // todo figure out how to edit info
                    $a = $a + 1;
                    $c = "style='display: none;'";
                    echo "<script> console.log('after CC $a')</script>";
                }
                echo "<option value='CC".$a."' name='CC".$a."'>add</option>";
                echo '</select>';
                $b = $b . "
                <form action='./addCC.php'>
                <div $c id='CC".$a."' name='CC".$a."' > 
                <label style='padding-left:40px' for='CCname'>Card Name: </label>
                <input type='text' id='CCname' name='CCname'> <br>
                <label style='padding-left:40px' for='CCnum'>Card Number: </label>
                <input type='text' id='CCnum' name='CCnum'> <br>
                <label style='padding-left:40px' for='CCexp'>Expiration Date: </label>
                <input type='text' id='CCexp' name='CCexp'> <br>
                <button name= 'itm' type= 'submit' value= '$a'>add </button> 
                </div>
                </form>";        
                echo $b;  


            ?>

        </div>

    </body>
</html>