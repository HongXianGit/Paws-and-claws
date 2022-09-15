<?php

session_start();

if(!isset($_POST["checkout-submit"])){
  header("Location: ../cart.php?error=checkout");
  exit();
}elseif(!isset($_SESSION["userId"])){
  header("Location: ../login.php?error=nologin");
  exit();
}else{
  require "dbh.inc.php";
  $userId = $_SESSION["userId"];

  $sql = "SELECT * FROM cart WHERE user_id=?;";
  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt, $sql)){
    Header("Location: ../$fileName.php?error=sqlerror");
    exit();
  }else{
    mysqli_stmt_bind_param($stmt, "s", $userId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $resultCheck = mysqli_stmt_num_rows($stmt);

    if($resultCheck > 0){
      $sql = "DELETE FROM cart WHERE user_id=?;";
      $stmt = mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmt, $sql)){
        Header("Location: ../cart.php?error=sqlerror");
        exit();
      }else{
        mysqli_stmt_bind_param($stmt, "s", $userId);
        mysqli_stmt_execute($stmt);
        Header("Location: ../cart.php?checkout=success");
        exit();
      }
    }else{
      Header("Location: ../cart.php?error=emptycart");
      exit();
    }
  }
}
