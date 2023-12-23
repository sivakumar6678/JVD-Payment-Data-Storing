<?php
// Require the database configuration file
require 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Year Update Summary</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        /* Additional Custom Styles if needed */
        table{
            color:black;
            font-size:large;
        }
        th{
            font-weight:bold;
        }
        .btn{
            padding:1em;
            margin:1em 1em 2em 40%;
            font-size:large;
            font-weight:bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        try {
            // Fetch the count of students and the maximum current year
            $count_sql = "SELECT `Year`, COUNT(*) as total_students FROM studentdetails GROUP BY `Year` ORDER BY `Year` ASC";
            $result = $conn->query($count_sql);

            // Check if there are records
            if ($result->num_rows > 0) {
                $currentYear = 0;
                echo '<h1 class="text-center">Year Update Summary</h1>';
                echo '<h4 class="text-center">Verify and click on update years button to update year</h4>';

                while ($row = $result->fetch_assoc()) {
                    $year = $row['Year'];
                    $totalStudents = $row['total_students'];

                    // Calculate new year for updating
                    $newYear = $year + 1;
                    if($year <= 4){
                    // Display summary for each year with Bootstrap styles
                        if($newYear ==5){
                            $currentYear = date('Y');
                            echo "<table class='table table-bordered table-striped'> <tr> <th>Total Students in YEAR $year</th> <th>Current Year</th> <th>New Year</th> </tr> <tr> <td>$totalStudents </td> <td>$year</td> <td class='btn-danger'>$currentYear Passed Out Batch</td> </tr> </table>";
                            // echo "<p class='well'>Total Students in $year year:<b> $totalStudents </b> <br> <th>Current Year : $year </th> <br> <td>New Year: $currentYear PassedOut Batch</td></p>";
                        }
                        else{    
                            echo "<table class='table table-bordered table-striped'> <tr> <th>Total Students in YEAR $year</th> <th>Current Year</th> <th>New Year</th> </tr> <tr> <td>$totalStudents </td> <td>$year</td> <td class='info'>$newYear   </td> </tr> </table>";
                            // echo "<p class='well'>Total Students in $year year: $totalStudents - Current Year: $year - New Year: $newYear</p>";
                        }
                    }

                    $currentYear = $year;
                }

                // Display update button for the next year with Bootstrap styles
                if ($currentYear) {
                    $nextYear = $currentYear + 1;
                    echo '<form action="update_process.php" method="post">';
                    echo '<input type="hidden" name="new_year" value="' . $nextYear . '">';
                    echo '<input type="submit" class="btn btn-primary  text-center" value="Update Years">';
                    echo '</form>';
                } else {
                    echo '<p class="alert alert-info">Passout batch reached for current year on this date.</p>';
                }
            } else {
                echo "<p class='alert alert-warning'>No student records found.</p>";
            }
        } catch (Exception $e) {
            // Handle exceptions, redirect with error message
            $privio = "An error occurred while fetching student details";
            header("Location: ../file.html#?privio=" . urlencode($privio));
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
    <!-- Bootstrap JS and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
