<?php
require_once '../classes/database.class.php';
require_once "../classes/student.class.php";

// Set the flag variable to false by default
$error = false;

// Check if the form has been submitted
if (isset($_POST['action']) && $_POST['action'] == 'add') {
    // Create a new Student object
    $students = new Student();

    $students->studentID = $_POST['studentID'];
    $students->studentFname = $_POST['firstname'];
    $students->studentLname = $_POST['lastname'];
    $students->studentYearLevel = $_POST['yearlevel'];
    $students->studentEmail = $_POST['email'];
    $students->programID = $_POST['program'];
    $students->studentCollege = $_POST['college'];

    // Validate studentFname to contain only letters and not exceed 20 characters
    if (!ctype_alpha($students->studentFname) || strlen($students->studentFname) > 20) {
        $error = true; // Set the flag variable to true
        echo '<script>alert("Invalid studentFname. Please enter only letters and maximum of 20 characters");</script>';
        echo '<script>window.location.href = "students.php";</script>';
        return;
} 
// Validate studentLname to contain only letters and not exceed 20 characters
    else if (!ctype_alpha($students->studentLname) || strlen($students->studentLname) > 20) {
        $error = true; // Set the flag variable to true
        echo '<script>alert("Invalid studentLname. Please enter only letters and maximum of 20 characters");</script>';
        echo '<script>window.location.href = "students.php";</script>';
        return;
}
   
    // Validate studentFname to contain only letters
    if (!ctype_alpha($students->studentFname)) {
        $error = true; // Set the flag variable to true
        echo '<script>alert("Invalid studentFname. Please enter only letters");</script>';
        echo '<script>window.location.href = "students.php";</script>';
        return;
    } 
    // Validate studentLname to contain only letters
    else if (!ctype_alpha($students->studentLname)) {
        $error = true; // Set the flag variable to true
        echo '<script>alert("Invalid studentLname. Please enter only letters");</script>';
        echo '<script>window.location.href = "students.php";</script>';
        return;
    } 
    // Validate studentEmail to contain only "@wmsu.edu.ph"
    else if (substr($students->studentEmail, -12) !== "@wmsu.edu.ph") {
        $error = true; // Set the flag variable to true
        echo '<script>alert("Invalid studentEmail. Please enter an email address that ends with @wmsu.edu.ph");</script>';
        echo '<script>window.location.href = "students.php";</script>'; // Redirect to students.php after displaying the error message
        return;
        }
    if (!$error) { // If there is no error, proceed with the form submission
        // Call the createStudent method to insert the new row into the student table
        if ($students->createStudent()) {
            // Redirect to a success page or display a success message
            header("Location: students.php");
            exit(); // add this line to stop executing the code
        } else {
            // Redirect to an error page or display an error message
            echo '<script>alert("Error creating student");</script>';
            return;
        }
        
    }
}

?>

<script>
    // Add an event listener to the form submission
    document.querySelector('form').addEventListener('submit', function(event) {
        if (<?php echo $error ? 'true' : 'false'; ?>) { // If there is an error, prevent the form from submitting and display an error message
            event.preventDefault();
            alert("Please correct the errors before submitting the form.");
            window.location.href = "students.php";
            
        }
    });
</script>
