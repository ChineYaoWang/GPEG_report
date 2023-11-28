<?php 
include 'session_check.php';
include 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="assets/js/scripts.js"></script>
    <link rel="stylesheet" href="assets/boostrap/css/bootstrap.css" />
    <link rel="stylesheet"  type="text/css" href="assets/css/main.css" />
</head>
<body>
<nav class="navbar navbar-expand-md navbar-expand-xl">
    <a class="navbar-brand" href="home.php"><img src="assets/images/logo.png" alt ="logo" width="250" 
              height="60"></a>
	<button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="main-navigation">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" href="home.php">Home</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">About</a>
			</li>
          
            <?php
                if($_SESSION['type_id'] == '0'){
                    echo '<div class="nav-item-dropdown">
                        <li class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Manage
                        <span class="caret"></span>
                        </li>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="add_user.php" class="dropdown-item">Add user</a>
                            <a href="add_study.php" class="dropdown-item">Add study</a>
                            <a href="add_project.php" class="dropdown-item">Add project</a>
                            <a href="add_report.php" class="dropdown-item">Add report</a>
                        </div>
                    </div>';
                }
            ?>
           
            <div class="nav-item-dropdown">
                <li class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Setting
                <span class="caret"></span>
                </li>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="#" class="dropdown-item">Account Details</a>
                    <a href="#" class="dropdown-item">Reset Password</a>
                    <div class="dropdown-divider"></div>
                    <a href="logout.php" class="dropdown-item">Logout</a>
                </div>
            </div>
		</ul>
	</div>
</nav>

<header class="page-header header2 container-fluid">
    <div class="overlay2">
        <div class="container">
            <div class = "row">
                <div class = "col-12">
                    <div class = home-content id = "home" style="height:90vh">
                        <!-- Fetch RPT_Header -->
                        <div class ="scrollable-row  responsive-width" id="TableContent">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<script script type="text/javascript" src="scripts.js"></script> 
<script type="text/javascript">
    
document.addEventListener("DOMContentLoaded", function() {
    fetch("fetch_rpt_header.php")
        .then(response => response.json())
        .then(data => {
            // Call the displayData function here
            display_RPT_Header(data);
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            popup.style.display = 'none';
        });
});
</script>
<?php
    $conn->close();
?>
</body>
</html>

