<?php
include("db.php");

if(isset($_GET['accountNumber'])){
    $accountNumber = $_REQUEST["accountNumber"];

    $stmt = $conn->prepare("SELECT * FROM details WHERE accountNumber = :accountNumber");
    $stmt->bindParam(":accountNumber", $accountNumber);
    $stmt->execute();
    $details = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
    echo json_encode($details);
}

if($_POST){

    $accountNumber = $_POST['accountNumber'];
    $movement = $_POST['movement'];
    $cant = $_POST['cant'];
    
    $stmt = $conn->prepare("INSERT INTO details(accountNumber, cant, movement) 
    VALUES (:accountNumber, :cant, :movement)");
    $stmt->bindParam(":accountNumber", $accountNumber);
    $stmt->bindParam(":cant", $cant);
    $stmt->bindParam(":movement", $movement);
    $stmt->execute();

    $stmt = $conn->prepare("SELECT total FROM accounts WHERE accountNumber = :accountNumber");
    $stmt->bindParam(":accountNumber", $accountNumber);
    $stmt->execute();
    $total = $stmt->fetch(PDO::FETCH_LAZY);

    if($movement === "+"){
        $newTotal = $total['total'] + $cant;
    }else if($movement === "-"){
        $newTotal = $total['total'] - $cant;
    }

    $stmt = $conn->prepare("UPDATE accounts SET total = :total WHERE accountNumber = :accountNumber");
    $stmt->bindParam(":total", $newTotal);
    $stmt->bindParam(":accountNumber", $accountNumber);
    $stmt->execute();

    $stmt = $conn->prepare("SELECT * FROM details WHERE accountNumber = :accountNumber");
    $stmt->bindParam(":accountNumber", $accountNumber);
    $stmt->execute();
    $details = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($details);

    
}
?>