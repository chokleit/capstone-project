<?php

include '../components/connect.php';

// Get the tutor ID from the cookie
if (isset($_COOKIE['tutor_id'])) {
    $tutor_id = $_COOKIE['tutor_id'];
} else {
    header('location:login.php'); // Redirect if no tutor ID is found
}

if (isset($_POST['submit'])) {

    $new_password = sha1($_POST['new_password']); // Hash the new password
    $confirm_password = sha1($_POST['confirm_password']);
    $secretquestion = $_POST['secretquestion'];
    $secretanswer = sha1($_POST['secretanswer']); // Hash the answer for security

    if ($new_password !== $confirm_password) {
        $message[] = 'Passwords do not match!';
    } else {
        // Update the password, secret question, and answer in the database
        $update_tutor = $conn->prepare("UPDATE `tutor` SET password = ?, secret_question = ?, secret_answer = ? WHERE id = ?");
        $update_tutor->execute([$new_password, $secretquestion, $secretanswer, $tutor_id]);

        if ($update_tutor) {
            $message[] = 'Password and security information updated successfully! You can now log in.';
            header('location:login.php'); // Redirect to login page
        } else {
            $message[] = 'Failed to update your information. Please try again.';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Password (Tutor)</title>
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body style="padding-left: 0;">

<?php
if (isset($message)) {
    foreach ($message as $msg) {
        echo '
        <div class="message form">
            <span>' . htmlspecialchars($msg) . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
        ';
    }
}
?>

<section class="form-container">
    <form action="" method="post" enctype="multipart/form-data" class="login">
        <h3>Create Your Password (Tutor)</h3>
        <p>New Password <span>*</span></p>
        <input type="password" name="new_password" placeholder="Enter your new password" maxlength="20" required class="box">
        <p>Confirm Password <span>*</span></p>
        <input type="password" name="confirm_password" placeholder="Confirm your new password" maxlength="20" required class="box">
        <p>Choose Secret Question: </p>
        <select name="secretquestion" class="box" required>
            <option value="What is the name of your first pet?">What is the name of your first pet?</option>
            <option value="What is the title of your favorite movie?">What is the title of your favorite movie?</option>
            <option value="What is your favorite food?">What is your favorite food?</option>
        </select>
        <input type="text" name="secretanswer" placeholder="Enter your answer" maxlength="50" required class="box">
        <input type="submit" name="submit" value="Create Password" class="btn">
    </form>
</section>

</body>
</html>
