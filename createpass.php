<?php

include 'components/connect.php';

// Get the student number from the cookie
if (isset($_COOKIE['student_number'])) {
    $student_number = $_COOKIE['student_number'];
} else {
    header('location:login.php'); // Redirect if no student number is found
}

if (isset($_POST['submit'])) {

    $new_password = sha1($_POST['new_password']); // Hash the new password
    $confirm_password = sha1($_POST['confirm_password']);
    $secretquestion = sha1($_POST['secretquestion']);
    $secretanswer = sha1($_POST['secretanswer']);

    if ($new_password !== $confirm_password) {
        $message[] = 'Passwords do not match!';
    } else {
        // Update the password, secret question, and answer in the database
        $update_user = $conn->prepare("UPDATE users SET password = ?, secret_question = ?, secret_answer = ? WHERE student_number = ?");
        $update_user->execute([$new_password, $secretquestion, $secretanswer, $student_number]);

        if ($update_user) {
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
    <title>Create a Password</title>
    <link rel="stylesheet" href="css/admin_style.css">
</head>
<body style="padding-left: 0;">

<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '
        <div class="message form">
            <span>' . $message . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
        ';
    }
}
?>

<section class="form-container">

    <form action="" method="post" enctype="multipart/form-data" class="login">
        <h3>Create Your Password</h3>
        <p>Student Number</p>
        <input type="text" name="student_number" value="<?= $student_number; ?>" readonly class="box">
        <p>New Password <span>*</span></p>
        <input type="password" name="new_password" placeholder="Enter your new password" maxlength="20" required class="box">
        <p>Confirm Password <span>*</span></p>

        <p>Choose Secret Question: </p>
            <select name="secretquestion" class="box">
               <option value="What is the name of your first pet?">What is the name of your first pet?</option>
               <option value="What is the title of your favorite movie?">What is the title of your favorite movie?</option>
               <option value="What is your favorite food?">What is your favorite food?</option>
            </select>
        <input type="text" name="secretanswer" placeholder="Enter your answer" maxlength="50" required class="box">
        <input type="password" name="confirm_password" placeholder="Confirm your new password" maxlength="20" required class="box">
        <input type="submit" name="submit" value="Create Password" class="btn">
    </form>

</section>

<script>
let darkMode = localStorage.getItem('dark-mode');
let body = document.body;

const enableDarkMode = () => {
    body.classList.add('dark');
    localStorage.setItem('dark-mode', 'enabled');
}

const disableDarkMode = () => {
    body.classList.remove('dark');
    localStorage.setItem('dark-mode', 'disabled');
}

if (darkMode === 'enabled') {
    enableDarkMode();
} else {
    disableDarkMode();
}
</script>

</body>
</html>