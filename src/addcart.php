<?php
session_start();
?>
<!-- cart section starts here -->
<div id="cart">
    <table id="tableCart">
        <thead>
            <tr>
                <th class="tcart">Product Image</th>
                <th class="tcart">Product Name</th>
                <th class="tcart">Product Quantity</th>
                <th class="tcart">Product Price</th>
                <th class="tcart">Remove</th>
            </tr>
        </thead>
        <!-- tbody section  -->
        <tbody id="tbodyCart">
            <?php
            
            
            // function to display the cart
            function displayCart(){
                $i = 0;
                $total=0;
        foreach ($_SESSION['cart'] as $productKey=>$value ) {
     echo "<tr><td><img src='" . $_SESSION['cart'][$productKey]['img'] . "'></td><td>" . $_SESSION['cart'][$productKey]['name'] . "</td><td>" . $_SESSION['cart'][$productKey]['quantity'] . "</td><td>" . $_SESSION['cart'][$productKey]['price'] . "</td><td><form  action='#' method='POST'><input type='submit' class='remove' value='Remove' name='remove'><input type='hidden' name='hidden' value='" . $i . "'></form></td></tr>";
                    $i++;
                    $total+=$_SESSION['cart'][$productKey]['price'];
                }
                echo"<tr><td colspan=5> <center>Total price= ".$total."</center></td></tr>";
                echo"<form action='#' method='POST'><tr><td colspan=5> <center><input type='submit' name='empty' value='EMPTY CART'></center></td></tr></form>";

            }
           
            // adding item in cart 
            if (isset($_POST['add'])) {
                $val = $_POST['hiddenproduct'];
                $index = 0;
                $index_s = 0;
                $name;
                foreach ($_SESSION['products'] as $key => $value) {
                    if ($index_s == $val) {
                        $name = $_SESSION['products'][$key]['title'];
                    }
                    $index_s++;
                }
                $flag = 0;
                foreach ($_SESSION['cart'] as $key => $value) {
                    if ($_SESSION['cart'][$key]['name'] == $name) {
                        $_SESSION['cart'][$key]['price'] += ($_SESSION['cart'][$key]['price'] / $_SESSION['cart'][$key]['quantity']);
                        $_SESSION['cart'][$key]['quantity'] += 1;
                        $flag = 1;

                        displayCart();
                    }
                }
                if ($flag == 0) {
                    foreach ($_SESSION['products'] as $key => $value) {
                        if ($index == $val) {
                            array_push($_SESSION['cart'],array(
                                    'img' => $_SESSION['products'][$key]['img'],
                                    'name' => $_SESSION['products'][$key]['title'],
                                    'quantity' => 1,
                                    'price' => $_SESSION['products'][$key]['price']
                                )
                            );
                        }
                        $index++;
                    }
                    displayCart();
                }
            }
            // removing item 
            if (isset($_POST['remove'])) {
                $val = $_POST['hidden'];
                $ind = 0;
                $name;
                foreach ($_SESSION['cart'] as $key => $value) {
                    if ($ind == $val) {
                        $name = $_SESSION['cart'][$key]['name'];
                    }
                    $ind++;
                }
                foreach ($_SESSION['cart'] as $key => $value) {
                    if ($_SESSION['cart'][$key]['name'] == $name) {
                        unset($_SESSION['cart'][$key]);
                    }
                }
                displayCart();
            }
            // for empty cart
            if(isset($_POST['empty']))
            {
                
              unset($_SESSION['cart']);
            }
            
            ?>
            
        </tbody>
    </table>