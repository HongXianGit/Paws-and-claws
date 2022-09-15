<?php require "headerLS.php"; ?>
    <div class="signup-form">
      <form action="includes/signup.inc.php" method="POST" id="signup-form">
        <div class="signup">
          <h1>CREATE ACCOUNT</h1>
  				<?php
  					if(isset($_GET["error"])){
  						$error = $_GET["error"];
  						if($error === "submit"){
  							echo '<p class="error">Please submit form properly.</p>';
  						}elseif($error === "emptyfields"){
  							echo '<p class="error">Please fill in all the fields.</p>';
  						}elseif($error === "invalidfirstlastemail"){
  							echo '<p class="error">Invalid first, last name and email.</p>';
  						}elseif($error === "invalidfirstlast"){
  							echo '<p class="error">Invalid first and last name.</p>';
  						}elseif($error === "invalidfirstemail"){
  							echo '<p class="error">Invalid first name and email.</p>';
  						}elseif($error === "invalidlastemail"){
  							echo '<p class="error">Invalid last name and email.</p>';
  						}elseif($error === "invalidFirst"){
  							echo '<p class="error">Invalid first name.</p>';
  						}elseif($error === "invalidLast"){
  							echo '<p class="error">Invalid last name.</p>';
  						}elseif($error === "invalidemail"){
  							echo '<p class="error">Invalid E-mail.</p>';
  						}elseif($error === "invalidPwd"){
  							echo '<p class="error">Invalid password.</p>';
  						}elseif($error === "invalidrepeatPwd"){
  							echo '<p class="error">Repeat password is not identical with password.</p>';
  						}elseif($error === "sqlerror"){
  							echo '<p class="error">SQL error.</p>';
  						}elseif($error === "emailtaken"){
  							echo '<p class="error">The email is taken. Please enter another e-mail.</p>';
  						}
  					}elseif(isset($_GET["signup"])){
  						echo '<p class="success">Registered successfully</p>';
  					}
  				?>
          <div>
            <div class="information-row">
              First name:
              <div class="information"><img src="img/exclamation.png"></div>
              <div class="requirement">
                <ul>
                  <li>Requirements:</li>
                  <li>- It can only contain words and some special characters (space, comma, period, apostrophe, hyphen, at sign and forward slash). </li>
                </ul>
              </div>
            </div>
            <div class="text-row">
              <img src="img/check.png" class="icon success"></img>
              <img src="img/delete.png" class="icon error"></img>
    					<?php
    						if(isset($_GET["first"])){
    							$first = $_GET["first"];
    							echo '<input type="text" name="first" id="first" placeholder="First name" value="'.$first.'">';
    						}else{
    							echo '<input type="text" name="first" id="first" placeholder="First name">';
    						}
    					?>
            </div>
            <small>Message</small>
          </div>
          <div>
            <div class="information-row">
              Last name:
              <div class="information"><img src="img/exclamation.png"></div>
              <div class="requirement">
                <ul>
                  <li>Requirements:</li>
                  <li>- It can only contain words and some special characters (space, comma, period, apostrophe, hyphen, at sign and forward slash). </li>
                </ul>
              </div>
            </div>
            <div class="text-row">
              <img src="img/check.png" class="icon success"></img>
              <img src="img/delete.png" class="icon error"></img>
    					<?php
    						if(isset($_GET["last"])){
    							$last = $_GET["last"];
    							echo '<input type="text" name="last" id="last" placeholder="Last name" value="'.$last.'">';
    						}else{
    							echo '<input type="text" name="last" id="last" placeholder="Last name">';
    						}
    					?>
            </div>
            <small>Message</small>
          </div>
          <div>
            <p>Email: </p>
            <div class="text-row">
              <img src="img/check.png" class="icon success"></img>
              <img src="img/delete.png" class="icon error"></img>
    					<?php
    						if(isset($_GET["email"])){
    							$email = $_GET["email"];
    							echo '<input type="text" name="email" id="email" placeholder="E-mail" value="'.$email.'">';
    						}else{
    							echo '<input type="text" name="email" id="email" placeholder="E-mail">';
    						}
    					?>
            </div>
            <small>Message</small>
          </div>
          <div>
            <div class="information-row">
              Password:
              <div class="information"><img src="img/exclamation.png"></div>
              <div class="requirement">
                <ul>
                  <li>Requirements:</li>
                  <li>- At least 8 characters</li>
                  <li>- At least 1 uppercase letter</li>
                  <li>- At least 1 lowercase letter</li>
                  <li>- At least 1 special symbol</li>
                  <li>- At least 1 digit</li>
                </ul>
              </div>
            </div>
            <div class="text-row">
              <img src="img/check.png" class="icon success"></img>
              <img src="img/delete.png" class="icon error"></img>
            	<input type="password" name="pwd" id="pwd" placeholder="Password">
            </div>
            <small>Message</small>
          </div>
          <div>
            <p>Repeat password:</p>
            <div class="text-row">
              <img src="img/check.png" class="icon success"></img>
              <img src="img/delete.png" class="icon error"></img>
            	<input type="password" name="repeatPwd" id="repeatPwd" placeholder="Repeat Password">
            </div>
            <small>Message</small>
          </div>
          <button class="button" type="submit" name="signup-submit">SIGN UP</button>
        </div>
      </form>
    </div>
  </body>
</html>
