<?php
// Set up error reporting


// Database connection parameters
require 'config.php';

// Upload and process CSV file if it exists in the POST request
if (isset($_FILES['file'])) {
    // Get the uploaded file
    $file = $_FILES['file'];

    // Check if the file is uploaded successfully
    if ($file['error'] === UPLOAD_ERR_OK) {
        // Get the file path
        $filePath = $file['tmp_name'];

        // Open the CSV file
        $fileHandle = fopen($filePath, "r");

        // Check if the file is opened successfully
        if ($fileHandle !== FALSE) {
            // Skip the header row
            fgetcsv($fileHandle);

            // Loop through each row of the CSV file
            while (($row = fgetcsv($fileHandle)) !== FALSE) {
                // Prepare data for insertion into the database
                try {
                $data = [];
                $data[] = $row[0]; // Admission_Number
                $data[] = $row[1]; // Name
                $data[] = (int) $row[2]; // Year
                $data[] = $row[3]; // Branch
                $data[] = $row[4]; // Scholarship
                $data[] = $row[5]; // Accommodation
                $data[] = (int) $row[6]; // Phone_Number
                $data[] = $row[7]; // Email_Id
                $data[] = $row[8]; // Cet_Qualified
                $data[] = (int) $row[9]; // Cet_Qualified

                    // Construct SQL query to insert data into the database
                    $sql = "INSERT INTO studentdetails (Admission_Number, Name, Year, Branch, `Jvd/Non_Jvd`, Accommodation, Phone_Number, Email_Id, CET_Qualified, Scholorship_Id) VALUES ('" . implode("', '", $data) . "')";

                    // Execute the SQL query
                    if ($conn->query($sql) === TRUE) {
                        // Redirect with a success message if data is inserted successfully
                        $success_message = "Data inserted successfully";
                        header("Location: ../file.html#?success_message=" . urlencode($success_message));
                    } else {
                        // Redirect with a message indicating that the Admission Number already exists in the database
                        $privio = "Admission Number already exists";
                        header("Location: ../file.html#?privio=" . urlencode($privio));
                    }
                } catch (Exception $e) {
                    // Redirect with a message indicating that the file is already uploaded
                    $privio = "File already uploaded";
                    header("Location: ../file.html#?privio=" . urlencode($privio));
                }
            }

            // Close the file handle after processing all rows
            fclose($fileHandle);
        } else {
            echo "Error opening file.";
        }
    } else {
        // Redirect with an error message if file upload fails
        $errormsg = "Failed to Upload File";
        header("Location: ../file.html#?errormsg=" . urlencode($errormsg));
    }
}

// Close the database connection
$conn->close();
?>
