<?php require "headerLS.php"; ?>
    <form action="includes/login.inc.php" method="POST" id="login-form">
      <div class="login">
        <h1>SIGN IN</h1>
        <?php
					if(isset($_GET["error"])){
						$error = $_GET["error"];
						if($error === "submit"){
							echo '<p class="error">Please submit form properly.</p>';
						}elseif($error === "emptyfields"){
							echo '<p class="error">Please fill in all the fields.</p>';
						}elseif($error === "sqlerror"){
							echo '<p class="error">SQL error.</p>';
						}elseif($error === "wrongpwd"){
							echo '<p class="error">Wrong password. Please try again.</p>';
						}elseif($error === "nouser"){
							echo '<p class="error">There is no account associated with this e-mail. Please register.</p>';
						}
					}
				?>
        <div>
          <p>Email:</p>
          <div class="text-row">
            <img src="img/check.png" class="icon success"></img>
            <img src="img/delete.png" class="icon error"></img>
          	<input type="text" name="email" placeholder="E-mail" id="email">
          </div>
          <small>Message</small>
        </div>
        <div>
          <p>Password:</p>
          <div class="text-row">
            <img src="img/check.png" class="icon success"></img>
            <img src="img/delete.png" class="icon error"></img>
        	  <input type="password" name="pwd" placeholder="Password" id="pwd">
          </div>
          <small>Message</small>
        </div>
        <button class="button" type="submit" name="login-submit">LOGIN</button>
      </div>
    </form>
  </body>
</html>
