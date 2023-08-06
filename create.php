<?php
include("db.php");
include("templates/header.php");

if($_POST){
    $accountNumber = (isset($_POST["accountNumber"])? $_POST["accountNumber"] : "");
    $clientName = (isset($_POST["client"])? $_POST["client"] : "");

    $stmt = $conn->prepare("SELECT * FROM accounts WHERE accountNumber = :accountNumber");
    $stmt->bindParam(":accountNumber", $accountNumber);
    $stmt->execute();
    $account = $stmt->fetch(PDO::FETCH_LAZY);

    if(empty($account)){
        if(!empty($accountNumber) || !empty($clientName)){
            $stmt = $conn->prepare("INSERT INTO accounts(accountNumber, client) 
            VALUES (:accountNumber, :client)");
            $stmt->bindParam(":accountNumber", $accountNumber);
            $stmt->bindParam(":client", $clientName);
            $stmt->execute();
        
            header("Location:index.php");
        }else{
            $message = "Account Number and Client Name can't be empty";
        }
    }else{
        $message = "This account number already exists";
    }
}

?>

<div class="card">
    <div class="card-header">
        Account information
    </div>
    <div class="card-body">
        <?php if(isset($message)){?>
            <div class="alert alert-danger" role="alert">
            <strong><?php echo $message; ?></strong>
            </div>
        <?php } ?>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="accountNumber" class="form-label">Account Number</label>
              <input type="text"
                class="form-control" name="accountNumber" id="accountNumber" placeholder="Account Number">
            </div>
            <div class="mb-3">
              <label for="client" class="form-label">Client Name</label>
              <input type="text"
                class="form-control" name="client" id="client" placeholder="Client Name">
            </div>
            <button type="submit" class="btn btn-success">Add Account</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancel</a>
        </form>
    </div>
</div>


<?php include("templates/footer.php");?>
