<?php
// Check if the form is submitted
if(isset($_POST['submit'])) {
    // Get form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];

    // Validate and process the data
    if(!empty($firstName) && !empty($lastName) && !empty($email)) {
        // Check if the email limit is reached (20 emails)
        $emailCount = file_get_contents('email_count.txt');
        if ($emailCount < 20) {
            // Send an email confirmation
            $to = $email;
            $subject = 'Discount Confirmation';
            $message = "Hello $firstName $lastName,\n\nYou have successfully received a discount!";
            $headers = 'From: municipiumrezervacije@gmail.com';

            mail($to, $subject, $message, $headers);

            // Increment the email count
            file_put_contents('email_count.txt', $emailCount + 1);

            echo "Discount confirmation sent to $email";
        } else {
            echo "Sorry, the discount limit has been reached.";
        }
    } else {
        echo "Please fill out all fields.";
    }
}
?>
