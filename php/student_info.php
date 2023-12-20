<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Get Student Data</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        form {
            max-width: 800px;
            margin: auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        /* Added style for data display */
        .data-container {
            margin-top: 20px;
            padding: 20px;
            
            background-color: #fff;
        }

        /* Added style for the table */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .data-table th,
        .data-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-size:x-large;
        }

        .data-table th {
            background-color: #f2f2f2;
        }

        /* Added style for the edit form */
       

        
    </style>
</head>
<body>



<!-- Display data below the container -->
<div class="container data-container">
    <?php
    // Check if the form is submitted
 
        session_start();
        // Access the login ID from the session after the button click
        if (isset($_SESSION['admissionNumber'])) {
            $admissionNumber = $_SESSION['admissionNumber'];
        require 'config.php';
        $query = "SELECT * FROM studentdetails WHERE `Admission_Number` = '$admissionNumber'";
        $result = mysqli_query($conn, $query);

        // Display the retrieved data in a table with an edit option
        if ($result && mysqli_num_rows($result) > 0) {
            echo "<table class='data-table'>";
            $row = mysqli_fetch_assoc($result);

            foreach ($row as $key => $value) {
                echo "<tr>";
                echo "<th>{$key}</th>";
                echo "<td>{$value}</td>";
                echo "</tr>";
            }

            echo "</table>";

            // Add an edit button to show the edit form
            
        } else {
            echo "No data found for the given admission number.";
        }

            // Use $loginId as needed after the button click
        } else {
            echo "No data found for the given admission number.";

            // Handle case where login ID is not set (user might not be logged in)
        }
        z
        mysqli_close($conn);
    // }
    ?>
</div>

<!-- Bootstrap JS and dependencies (Optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>
</html>