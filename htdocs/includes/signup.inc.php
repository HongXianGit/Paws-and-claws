<?php

if(!isset($_POST["signup-submit"])){
  Header("Location: ../signup.php?error=submit");
}else{
  require "dbh.inc.php";

  $first = trim($_POST["first"]);
  $last = trim($_POST["last"]);
  $email = trim($_POST["email"]);
  $pwd = trim($_POST["pwd"]);
  $repeatPwd = trim($_POST["repeatPwd"]);

  if(empty($first) || empty($last) || empty($email) || empty($pwd) || empty($repeatPwd)){
    Header("Location: ../signup.php?error=emptyfields&first=$first&last=$last&email=$email");
    exit();
  }elseif(!preg_match('/^[a-zA-Z ,.\'-@\/]+$/', $first) && !preg_match('/^[a-zA-Z ,.\'-@\/]+$/', $last) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
    Header("Location: ../signup.php?error=invalidfirstlastemail");
    exit();
  }elseif(!preg_match('/^[a-zA-Z ,.\'-@\/]+$/', $first) && !preg_match('/^[a-zA-Z ,.\'-@\/]+$/', $last)){
    Header("Location: ../signup.php?error=invalidfirstlast&email=$email");
    exit();
  }elseif(!preg_match('/^[a-zA-Z ,.\'-@\/]+$/', $first) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
    Header("Location: ../signup.php?error=invalidfirstemail&last=$last");
    exit();
  }elseif(!preg_match('/^[a-zA-Z ,.\'-@\/]+$/', $last) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
    Header("Location: ../signup.php?error=invalidlastemail&first=$first");
    exit();
  }elseif(!preg_match('/^[a-zA-Z ,.\'-@\/]+$/', $first)){
    Header("Location: ../signup.php?error=invalidFirst&last=$last&email=$email");
    exit();
  }elseif(!preg_match('/^[a-zA-Z ,.\'-@\/]+$/', $last)){
    Header("Location: ../signup.php?error=invalidLast&first=$first&email=$email");
    exit();
  }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    Header("Location: ../signup.php?error=invalidemail&first=$first&last=$last");
    exit();
  }elseif(!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[\W])[A-Za-z\d\W].{7,}$/', $pwd)){
    Header("Location: ../signup.php?error=invalidPwd&first=$first&last=$last&email=$email");
    exit();
  }elseif($pwd !== $repeatPwd){
    Header("Location: ../signup.php?error=invalidrepeatPwd&first=$first&last=$last&email=$email");
    exit();
  }else{

    //sql statement
    $sql = "SELECT * FROM users WHERE email=?;";
    //create the statement
    $stmt = mysqli_stmt_init($conn);
    //prepare the statement
    if(!mysqli_stmt_prepare($stmt, $sql)){
      Header("Location: ../signup.php?error=sqlerror");
      exit();
    }else{
      //hash the password
      mysqli_stmt_bind_param($stmt, "s", $email);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultCheck = mysqli_stmt_num_rows($stmt);

      if($resultCheck > 0){
        Header("Location: ../signup.php?error=emailtaken");
        exit();
      }else{
        $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
          Header("Location: ../signup.php?error=sqlerror");
          exit();
        }else{
          //hash the password
          $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
          mysqli_stmt_bind_param($stmt, "ssss", $first, $last, $email, $hashedPwd);
          mysqli_stmt_execute($stmt);
          header("Location: ../signup.php?signup=success");
        }
      }
    }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
