<?php include_once "../headerAll.php"; ?>
		<div class="notification">
			<div>
				<img src="../img/successful.png">
			</div>
			<p>Item has been added into your shopping cart</p>
		</div>
    <section class="catalogue">
      <div class="directory"><a href="index.php">Home</a> > <a href="products.php">Products</a> > Dog</div>
      <h1>Dog's products</h1>
      <div class="container">
				<?php
          include_once "../includes/dbh.inc.php";
          $sql = "SELECT * FROM products WHERE product_name LIKE '%DOG%' OR product_name LIKE '%Dog%' OR product_name LIKE '%Dog%' ORDER BY product_id;";
          $result = mysqli_query($conn, $sql);
					$resultCheck = mysqli_num_rows($result);

					if($resultCheck > 0){
						while($row = mysqli_fetch_assoc($result)){
								$productBrand = strtok($row["product_name"], " ");
								$productDescription = str_replace("$productBrand ", "",$row["product_name"]);
								echo '
								<div>
									<img src="../'.$row["product_image"].'">
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
	     ?>
		 </div>
		</section>
		<section class="category">
			<h1>Shop by Category</h1>
      <div class="container">
					<div>
						<a href="cat.php">
							<img src="../img/cat/cat.png">
							<div class="image-text">Cat</div>
						</a>
					</div>
					<div>
						<a href="dog.php">
							<img src="../img/dog/dog1.png">
							<div class="image-text">Dog</div>
						</a>
					</div>
			</div>
		</section>
		<?php include_once "../footer.php"; ?>
	</body>
</html>
