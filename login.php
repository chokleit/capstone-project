<?php

include 'components/connect.php';

if (isset($_POST['submit'])) {
   $student_number = filter_var($_POST['student_number'], FILTER_SANITIZE_STRING);
   $password = sha1($_POST['pass']); // Hash the input password

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE student_number = ? LIMIT 1");
   $select_user->execute([$student_number]);

   if ($select_user->rowCount() > 0) {
       $row = $select_user->fetch(PDO::FETCH_ASSOC);

       // Password verification
       if ($password === $row['password']) {
           // Set cookies for user ID and student number
           setcookie('user_id', $row['id'], time() + 60 * 60 * 24 * 30, '/');
           setcookie('student_number', $row['student_number'], time() + 60 * 60 * 24 * 30, '/');

           // Redirect based on password check
           if ($password === sha1('abcde')) { // Check if the password is 'abcde'
               header('location:createpass_tutor.php'); // Redirect to createpass_tutor.php
           } else {
               header('location:home.php'); // Redirect to home.php
           }
           exit;
       } else {
           $message[] = 'Incorrect student number or password!';
       }
   } else {
       $message[] = 'No user found!';
   }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible=IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="css/admin_style.css">
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
        <h3>Enter your student number and password to login.</h3>
        <p>Student Number <span>*</span></p>
        <input type="text" name="student_number" placeholder="Enter your student number" maxlength="50" required class="box">
        <p>Password <span>*</span></p>
        <input type="password" name="pass" placeholder="Enter your password" maxlength="20" required class="box">
        <input type="submit" name="submit" value="Login Now" class="btn">
    </form>
</section>

<script>
let darkMode = localStorage.getItem('dark-mode');
const body = document.body;

const enableDarkMode = () => {
    body.classList.add('dark');
    localStorage.setItem('dark-mode', 'enabled');
};

const disableDarkMode = () => {
    body.classList.remove('dark');
    localStorage.setItem('dark-mode', 'disabled');
};

darkMode === 'enabled' ? enableDarkMode() : disableDarkMode();
</script>

</body>
</html>
