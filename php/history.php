<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <!-- Meta tags for character set and viewport -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title of the document -->
    <title>Get and Display Student Data</title>

    <!-- Bootstrap CSS -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- Internal CSS styles -->
    <style>
        /* CSS styles for the body */
        body {
            background-color: #f8f9fa;
        }

        /* CSS styles for the container */
        .container {
            margin-top: 50px;
        }

        /* CSS styles for heading 2 */
        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        /* CSS styles for form */
        form {
            max-width: 400px;
            margin: auto;
        }

        /* CSS styles for form group */
        .form-group {
            margin-bottom: 20px;
        }

        /* CSS styles for data container */
        .data-container {
            margin-top: 20px;
            padding: 20px;
        }

        /* CSS styles for data table */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        /* CSS styles for table header and data cells */
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
    </style>
    
    <!-- External CSS for navbar style -->
    <link rel="stylesheet" href="../css/navbarstyle.css">

</head>

<body>
    <!-- Container for content -->
    <div class="container">
        <!-- Navbar section -->
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
        
        <!-- Heading 2 -->
        <h2>Get and Display Student Data</h2>

        <div class="row">
            <div class="col-lg-6">
                <form method="post" action="" class="needs-validation" novalidate>
                    <div class="form-group">
                        <label for="admissionNumber">Admission Number:</label>
                        <input name="admissionNumber" type="text" class="form-control" id="admissionNumber" placeholder="Enter Admission Number" required>
                        <div class="invalid-feedback">
                            Please enter the admission number.
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Get History</button>
                </form> 
            </div>
            <div class="col-lg-6">
                <h4></h4>
                <label for="date">Get Details by Date:</label>
                <form method="post" action="" class="needs-validation" novalidate>
                    <div class="form-group">
                        <input name="date" type="date" class="form-control" id="date"  required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Get History</button>
                </form>                


            </div>
        </div>

        <!-- Form to get admission number -->

    </div>

    <!-- Display data below the container -->
    <div class="container data-container">
    <?php
    require 'vendor/autoload.php';
    require 'config.php';

    function buildQuery($field, $value)
    {
        $query = "SELECT * FROM payment_logs WHERE $field = '$value'";
        return $query;
    }

    function displayPaymentHistory($query)
    {
        require 'config.php';

        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            echo '<table class="data-table">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Date</th>';
            echo '<th>Admission Number</th>';
            echo '<th>Name</th>';
            echo '<th>Fees_Type</th>';
            echo '<th>Amount_paid</th>';
            echo '<th>Date Of Payment</th>';
            echo '<th>UTR_Number</th>';
            // Add more columns as needed
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['Date'] . '</td>';
                echo '<td>' . $row['Admission_Number'] . '</td>';
                echo '<td>' . $row['Name'] . '</td>';
                echo '<td>' . $row['Fees_Type'] . '</td>';
                echo '<td>' . $row['Amount_paid'] . '</td>';
                echo '<td>' . $row['Date_of_payment'] . '</td>';
                echo '<td>' . $row['UTR_Number'] . '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo "No payment history found.";
        }
    }

    if (isset($_POST['admissionNumber'])) {
        $admissionNumber = $_POST['admissionNumber'];
        $query = buildQuery('Admission_Number', $admissionNumber);
        displayPaymentHistory($query);
    }

    if (isset($_POST['date'])) {
        $date = $_POST['date'];
        $query = buildQuery('Date_of_payment', $date);
        displayPaymentHistory($query);
    }

    $conn->close();
?>

    </div>

    <!-- Bootstrap JS and dependencies (Optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
</body>

</html>
