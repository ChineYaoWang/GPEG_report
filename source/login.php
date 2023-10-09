<?php
    session_start();
    if(!empty($_SESSION['user_name'])) {
        header('location:home.php');
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/main.css" />
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-expand-xl">
        <b class="navbar-brand" >Global Psychiatric Epidemiology Group </b>
        <!-- <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">
            <span class="navbar-toggler-icon"></span>
        </button> -->
    </nav>

    <header>
    <div class = "left"></div>

    <div class = "content">
        <h2> Login </h2>
        <form action = "index.php" method = "POST">
            <label for="user_name">User name: </label>
            <input type="text" id="user_name" name="user_name" required><br>
            <br>
            <label for="password">Password: </label>
            <input type="password" id="password" name="password" required><br>

            <button type="submit" name = "submit" id = "submit" class="btn btn-success">Submit</button>
        </form>

        <div class = "col">
            <a>No account ? </a><br>
            <a>Please contact <b>George.Musa@nyspi.columbia.edu for more information</b></a>
        </div>
    </div>

    <div class = "right"></div>
</header>
</body>
</html>

