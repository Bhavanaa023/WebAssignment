<?php
// Set content type to HTML (important for the AJAX response)
header('Content-Type: text/html');

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Basic sanitization and retrieval of POST data
    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : 'N/A';
    $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : 'N/A';
    $course = isset($_POST['course']) ? htmlspecialchars(trim($_POST['course'])) : 'N/A';
    $phone = isset($_POST['phone']) ? htmlspecialchars(trim($_POST['phone'])) : 'N/A';

    // --- Server-Side Validation (Basic) ---
    if (empty($name) || empty($email) || empty($course)) {
        // HTTP 400 Bad Request
        http_response_code(400); 
        echo "<p>❌ **Error:** Required fields (Name, Email, Course) were not submitted.</p>";
        exit;
    }

    // --- Success Output with Styling/Formatting ---
    
    // We can apply specific formatting here using inline styles or classes
    // which the jQuery script will then place inside the #response-message div.
    
    $output = "<p>✅ **Application Successfully Submitted!**</p>";
    $output .= "<hr style='border-top: 1px solid #c3e6cb;'>";
    $output .= "<p><strong>Applicant Name:</strong> <span style='color:#007bff;'>{$name}</span></p>";
    $output .= "<p><strong>Email:</strong> <em>{$email}</em></p>";
    $output .= "<p><strong>Course:</strong> <strong>{$course}</strong></p>";
    if (!empty($phone) && $phone !== 'N/A') {
        $output .= "<p><strong>Phone:</strong> {$phone}</p>";
    }
    $output .= "<p style='font-size:0.9em; margin-top:15px;'>Thank you for your interest. We will contact you soon.</p>";
    
    // Print the formatted HTML response back to the AJAX 'success' function
    echo $output;

} else {
    // If someone tries to access process.php directly
    http_response_code(405); // HTTP 405 Method Not Allowed
    echo "<p>❌ **Error:** Invalid request method.</p>";
}
?>