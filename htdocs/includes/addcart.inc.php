<?php
session_start();
$data = array();

if(!isset($_SESSION["userId"])){
  array_push($data, "error=login");
  echo json_encode($data);
  exit();
}else{
  require "dbh.inc.php";
  $userId = $_SESSION["userId"];
  $productId = $_POST["productId"];

  $sql = "SELECT * FROM cart WHERE user_id=? AND product_id=?;";

  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt, $sql)){
    array_push($data, "error=sqlerror");
    echo json_encode($data);
    exit();
  }else{
    mysqli_stmt_bind_param($stmt, "ss", $userId, $productId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_store_result($stmt);
    $resultCheck = mysqli_stmt_num_rows($stmt);
    mysqli_stmt_bind_result($stmt, $userId, $productId, $currentQuantity);
    mysqli_stmt_fetch($stmt);

    if($resultCheck > 0){
      if(!isset($_POST["quantity"])){
        if(!preg_match('/^-?[\d]+$/', $_POST["cus-quantity"])){
          array_push($data, "error=addcart");
          echo json_encode($data);
          exit();
        }else{
          if($_POST["cus-quantity"] <= 0){
            $sql = "DELETE FROM cart WHERE user_id = ? AND product_id = ?;";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
              array_push($data, "error=sqlerror");
              echo json_encode($data);
              exit();
            }else{
              mysqli_stmt_bind_param($stmt, "ss", $userId, $productId);
              mysqli_stmt_execute($stmt);
              array_push($data, "remove=success");
            }
          }else{
            $sql = "UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?;";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
              array_push($data, "error=sqlerror");
              echo json_encode($data);
              exit();
            }else{
              mysqli_stmt_bind_param($stmt, "sss", $_POST["cus-quantity"], $userId, $productId);
              mysqli_stmt_execute($stmt);
              array_push($data, "update=success");
            }
          }
        }
      }elseif(!preg_match('/^-?[\d]+$/', $_POST["quantity"])){
        array_push($data, "error=addcart");
        echo json_encode($data);
        exit();
      }elseif($_POST["quantity"] == 0){
        $sql = "DELETE FROM cart WHERE user_id = ? AND product_id = ?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
          array_push($data, "error=sqlerror");
          echo json_encode($data);
          exit();
        }else{
          mysqli_stmt_bind_param($stmt, "ss", $userId, $productId);
          mysqli_stmt_execute($stmt);
          array_push($data, "remove=success");
        }
      }elseif(($currentQuantity + $_POST["quantity"]) <= 0){
        $sql = "DELETE FROM cart WHERE user_id = ? AND product_id = ?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
          array_push($data, "error=sqlerror");
          echo json_encode($data);
          exit();
        }else{
          mysqli_stmt_bind_param($stmt, "ss", $userId, $productId);
          mysqli_stmt_execute($stmt);
          array_push($data, "remove=success");
        }
      }else{
        $sql = "UPDATE cart SET quantity = quantity + ? WHERE user_id = ? AND product_id = ?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
          array_push($data, "error=sqlerror");
          echo json_encode($data);
          exit();
        }else{
          mysqli_stmt_bind_param($stmt, "sss", $_POST["quantity"], $userId, $productId);
          mysqli_stmt_execute($stmt);
          array_push($data, "update=success");
        }
      }
    }else{
      $sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?);";
      $stmt = mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmt, $sql)){
        array_push($data, "error=sqlerror");
        echo json_encode($data);
        exit();
      }else{
        //hash the password
        mysqli_stmt_bind_param($stmt, "sss", $userId, $productId, $_POST["quantity"]);
        mysqli_stmt_execute($stmt);
        array_push($data, "addcart=success");
      }
    }
  }
}

//the response message for sending back to the javascript
$sql = 'SELECT p.product_id, product_image, product_name, quantity, price, price * quantity AS "totPrice" FROM products p, cart c WHERE p.product_id = c.product_id AND user_id=?;';
//create the statement
$stmt = mysqli_stmt_init($conn);
//prepare the statement
if(!mysqli_stmt_prepare($stmt, $sql)){
  array_push($data, "error=sqlerror");
  echo json_encode($data);
  exit();
}else{
  mysqli_stmt_bind_param($stmt, "s", $userId);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  while($row = mysqli_fetch_assoc($result)){
    array_push($data, $row);
  }
}

echo json_encode($data);
mysqli_stmt_close($stmt);
mysqli_close($conn);
