<?php

include '../components/connect.php';

if (isset($_COOKIE['tutor_id'])) {
    $tutor_id = $_COOKIE['tutor_id'];
} else {
    $tutor_id = '';
}

$prefix = "SN";
$year = date("Y");
$month = date("m");

// Generate the student number
$query = $conn->prepare("SELECT student_number FROM `users` WHERE student_number LIKE ? ORDER BY student_number DESC LIMIT 1");
$query->execute([$prefix . $year . $month . '%']);
$last_student_number = $query->fetchColumn();

if ($last_student_number) {
    $last_increment = (int)substr($last_student_number, -2);
    $new_increment = str_pad($last_increment + 1, 2, '0', STR_PAD_LEFT);
} else {
    $new_increment = "01";
}

$student_number = $prefix . $year . $month . $new_increment;

if (isset($_POST['submit'])) {
    $id = unique_id();
    $fname = filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
    $lname = filter_var($_POST['lname'], FILTER_SANITIZE_STRING);
    $mname = filter_var($_POST['mname'], FILTER_SANITIZE_STRING);
    $dob = filter_var($_POST['dob'], FILTER_SANITIZE_STRING);
    $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $contactnum = filter_var($_POST['contactnum'], FILTER_SANITIZE_STRING);
    $batch_number = filter_var($_POST['batch_number'], FILTER_SANITIZE_STRING);
    $course_id = filter_var($_POST['course'], FILTER_SANITIZE_STRING); // New field for course ID

    $password = sha1('12345'); // Default password

    $image = $_FILES['image']['name'] ? filter_var($_FILES['image']['name'], FILTER_SANITIZE_STRING) : '';
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $rename = unique_id() . '.' . $ext;
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_files/' . $rename;

    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array(strtolower($ext), $allowed_types)) {
            if (move_uploaded_file($image_tmp_name, $image_folder)) {
                // Insert student into `users` table
                $insert_user = $conn->prepare("INSERT INTO `users`(id, student_number, batch_number, fname, mname, lname, dob, address, email, contactnum, password, image) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
                $insert_user->execute([$id, $student_number, $batch_number, $fname, $mname, $lname, $dob, $address, $email, $contactnum, $password, $rename]);

                // Insert enrollment details into `enrollments` table
                $insert_enrollment = $conn->prepare("INSERT INTO `enrollments`(id, student_number, course_id, batch_number) VALUES(?,?,?,?)");
                $insert_enrollment->execute([$id, $student_number, $course_id, $batch_number]);

                $message = 'Student successfully registered and enrolled!';
                header('location:dashboard.php');
                exit;
            } else {
                $message = 'Failed to upload image.';
            }
        } else {
            $message = 'Invalid file type.';
        }
    } else {
        $message = 'Image upload error.';
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/teacher_header.php'; ?>

<section class="form-container">

   <form class="register" action="" method="post" enctype="multipart/form-data">
      <h3>create account</h3>
      <div class="flex">
         <div class="col">
         <h2>Personal Information</h2>
            <p>First Name<span>*</span></p>
            <input type="text" name="fname" placeholder="enter first name" maxlength="50" required class="box">
            <p>Last Name<span>*</span></p>
            <input type="text" name="lname" placeholder="enter last name" maxlength="20" required class="box">
         </div>
         <div class="col">
         <h2 class="hidden">Personal Information</h2>
            <p>Middle Name<span></span></p>
            <input type="text" name="mname" placeholder="enter middle name" maxlength="20" class="box">
            <p class="hidden"><span></span></p>
            <input type="text" name="none" placeholder="" maxlength="20" class="hidden">
         </div>
      </div>
      <div class="flex">
         <div class="col">
   
            <p>Date of Birth<span>*</span></p>
            <input type="date" name="dob" placeholder="eneter your name" maxlength="50" class="box">
            <h2>Account</h2>
            <p>Email</p>
            <input type="email" name="email" placeholder="enter your email" maxlength="20" class="box">
         </div>
         <div class="col">
            <p>Address<span>*</span></p>
            <input type="text" name="address" placeholder="enter your password" maxlength="20" required class="box">
            <h2 class="hidden"></h2>
            <p class="hidden" ></p>
            <input type="text" name="none" placeholder="" maxlength="20" class="hidden">
         </div>
         
      </div>

      <div class="flex">
         <div class="col">
         <p>Choose Batch<span>*</span></p>
<select name="course" class="box" required>
   <option value="" selected disabled>-- select batch --</option>
   <?php
   $select_batches = $conn->prepare("SELECT * FROM batch WHERE tutor_id = ? ORDER BY id DESC");
   $select_batches->execute([$tutor_id]);
   if ($select_batches->rowCount() > 0) {
      while ($batch = $select_batches->fetch(PDO::FETCH_ASSOC)) {
         echo '<option value="' . htmlspecialchars($batch['course_id']) . '" data-batch="' . htmlspecialchars($batch['batch_number']) . '">' . htmlspecialchars($batch['title']) . '</option>';
      }
   } else {
      echo '<option value="" disabled>No batches available</option>';
   }
   ?>
</select>
<p>Batch Number<span>*</span></p>
<input type="text" name="batch_number" id="batch_number" class="box" readonly required>  
            <p>Student Number<span>*</span></p>
            <input type="text" name="student_number" value="<?= $student_number; ?>" readonly class="box">
         </div>
         <div class="col">
            <p>Contact Number:<span>*</span></p>
            <input type="text" name="contactnum" placeholder="contact number" maxlength="20" required class="box">
            <p>Password: 12345 (default)</p>
         </div>
         
      </div>
      <p>select pic <span>*</span></p>
      <input type="file" name="image" accept="image/*" required class="box">
      <p class="link">already have an account? <a href="login.php">login now</a></p>
      <input type="submit" name="submit" value="register now" class="btn">
   </form>

</section>





<!-- custom js file link  -->
<script src="js/script.js"></script>
<script>
   // Select the batch dropdown and batch number input
   const batchDropdown = document.querySelector('select[name="course"]');
   const batchNumberInput = document.getElementById('batch_number');

   // Listen for changes in the dropdown
   batchDropdown.addEventListener('change', function () {
      // Get the selected option's data-batch attribute
      const selectedBatch = batchDropdown.options[batchDropdown.selectedIndex].getAttribute('data-batch');
      
      // Update the batch number input field
      batchNumberInput.value = selectedBatch || '';
   });
</script>
   
</body>
</html>