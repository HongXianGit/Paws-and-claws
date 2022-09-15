<footer>
  <div>
    <div class="newsletter">
      <p>Join the newsletter & get the latest information</p>
      <form>
        <input type="email" id="newsletter" placeholder="Enter your email">
        <button type="submit">Subscribe</button>
      </form>
    </div>
    <div>
      <dl class="all-page">
        <?php
        if($fileName === "news1" || $fileName === "news2" || $fileName === "news3" || $fileName === "dog"|| $fileName === "cat"){
          echo '<dt><a href="../index.php">Home</a></dt>
                <dt>
                  <a href="../products.php">Products</a>
                  <div><a href="../products/cat.php">Cat</a></div>
                  <div><a href="../products/dog.php">Dog</a></div>
                </dt>
                <dt><a href="../news.php">News</a></dt>
                <dt><a href="../about.php">About us</a></dt>
                </dl>
              </div>
            </div>
            <div class="statement">
              <img src="../img/Logo.svg" alt="Logo">';
        }else{
          echo '<dt><a href="index.php">Home</a></dt>
                <dt>
                  <a href="products.php">Products</a>
                  <div><a href="products/cat.php">Cat</a></div>
                  <div><a href="products/dog.php">Dog</a></div>
                </dt>
                <dt><a href="news.php">News</a></dt>
                <dt><a href="about.php">About us</a></dt>
                </dl>
              </div>
            </div>
            <div class="statement">
              <img src="img/Logo.svg" alt="Logo">';
        }
echo '<div>Paws & Claws</div>
        <small><i>Copyright &copy; 2020 Paws & Claws</i></small>
      </div>
    </footer>';
?>
