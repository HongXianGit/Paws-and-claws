<?php

if(!isset($_POST["login-submit"])){
  Header("Location: ../login.php?error=submit");
}else{
  require "dbh.inc.php";

  $email = trim($_POST["email"]);
  $pwd = trim($_POST["pwd"]);

  if(empty($email) || empty($pwd)){
    Header("Location: ../login.php?error=emptyfields&email=$email");
    exit();
  }else{

    //sql statement
    $sql = "SELECT * FROM users WHERE email=?;";
    //create the statement
    $stmt = mysqli_stmt_init($conn);
    //prepare the statement
    if(!mysqli_stmt_prepare($stmt, $sql)){
      Header("Location: ../login.php?error=sqlerror");
      exit();
    }else{
      //hash the password
      mysqli_stmt_bind_param($stmt, "s", $email);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      if($row = mysqli_fetch_assoc($result)){
        $pwdCheck = password_verify($pwd, $row["password"]);
        if($pwdCheck == false){
          Header("Location: ../login.php?error=wrongpwd");
          exit();
        }else{
          //make a session so that they can add cart
          session_start();
          $_SESSION["userId"] = $row["user_id"];
          Header("Location: ../index.php?login=success");
          exit();
        }
      }else{
        Header("Location: ../login.php?error=nouser");
        exit();
      }
    }
  }
}
