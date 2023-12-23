<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <!-- Meta tags for character set and viewport -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title of the document -->
    <title>Payment History</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

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

        /* CSS styles for data container */
        .data-container {
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #fff;
            overflow-x: auto; /* Enable horizontal scroll for small screens */
        }

        /* CSS styles for the data table */
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
    </style>
</head>

<body>
    <!-- Container for content -->
    <div class="container">
        <!-- Heading 2 -->
        <h2>Get Data</h2>

        <!-- Data display container -->
        <div class="container data-container">
            <?php
            // Start session
            session_start();

            // Check if admission number is set in session
            if (isset($_SESSION['admissionNumber'])) {
                $admissionNumber = $_SESSION['admissionNumber'];
                require 'config.php'; // Include database connection

                // Function to build SQL query by admission number
                function buildQueryByAdmissionNumber($admissionNumber)
                {
                    return "SELECT * FROM payment_logs WHERE Admission_Number = '$admissionNumber'";
                }

                // Build and execute the query
                $query = buildQueryByAdmissionNumber($admissionNumber);
                $result = $conn->query($query);

                // Display payment history in a table if data exists
                if ($result && $result->num_rows > 0) {
                    echo '<table class="data-table mx-auto">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th>Date</th>';
                    echo '<th>Admission Number</th>';
                    echo '<th>Name</th>';
                    echo '<th>Fees Type</th>';
                    echo '<th>Amount Paid</th>';
                    echo '<th>Date Of Payment</th>';
                    echo '<th>UTR Number</th>';
                    // Add more columns as needed
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';

                    // Loop through query results and display in table rows
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
                    echo "No payment history found for the given admission number.";
                }

                // Close the database connection
                $conn->close();
            }
            ?>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies (Optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
