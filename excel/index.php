<?php require 'config.php'; ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 
    <link rel="stylesheet" href="../css/navbarstyle.css">

    <title>Export To Excel</title>
    <style>
        body {
            background: linear-gradient(to bottom,#f7f7f7, #dde6f4,  #9999e6);
            background-repeat:no-repeat;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
                background-color: #f5f5f5;
                border-radius: 8px;
                padding: 0;
                overflow-x: auto; /* Add this line */
        }

        .main {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            /* width: 100%; Set width to 100% */
            overflow-x: auto; /* Allow horizontal scrolling if needed */
            margin-top: 20px;
        }

        label {
            font-size: 16px;
            font-weight: bold;
        }

        select {
            margin-bottom: 20px;
            width: 200px;
        }

        button {
            margin-top: 20px;
        }

        table {

            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        #exportButton button {
            background-color: #28a745;
            margin-top: 20px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #exportButton button:hover {
            background-color: #218838;
        }
       
    </style>
</head>
<body>
        <div class="container">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">Admin Panel</a>
                    </div>
                    <div class="navbar-right">
                        <a href="logout.php" class="btn btn-danger navbar-btn">Logout</a>
                    </div>
                </div>
            </nav>
        </div>

        <div class="container main">
            <label for="year">Select Year:</label>
            <select id="year" name="year" class="form-control">
                <option value="">All Years</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
            
            <label for="scholarship">Select Jvd/Non-Jvd:</label>
            <select id="scholarship" name="scholarship" class="form-control">
                <option value="">Both</option>
                <option value="Jvd">Jvd</option>
                <option value="Non-Jvd">Non-Jvd</option>
            </select>
            
            <label for="branch">Select Branch:</label>
            <select id="branch" name="branch" class="form-control">
                <option value="">All Branches</option>
                <option value="CSE">CSE</option>
                <option value="ECE">ECE</option>
                <option value="EEE">EEE</option>
                <option value="MECH">MECH</option>
                <option value="CIVIL">CIVIL</option>
                <option value="FDT">FDT</option>
            </select>
            <button type="button" class="btn btn-primary" onclick="updateTable()">Apply Filters</button>
            
            <hr>
            
            <table class="table table-bordered table-responsive" id="dataTable">
                <!-- ... your table headers ... -->
            </table>
            
            <div id="exportButton">
                <button type="button" class="btn btn-success" onclick="exportToExcel()">Export To Excel</button>
            </div>
        </div>
        
    <!-- Bootstrap JS and dependencies (Optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script>
        function updateTable() {
            var year = document.getElementById('year').value;
            var scholarship = document.getElementById('scholarship').value;
            var branch = document.getElementById('branch').value;

            var url = 'data.php?year=' + year + '&scholarship=' + scholarship + '&branch=' + branch;

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("dataTable").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", url, true);
            xhttp.send();
        }

        function exportToExcel() {
            var year = document.getElementById('year').value;
            var scholarship = document.getElementById('scholarship').value;
            var branch = document.getElementById('branch').value;

            var url = 'export.php';
            if (year || scholarship || branch) {
                url += '?year=' + year + '&scholarship=' + scholarship + '&branch=' + branch;
            }

            window.location.href = url;
        }
    </script>

</body>

</html>
