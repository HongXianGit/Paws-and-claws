<?php require "headerAll.php"; ?>
    <section id="shopping-cart">
      <h1>Shopping Cart</h1>
			<table id="cart-table">
				<thead>
					<tr>
						<th id="product-head">Product</th>
						<th>Price</th>
						<th>Quantity</th>
						<th class="total-head">Total</th>
					</tr>
				</thead>
				<tbody id="tbody">
	      <?php
	        if(!isset($_SESSION["userId"])){
	          Header("Location: login.php?error=login");
	          exit();
	        }else{
	          include_once "includes/dbh.inc.php";

	          $userId = $_SESSION["userId"];

	          $sql = 'SELECT p.product_id, product_image, product_name, quantity, price, price * quantity AS "totPrice" FROM products p, cart c WHERE p.product_id = c.product_id AND user_id=?;';
	          //create the statement
	          $stmt = mysqli_stmt_init($conn);
	          //prepare the statement
	          if(!mysqli_stmt_prepare($stmt, $sql)){
	            Header("Location: cart.php?error=sqlerror");
	            exit();
	          }else{
	            mysqli_stmt_bind_param($stmt, "s", $userId);
	            mysqli_stmt_execute($stmt);
	            $result = mysqli_stmt_get_result($stmt);

							$total = 0;

	            while($row = mysqli_fetch_assoc($result)){
	              echo
								'<tr>
									<td>
										<div class="product-data">
											<img src="'.$row["product_image"].'">
			              	<div>'.$row["product_name"].'
												<form class="remove-form" method="POST">
													<input type="hidden" name="productId" value="'.$row["product_id"].'">
													<input type="hidden" name="quantity" value="0">
													<button class="remove" name="addcart-submit">Remove</button>
												</form>
											</div>
										</div>
									</td>
									<td class="price-data"<div>'.$row["price"].'</div></td>
		              <td class="quantity-data">
										<form method="POST" class="edit-cart-form">
											<input type="hidden" name="productId" value="'.$row["product_id"].'">
											<input type="hidden" name="quantity" value="-1">
											<button class="edit-cart" name="addcart-submit">-</button>
										</form>'.
										'<form method="POST" class="cus-qty-form">
											<input type="hidden" name="productId" value="'.$row["product_id"].'">
											<input type="text" name="cus-quantity" value="'.$row["quantity"].'" maxlength="2">
											<button class="invisible" name="addcart-submit"></button>
										</form>'.
										'<form method="POST" class="edit-cart-form">
											<input type="hidden" name="productId" value="'.$row["product_id"].'">
											<input type="hidden" name="quantity" value="1">
											<button class="edit-cart" name="addcart-submit">+</button>
										</form>
									</td>
		              <td class="total-data"><span>RM '.$row["totPrice"].'</div></td>
								</tr>';
								$total += $row["totPrice"];
	            }
	          }
	        }
	      ?>
				</tbody>
			</table>
			<p id="subtotal">Subtotal: RM <?php echo $total; ?></p>
			<form action="includes/checkout.inc.php" method="POST" class="checkout-form">
				<button class="button" name="checkout-submit">CHECK OUT</button>
			</form>
    </section>
		<?php require "footer.php";?>
  </body>
</html>
