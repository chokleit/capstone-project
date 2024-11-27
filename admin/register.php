<?php

include '../components/connect.php';

if(isset($_POST['submit'])){

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
   $profession = $_POST['profession'];
   $profession = filter_var($profession, FILTER_SANITIZE_STRING);
   $secretquestion = $_POST['secretquestion'];
   $secretquestion = filter_var($secretquestion, FILTER_SANITIZE_STRING);
   $secretanswer = $_POST['secretanswer'];
   $secretanswer = filter_var($secretanswer, FILTER_SANITIZE_STRING);
   $username = $_POST['username'];
   $username = filter_var($username, FILTER_SANITIZE_STRING);
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
   $image_folder = '../uploaded_files/'.$rename;

   $select_tutor = $conn->prepare("SELECT * FROM `tutors` WHERE email = ?");
   $select_tutor->execute([$email]);
   
   if($select_tutor->rowCount() > 0){
      $message[] = 'email already taken!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm passowrd not matched!';
      }else{
         $insert_tutor = $conn->prepare("INSERT INTO `tutors`(id, fname, mname, lname, dob, address, email, gender, profession, contactnum, secretquestion, secretanswer, username, password, image) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
         $insert_tutor->execute([$id, $fname, $mname, $lname, $dob, $address, $email, $gender, $profession, $contactnum, $secretquestion, $secretanswer, $username, $cpass, $rename]);
         move_uploaded_file($image_tmp_name, $image_folder);
         $message[] = 'new tutor registered! please login now';
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
   <title>Teachers - Register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body style="padding-left: 0;">

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message form">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<!-- register section starts  -->

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
         <p>Contact Number<span>*</span></p>
         <input type="text" name="contactnum" placeholder="enter your contact" maxlength="50" class="box">
            <p>Date of Birth<span>*</span></p>
            <input type="date" name="dob" placeholder="enter your name" maxlength="50" class="box">
            <h2>Account</h2>
            <p>Email<span>*</span></p>
            <input type="email" name="email" placeholder="enter your email" maxlength="100" required class="box">
         </div>
         <div class="col">
            <p>Address<span>*</span></p>
            <input type="text" name="address" placeholder="enter your password" maxlength="100" required class="box">
            <p>Gender <span>*</span></p>
            <select name="gender" class="box" required>
               <option value="" disabled selected>-- gender</option>
               <option value="teacher">Male</option>
               <option value="engineer">Female</option>
               <option value="engineer">Other</option>
            </select>
            <h2 class="hidden">Personal Information</h2>
            <p>profession <span>*</span></p>
            <select name="profession" class="box" required>
               <option value="" disabled selected>-- select your profession</option>
               <option value="teacher">teacher</option>
               <option value="engineer">student teacher</option>
            </select>
         </div>
         
      </div>

      <div class="flex">
         <div class="col">
            <p>Secret Question<span>*</span></p>
            <select name="secretquestion" class="box" required>
               <option value="" disabled selected>-- choose secret question</option>
               <option value="q1">What is the name of your first pet?</option>
               <option value="q2">What is your favorite movie?</option>
               <option value="q3">What is your favorite food?</option>
            </select>
            <p>Username<span>*</span></p>
            <input type="text" name="username" placeholder="enter your username" maxlength="20" required class="box">
         </div>
         <div class="col">
            <p>Secret Answer<span>*</span></p>
            <input type="text" name="secretanswer" placeholder="secret answer" maxlength="20" required class="box">
            <p>Password<span>*</span></p>
            <input type="password" name="cpass" placeholder="password" maxlength="20" required class="box">
            <p>Confirm Password<span>*</span></p>
            <input type="password" name="pass" placeholder="confirm your password" maxlength="20" required class="box">        
         </div>
         
      </div>
      <p>select pic <span>*</span></p>
      <input type="file" name="image" accept="image/*" required class="box">
      <p class="link">already have an account? <a href="login.php">login now</a></p>
      <input type="submit" name="submit" value="register now" class="btn">
   </form>

</section>

<!-- registe section ends -->












<script>

let darkMode = localStorage.getItem('dark-mode');
let body = document.body;

const enabelDarkMode = () =>{
   body.classList.add('dark');
   localStorage.setItem('dark-mode', 'enabled');
}

const disableDarkMode = () =>{
   body.classList.remove('dark');
   localStorage.setItem('dark-mode', 'disabled');
}

if(darkMode === 'enabled'){
   enabelDarkMode();
}else{
   disableDarkMode();
}

</script>
   
</body>
</html>