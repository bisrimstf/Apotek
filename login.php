<?php

include 'config.php';

if (isset($_SESSION['login'])) {
    header("Location:index.php");
}

if (isset($_POST['submit'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $query = "SELECT username FROM users WHERE username = '$user' AND password = '$pass'";

    $user = $conn->query($query);

    if ($result = $user->fetch_object()) {
        $_SESSION['login'] = $result->username;
        header("Location:index.php");
    } else {
        $message = 'Username atau Password salah.';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <p><?php require_once 'header.php' ?></p>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>


<body>

    <div class="d-flex align-items-center light-blue-gradient" style="height: 100vh;">
        <div class="container" >
            <div class="d-flex justify-content-center">
                <div class="col-md-6">
                    <div class="card rounded-0 shadow">
                        <div class="card-body">

             <main>
                <h1>Login</h1>
                <br>
                 <?php if (isset($message)) : ?>
                <p><mark><?= $message ?></mark></p>
                <?php endif; ?>
                <form action="" method="post">
                <p>
                <label>Username: </label>
                <input type="text" name="username" class="form-control" placeholder="Masukan Username">
                </p>
                <p>
                <label>Password: </label>
                <input type="password" name="password" class="form-control" placeholder="Masukan Password">
                </p>
                <p>
                    <button name="submit" type="submit" class="btn btn-primary">Login</button>
                </p>
                </form>
            </main>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>