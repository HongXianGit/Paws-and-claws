<?php require "headerAll.php"; ?>
		<div class="notification">
			<div>
				<img src="img/successful.png">
			</div>
			<p>Item has been added into your shopping cart</p>
		</div>
		<section class="showcase">
	    <div>
	      <div class="box1">
	        <p id="discount">Up to 30% discount</p>
	        <p>T&C applied</p>
	        <a href="products.php"><button class="button">Shop Now</button></a>
	      </div>
				<div class="box2">
					<img src="img/Pet food.png" alt="pet">
				</div>
	    </div>
		</section>
    <section id="info">
      <div>
        <img src="./img/free_shipping_50px.png" alt="Free shipping">
        <span>Free shipping above RM 100</span>
      </div>
      <div>
        <img src="./img/refund_2_50px.png" alt="Refund">
        <span>30 Days Free Returns</span>
      </div>
      <div>
        <img src="./img/card_in_use_50px.png" alt="Free shipping">
        <span>Various Payment Methods</span>
      </div>
    </section>
    <section class="catalogue">
      <h1>Trending Now</h1>
			<div class="container">
				<?php
          include_once "includes/dbh.inc.php";
          $sql = 'SELECT * FROM products;';
          $result = mysqli_query($conn, $sql);
					$resultCheck = mysqli_num_rows($result);

					if($resultCheck > 0){
							while($row = mysqli_fetch_assoc($result)){
								if($row["product_id"] < 7) {
									$productBrand = strtok($row["product_name"], " ");
									$productDescription = str_replace("$productBrand ", "",$row["product_name"]);
									echo '
									<div>
										<img src='.$row["product_image"].'>
										<form method="POST" class="addcart">
											<input type="hidden" name="productId" value="'.$row["product_id"].'">
											<input type="hidden" name="quantity" value="1">
											<button type="submit" class="add-cart" name="addcart-submit">Add to cart</button>
										</form>
										<div class="description">
											<p>'.$productBrand.'</p>
											<hr>
											<small>'.$productDescription.'</small>
											<p class="price">RM '.$row["price"].'</p>
										</div>
									</div>';
								}
							}
					}
	     ?>
			</div>
			<div style="text-align: center;"><a href="products.php"><button class="button">More</button></a></div>
		</section>
		<section class="category">
			<h1>Shop by Category</h1>
			<div class="container">
					<div>
						<a href="products/cat.php">
							<img src="img/cat/cat.png">
							<div class="image-text">Cat</div>
						</a>
					</div>
					<div>
						<a href="products/dog.php">
							<img src="img/dog/dog1.png">
							<div class="image-text">Dog</div>
						</a>
					</div>
			</div>
		</section>
	</body>
  <?php require "footer.php";?>
</html>
