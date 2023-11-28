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
    <div class = "top_rep" id="title">
        <h1>Generate Report</h1>
    </div>

    <div class="report-section">
        <div class = "centered-container">
            <div id="result"></div>
        </div>
    </div>

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
    // Function to create a table based on section name and data
    function createTable_header(sectionName, sectionData) {
        const table = document.createElement("table");
        table.classList.add("report-rows");

        // Create a row for keys
        const keysRow = table.insertRow();
        for (const attribute in sectionData) {
            const values = sectionData[attribute];
            let keyCell;
            if(attribute === 'invite_name'){
                const nameRow = table.insertRow();
                keyCell = nameRow.insertCell();
                keyCell.colSpan = Object.keys(sectionData).length; // Span the cell across all columns
                keyCell.style.textAlign = "center"; // Center the text
                keyCell.style.maxWidth = "100%"; // Set a max width if n
            }
            else{
                keyCell = keysRow.insertCell();
            }
            var str =  attribute.replace('invite_','') +": ";
            var str = str.replace(/_/g, ' ');
            const keyText = document.createElement("span");
            keyText.textContent = str.charAt(0).toUpperCase()+str.slice(1);
            keyText.style.fontWeight = "bold";
            // Create a <span> element for the value text
            const valueText = document.createElement("span");
            valueText.textContent = values[0];

            // Append the key and value elements to the keyCell
            keyCell.appendChild(keyText);
            keyCell.appendChild(valueText);
        }
           
            // Append the table and section heading to the container
            tableContainer = document.getElementById("result");
            tableContainer.appendChild(table);
            
    }
    
    // Function to create a table based on section name and data
    function createTable_vertical(sectionName, sectionData) {
        const table = document.createElement("table");
        table.classList.add("report-rows");

        // Create a row for keys
        const keysRow = table.insertRow();
        // Create a row for values
        const valuesRow = table.insertRow();
        for (const attribute in sectionData) {
            const values = sectionData[attribute];
            const keyCell = keysRow.insertCell();
            const valueCell = valuesRow.insertCell();
            // remove some unnecessary words
            var str =  attribute.replace('invite_',' ');
            var str = str.replace(/_/g, ' ');
            // Make first letter upper case
            keyCell.textContent = str.charAt(0).toUpperCase()+str.slice(1);
            // Make words bold
            keyCell.style.fontWeight = "bold";
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

            // Append the table and section heading to the container
            tableContainer = document.getElementById("result");
            tableContainer.appendChild(table);
            
    }
    function adjustObtainedDuringRecruitmentHeights() {
        // Get all 'Obtained During Recruitment' elements
        const obtainedCells = document.querySelectorAll('.obtained-during-recruitment');
        let maxHeight = 0;

        // Find the maximum height among the 'Obtained During Recruitment' cells
        obtainedCells.forEach(function(cell) {
            maxHeight = Math.max(maxHeight, cell.clientHeight);
        });

        // Set all 'Obtained During Recruitment' cells to the maximum height
        obtainedCells.forEach(function(cell) {
            cell.style.height = `${maxHeight}px`;
        });
    }
    function adjustReportContentHeights() {
        // Get all 'Obtained During Recruitment' elements
        const obtainedCells = document.querySelectorAll('.report-content');
        let maxHeight = 0;

        // Find the maximum height among the cells
        obtainedCells.forEach(function(cell) {
            maxHeight = Math.max(maxHeight, cell.clientHeight);
        });

        // Set all  cells to the maximum height
        obtainedCells.forEach(function(cell) {
            cell.style.height = `${maxHeight}px`;
        });
    }

    function createTable_parallel(sectionName, sectionData) {
        const tableContainer = document.createElement("div");
        tableContainer.classList.add("report-container");
        console.log(sectionData);
        const table = document.createElement("table");
        table.classList.add("report-rows");
        for (const attribute in sectionData) {
            const values = sectionData[attribute];
            // Create a row for the key
            const keyRow = table.insertRow();
            const keyCell = keyRow.insertCell();
            // Apply the CSS class
            keyCell.classList.add("report-header"); 
            // title is column name for each section
            var title;
            // modify the name
            if(attribute == 'Recruitment') title = 'Obtained During Recruitment';
            else if(attribute == 'invite_address_line') title = 'Address';
            else title = attribute;
            keyCell.textContent = title.replace('invite_', '').charAt(0).toUpperCase() + title.replace('invite_', '').slice(1);
            keyCell.style.fontWeight = "bold";

            // Create a row for the values
            const valuesRow = table.insertRow();
            const ColumnCell = valuesRow.insertCell();
            // Check if the attribute has multiple values
            if (values.length > 1) {
                if(title == 'Obtained During Recruitment'){
                    ColumnCell.classList.add('obtained-during-recruitment');
                }
                else{
                    ColumnCell.classList.add('report-content');
                }
                
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
                ColumnCell.classList.add("report-content"); 
                ColumnCell.textContent = values[0];
            }
        }
       
            // Append the table container to the result div
            tableContainer.appendChild(table);
            const resultDiv = document.getElementById("result");
            resultDiv.appendChild(tableContainer);
            // Adjust the header heights after the table is added to the DOM
            adjustReportContentHeights();
            adjustObtainedDuringRecruitmentHeights();
            
    }

    function createEmptyTable_parallel(sectionName, sectionData) {
        const tableContainer = document.createElement("div");
        tableContainer.classList.add("report-container");
        const table = document.createElement("table");
        table.classList.add("report-rows");
        console.log(sectionData);
            // Create a row for the key
            var keyRow = table.insertRow();
            var keyCell = keyRow.insertCell();
            // Apply the CSS class
            keyCell.classList.add("report-header"); 
            // title is column name for each section
            var title;
            // modify the name
            if(sectionData == 'invite_address_line') title = 'Address';
            else title = sectionData;
            keyCell.textContent = title.replace('invite_', '').charAt(0).toUpperCase() + title.replace('invite_', '').slice(1);
            keyCell.style.fontWeight = "bold";

            // Create a row for the values
            var valuesRow = table.insertRow();
            var ColumnCell = valuesRow.insertCell();
        
            ColumnCell.textContent = "NULL";
            ColumnCell.classList.add("report-content"); 
        // Append the table container to the result div
        tableContainer.appendChild(table);
        const resultDiv = document.getElementById("result");
        resultDiv.appendChild(tableContainer);
        // Adjust the header heights after the table is added to the DOM
        adjustReportContentHeights();
        adjustObtainedDuringRecruitmentHeights();
            
    }
        
    // Using a for...in loop to iterate over the JSON data and retrieve keys

    // Iterate over the keys within the section

    // Iterate over JSON data and create tables for each section
    let counter = 0;
    const attribute_Name = ['RPT_Addresses', 'RPT_Phone', 'RPT_Emails'];
    const attribute_Data = ['invite_address_line', 'invite_phone', 'invite_email'];
    for (const sectionName in jsonData) {
        const sectionData = jsonData[sectionName];
        if(sectionName == 'RPT_Addresses' || sectionName == 'RPT_Phone' ||sectionName == 'RPT_Emails' ){
            if(sectionData.hasOwnProperty(attribute_Data[counter])){
                // console.log(sectionData);
                createTable_parallel(sectionName, sectionData);
            }
            else{
                createEmptyTable_parallel(sectionName, attribute_Data[counter]);
            }
            counter+=1;
        }
        else if (sectionName == 'Header'){
            createTable_header(sectionName, sectionData);
        }
        else{
            if(sectionName =='RPT_SubHeader') createTable_vertical("Date", sectionData);
            else createTable_vertical(sectionName, sectionData);
        }
    }
    
});
</script>

</body>
</html>

