<?php
// Establishing a connection to the database
$conn = mysqli_connect("localhost", "root", "", "paymentdetails");

// Initialize query with no filters
$query = "SELECT * FROM studentdetails WHERE 1";

// Check if year filter is set
if (!empty($_GET['year'])) {
    $query .= " AND Year = '{$_GET['year']}'";
}

// Check if scholarship filter is set
if (!empty($_GET['scholarship'])) {
    // Use backticks to handle the column name with a special character
    $query .= " AND `Jvd/Non_Jvd` = '{$_GET['scholarship']}'";
}

// Check if branch filter is set
if (!empty($_GET['branch'])) {
    $query .= " AND Branch = '{$_GET['branch']}'";
}

// Execute the query and retrieve the rows
$rows = mysqli_query($conn, $query);

// Displaying the fetched data in a table
echo "<table border='1'>";
echo "<tr>";
// Table headers
echo "<th>#</th>";
echo "<th>Admission Number</th>";
echo "<th>Name</th>";
echo "<th>Scholarship Id</th>";
echo "<th>Branch</th>";
echo "<th>Jvd/Non Jvd</th>";
echo "<th>Phone Number</th>";
echo "<th>CET Qualified</th>";
echo "<th>Admission Fees</th>";
echo "<th>Tuition Fee</th>";
echo "<th>Special Fee</th>";
echo "<th>UCS Fee</th>";
echo "<th>Due Amount</th>";
echo "</tr>";

// Initializing a counter
$i = 1;
$totalDueAmount = 0; // Initializing total due amount

// Loop through each row fetched from the database
foreach ($rows as $row) {
    echo "<tr>";
    // Displaying row data in table cells
    echo "<td>{$i}</td>";
    echo "<td>{$row['Admission_Number']}</td>";
    echo "<td>{$row['Name']}</td>";
    echo "<td>{$row['Scholorship_Id']}</td>";
    echo "<td>{$row['Branch']}</td>";
    echo "<td>{$row['Jvd/Non_Jvd']}</td>";
    echo "<td>{$row['Phone_Number']}</td>";
    echo "<td>{$row['CET_Qualified']}</td>";
    echo "<td>{$row['Admission_Fees']}</td>";
    echo "<td>{$row['Tution_fee']}</td>";
    echo "<td>{$row['Special_fee']}</td>";
    echo "<td>{$row['UCS_fee']}</td>";
    echo "<td>{$row['Due_Amount']}</td>";
    echo "</tr>";

    // Calculating total due amount
    $totalDueAmount += $row["Due_Amount"];
    $i++; // Incrementing counter
}

// Displaying the total due amount row
echo "<tr style=\"font-size: 2em;\">";
echo "<td colspan='12' >Total Due Amount:</td>";
echo "<td>{$totalDueAmount}</td>";
echo "</tr>";

echo "</table>"; // End of table
?>
