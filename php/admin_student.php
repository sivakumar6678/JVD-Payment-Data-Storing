<!-- The HTML document starts -->
<!DOCTYPE html>
<html lang="en" dir="ltr">

<!-- Head section containing meta tags, stylesheets, and scripts -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <title>Get and Update Student Data</title>

    <!-- Custom styles -->
    <link rel="stylesheet" href="../css/navbarstyle.css">
    
    <!-- Internal styles -->
    <style>
        /* CSS styles for the body */
        body {
            background-color: #f8f9fa;
        }

        /* CSS styles for heading 2 */
        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        /* CSS styles for forms */
        form {
            max-width: 400px;
            margin: auto;
        }

        /* CSS styles for form group */
        .form-group {
            margin-bottom: 20px;
        }

        /* CSS styles for data display container */
        .data-container {
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #fff;
            border: none;
            box-shadow: 0 0 10px 0 rgba(0,0,0,0.1);
        }

        /* CSS styles for data table */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        /* CSS styles for table headers and data cells */
        .data-table th,
        .data-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        /* CSS styles for table header */
        .data-table th {
            background-color: #f2f2f2;
        }

        /* CSS styles for the edit form */
        .edit-form {
            display: none; /* Initially hide the edit form */
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #fff;
        }

        /* CSS styles for the edit button */
        .edit-button {
            margin-top: 20px;
        }
    </style>
</head>

<!-- JavaScript code for displaying success message -->
<script>
    // JavaScript to display a success message
    window.onload = function() {
        function showMessage(param, bgColor) {
            // Retrieving the error message from URL parameters
            var errorMessage = getParameterByName(param);
            if (errorMessage) {
                // Displaying the error message with a specified background color
                var errorElement = document.getElementById('success');
                errorElement.innerText = errorMessage;
                errorElement.style.color = 'white';
                errorElement.style.fontSize = '20px';
                errorElement.style.backgroundColor = bgColor;
                // Additional styling for the message
                errorElement.style.margin = '10px';
                errorElement.style.padding = '0.1em 1em 0.1em 1em';
                errorElement.style.height = '32px'; // Adjust the height as needed
                errorElement.style.width = '100px'; // Adjust the width as needed
                errorElement.style.boxShadow = '0.1em 0.1em 0.2em 0.2em rgba(0, 0, 0, 1)'; // Adjust shadow values as needed
                errorElement.style.transition = 'height 0.3s linear, opacity 0.';
                // Hiding the message after a certain duration
                setTimeout(function() {
                    errorElement.style.height = '0';
                    errorElement.style.opacity = '0';
                    setTimeout(function() {
                        errorElement.style.display = 'none';
                    }, 500)
                }, 2500);
            }
        }

        function getParameterByName(name, url) {
            if (!url) url = window.location.href;
            name = name.replace(/[\[\]]/g, "\\$&");
            var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, " "));
        }

        showMessage('success_message', 'green'); // Call function to display success message
    }
</script>

<!-- Body section of the HTML document -->
<body>
    <!-- Container for navigation -->
    <div class="container">
        <!-- Navbar using Bootstrap -->
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
        <!-- Success message display area -->
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4 col-xs-12 text-center">
                <h4 id="chagecolor"> <span id="success"> </span></h4>
            </div>
        </div>
        <!-- Heading 2 -->
        <h2>Get and Update Student Data</h2>
        
        <!-- Form for getting student data -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="needs-validation" novalidate>
            <div class="form-group">
                <label for="admissionNumber">Admission Number:</label>
                <input type="text" class="form-control" id="admissionNumber" name="admissionNumber" placeholder="Enter Admission Number" required>
                <div class="invalid-feedback">
                    Please enter the admission number.
                </div>
            </div>
            <!-- Button for submitting the form -->
            <button type="submit" class="btn btn-primary btn-block">Get Data</button>
        </form>
    </div>

    <!-- Container for displaying retrieved data -->
    <div class="container data-container">
        <!-- PHP code to retrieve and display student data -->
        <?php
        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get the admission number from the form
            $admissionNumber = $_POST["admissionNumber"];

            // Perform database query to get student data
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
                echo "<div class='edit-button'>";
                echo "<button class='btn btn-warning' onclick='showEditForm()'>Edit</button>";
                echo "</div>";

                // Add an edit form with input fields for each column
                echo "<div class='edit-form' id='editForm'>";
                echo "<h3>Edit Data</h3>";
                echo "<form method='post' action='update.php'>";
                foreach ($row as $key => $value) {
                    echo "<div class='form-group'>";
                    echo "<label for='{$key}'>{$key}:</label>";
                    echo "<input type='text' class='form-control' id='{$key}' name='{$key}' value='{$value}' required>";
                    echo "</div>";
                }
                echo "<button type='submit' class='btn btn-primary'>Update Data</button>";
                echo "</form>";
                echo "</div>";
            } else {
                echo "No data found for the given admission number.";
            }

            // Close the database connection
            mysqli_close($conn);
        }
        ?>
    </div>

    <!-- JavaScript code to handle showing the edit form -->
    <script>
        function showEditForm() {
            document.getElementById('editForm').style.display = 'block';
        }
    </script>
</body>
</html>
