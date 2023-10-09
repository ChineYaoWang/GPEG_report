<?php 
include 'session_check.php';
include 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add report</title>
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
                  <button class=" h1 fw-bold mb-5 mx-1 mx-md-4 mt-4 btn-lg btn-primary" onclick="SwitchFunction_report()">Add/Edit Report</button>
                <div>

                <form id ="add-report"class="mx-1 mx-md-4" autocomplete="off"  action = "connect.php" method = "POST">
                <div class = "container">
                    <div class = "row d-flex">
                        <!-- Study -->
                        <div class ="col-xl-6 col-lg-6 col-md-6 col-sm-12 h-25">
                            <div class="d-flex flex-row align-items-center mb-4">
                                <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                <div class="form-outline flex-fill mb-0">
                                    <div class="dropdown">
                                        <select data-display="static" id= "study_button" name="study_button"  class="select form form-control " aria-label="label for the select" required></select>
                                        <div class=" dropdown-menu dropdown-menu-right responsive-width" id = "studies">
                                            <!-- ajax (check scripts.js) -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- project -->
                        <div class ="col-xl-6 col-lg-6 col-md-6 col-sm-12 h-25">
                            <div class="d-flex flex-row align-items-center mb-4">
                                <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                <div class="form-outline flex-fill mb-0">
                                    <div class="dropdown">
                                        <select data-display="static" id= "project_button" name="project_button" class="select form form-control" aria-label="label for the select" required></select>
                                        <div class=" dropdown-menu dropdown-menu-right responsive-width" id = "projects">
                                            <!-- ajax (scripts.js) -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class = "row">
                        <!-- report id -->
                        <div class ="col-xl-12 col-lg-12 col-md-12 col-sm-12 h-25">
                            <div class="d-flex flex-row align-items-center mb-4">
                                <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                <div class="form-outline flex-fill mb-0">
                                    <input type="text" id="report_id" name="report_name_id" placeholder="Report ID" class="form-control" required/>
                                </div>
                            </div>
                        </div>
                        <!-- report name -->
                        <div class ="col-xl-12 col-lg-12 col-md-12 col-sm-12 h-25">
                            <div class="d-flex flex-row align-items-center mb-4">
                                <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                <div class="form-outline flex-fill mb-0">
                                    <input type="text" id="report_name" name="report_name" placeholder="Report Name" class="form-control" required/>
                                </div>
                            </div>
                        </div>
                        <div class ="col-xl-12 col-lg-12 col-md-12 col-sm-12 h-25">
                            <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                <button type="submit" name = "submit_report" id = "submit_report" class="btn btn-dark btn-lg">ADD</button><br>
                            </div>
                        </div>
                    </div>
                    
                </div>
                </form>

                <form id ="edit-report" autocomplete="off"  class="mx-1 mx-md-4" action = "connect.php" method = "POST" style="display: none">
                <div class = "container">
                    <div class="d-flex justify-content-center mb-1 mb-lg-4">
                        <div class="row">
                            <div class="col-sm-12 col-lg-12">
                                <p id = "show_sp"><span onclick='show_reset_sp()' style="cursor: pointer; color:blue">Reset report's Study and Project</span></p>
                            </div>
                            <div class="col-sm-12 col-lg-12">
                                <p id = "show_report"><span onclick='show_reset_report()' style="cursor: pointer; color:blue">Reset Report Name</span></p>
                            </div>
                            <!-- report to be updated-->
                            <div class ="col-xl-12 col-lg-12 col-md-12 col-sm-12" id = "report">
                                <div class="d-flex flex-row align-items-center mb-4">
                                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        <select  id="report_name_r" name="report_name_r" class="select form form-control" aria-label="label for the select" style="overflow: hidden;">
                                            <option selected>--Please select reportname--</option>
                                            <?php
                                                $sql ="SELECT `reportname` FROM `$report_table` ORDER BY `reportname`";
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
                            <div class="col-sm-12 col-lg-12 col-xl-12" id = "sp">
                                <!-- Study -->
                                <div class ="col-xl-12 col-lg-12 col-md-12 col-sm-12 h-25">
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <div class="dropdown">
                                                <select data-display="static" id= "study" name="study"  class="select form form-control" aria-label="label for the select" ></select>
                                                <div class=" dropdown-menu dropdown-menu-right responsive-width" id = "studies">
                                                    <script type = "text/javascript">
                                                        $.ajax({
                                                            type:"GET",
                                                            url:"fetch_study.php",
                                                            datatype:"json",
                                                            success:function(data){
                                                                html = "<option selected>--Select New Study--</option>\n";
                                                                var obj = JSON.parse(data);
                                                                var set = new Set();
                                                                for(var i = 0; i < obj.length; i++) {
                                                                    if(!set.has(obj[i][1])){
                                                                        set.add(obj[i][1]);
                                                                        html += "<option value=" + "\"" + obj[i][1] + "\"" + ">" +obj[i][1] + "</option>\n";
                                                                    }
                                                                }
                                                                document.getElementById("study").innerHTML = html;
                                                            }
                                                        })
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 <!-- project -->
                                <div class ="col-xl-12 col-lg-12 col-md-12 col-sm-12 h-25">
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <div class="dropdown">
                                                <select data-display="static" id= "project" name="project" class="select form form-control" aria-label="label for the select" ></select>
                                                <div class=" dropdown-menu dropdown-menu-right responsive-width" id = "projects">
                                                    <script type = "text/javascript">
                                                        $.ajax({
                                                            type:"GET",
                                                            url:"fetch_study.php",
                                                            datatype:"json",
                                                            success:function(data){
                                                                var obj = JSON.parse(data);
                                                                $("#study").change(function(){
                                                                    html = "<option selected>--Select New Project--</option>";
                                                                    var chosen_study = document.getElementById("study");
                                                                    var text = chosen_study.options[chosen_study.selectedIndex].text;
                                                                    for(var i = 0; i < obj.length; i++) {
                                                                        if( obj[i][1] == text){
                                                                            html += "<option value=" + "\"" + obj[i][0] + "\"" +">"+obj[i][0] + "</option>";
                                                                        }
                                                                        
                                                                    }
                                                                    document.getElementById("project").innerHTML = html;
                                                                });
                                                            }
                                                        })
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-12 col-lg-12 col-xl-12" id = "rn">
                                <div class="d-flex flex-row align-items-center mb-4">
                                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        <input type="text" id="new_report_id" name="new_report_id" placeholder="New Report ID" class="form-control"/>
                                    </div>
                                </div>
                                <div class="d-flex flex-row align-items-center mb-4">
                                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        <input type="text" id="new_report_name" name="new_report_name" placeholder="New Report Name" class="form-control"/>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-lg-12">
                                <button type="submit" name = "edit_report" id = "edit_report" class="btn btn-dark btn-lg">EDIT</button><br>
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
<script type="text/javascript" src="scripts.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    document.getElementById ("show_sp").addEventListener ("click", show_reset_sp(), false);
    document.getElementById ("show_report").addEventListener ("click", show_reset_report(), false);
    $("#sp").hide();
    $("#rn").hide();
    $("#report").hide();
 });
</script>

</body>
</html>
