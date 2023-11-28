<?php 
include 'session_check.php';
include 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
    <!-- css -->
    <link rel="stylesheet" type="text/css" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/boostrap/css/bootstrap.css" />
    
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    
    <!-- Javacript -->
    <script src="assets/boostrap/js/bootstrap.js"></script>
    
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

<header class="page-header header container-fluid h-auto" style="background-image: url('assets/images/background_photo.jpg');">
  <div class="container h-auto" style="min-height: 100vh;" >
    <div class="overlay">
      <div class = "row d-flex justify-content-center align-items-center h-100">
        <div class = "col-ml-12 h-100"></div>
      </div>
    </div>
    <div class="row d-flex justify-content-center align-items-center h-auto">
      <div class="col-md-8 col-lg-8 col-xl-8">
        <div class="card text-black" style="border-radius: 50px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-12 col-lg-12 col-xl-12 order-2 order-lg-1">
                <div class="text-center">
                  <h2 id = "title"> ADD</h2>
                  <button class=" h1 fw-bold mb-5 mx-1 mx-md-4 mt-4 btn-lg btn-primary" onclick="SwitchFunction_usr()">Add/Edit User</button>
                <div>
                    
                <!-- Add User -->
                <form id ="add-usr" onsubmit="return CheckPassword()" class="mx-1 mx-md-4" action = "connect.php" method = "POST">
                <div class = "container">
                    <div class = "row d-flex">
                        <div class ="col-xl-6 col-lg-6 col-md-6 col-sm-12 h-25">
                            <!-- First Name -->
                            <div class="d-flex flex-row align-items-center mb-2">
                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                <div class="form-outline flex-fill mb-0">
                                    <input type="text" id="fname" name="fname" placeholder="First Name" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <!-- Last Name -->
                        <div class ="col-xl-6 col-lg-6 col-md-6 col-sm-12 h-25">
                            <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                <div class="form-outline flex-fill mb-0">
                                    <input type="text" id="lname" name="lname" placeholder="Last Name" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Username -->
                    <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <input type="text" id="user_name" name="user_name" placeholder="Username" class="form-control" required/>
                        </div>
                    </div>
                    <!-- Email -->
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                            <input type="email" id="email" name="email" placeholder="Email" class="form-control" required/>
                            </div>
                    </div>
                    <!-- Password -->
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                        <input type="password" id="password" name="password" placeholder="Password" class="form-control" required/>
                        </div>
                    </div>
                    <!--Check Password -->
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" class="form-control" />
                        <p id='message'></p>
                        </div>
                    </div>
                    <div class = "row">
                        <!-- Status -->
                        <div class ="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="d-flex flex-row align-items-center mb-4">
                                <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                <div class="form-outline flex-fill mb-0">
                                    <select id="status" name="status" class="select form form-control" aria-label="label for the select" >
                                        <option selected>--Please choose status--</option>
                                        <option value="active">Active</option>
                                        <option value="expired">Expired</option>
                                    </select>
                                    <br>
                                </div>
                            </div>
                        </div>

                        <!-- Type -->
                        <div class ="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="d-flex flex-row align-items-center mb-4">
                                <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                <div class="form-outline flex-fill mb-0">
                                    <select  id="type" name="type" class="select form form-control" aria-label="label for the select" >
                                        <option selected>--Please choose a type--</option>
                                        <option value="admin">Admin</option>
                                        <option value="coord">Coord</option>
                                        <option value="review">Review</option>
                                        <option value="oecode">Oecode</option>
                                        <option value="data">Data</option>
                                        <option value="analyst">Analyst</option>
                                    </select>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                        <button type="submit" name = "submit_register" id = "submit_register" class="btn btn-dark btn-lg">ADD</button><br>
                    </div>
                    
                </div>
                </form>
                <!-- Edit user -->
                <form id ="edit-usr" autocomplete="off" onsubmit="return CheckPassword()" class="mx-1 mx-md-4" action = "connect.php" method = "POST">
                <div class = "container">
                    <div class="d-flex justify-content-center mb-1 mb-lg-4">
                        <div class="row">
                            <!-- Choose reset config or password-->
                            <div class="col-sm-12 col-lg-12">
                                <p id = "show_cfg"><span onclick='show_reset_cfg()' style="cursor: pointer; color:blue">Reset Configurations</span></p>
                            </div>
                            <div class="col-sm-12 col-lg-12">
                                <p id = "show_ps"><span onclick='show_reset_ps()' style="cursor: pointer; color:blue">Reset Password</span></p>
                            </div>
                            <!-- Reset Config -->
                            <div class="col-sm-12 col-lg-12 col-xl-12" id = "cfg">
                                <div class ="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <!-- User to be updated-->
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <!-- Select username  -->
                                            <select  id="usr" name="usr" class="select form form-control" aria-label="label for the select" style="overflow: hidden;">
                                                <option selected>--Please select username--</option>
                                                <?php
                                                    $sql ="SELECT `username` FROM `$user_table` ORDER BY `username`";
                                                    $query=mysqli_query($conn,$sql);
                                                    while($row = $query->fetch_row())
                                                    {?>
                                                    <option value=<?="\"$row[0]\""?>><?=$row[0]?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                                <div class ="row">
                                <div class ="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <!-- Status -->
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <select id="status" name="status" class="select form form-control" aria-label="label for the select" >
                                                <option selected>--Please choose status--</option>
                                                <option value="active">Active</option>
                                                <option value="expired">Expired</option>
                                            </select>
                                            <br>
                                        </div>
                                    </div>
                                 </div>
                                 <div class ="col-xl-6 col-lg-6 col-md-6 col-sm-12 h-25">
                                    <!-- Type -->
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <select  id="type" name="type" class="select form form-control" aria-label="label for the select" >
                                                <option selected>--Please choose a type--</option>
                                                <option value="admin">Admin</option>
                                                <option value="coord">Coord</option>
                                                <option value="review">Review</option>
                                                <option value="oecode">Oecode</option>
                                                <option value="data">Data</option>
                                                <option value="analyst">Analyst</option>
                                            </select>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <!-- Choose reset  password-->
                            <div class="col-sm-12 col-lg-12 col-xl-12" id = "ps">
                                <!-- User to be updated-->
                                <div class="d-flex flex-row align-items-center mb-4">
                                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                         <!-- Select username  -->
                                        <select  id="usr" name="usr" class="select form form-control" aria-label="label for the select" style="overflow: hidden;">
                                            <option selected>--Please select username--</option>
                                            <?php
                                                $sql ="SELECT `username` FROM `$user_table` ORDER BY `username`";
                                                $query=mysqli_query($conn,$sql);
                                                while($row = $query->fetch_row())
                                                {?>
                                                <option value=<?="\"$row[0]\""?>><?=$row[0]?></option>
                                                <?php }
                                            ?>
                                        </select>
                                        <br>
                                    </div>
                                </div>
                                <!-- Password -->
                                <div class="d-flex flex-row align-items-center mb-4">
                                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                    <input type="password" id="password2" name="password" placeholder="Password" class="form-control"/>
                                    </div>
                                </div>
                                <!--Check Password -->
                                <div class="d-flex flex-row align-items-center mb-4">
                                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                    <input type="password" id="confirm_password2" name="confirm_password" placeholder="Confirm Password" class="form-control" />
                                    <p id='message2'></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-12">
                                <button type="submit" name = "edit_register" id = "edit_register" class="btn btn-dark btn-lg">EDIT</button><br>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

<script type="text/javascript">
// cfg->config, ps->password
$(document).ready(function() {
    document.getElementById ("show_cfg").addEventListener ("click", show_reset_cfg(), false);
    document.getElementById ("show_ps").addEventListener ("click", show_reset_ps(), false);
    $("#edit-usr").hide();
    $("#ps").hide();
    $("#cfg").hide();
    // if comfirm password is same as password, show green, else show red
    $('#password, #confirm_password').on('keyup', function () {
        if ($('#password').val() == $('#confirm_password').val()) {
            $('#message').html('Matching').css('color', 'green');
        } else {
            $('#message').html('Not Matching').css('color', 'red');
        }
    });
    // if comfirm password is same as password, show green, else show red (edit)
    $('#password2, #confirm_password2').on('keyup', function () {
        if ($('#password2').val() == $('#confirm_password2').val()) {
            $('#message2').html('Matching').css('color', 'green');
        } else {
            $('#message2').html('Not Matching').css('color', 'red');
        }
    });
 });
 function show_reset_cfg(){
    $("#cfg").show();
    $("#ps").hide();
    document.getElementById("edit-usr").reset();
}
function show_reset_ps(){
    $("#ps").show();
    $("#cfg").hide();
    document.getElementById("edit-usr").reset();
}
</script>
<script type="text/javascript" src="scripts.js"></script>

</body>
</html>
