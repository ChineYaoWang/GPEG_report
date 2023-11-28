function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    let expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }

$(document).ready(function(){
    // show all studies
    if(document.getElementById("study_button")){
        $.ajax({
            type:"GET",
            url:"fetch_study.php",
            datatype:"json",
            success:function(data){
                html = "<option selected>--Select Study--</option>\n";
                var obj = JSON.parse(data);
                var set = new Set();
                for(var i = 0; i < obj.length; i++) {
                    if(!set.has(obj[i][1])){
                        set.add(obj[i][1]);
                        html += "<option value=" + "\"" + obj[i][1] + "\"" + ">" +obj[i][1] + "</option>\n";
                    }
                }
                document.getElementById("study_button").innerHTML = html;
            }
        })
    }

// ajax to get project based on the selected study
    if(document.getElementById("project_button")){
        $.ajax({
            type:"GET",
            url:"fetch_study.php",
            datatype:"json",
            success:function(data){
                var obj = JSON.parse(data);
                $("#study_button").change(function(){
                    html = "<option selected>--Select Project--</option>";
                    var chosen_study = document.getElementById("study_button");
                    var text = chosen_study.options[chosen_study.selectedIndex].text;
                    for(var i = 0; i < obj.length; i++) {
                        if( obj[i][1] == text){
                            html += "<option value=" + "\"" + obj[i][0] + "\"" +">"+obj[i][0] + "</option>";
                        }
                        
                    }
                    document.getElementById("project_button").innerHTML = html;
                });
            }
        })  
    }

    $("#project_button").hide();
    $("#no_token").hide();


    $("#study_button").change(function(){
        if(this.value == '--Select Study--'){
            $('#project_button').hide();
        } 
        else {
            $('#project_button').show();
        }
    });
    // ajax: get token if exist, else add token
    $('#get_token').submit(function(e){
        $("#get_token").hide();
        var study = document.getElementById("study_button").value;
        var project = document.getElementById("project_button").value;
        // set cookie
        setCookie("studyname",study,1);
        setCookie("projectname",project,1);
        var fromatdata = {'project_button':project,'study_button':study};
        e.preventDefault();
        $.ajax({
                url: "fetch_token.php",
                type: "GET",
                data:fromatdata,
                datatype: "json",
                success: function(token) {
                    if(token.result != "") {
                        if(token == "\"Token not found\""){
                            $("#no_token").show();
                        }
                        else{
                            $('#token_result').html("Redirecting.....Please Wait");
                            // fetch the content
                            var data_check = {'rpt_content':true};
                            $.ajax({
                                url: "connect.php",
                                type: "GET",
                                data:data_check,
                                datatype: "json",
                                success: function() {},
                                error: function(){console.log("failed fectching content");}    
                            });
                            ////////
                            window.location.href = "select_report.php";
                        }
                    }
                },
                error: function(){}             
        });
    
    }); 
    // ajax to add the token
    $('#add_token').submit(function(e){
        var study = document.getElementById("study_button").value;
        var project = document.getElementById("project_button").value;
        var token = document.getElementById("token").value;
        var fromatdata = {'project_button':project,'study_button':study,'token':token}
        e.preventDefault();
        $.ajax({
                url: "add_token.php",
                type: "POST",
                data:fromatdata,
                datatype: "json",
                success: function(token) {
                    alert(token);
                    window.location.href = "home.php";
                    
                },
                error: function(){}             
        });
    
    });

});
// Check if comfirm password and password match
function CheckPassword(){
    let message = document.getElementById("message").innerText;
    let message2 = document.getElementById("message2").innerText;
    let x = document.getElementById("ps")
    if(message === ""){
        if(message2 == "Matching" || "none" == document.getElementById("ps").style.display){
            return true;
        }
        else{
            
            return false;
        }
    }
    else{
        console.log(message);
        if(message == "Matching"){
            return true;
        }
        else{
            
            return false;
        }
    }
}
// toggle between edit user page and add user page
function SwitchFunction_usr(){
    $("#add-usr").toggle();
    document.getElementById("add-usr").reset();
    $("#edit-usr").toggle();
    document.getElementById("add-usr").reset();
    if(document.getElementById("title").innerText == "ADD"){
        document.getElementById("title").innerText = `EDIT`;
    }
    else{
        document.getElementById("title").innerText = `ADD`;
    }
   
    console.log(document.getElementById("title").innerText);
}
// toggle between edit study page and add study page
function SwitchFunction_std(){
    $("#add-study").toggle();
    document.getElementById("add-study").reset();
    $("#edit-study").toggle();
    document.getElementById("add-study").reset();
    if(document.getElementById("title").innerText == "ADD"){
        document.getElementById("title").innerText = `EDIT`;
    }
    else{
        document.getElementById("title").innerText = `ADD`;
    }
   
    console.log(document.getElementById("title").innerText);
}
// toggle between edit project page and add project page
function SwitchFunction_pjt(){
    $("#add-project").toggle();
    document.getElementById("add-project").reset();
    $("#edit-project").toggle();
    document.getElementById("edit-project").reset();


    if(document.getElementById("title").innerText == "ADD"){
        document.getElementById("title").innerText = `EDIT`;
    }
    else{
        document.getElementById("title").innerText = `ADD`;
    }
   
    console.log(document.getElementById("title").innerText);
}
// toggle between edit report page and add report page
function SwitchFunction_report(){
    if(document.getElementById('add-report')){
        if (document.getElementById('edit-report').style.display == 'none') {
            document.getElementById('edit-report').style.display = 'block';
            document.getElementById('add-report').style.display = 'none';
        }
        else {
            document.getElementById('edit-report').style.display = 'none';
            document.getElementById('add-report').style.display = 'block';
        }
    }
    console.log($("#edit-report").css('display'));



    if(document.getElementById("title").innerText == "ADD"){
        document.getElementById("title").innerText = `EDIT`;
    }
    else{
        document.getElementById("title").innerText = `ADD`;
    }
   
    console.log(document.getElementById("title").innerText);
}
// show study&projectpage and hide reportname page
function show_reset_sp(){
    $("#report").show();
    $("#sp").show();
    $("#rn").hide();
    document.getElementById("edit-report").reset();
}
// hide study&projectpage and show reportname page
function show_reset_report(){
    $("#report").show();
    $("#sp").hide();
    $("#rn").show();
    document.getElementById("edit-report").reset();
}
function handleRowClick(rowData) {
    // Log the selected row's data to the console
    console.log('Selected Row Data:', rowData);
}
// Define a flag to track whether a form submission is in progress
let lastClickedRow = null;
let isFormSubmitting = false;
function display_RPT_Header(data) {
    var TableContent = document.getElementById('TableContent');
    
    
    // Create a form element
    const form = document.createElement('form');
    form.id = 'RPT_header'; // Set an ID for the form
    form.method = 'POST'; // Specify the HTTP method
    form.action = 'connect.php'; // Specify the server endpoint to receive the data
    
    // Add submit button
    const buttonContainer = document.createElement('div');
    buttonContainer.classList.add('button-container');

    const submitButton = document.createElement('button');
    submitButton.textContent = 'Submit';
    submitButton.id = 'submit-button'; // Set the id attribute
    submitButton.style.fontSize = '14px'; // Adjust the font size as needed

    buttonContainer.appendChild(submitButton);


    const formContainer = document.getElementById('home');
    // Append the form to a container in the DOM
    formContainer.appendChild(form);

    // Create a div for the search bar and column selection
    const searchDiv = document.createElement('div');
    searchDiv.classList.add('search-div');

    // Create a search input element
    const searchInput = document.createElement('input');
    searchInput.setAttribute('type', 'text');
    searchInput.setAttribute('placeholder', 'Search...');
    searchInput.classList.add('search-input');

    // Create a column selection dropdown
    const columnSelect = document.createElement('select');
    const headers = ['record_id', 'g_famid', 'snw_parentchild_id', 'invite_name'];
    const headers_show = ['Record ID', 'Fam ID', 'S&W ID', 'Invite Name'];
    
    // Create hidden input fields to store row data
    const hiddenFields = {};
    headers.forEach(header => {
        const input = document.createElement('input');
        input.type = 'hidden'; // Hidden input field
        input.name = header; // Use the header as the input field name
        hiddenFields[header] = input;
        form.appendChild(input);
    });

    headers.forEach((header, index) => {
        const option = document.createElement('option');
        option.value = header;
        option.text = headers_show[index];
        columnSelect.appendChild(option);
    });
    

    // Create a table element
    const table = document.createElement('table');
    table.classList.add('data-table');

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
            cell.textContent = rowData[header];
            row.appendChild(cell);
        });

        row.addEventListener('click', () => {
            // prevent from muti-submission when clicking same row
            if (lastClickedRow !== row) {
                // Set the last click row
                lastClickedRow = row;
                // Remove the 'selected-row' class from all rows
                table.querySelectorAll('tbody tr').forEach(row => {
                    row.classList.remove('selected-row');
                });
                // Add the 'selected-row' class to the clicked row
                row.classList.add('selected-row');
                // Populate the hidden input fields with the row data
                headers.forEach(header => {
                    hiddenFields[header].value = rowData[header];
                });
                //Set the flag to indicate that a form submission is in progress
                isFormSubmitting = true;
                handleRowClick(rowData);
            }
        });
        tableBody.appendChild(row);
    });
    // Add event listener for input and column select
    searchInput.addEventListener('input', () => {
        filterTable(searchInput.value.toLowerCase(), columnSelect.value);
    });

    columnSelect.addEventListener('change', () => {
        filterTable(searchInput.value.toLowerCase(), columnSelect.value);
    });

    searchDiv.appendChild(searchInput);
    searchDiv.appendChild(columnSelect);
    table.appendChild(tableBody);

    // Create a div for fix searching bar
    const fixcontainer = document.createElement('div');
    fixcontainer.classList.add('fixed-search-container');

    // Append the searchDiv to a fixcontainer
    fixcontainer.appendChild(searchDiv);
    // Append the button to a fixcontainer
    fixcontainer.appendChild(buttonContainer);
    

    // Append the table to the TableContent div
    TableContent.innerHTML = ''; // Clear existing content


    // Create a div for table
    const tableContainer = document.createElement('div');
    tableContainer.classList.add('table-container');
    // Append the table to a table container 
    tableContainer.appendChild(table);


    // Append searching bar and table to content
    TableContent.appendChild(fixcontainer);
    TableContent.appendChild(tableContainer);

    // Set the position of header based on the height of fix container
    const totalHeight = fixcontainer.offsetHeight;
    tableHeader.style.top = `${totalHeight}px`;
    
    // Function to filter the table based on search input and selected column
    function filterTable(query, selectedColumn) {
        const columnIndex = headers.indexOf(selectedColumn);
        const rows = table.querySelectorAll('tbody tr');
        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            let found = false;
            cells.forEach((cell, index) => {
                if (index === columnIndex && cell.textContent.toLowerCase().includes(query)) {
                    found = true;
                }
            });
            row.style.display = found ? '' : 'none';
        });
    }
    
    submitButton.addEventListener('click', () => {
        handleSubmitButtonClick(form);
    });;
}
function handleSubmitButtonClick(form) {
    if (isFormSubmitting) {
        // Submit the form using ajax
        fetch('connect.php', {
            method: 'POST',
            body: new FormData(form),
        })
        .then(response => response.text()) // Adjust this based on the response format
        .then(responseData => {
            // Handle the response data here
            window.location.href = 'report.php?data=' + encodeURIComponent(responseData);
        })
        .catch(error => {
            console.error('Error:', error);
        });
        // Reset the flag after submission
        isFormSubmitting = false;
    }
    document.body.style.overflow = 'hidden';
    document.documentElement.style.overflow = 'hidden';
}



