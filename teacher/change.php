<?php

include '../components/connect.php';

if (isset($_COOKIE['tutor_id'])) {
    $tutor_id = $_COOKIE['tutor_id'];
} else {
    $tutor_id = '';
    header('location:login.php');
    exit;
}


if (isset($_POST['submit'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $secretanswer = filter_var($_POST['secretanswer'], FILTER_SANITIZE_STRING);
    $new_pass = sha1($_POST['new_pass']);
    $cpass = sha1($_POST['cpass']);

    // Update email
    if (!empty($email)) {
        $select_email = $conn->prepare("SELECT email FROM `users` WHERE email = ? AND id != ?");
        $select_email->execute([$email, $user_id]);
        if ($select_email->rowCount() > 0) {
            $message[] = 'Email is already in use by another account!';
        } else {
            $update_email = $conn->prepare("UPDATE `users` SET email = ? WHERE id = ?");
            $update_email->execute([$email, $user_id]);
            $message[] = 'Email updated successfully!';
        }
    }

    // Update secret answer (only, secret question is read-only)
    if (!empty($secretanswer)) {
        $update_secret = $conn->prepare("UPDATE `users` SET secretanswer = ? WHERE id = ?");
        $update_secret->execute([$secretanswer, $user_id]);
        $message[] = 'Secret answer updated successfully!';
    }

    // Update password
    if (!empty($new_pass) && !empty($cpass)) {
        if ($new_pass !== $cpass) {
            $message[] = 'Password confirmation does not match!';
        } else {
            $update_pass = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
            $update_pass->execute([$cpass, $user_id]);
            $message[] = 'Password updated successfully!';
        }
    } elseif (!empty($new_pass) || !empty($cpass)) {
        $message[] = 'Please fill in both the new password and confirm password!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update profile</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="stylesheet" href="../css/style.css">

</head>
<body>

<?php include '../components/teacher_header.php'; ?>

<section class="form-container" style="min-height: calc(100vh - 19rem);">

  <form action="" method="post" enctype="multipart/form-data">
     <h3>Account Settings</h3>
     <div class="flex">
        <div class="col">
           <p>your email</p>
           <input type="email" name="email" placeholder="<?= $fetch_profile['email']; ?>" maxlength="100" class="box">
           <p>secret question</p>
           <input type="text" name="secretquestion" placeholder="<?= $fetch_profile['secretquestion']; ?>" maxlength="50" class="box" readonly>
           <p>secret answer</p>
           <input type="text" name="secretanswer" placeholder="enter your answer" maxlength="50" class="box">
        </div>
        <div class="col">
        <br><br><br><br><br><br><br><br>
              <p>new password</p>
              <input type="password" name="new_pass" placeholder="enter your new password" maxlength="50" class="box">
              <p>confirm password</p>
              <input type="password" name="cpass" placeholder="confirm your new password" maxlength="50" class="box">
        </div>
     </div>
     <input type="submit" name="submit" value="update profile" class="btn">
  </form>

</section>


<!-- update profile section ends -->
<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>