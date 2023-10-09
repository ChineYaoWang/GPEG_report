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
<header class="page-header header container-fluid">
    <div class="overlay">
        <div class="container">
            <div class = "row">
            <div class = "col-12">
                <div class = home-content>
                    <div class ="scrollable-row" id="TableContent"></div>
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
                displayTable(data);
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });

        function displayTable(data) {
            const tableContainer = document.getElementById('TableContent');
            const table = document.createElement('table');
            const headers = ['record_id', 'g_famid', 'snw_parentchild_id', 'invite_name'];
            const headers_show = ['Record ID', 'Fam ID', 'S&W ID', 'Invite Name'];

            // Create table header
            const tableHeader = document.createElement('thead');
            const headerRow = document.createElement('tr');
            headers_show.forEach(headerText => {
                const th = document.createElement('th');
                th.textContent = headerText;
                headerRow.appendChild(th);
            });
            tableHeader.appendChild(headerRow);
            table.appendChild(tableHeader);

            // Create table body
            const tableBody = document.createElement('tbody');
            data.forEach(rowData => {
                const row = document.createElement('tr');
                headers.forEach(header => {
                    const cell = document.createElement('td');
                    cell.textContent = rowData[header]; // Adjust keys if needed
                    row.appendChild(cell);
                });
                tableBody.appendChild(row);
            });
            table.appendChild(tableBody);
            tableContainer.innerHTML = '';
            tableContainer.appendChild(table);
        }
        
});
    
//     // console.log(getCookie("studyname"));
//     // console.log(getCookie("projectname"));
//     // // store selected study and project in the cookie
//     // var study = getCookie("studyname");
//     // var project = getCookie("projectname");
//     // var fromatdata = {'projectname':project,'studyname':study};
</script>

</body>
</html>

