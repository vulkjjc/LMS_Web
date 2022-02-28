<?php
// (A) INIT
require "assets/price/core.php";
switch ($_POST['req']) {
  // (B) INVALID REQUEST
  default:
    echo "INVALID REQUEST";
    break;

  // (C) ADD ITEM TO CART
  case "add":
    $pass = $_CC->cartItem($_POST['product_id'], 1);
    echo json_encode([
      "status" => $pass,
      "message" => $pass ? "" : $_CC->error
    ]);
    break;

  // (D) CHANGE QTY
  case "change":
    $pass = $_CC->cartItem($_POST['product_id'], $_POST['qty'], false);
    echo json_encode([
      "status" => $pass,
      "message" => $pass ? "" : $_CC->error
    ]);
    break;

  // (E) COUNT TOTAL NUMBER OF ITEMS
  case "count":
    echo $_CC->cartCount();
    break;

  // (F) SHOW CART ITEMS
  case "show":
    	header('location :index.php?page=order');
    break;

  // (G) CHECKOUT - DO YOUR SECURITY CHECKS + PAYMENT HERE!
  case "checkout":
    $pass = $_CC->cartCheckout($_SESSION['name'],$_SESSION['email']);
    echo json_encode([
      "status" => $pass,
      "message" => $pass ? "" : $_CC->error
    ]);
    break;
}