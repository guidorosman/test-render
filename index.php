<?php 
include("db.php");
include("templates/header.php");

$stmt = $conn->prepare("SELECT * FROM accounts");
$stmt->execute();
$accounts = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<h4>Accounts</h4>
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="create.php" role="button">Creat new account</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table id="table-accounts" class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Account Number</th>
                        <th scope="col">Client</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($accounts as $account) { ?>
                        <tr class="">
                            <td><?php echo $account['accountNumber']; ?></td>
                            <td><?php echo $account['client']; ?></td>
                            <td><?php echo $account['total']; ?></td>
                        </tr>
                    <?php } ?>   
                </tbody>
            </table>
        </div>
    </div>  
</div>

<div id="movements-section" class="row d-none">
    <div class="col-md-4 mt-5">
        <div class="card">
            <div class="card-header">
                Add Movement
            </div>
            <div class="card-body">
                <form id="movement-form" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <input type="hidden"
                            class="form-control" name="accountNumber" id="accountNumber">
                    </div>
                    <div class="mb-3">
                        <label for="movement" class="form-label">Select Movement</label>
                        <select class="form-select" name="movement" id="movement">
                            <option value="0" selected> Select Movement</option>
                            <option value="+">Deposit</option>                   
                            <option value="-">Extract</option>                                      
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="cant" class="form-label">Cant</label>
                        <input type="text"
                            class="form-control" name="cant" id="cant" placeholder="Cant">
                    </div>
                    <button type="submit" class="btn btn-success" onclick="addMovement(event)">Add Movement</button>
                </form>
            </div>
        </div>                    
    </div>
    <div class="col-md-8 mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Details Account Number: <span id="titleDetails"> </span></h4>
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table id="table-accounts" class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Cant</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                        
                        </tbody>
                    </table>
                </div>
            </div>  
        </div>                    
    </div>
</div>

<?php include("templates/footer.php"); ?>
