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
    <nav class="navbar navbar-expand-md navbar-expand-xl ">
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


<header class="page-header header container-fluid" style="background-image: url('assets/images/background_photo.jpg');">
  <div class="container h-auto" style="min-height: 100vh;">
    <div class="overlay">
    </div>
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-10 col-lg-10 col-xl-10">
        <div class="card text-black" style="border-radius: 50px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-10 col-xl-10 order-2 order-lg-1">
                <div class="text-center">
                  <h2 id = "title"> ADD</h2>
                  <button class=" h1 fw-bold mb-5 mx-1 mx-md-4 mt-4 btn-lg btn-primary" onclick="SwitchFunction_pjt()">Add/Edit Project</button>
                <div>
                <!-- Add project to project table -->
                <form autocomplete="off" id ="add-project" class="mx-1 mx-md-4" action = "connect.php" method = "POST">

                    <!-- Project ID -->
                    <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <input type="text" id="project_id" name="project_id" placeholder="Project ID" class="form-control" required />
                        </div>
                    </div>
                    <!-- Study Name -->
                    <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <select  id="study_name" name="study_name" class="select form form-control" aria-label="label for the select">
                                <option selected>--Choose study--</option>
                                  <?php
                                    $sql ="SELECT `studyname` FROM `$study_table` ORDER BY `studyname`";
                                    $query=mysqli_query($conn,$sql);
                                    while($row = $query->fetch_row())
                                    {?>
                                      <option value=<?="\"$row[0]\""?>><?=$row[0]?></option>
                                    <?php }
                                  ?>
                            </select>
                        </div>
                    </div>
                    <!-- Project Name -->
                    <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <input type="text" id="project_name" name="project_name" placeholder="Project Name" class="form-control" required/>
                        </div>
                    </div>

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" name = "submit_project" id = "submit_project" class="btn btn-dark btn-lg">ADD</button><br>
                  </div>
                </form>

                <!-- Edit project table-->
                <form autocomplete="off" id ="edit-project" class="mx-1 mx-md-4" action = "connect.php" method = "POST">
                  <div class = "container">
                      <div class="row">
                        <!--Reset study or project -->
                        <div class="col-sm-12 col-lg-12 col-xl-6">
                            <p id = "show_std"><span onclick='show_reset_std()' style="cursor: pointer; color:blue">Reset StudyName</span></p>
                        </div>
                        <div class="col-sm-12 col-lg-12 col-xl-6">
                            <p id = "show_pjt"><span onclick='show_reset_pjt()' style="cursor: pointer; color:blue">Reset ProjectName</span></p>
                        </div>
                        <!-- Project be updated -->
                        <div class="col-sm-12 col-lg-12 col-xl-12">
                          <div class="d-flex flex-row align-items-center mb-4">
                                <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                <div class="form-outline flex-fill mb-0">
                                    <select  id="projectname" name="projectname" class="select form form-control" aria-label="label for the select" require>
                                        <option selected>--Choose Project--</option>
                                          <?php
                                            $sql ="SELECT `projectname` FROM `$project_table` ORDER BY `projectname`";
                                            $query=mysqli_query($conn,$sql);
                                            while($row = $query->fetch_row())
                                            {?>
                                              <option value=<?="\"$row[0]\""?>><?=$row[0]?></option>
                                            <?php }
                                          ?>
                                    </select>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-12 col-lg-12 col-xl-12" id = "std">
                          <!-- Change study-->
                          <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <select  id="studyname" name="studyname" class="select form form-control" aria-label="label for the select" style="overflow: hidden;">
                                    <option selected>--Please select studyname--</option>
                                    <?php
                                        $sql ="SELECT `studyname` FROM `$study_table` ORDER BY `studyname`";
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

                        <div class="col-sm-12 col-lg-12 col-xl-12" id = "pjt">
                          <!-- Change project-->
                          <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                            <input type="text" id="new_projectname" name="new_projectname" placeholder="New Project Name" class="form-control"/>
                            </div>
                          </div>
                        </div>

                        <div class="col-sm-12 col-lg-12 col-xl-12">
                          <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                            <button type="submit" name = "edit_project" id = "edit_project" class="btn btn-dark btn-lg">UPDATE</button><br>
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



<script type="text/javascript">
$(document).ready(function() {
    // pjt-> reset project, std->reset study
    document.getElementById ("show_pjt").addEventListener ("click", show_reset_pjt(), false);
    document.getElementById ("show_std").addEventListener ("click", show_reset_std(), false);
    $("#edit-project").hide();
    $("#std").hide();
    $("#pjt").hide();
 });
function show_reset_pjt(){
    $("#pjt").show();
    $("#std").hide();
    document.getElementById("edit-project").reset();
}
function show_reset_std(){
    $("#std").show();
    $("#pjt").hide();
    document.getElementById("edit-project").reset();
}
</script>
<script type="text/javascript" src="scripts.js"></script>
</header>
</body>
</html>
