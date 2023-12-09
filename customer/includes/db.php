<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $db = "ecom_store";
    try {
      $conn = new PDO("mysql:host=$host;dbname=$db", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
      echo 'ERROR: ' . $e->getMessage();
    }
?>