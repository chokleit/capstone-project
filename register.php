<?php

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

$prefix = "SN";
$year = date("Y"); // Current year
$month = date("m"); // Current month

if ($month >= 6) { // June to December
   $batch_number = $year . '-' . ($year + 1);
} else { // January to May
   $batch_number = ($year - 1) . '-' . $year;
}

// Fetch the last student number for the current year and month
$query = $conn->prepare("SELECT student_number FROM `users` WHERE student_number LIKE ? ORDER BY student_number DESC LIMIT 1");
$query->execute([$prefix . $year . $month . '%']);
$last_student_number = $query->fetchColumn();

if ($last_student_number) {
    // Extract the last 2 digits of the student number and increment it
    $last_increment = (int)substr($last_student_number, -2); // Get the last 2 digits
    $new_increment = str_pad($last_increment + 1, 2, '0', STR_PAD_LEFT); // Increment and pad with leading zeros
} else {
    $new_increment = "01"; // Start with 01 if no entries exist for the current year and month
}

// Combine parts to create the student number
$student_number = $prefix . $year . $month . $new_increment;
if(isset($_POST['submit'])){
   // Process form submission
   $id = unique_id();
   $fname = $_POST['fname'];
   $fname = filter_var($fname, FILTER_SANITIZE_STRING);
   $lname = $_POST['lname'];
   $lname = filter_var($lname, FILTER_SANITIZE_STRING);
   $mname = $_POST['mname'];
   $mname = filter_var($mname, FILTER_SANITIZE_STRING);
   $dob = $_POST['dob'];
   $dob = filter_var($dob, FILTER_SANITIZE_STRING);
   $address = $_POST['address'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $secretquestion = $_POST['secretquestion'];
   $secretquestion = filter_var($secretquestion, FILTER_SANITIZE_STRING);
   $secretanswer = $_POST['secretanswer'];
   $secretanswer = filter_var($secretanswer, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $ext = pathinfo($image, PATHINFO_EXTENSION);
   $rename = unique_id().'.'.$ext;
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_files/'.$rename;

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select_user->execute([$email]);
   
   if($select_user->rowCount() > 0){
      $message[] = 'email already taken!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         $insert_user = $conn->prepare("INSERT INTO `users`(id, student_number, batch_number, fname, mname, lname, dob, address, email, secretquestion, secretanswer, password, image) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
         $insert_user->execute([$id, $student_number, $batch_number, $fname, $mname, $lname, $dob, $address, $email, $secretquestion, $secretanswer, $cpass, $rename]);
         move_uploaded_file($image_tmp_name, $image_folder);
         
         $verify_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ? LIMIT 1");
         $verify_user->execute([$email, $pass]);
         $row = $verify_user->fetch(PDO::FETCH_ASSOC);
         
         if($verify_user->rowCount() > 0){
            setcookie('user_id', $row['id'], time() + 60*60*24*30, '/');
            header('location:home.php');
         }
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
   <title>home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>

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
            <p>Middle Name<span>*</span></p>
            <input type="text" name="mname" placeholder="enter middle name" maxlength="20" required class="box">
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
           
            <p>Password<span>*</span></p>
            <input type="password" name="cpass" placeholder="password" maxlength="20" required class="box">
            
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
   
</body>
</html>