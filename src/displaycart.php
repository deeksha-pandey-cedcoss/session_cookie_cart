<?php
session_start();
$i=0;
		foreach ($_SESSION['cart'] as $key => $value) {
				echo "<tr><td><img src='".$_SESSION['cart'][$key]['pimg']."'></td>";
				echo "<td>".$_SESSION['cart'][$key]['pname']."</td>";
				echo "<td>". $_SESSION['cart'][$key]['pquantity'] ."</td>";
				echo "<td>". $_SESSION['cart'][$key]['pprice'] ."</td>";
				echo "<td><form  action='#' method='POST'><input type='submit' class='remove' value='Remove' name='remove'><input type='hidden' name='hidden' value='" . $i . "'></form></td></tr>";
				$i++;

			}

			// add to cart
			


?>
<?php
include "footer.php";
?>