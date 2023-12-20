<?php
// Check if the form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create a new connection to the database
    require 'config.php';

    // Fetch the Admission Number from the form
    $adi = $_POST['Admission_Number'];
    echo "" . $adi; // Outputting the Admission Number

    // Get the edited data from the form
    $AdmissionNumber = $_POST['Admission_Number'];
    $Name = $_POST['Name'];
    $Year = $_POST['Year'];
    $Branch = $_POST['Branch'];
    $Scholarship = $_POST['Scholarship'];
    $Phone_Number = $_POST['Phone_Number'];
    $Tution_fee = $_POST['Tution_fee'];
    $Special_fee = $_POST['Special_fee'];
    $Other_fee = $_POST['Other_fee'];
    $Accommodation = $_POST['Accommodation'];
    $Email_Id = $_POST['Email_Id'];
    $Cet_Qualified = $_POST['Cet_Qualified'];

    // Prepare SQL query for updating studentdetails table
    $sql = "UPDATE `studentdetails` SET 
            `Admission_Number`='$AdmissionNumber',
            `Name`='$Name',
            `Year`='$Year',
            `Branch`='$Branch',
            `Scholarship`='$Scholarship',
            `Phone_Number`='$Phone_Number',
            `Tution_fee`='$Tution_fee',
            `Special_fee`='$Special_fee',
            `Other_fee`='$Other_fee',
            `Accommodation`='$Accommodation',
            `Email_Id`='$Email_Id',
            `Cet_Qualified`='$Cet_Qualified' 
            WHERE Admission_Number='$AdmissionNumber'";

    // Execute the SQL query
    $u = mysqli_query($conn, $sql);

    // Check if the query executed successfully
    if ($u === true) {
        // Redirect to the admin_student.php page with a success message
        $success_message = "Record Updated successfully";
        header("Location: admin_student.php#?success_message=" . urlencode($success_message));
    } else {
        // Output the error message if the query encountered an error
        echo "error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
