<?php include 'session_check.php';?>
<!DOCTYPE html>
<html>
<head>
    <title>Generate Report</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/main.css" />
</head>
<body>
    <div class = "top" id="title">
        <h1>Generate Report</h1>
    </div>
    <!-- <div class = "content"> -->
    <div class="report-section">
        <div class = "centered-container">
            <div id="result"></div>
        </div>
    </div>
        <!-- <h3>Choose the type of report format: </h3>
        <a class="btn btn-success" href="csv_gen.php" role="button">CSV</a><br>
        <br>
        <a class="btn btn-success" href="pdf_gen.php" role="button">PDF</a><br> -->

<script script type="text/javascript" src="scripts.js"></script> 
<script>
$(document).ready(function(){
    // Set the topic with sudy name and project name
    const topDiv = document.getElementById('title');
    const newTitle = getCookie("studyname")+': ' + getCookie("projectname");
    const h1Element = topDiv.querySelector('h1');
    h1Element.textContent = newTitle;


    // Retrieve the data from URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const data = urlParams.get('data');
    const jsonData = JSON.parse(data);
    // console.log(data);
    // Display the data
    // document.getElementById('result').textContent = data;
    // Function to create a table based on section name and data
    function createTable_vertical(sectionName, sectionData) {
        const table = document.createElement("table");
        table.classList.add("report-rows");
        // table.border = "1";

        // Create a row for keys
        const keysRow = table.insertRow();
        // Create a row for values
        const valuesRow = table.insertRow();

        for (const attribute in sectionData) {
            const values = sectionData[attribute];
            const keyCell = keysRow.insertCell();
            const valueCell = valuesRow.insertCell();
            var str =  attribute.replace('invite_','');
            keyCell.textContent = str.charAt(0).toUpperCase()+str.slice(1);

            // Check if the attribute has multiple values
            if (values.length > 1) {
                // If multiple values, create a list to display them
                const ul = document.createElement("ul");
                values.forEach(value => {
                    const li = document.createElement("li");
                    li.textContent = value;
                    ul.appendChild(li);
                });
                valueCell.appendChild(ul);
            } else {
                // If a single value, display it normally
                const ul = document.createElement("ul");
                values.forEach(value => {
                    const li = document.createElement("li");
                    li.textContent =  values[0];
                    ul.appendChild(li);
                });
                valueCell.appendChild(ul);
                // valueCell.textContent = values[0];
            }
        }

            // Create a heading for the section
            const sectionHeading = document.createElement("h2");
            // Remove RPT_
            sectionHeading.textContent = sectionName.replace('RPT_','');
           
            // Append the table and section heading to the container
            tableContainer = document.getElementById("result");
            tableContainer.appendChild(sectionHeading);
            tableContainer.appendChild(table);
            
    }
    function createTable_parallel(sectionName, sectionData) {
        const tableContainer = document.createElement("div");
        tableContainer.classList.add("report-container");
        
        const table = document.createElement("table");
        table.classList.add("report-rows");
        table.border = "1";

        for (const attribute in sectionData) {
            const values = sectionData[attribute];
            console.log(values);
            // Create a row for the key
            const keyRow = table.insertRow();
            const keyCell = keyRow.insertCell();
            keyCell.textContent = attribute.replace('invite_', '').charAt(0).toUpperCase() + attribute.replace('invite_', '').slice(1);
            keyCell.style.fontWeight = "bold";
            // Create a row for the values
            const valuesRow = table.insertRow();
            const ColumnCell = valuesRow.insertCell();
            // Check if the attribute has multiple values
            if (values.length > 1) {
                // If multiple values, create lists to display them in both columns
                const ul1 = document.createElement("ul");
                const ul2 = document.createElement("ul");
                values.forEach(value => {
                    const li1 = document.createElement("li");
                    li1.textContent = value;
                    ul1.appendChild(li1);

                    const li2 = document.createElement("li");
                    li2.textContent = value;
                    ul2.appendChild(li2);
                });
                ColumnCell.appendChild(ul1);
            } else {
                // If a single value, display it in both columns
                ColumnCell.textContent = values[0];
            }
        }


            // Create a heading for the section
            const sectionHeading = document.createElement("h2");
            // Remove RPT_
            sectionHeading.textContent = sectionName.replace('RPT_','');
       
            // Append the table container to the result div
            tableContainer.appendChild(sectionHeading);
            tableContainer.appendChild(table);
            const resultDiv = document.getElementById("result");
            resultDiv.appendChild(tableContainer);
            
    }
    // Using a for...in loop to iterate over the JSON data and retrieve keys

    // Iterate over the keys within the section

    // Iterate over JSON data and create tables for each section
    
    for (const sectionName in jsonData) {
        const sectionData = jsonData[sectionName];
        if(sectionName == 'RPT_Addresses' || sectionName == 'RPT_Phone' ||sectionName == 'RPT_Emails' ){
            createTable_parallel(sectionName, sectionData,1);
        }
        else{
            createTable_vertical(sectionName, sectionData,0);
        }
    }
    
});
</script>

</body>
</html>

