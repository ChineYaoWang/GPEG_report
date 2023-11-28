<?php 
include 'session_check.php';
include 'config.php';
global $row;
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
            <!-- If the user's type_id is 0 (admin), it has permission to edit user,study,project, and report -->
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
            <!-- Some funcitonal button -->
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
<header class="page-header header container-fluid">
    <div class="overlay">
        <div class="container">
            <div class = "row">
                    <div class = "col-2"></div>
                    <div class = "col-8">
                        <div class = home-content>
                            <h2> Hi, <?php $user =  $_SESSION['user_name'];echo $user;?> </h2>
                            <h2> Welcome to</h2>
                            <h2> Global Psychiatric Epidemiology Group </h2>
                            <h2> Report Generator </h2>
                            <!-- Select study and project to fetch the token -->
                            <form id ="get_token">
                                <p> Please select the study</p><br>
                                <div class="dropdown">
                                    <select data-display="static" id= "study_button" name="study_button" type="button" class="btn btn-success responsive-width"  aria-expanded="false"  style="margin:10px; max-width: 100%" required></select>
                                    <div class=" dropdown-menu dropdown-menu-right responsive-width" id = "studies">
                                        <!-- ajax (check buttom) -->
                                    </div>
                                </div>
                                <br>
                                <div class="dropdown">
                                    <select data-display="static" id= "project_button" name="project_button"  type="button" class="btn btn-success responsive-width"  aria-expanded="false" required></select>
                                    <div class="dropdown-menu dropdown-menu-right responsive-width" id = "projects">
                                         <!-- ajax (check buttom) -->
                                    </div>
                                </div>
                                <br>
                                <button type="submit" id ="get_token_btn" name="get_token_btn" class="btn btn-primary responsive-width">Submit</button><br>
                            </form>
                            <!-- if no token exist, add token -->
                            <div id ="no_token" col-8>
                                <p> Token not found ! </p>
                                <p> Please re-select other study and project or add token</p>
                                <a class="btn btn-primary" href="home.php" role="button">Re-select</a>
                                <br>
                                <form id = "add_token">
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                        <input type="text" id="token" name="token" placeholder="Token" class="form-control" />
                                        </div>
                                    </div>
                                    <button class="btn btn-primary" id="add_token" type="submit">Add token</button>
                                </form>
                            </div>
                            <!-- token_result -->
                            <p id = "token_result"></p>
                        </div>   
                    </div>
                    <div class = "col-2"> </div>
            </div>
        </div>
    </div>
</header>

<!-- <footer class="page-footer">
    <div class="container h-auto">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h6 class="text-uppercase font-weight-bold">Additional Information</h6>
                <p>Content 1</p>
                <p>Content 2</p>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h6 class="text-uppercase font-weight-bold">Contact</h6>
                <p>1051 Riverside Drive, Unit 43/Room 5217 New York, NY 10032
                <br/>George.Musa@nyspi.columbia.edu
                <br/>+ 1 646 774 5794
                <br/>+ 1 646 774 6068
                <br/>+ 1 212 781 6050 (fax)</p>
            </div>
        </div>
    <div>
    <div class="footer-copyright text-center"></div>
</footer>  -->

<script script type="text/javascript" src="scripts.js"></script>  

<script script type="text/javascript">
</script>  
<?php
    $conn->close();
?>
</body>
</html>

