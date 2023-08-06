<?php
session_start();
if(isset($_SESSION['username'])){
    header("Location:index.php");
}

if($_POST){
    include("db.php");
    $stmt = $conn->prepare("SELECT *, count(*) as n_users FROM users
    WHERE username = :username AND password = :password");
    
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":password", $password);

    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_LAZY);

    if($user["n_users"] > 0){
        $_SESSION["username"] = $user["username"];
        header("Location:index.php");
    }else{
        $message = "Error: Username or password wrong";
    }
}?>

<!doctype html>
<html lang="en">

<head>
  <title>Login</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
  <header>
    <!-- place navbar here -->
  </header>
  <main>
    <main class="container">
        <div class="row">
            <div class="col-md-4">
            
            </div>
            <div class="col-md-4">
                <div class="card mt-5">
                    <div class="card-header">
                        Login
                    </div>
                    <div class="card-body">
                        <?php if(isset($message)){?>
                            <div class="alert alert-danger" role="alert">
                                <strong><?php echo $message; ?></strong>
                            </div>
                        <?php } ?>
                        <form action="" method="post">
                            <div class="mb-3">
                              <label for="username" class="form-label">Username:</label>
                              <input type="text"
                                class="form-control" name="username" id="username" placeholder="Username">
                            </div>
                            <div class="mb-3">
                              <label for="password" class="form-label">Password:</label>
                              <input type="text"
                                class="form-control" name="password" id="password" placeholder="Password">
                            </div>

                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                    </div>                    
                </div>
            </div>
        </div>
    </main>
  </main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>